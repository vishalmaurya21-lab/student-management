@extends('layouts.app')

@section('title', 'Add Grade')

@section('content')
<div class="container">
    <div class="form-container">
        <h2 class="mb-4">➕ Add New Grade</h2>

        <form action="{{ route('grade.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="student_id" class="form-label">Student</label>
                <select class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id') === (string)$student->id ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->enrollment_no }})
                        </option>
                    @endforeach
                </select>
                @error('student_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="course_id" class="form-label">Course</label>
                <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') === (string)$course->id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                @error('subject') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="marks_obtained" class="form-label">Marks Obtained</label>
                    <input type="number" step="0.01" class="form-control @error('marks_obtained') is-invalid @enderror" id="marks_obtained" name="marks_obtained" value="{{ old('marks_obtained') }}" required>
                    @error('marks_obtained') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="marks_total" class="form-label">Total Marks</label>
                    <input type="number" step="0.01" class="form-control @error('marks_total') is-invalid @enderror" id="marks_total" name="marks_total" value="{{ old('marks_total', 100) }}" required>
                    @error('marks_total') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="teacher_id" class="form-label">Teacher (Optional)</label>
                <select class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id">
                    <option value="">Select Teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id') === (string)$teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="comments" class="form-label">Comments</label>
                <textarea class="form-control @error('comments') is-invalid @enderror" id="comments" name="comments" rows="3">{{ old('comments') }}</textarea>
                @error('comments') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Add Grade</button>
                <a href="{{ route('grade.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
