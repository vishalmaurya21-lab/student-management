<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample teachers
        $teachers = [
            [
                'name' => 'Dr. John Smith',
                'email' => 'john.smith@school.edu',
                'phone' => '9876543210',
                'department' => 'Computer Science',
                'employee_id' => 'EMP001',
                'qualifications' => 'Ph.D. in Computer Science',
                'status' => 'active',
            ],
            [
                'name' => 'Prof. Sarah Johnson',
                'email' => 'sarah.johnson@school.edu',
                'phone' => '9876543211',
                'department' => 'Mathematics',
                'employee_id' => 'EMP002',
                'qualifications' => 'M.Sc. in Mathematics',
                'status' => 'active',
            ],
            [
                'name' => 'Dr. Michael Brown',
                'email' => 'michael.brown@school.edu',
                'phone' => '9876543212',
                'department' => 'Physics',
                'employee_id' => 'EMP003',
                'qualifications' => 'Ph.D. in Physics',
                'status' => 'active',
            ],
        ];

        $teachers = Teacher::insert($teachers);

        // Create sample courses
        $courses = [
            ['course_name' => 'MBA'],
            ['course_name' => 'MCA'],
            ['course_name' => 'BCA'],
            ['course_name' => 'B.Tech'],
            ['course_name' => 'M.Tech'],
        ];

        // Create sample students
        $studentNames = ['John Doe', 'Jane Smith', 'Robert Wilson', 'Emma Davis', 'Michael Johnson'];
        $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix'];

        foreach ($studentNames as $index => $name) {
            $student = Student::create([
                'name' => $name,
                'email' => 'student' . ($index + 1) . '@school.edu',
                'phone' => '555000' . ($index + 1),
                'city' => $cities[$index],
                'enrollment_no' => 'ENR' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),
            ]);

            // Create course for student
            Course::create([
                'student_id' => $student->id,
                'course_name' => $courses[$index % count($courses)]['course_name'],
            ]);

            // Create sample grades
            $subjects = ['Mathematics', 'Physics', 'Computer Science', 'Programming', 'Database'];
            foreach ($subjects as $subIdx => $subject) {
                Grade::create([
                    'student_id' => $student->id,
                    'course_id' => $student->id,
                    'teacher_id' => ($subIdx % 3) + 1,
                    'subject' => $subject,
                    'marks_obtained' => rand(65, 98),
                    'marks_total' => 100,
                    'grade' => chr(65 + rand(0, 4)), // A-E
                ]);
            }

            // Create attendance records for last 10 days
            $today = now();
            for ($i = 0; $i < 10; $i++) {
                $date = $today->copy()->subDays($i);
                $statuses = ['present', 'absent', 'late', 'leave'];

                Attendance::create([
                    'student_id' => $student->id,
                    'attendance_date' => $date,
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }

        $this->command->info('✅ Database seeded successfully with sample data!');
    }
}
