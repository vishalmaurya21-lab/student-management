@extends('layouts.app')

@section('title', 'Grades')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📊 Grades Management</h1>
        <a href="{{ route('grade.create') }}" class="btn btn-success">+ Add Grade</a>
    </div>

    <div class="table-container">
        <div class="mb-3">
            <form method="GET" action="{{ route('grade.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search by student name or enrollment..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Student</th>
                    <th>Enrollment No</th>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Teacher</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $grade)
                    <tr>
                        <td>{{ $grade->student->name }}</td>
                        <td>{{ $grade->student->enrollment_no }}</td>
                        <td>{{ $grade->subject }}</td>
                        <td>{{ $grade->marks_obtained }} / {{ $grade->marks_total }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $grade->grade }}</span>
                        </td>
                        <td>{{ $grade->teacher?->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('grade.edit', $grade->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('grade.destroy', $grade->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No grades found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $grades->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
