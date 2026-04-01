@extends('layouts.app')

@section('title', 'View Students')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>👥 Students Management</h1>
        <a href="{{ route('student.index') }}" class="btn btn-success">+ Add Student</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <input
                type="text"
                id="search"
                name="search"
                placeholder="Search by name or email..."
                value="{{ $search ?? '' }}"
                autocomplete="off"
                class="form-control"
            >
        </div>
    </div>

    <div class="table-container">
        <div id="student-table">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Enrollment No</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->city }}</td>
                            <td>{{ $student->enrollment_no }}</td>
                            <td><span class="badge bg-info">{{ $student->course?->course_name ?? 'N/A' }}</span></td>
                            <td>
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No students found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $students->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function fetchData(query = '', page = 1) {
        $.ajax({
            url: "{{ route('student.show') }}?page=" + page + "&search=" + query,
            success: function (data) {
                $('#student-table').html(data);
            }
        });
    }

    $('#search').on('keyup', function () {
        let query = $(this).val();
        fetchData(query);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        fetchData(query, page);
    });
});
</script>
@endsection
