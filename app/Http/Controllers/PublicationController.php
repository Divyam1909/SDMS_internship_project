<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $publications = $request->user()->publications();

        if ($request->has('search')) {
            $publications->where('title', 'like', '%' . $request->search . '%')
                         ->orWhere('journal', 'like', '%' . $request->search . '%');
        }

        $publications = $publications->paginate(10);

        return view('publications.index', compact('publications'));
    }

    public function create()
    {
        return view('publications.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'journal' => 'required|max:255',
            'publication_date' => 'required|date',
            'description' => 'required',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $publication = new Publication($validatedData);
        $publication->user_id = $request->user()->id;

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('publications', 'public');
            $publication->document = $path;
        }

        $publication->save();

        return redirect()->route('publications.index')->with('success', 'Publication added successfully.');
    }

    public function edit(Publication $publication)
    {
        return view('publications.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'journal' => 'required|max:255',
            'publication_date' => 'required|date',
            'description' => 'required',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $publication->update($validatedData);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('publications', 'public');
            $publication->document = $path;
            $publication->save();
        }

        return redirect()->route('publications.index')->with('success', 'Publication updated successfully.');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('publications.index')->with('success', 'Publication deleted successfully.');
    }

    public function viewDocument(Publication $publication)
    {
        if ($publication->document && Storage::disk('public')->exists($publication->document)) {
            return response()->file(storage_path('app/public/' . $publication->document));
        }
        abort(404, 'Document not found');
    }
}

