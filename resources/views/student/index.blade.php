<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <form action="{{ route('student.store') }}" method="post" class="form-control w-50 mx-auto mt-5 p-4">
        <h2 class="text-center">Student Registration Form</h2>
        @csrf
        
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        <br>
        
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        <br>
        
        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone" class="form-control">
        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        <br>
        
        <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="form-control">
        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
        <br>
        
        <input type="text" name="enrollment_no" value="{{ old('enrollment_no') }}" placeholder="Enrollment No" class="form-control">
        @error('enrollment_no') <span class="text-danger">{{ $message }}</span> @enderror
        <br>
        
        <select name="course" class="form-control">
            <option value="">Select Course</option>
            <option value="MBA">MBA</option>
            <option value="MCA">MCA</option>
            <option value="BCA">BCA</option>
        </select>
        @error('course') <span class="text-danger">{{ $message }}</span> @enderror
        <br>
    
        <button type="submit" class="btn btn-primary w-100">Submit</button>
        <br><br>
        
        <a href="{{ route('student.show') }}" class="btn btn-secondary w-100">View</a>
    </form>
    
</body>
</html>