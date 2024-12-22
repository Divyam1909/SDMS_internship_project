<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $internships = $request->user()->internships();

        if ($request->has('search')) {
            $internships->where('company', 'like', '%' . $request->search . '%')
                        ->orWhere('position', 'like', '%' . $request->search . '%');
        }

        $internships = $internships->paginate(10);

        return view('internships.index', compact('internships'));
    }

    public function create()
    {
        return view('internships.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company' => 'required|max:255',
            'position' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $internship = new Internship($validatedData);
        $internship->user_id = $request->user()->id;

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('internships', 'public');
            $internship->document = $path;
        }

        $internship->save();

        return redirect()->route('internships.index')->with('success', 'Internship added successfully.');
    }

    public function edit(Internship $internship)
    {
        return view('internships.edit', compact('internship'));
    }

    public function update(Request $request, Internship $internship)
    {
        $validatedData = $request->validate([
            'company' => 'required|max:255',
            'position' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $internship->update($validatedData);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('internships', 'public');
            $internship->document = $path;
            $internship->save();
        }

        return redirect()->route('internships.index')->with('success', 'Internship updated successfully.');
    }

    public function destroy(Internship $internship)
    {
        $internship->delete();
        return redirect()->route('internships.index')->with('success', 'Internship deleted successfully.');
    }

    public function viewDocument(Internship $internship)
    {
        if ($internship->document && Storage::disk('public')->exists($internship->document)) {
            return response()->file(storage_path('app/public/' . $internship->document));
        }
        abort(404, 'Document not found');
    }
}

