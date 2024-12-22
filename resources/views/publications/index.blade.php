@extends('layouts.app')

@section('content')
<h1>Student Paper Publications</h1>
<div class="mb-3">
    <a href="{{ route('publications.create') }}" class="btn btn-primary">Add New Publication</a>
</div>
<div class="mb-3">
    <form action="{{ route('publications.index') }}" method="GET" class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search publications" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Authors</th>
            <th>Journal</th>
            <th>Publication Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($publications as $publication)
        <tr>
            <td>{{ $publication->title }}</td>
            <td>{{ $publication->authors }}</td>
            <td>{{ $publication->journal }}</td>
            <td>{{ $publication->publication_date }}</td>
            <td>
                <a href="{{ route('publications.edit', $publication) }}" class="btn btn-sm btn-primary">Edit</a>
                @if($publication->document)
                    <a href="{{ route('publications.document', $publication) }}" class="btn btn-sm btn-info" target="_blank">View Document</a>
                @endif
                <form action="{{ route('publications.destroy', $publication) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $publications->links() }}
@endsection

