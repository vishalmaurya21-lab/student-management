@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">📊 Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card dashboard-stat stat-blue">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <h2>{{ $total_students }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card dashboard-stat stat-green">
                <div class="card-body">
                    <h5 class="card-title">Total Teachers</h5>
                    <h2>{{ $total_teachers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card dashboard-stat stat-orange">
                <div class="card-body">
                    <h5 class="card-title">Total Grades</h5>
                    <h2>{{ $total_grades }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card dashboard-stat stat-red">
                <div class="card-body">
                    <h5 class="card-title">Active Teachers</h5>
                    <h2>{{ $active_teachers }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Today's Attendance</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>Present:</strong> <span class="badge bg-success">{{ $today_present }}</span>
                    </p>
                    <p class="mb-2">
                        <strong>Absent:</strong> <span class="badge bg-danger">{{ $today_absent }}</span>
                    </p>
                    <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-primary mt-2">Mark Attendance</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('student.index') }}" class="btn btn-sm btn-outline-primary mb-2 w-100">Add Student</a>
                    <a href="{{ route('teacher.create') }}" class="btn btn-sm btn-outline-primary mb-2 w-100">Add Teacher</a>
                    <a href="{{ route('grade.create') }}" class="btn btn-sm btn-outline-primary mb-2 w-100">Add Grade</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Top Students</h5>
                </div>
                <div class="card-body">
                    @if($top_students->count() > 0)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Average Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($top_students as $student)
                                    <tr>
                                        <td>{{ $student->student->name }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ number_format($student->avg_score, 2) }}%
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No grades recorded yet</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Recent Grades</h5>
                </div>
                <div class="card-body">
                    @if($recent_grades->count() > 0)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_grades as $grade)
                                    <tr>
                                        <td>{{ $grade->student->name }}</td>
                                        <td>{{ $grade->subject }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $grade->grade }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No grades recorded yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
