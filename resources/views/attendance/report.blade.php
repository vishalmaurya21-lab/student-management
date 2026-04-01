@extends('layouts.app')

@section('title', 'Attendance Report')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">📊 Attendance Report</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('attendance.report') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="student_id" class="form-label">Student</label>
                    <select class="form-control" id="student_id" name="student_id">
                        <option value="">All Students</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $student_id === (string)$student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->enrollment_no }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="date" class="form-control" id="from_date" name="from_date" value="{{ $from_date }}">
                </div>
                <div class="col-md-4">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="date" class="form-control" id="to_date" name="to_date" value="{{ $to_date }}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Student</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->student->name }}</td>
                        <td>{{ $attendance->attendance_date->format('d M Y') }}</td>
                        <td>
                            <span class="badge
                                {{ $attendance->status === 'present' ? 'bg-success' : '' }}
                                {{ $attendance->status === 'absent' ? 'bg-danger' : '' }}
                                {{ $attendance->status === 'late' ? 'bg-warning' : '' }}
                                {{ $attendance->status === 'leave' ? 'bg-info' : '' }}
                            ">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>
                        <td>{{ $attendance->remarks ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No attendance records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $attendances->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
