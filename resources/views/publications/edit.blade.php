@extends('layouts.app')

@section('content')
<h1>Edit Publication</h1>
<form action="{{ route('publications.update', $publication) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $publication->title }}" required>
    </div>
    <div class="mb-3">
        <label for="authors" class="form-label">Authors</label>
        <input type="text" class="form-control" id="authors" name="authors" value="{{ $publication->authors }}" required>
    </div>
    <div class="mb-3">
        <label for="journal" class="form-label">Journal</label>
        <input type="text" class="form-control" id="journal" name="journal" value="{{ $publication->journal }}" required>
    </div>
    <div class="mb-3">
        <label for="publication_date" class="form-label">Publication Date</label>
        <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ $publication->publication_date }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $publication->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="document" class="form-label">Document</label>
        <input type="file" class="form-control" id="document" name="document">
        @if($publication->document)
            <p>Current document: {{ basename($publication->document) }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

