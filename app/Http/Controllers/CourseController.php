<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = $request->user()->courses();

        if ($request->has('search')) {
            $courses->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('provider', 'like', '%' . $request->search . '%');
        }

        $courses = $courses->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'provider' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $course = new Course($validatedData);
        $course->user_id = $request->user()->id;

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('courses', 'public');
            $course->document = $path;
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course added successfully.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'provider' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $course->update($validatedData);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('courses', 'public');
            $course->document = $path;
            $course->save();
        }

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function viewDocument(Course $course)
    {
        if ($course->document && Storage::disk('public')->exists($course->document)) {
            return response()->file(storage_path('app/public/' . $course->document));
        }
        abort(404, 'Document not found');
    }
}

