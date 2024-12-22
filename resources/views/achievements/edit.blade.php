@extends('layouts.app')

@section('content')
<h1>Edit Achievement</h1>
<form action="{{ route('achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $achievement->title }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $achievement->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ $achievement->date }}" required>
    </div>
    <div class="mb-3">
        <label for="document" class="form-label">Document</label>
        <input type="file" class="form-control" id="document" name="document">
        @if($achievement->document)
            <p>Current document: {{ basename($achievement->document) }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

