@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<div class="container">
    <div class="form-container">
        <h2 class="mb-4">➕ Add New Student</h2>

        <form action="{{ route('student.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="form-control @error('name') is-invalid @enderror" required>
                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required>
                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror" required>
                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="form-control @error('city') is-invalid @enderror" required>
                @error('city') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="enrollment_no" class="form-label">Enrollment No</label>
                <input type="text" name="enrollment_no" value="{{ old('enrollment_no') }}" placeholder="Enrollment No" class="form-control @error('enrollment_no') is-invalid @enderror" required>
                @error('enrollment_no') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <select name="course" class="form-control @error('course') is-invalid @enderror" required>
                    <option value="">Select Course</option>
                    <option value="MBA" {{ old('course') === 'MBA' ? 'selected' : '' }}>MBA</option>
                    <option value="MCA" {{ old('course') === 'MCA' ? 'selected' : '' }}>MCA</option>
                    <option value="BCA" {{ old('course') === 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="B.Tech" {{ old('course') === 'B.Tech' ? 'selected' : '' }}>B.Tech</option>
                    <option value="M.Tech" {{ old('course') === 'M.Tech' ? 'selected' : '' }}>M.Tech</option>
                </select>
                @error('course') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Add Student</button>
                <a href="{{ route('student.show') }}" class="btn btn-secondary">View Students</a>
            </div>
        </form>
    </div>
</div>
@endsection
