@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>👨‍🏫 Teachers Management</h1>
        <a href="{{ route('teacher.create') }}" class="btn btn-success">+ Add Teacher</a>
    </div>

    <div class="table-container">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Employee ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->department }}</td>
                        <td>{{ $teacher->employee_id }}</td>
                        <td>
                            <span class="badge {{ $teacher->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($teacher->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No teachers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $teachers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
