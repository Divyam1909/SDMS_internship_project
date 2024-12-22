<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $achievements = $request->user()->achievements();

        if ($request->has('search')) {
            $achievements->where('title', 'like', '%' . $request->search . '%');
        }

        $achievements = $achievements->paginate(10);

        return view('achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('achievements.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $achievement = new Achievement($validatedData);
        $achievement->user_id = $request->user()->id;

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('achievements', 'public');
            $achievement->document = $path;
        }

        $achievement->save();

        return redirect()->route('achievements.index')->with('success', 'Achievement added successfully.');
    }

    public function edit(Achievement $achievement)
    {
        return view('achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $achievement->update($validatedData);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('achievements', 'public');
            $achievement->document = $path;
            $achievement->save();
        }

        return redirect()->route('achievements.index')->with('success', 'Achievement updated successfully.');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return redirect()->route('achievements.index')->with('success', 'Achievement deleted successfully.');
    }

    public function viewDocument(Achievement $achievement)
    {
        if ($achievement->document && Storage::disk('public')->exists($achievement->document)) {
            return response()->file(storage_path('app/public/' . $achievement->document));
        }
        abort(404, 'Document not found');
    }
}

