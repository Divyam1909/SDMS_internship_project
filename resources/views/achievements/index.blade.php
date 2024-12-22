@extends('layouts.app')

@section('content')
<h1>Student Achievements</h1>
<div class="mb-3">
    <a href="{{ route('achievements.create') }}" class="btn btn-primary">Add New Achievement</a>
</div>
<div class="mb-3">
    <form action="{{ route('achievements.index') }}" method="GET" class="form-inline">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search achievements" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($achievements as $achievement)
        <tr>
            <td>{{ $achievement->title }}</td>
            <td>{{ $achievement->date }}</td>
            <td>
                <a href="{{ route('achievements.edit', $achievement) }}" class="btn btn-sm btn-primary">Edit</a>
                @if($achievement->document)
                    <a href="{{ route('achievements.document', $achievement) }}" class="btn btn-sm btn-info" target="_blank">View Document</a>
                @endif
                <form action="{{ route('achievements.destroy', $achievement) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $achievements->links() }}
@endsection

