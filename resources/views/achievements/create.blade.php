@extends('layouts.app')

@section('content')
<h1>Add New Achievement</h1>
<form action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div class="mb-3">
        <label for="document" class="form-label">Document</label>
        <input type="file" class="form-control" id="document" name="document">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

