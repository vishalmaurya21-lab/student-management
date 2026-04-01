<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $grades = Grade::with(['student', 'course', 'teacher'])
            ->when($search, function ($query, $search) {
                $query->whereHas('student', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('enrollment_no', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('grade.index', compact('grades', 'search'));
    }

    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        $teachers = Teacher::where('status', 'active')->get();
        return view('grade.create', compact('students', 'courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'    => 'required|exists:students,id',
            'course_id'     => 'required|exists:courses,id',
            'teacher_id'    => 'nullable|exists:teachers,id',
            'subject'       => 'required|string',
            'marks_obtained' => 'required|numeric|min:0',
            'marks_total'   => 'required|numeric|min:1',
            'comments'      => 'nullable|string',
        ]);

        // Calculate grade automatically
        $percentage = ($validated['marks_obtained'] / $validated['marks_total']) * 100;
        if ($percentage >= 90) $validated['grade'] = 'A';
        elseif ($percentage >= 80) $validated['grade'] = 'B';
        elseif ($percentage >= 70) $validated['grade'] = 'C';
        elseif ($percentage >= 60) $validated['grade'] = 'D';
        else $validated['grade'] = 'F';

        Grade::create($validated);
        return redirect()->route('grade.index')->with('success', 'Grade added successfully');
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $students = Student::all();
        $courses = Course::all();
        $teachers = Teacher::where('status', 'active')->get();
        return view('grade.edit', compact('grade', 'students', 'courses', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id'    => 'required|exists:students,id',
            'course_id'     => 'required|exists:courses,id',
            'teacher_id'    => 'nullable|exists:teachers,id',
            'subject'       => 'required|string',
            'marks_obtained' => 'required|numeric|min:0',
            'marks_total'   => 'required|numeric|min:1',
            'comments'      => 'nullable|string',
        ]);

        $percentage = ($validated['marks_obtained'] / $validated['marks_total']) * 100;
        if ($percentage >= 90) $validated['grade'] = 'A';
        elseif ($percentage >= 80) $validated['grade'] = 'B';
        elseif ($percentage >= 70) $validated['grade'] = 'C';
        elseif ($percentage >= 60) $validated['grade'] = 'D';
        else $validated['grade'] = 'F';

        Grade::findOrFail($id)->update($validated);
        return redirect()->route('grade.index')->with('success', 'Grade updated successfully');
    }

    public function destroy($id)
    {
        Grade::findOrFail($id)->delete();
        return redirect()->route('grade.index')->with('success', 'Grade deleted successfully');
    }
}
