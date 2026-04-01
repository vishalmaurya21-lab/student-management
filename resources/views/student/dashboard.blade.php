<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <title>Document</title>
</head>
<body>

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
    
        // 🔍 Live search typing
        $('#search').on('keyup', function () {
            let query = $(this).val();
            fetchData(query);
        });
    
        // 📄 Pagination click (AJAX)
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
    
            let page = $(this).attr('href').split('page=')[1];
            let query = $('#search').val();
    
            fetchData(query, page);
        });
    
    });
    </script>

<div style="text-align:center; margin-bottom: 12px;" class="mt-4">
    <input
        type="text"
        id="search"
        name="search"
        placeholder="Search by name or email..."
        value="{{ $search ?? '' }}"
        autocomplete="off"
        style="padding: 8px 12px; width: 300px; font-size: 14px;"
    >
    {{-- Spinner shown while AJAX request is in flight --}}
    <span id="search-spinner" style="display:none; margin-left: 8px; font-size: 13px; color: #888;">
        Searching...
    </span>
</div>

{{-- data-url passes the route to script.js without Blade syntax in the .js file --}}
<div id="student-table" data-url="{{ route('student.show') }}">
    <table align="center" border="1" class='table table-borderrd'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Inrollment No</th>
                <th>Course</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->city }}</td>
                    <td>{{ $student->inrollment_no }}</td>
                    {{-- Fixed: courses() renamed to course() on the model --}}
                    <td>{{ $student->course?->course_name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary">Edit</a> |
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $students->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>
</body>
</html>