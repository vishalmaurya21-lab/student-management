<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $search = $request->input('search');

        $query = Student::with(['attendances' => function ($q) use ($date) {
            $q->where('attendance_date', $date);
        }]);

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('enrollment_no', 'like', "%{$search}%");
        }

        $students = $query->paginate(10);

        return view('attendance.index', compact('students', 'date', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'      => 'required|exists:students,id',
            'attendance_date' => 'required|date',
            'status'          => 'required|in:present,absent,late,leave',
            'remarks'         => 'nullable|string',
        ]);

        Attendance::updateOrCreate(
            ['student_id' => $validated['student_id'], 'attendance_date' => $validated['attendance_date']],
            ['status' => $validated['status'], 'remarks' => $validated['remarks']]
        );

        return redirect()->back()->with('success', 'Attendance recorded successfully');
    }

    public function report(Request $request)
    {
        $student_id = $request->input('student_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date', date('Y-m-d'));

        $students = Student::all();

        $query = Attendance::with('student');

        if ($student_id) {
            $query->where('student_id', $student_id);
        }

        if ($from_date) {
            $query->whereBetween('attendance_date', [$from_date, $to_date]);
        }

        $attendances = $query->paginate(10);

        return view('attendance.report', compact('attendances', 'students', 'student_id', 'from_date', 'to_date'));
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Attendance deleted successfully');
    }
}
