@extends('layouts.app')

@section('content')
<h1>Add New Publication</h1>
<form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="authors" class="form-label">Authors</label>
        <input type="text" class="form-control" id="authors" name="authors" required>
    </div>
    <div class="mb-3">
        <label for="journal" class="form-label">Journal</label>
        <input type="text" class="form-control" id="journal" name="journal" required>
    </div>
    <div class="mb-3">
        <label for="publication_date" class="form-label">Publication Date</label>
        <input type="date" class="form-control" id="publication_date" name="publication_date" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="document" class="form-label">Document</label>
        <input type="file" class="form-control" id="document" name="document">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

