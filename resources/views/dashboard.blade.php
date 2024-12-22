@extends('layouts.app')

@section('content')
<h1 class="mb-4">Dashboard</h1>
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="text-center mb-3">
                    <i class="fas fa-trophy fa-2x text-primary"></i>
                </div>
                <h5 class="card-title text-center">Student Achievements</h5>
                <p class="card-text flex-grow-1 text-center">Manage your achievements</p>
                <a href="{{ route('achievements.index') }}" class="btn btn-primary mt-auto">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="text-center mb-3">
                    <i class="fas fa-briefcase fa-2x text-success"></i>
                </div>
                <h5 class="card-title text-center">Student Internships</h5>
                <p class="card-text flex-grow-1 text-center">Manage your internships</p>
                <a href="{{ route('internships.index') }}" class="btn btn-primary mt-auto">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="text-center mb-3">
                    <i class="fas fa-graduation-cap fa-2x text-info"></i>
                </div>
                <h5 class="card-title text-center">Student Courses & Workshops</h5>
                <p class="card-text flex-grow-1 text-center">Manage your courses and workshops</p>
                <a href="{{ route('courses.index') }}" class="btn btn-primary mt-auto">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <div class="text-center mb-3">
                    <i class="fas fa-book fa-2x text-warning"></i>
                </div>
                <h5 class="card-title text-center">Student Paper Publications</h5>
                <p class="card-text flex-grow-1 text-center">Manage your paper publications</p>
                <a href="{{ route('publications.index') }}" class="btn btn-primary mt-auto">View</a>
            </div>
        </div>
    </div>
</div>
@endsection

