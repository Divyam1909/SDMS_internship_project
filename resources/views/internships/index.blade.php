@extends('layouts.app')

@section('content')
<h1>Student Internships</h1>
<div class="mb-3">
    <a href="{{ route('internships.create') }}" class="btn btn-primary">Add New Internship</a>
</div>
<div class="mb-3">
    <form action="{{ route('internships.index') }}" method="GET" class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search internships" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Company</th>
            <th>Position</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($internships as $internship)
        <tr>
            <td>{{ $internship->company }}</td>
            <td>{{ $internship->position }}</td>
            <td>{{ $internship->start_date }}</td>
            <td>{{ $internship->end_date }}</td>
            <td>
                <a href="{{ route('internships.edit', $internship) }}" class="btn btn-sm btn-primary">Edit</a>
                @if($internship->document)
                    <a href="{{ route('internships.document', $internship) }}" class="btn btn-sm btn-info" target="_blank">View Document</a>
                @endif
                <form action="{{ route('internships.destroy', $internship) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $internships->links() }}
@endsection

