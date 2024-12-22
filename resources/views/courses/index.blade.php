@extends('layouts.app')

@section('content')
<h1>Student Courses & Workshops</h1>
<div class="mb-3">
    <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
</div>
<div class="mb-3">
    <form action="{{ route('courses.index') }}" method="GET" class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search courses" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Provider</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{ $course->title }}</td>
            <td>{{ $course->provider }}</td>
            <td>{{ $course->start_date }}</td>
            <td>{{ $course->end_date }}</td>
            <td>
                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-primary">Edit</a>
                @if($course->document)
                    <a href="{{ route('courses.document', $course) }}" class="btn btn-sm btn-info" target="_blank">View Document</a>
                @endif
                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $courses->links() }}
@endsection

