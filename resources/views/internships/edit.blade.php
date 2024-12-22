@extends('layouts.app')

@section('content')
<h1>Edit Internship</h1>
<form action="{{ route('internships.update', $internship) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="company" class="form-label">Company</label>
        <input type="text" class="form-control" id="company" name="company" value="{{ $internship->company }}" required>
    </div>
    <div class="mb-3">
        <label for="position" class="form-label">Position</label>
        <input type="text" class="form-control" id="position" name="position" value="{{ $internship->position }}" required>
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $internship->start_date }}" required>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $internship->end_date }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $internship->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="document" class="form-label">Document</label>
        <input type="file" class="form-control" id="document" name="document">
        @if($internship->document)
            <p>Current document: {{ basename($internship->document) }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

