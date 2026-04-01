@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="container">
    <div class="form-container">
        <h2 class="mb-4">✏️ Edit Student</h2>

        <form action="{{ route('student.update', $student->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $student->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" name="phone" value="{{ old('phone', $student->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" value="{{ old('city', $student->city) }}" class="form-control @error('city') is-invalid @enderror" required>
                @error('city') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="enrollment_no" class="form-label">Enrollment No</label>
                <input type="text" name="enrollment_no" value="{{ old('enrollment_no', $student->enrollment_no) }}" class="form-control @error('enrollment_no') is-invalid @enderror" required>
                @error('enrollment_no') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <select name="course" class="form-control @error('course') is-invalid @enderror" required>
                    <option value="">Select Course</option>
                    @foreach(['MBA', 'MCA', 'BCA', 'B.Tech', 'M.Tech', 'Maths', 'Physics', 'Laravel'] as $option)
                        <option value="{{ $option }}" {{ $student->course?->course_name === $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error('course') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('student.show') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
