@extends('layouts.app')

@section('content')
<h1>Edit Course</h1>
<form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $course->title }}" required>
    </div>
    <div class="mb-3">
        <label for="provider" class="form-label">Provider</label>
        <input type="text" class="form-control" id="provider" name="provider" value="{{ $course->provider }}" required>
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $course->start_date }}" required>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $course->end_date }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $course->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="document" class="form-label">Document</label>
        <input type="file" class="form-control" id="document" name="document">
        @if($course->document)
            <p>Current document: {{ basename($course->document) }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

