<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_students = Student::count();
        $total_teachers = Teacher::count();
        $total_grades = Grade::count();
        $active_teachers = Teacher::where('status', 'active')->count();

        // Get attendance stats for today
        $today = date('Y-m-d');
        $today_present = Attendance::where('attendance_date', $today)
            ->where('status', 'present')
            ->count();
        $today_absent = Attendance::where('attendance_date', $today)
            ->where('status', 'absent')
            ->count();

        // Top performing students (by average grade)
        $top_students = Grade::selectRaw('student_id, AVG(CAST(marks_obtained AS DECIMAL(5,2))/CAST(marks_total AS DECIMAL(5,2))*100) as avg_score')
            ->groupBy('student_id')
            ->orderByDesc('avg_score')
            ->limit(5)
            ->with('student')
            ->get();

        // Recent grades
        $recent_grades = Grade::with(['student', 'teacher'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'total_students',
            'total_teachers',
            'total_grades',
            'active_teachers',
            'today_present',
            'today_absent',
            'top_students',
            'recent_grades'
        ));
    }
}
