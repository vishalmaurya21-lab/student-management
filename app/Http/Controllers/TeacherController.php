<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::paginate(10);
        return view('teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'email'         => 'required|email|unique:teachers',
            'phone'         => 'required',
            'department'    => 'required',
            'employee_id'   => 'required|unique:teachers',
            'qualifications' => 'nullable|string',
        ]);

        Teacher::create($validated);
        return redirect()->route('teacher.index')->with('success', 'Teacher added successfully');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'email'         => 'required|email|unique:teachers,email,' . $id,
            'phone'         => 'required',
            'department'    => 'required',
            'employee_id'   => 'required|unique:teachers,employee_id,' . $id,
            'qualifications' => 'nullable|string',
            'status'        => 'required|in:active,inactive',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($validated);
        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully');
    }

    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();
        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully');
    }
}
