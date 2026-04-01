<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course; 
use Illuminate\Http\Request;


class StudentController extends Controller
{

    public function index()
    {
        return view('student.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email',
            'phone'         => 'required',
            'city'          => 'required',
            'inrollment_no' => 'required',
            'course'        => 'required',
        ]); 

        $student = Student::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'city'          => $request->city,
            'inrollment_no' => $request->inrollment_no,
        ]);

        Course::create([
            'student_id'  => $student->id,
            'course_name' => $request->course,
        ]);

        return redirect()->route('student.index')->with('success', 'Student created successfully');
    }

    public function show(Request $request)
    {
        $search = $request->input('search');

        $students = Student::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        })->paginate(5);

        // 👇 ADD THIS (important for live search)
        if ($request->ajax()) {
            return view('student.dashboard', compact('students'))->render();
        }

        return view('student.dashboard', compact('students', 'search'));
    }

    public function edit($id)
    {
        // Fixed: findOrFail gives a clean 404 instead of crashing on null
        $student = Student::findOrFail($id);
        return view('student.edit', compact('student'));
    }
    
    public function update(Request $request, $id)
    {
        // Fixed: validate first, then update only known fields (was $request->all() with no validation)
        $validated = $request->validate([
            'name'          => 'required',
            'email'         => 'required|email',
            'phone'         => 'required',
            'city'          => 'required',
            'inrollment_no' => 'required',
            'course'        => 'required',
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name'          => $validated['name'],
            'email'         => $validated['email'],
            'phone'         => $validated['phone'],
            'city'          => $validated['city'],
            'inrollment_no' => $validated['inrollment_no'],
        ]);

        // Update or create the related course record
        $student->course()->updateOrCreate(
            ['student_id' => $student->id],
            ['course_name' => $validated['course']]
        );

        return redirect()->route('student.show')->with('success', 'Student updated successfully');
    } 

    public function destroy($id)
    {
        // Fixed: findOrFail instead of find (avoids crash on missing record)
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('student.show')->with('success', 'Student deleted successfully');
    }
}