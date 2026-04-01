@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">📋 Mark Attendance</h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('attendance.index') }}" class="d-flex gap-2">
                        <input type="date" name="date" class="form-control" value="{{ $date }}" required>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('attendance.report') }}" class="btn btn-info">📊 View Report</a>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Student Name</th>
                    <th>Enrollment No</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->enrollment_no }}</td>
                        <td>
                            @php
                                $attendance = $student->attendances->first();
                            @endphp
                            <form action="{{ route('attendance.store') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <input type="hidden" name="attendance_date" value="{{ $date }}">
                                <select name="status" class="form-select form-select-sm" style="width: 120px;" onchange="this.form.submit()" required>
                                    <option value="">Select</option>
                                    <option value="present" {{ $attendance?->status === 'present' ? 'selected' : '' }}>Present</option>
                                    <option value="absent" {{ $attendance?->status === 'absent' ? 'selected' : '' }}>Absent</option>
                                    <option value="late" {{ $attendance?->status === 'late' ? 'selected' : '' }}>Late</option>
                                    <option value="leave" {{ $attendance?->status === 'leave' ? 'selected' : '' }}>Leave</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            @if($attendance)
                                <small class="text-muted">{{ $attendance->remarks }}</small>
                            @endif
                        </td>
                        <td>
                            @if($attendance)
                                <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Clear attendance?')">Clear</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No students found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
