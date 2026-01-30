<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@unicourse.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create Sample Courses
        $courses = [
            [
                'title' => 'Web Development Bootcamp',
                'description' => 'Learn full-stack web development from scratch. This comprehensive course covers HTML, CSS, JavaScript, PHP, Laravel, and MySQL. Perfect for beginners who want to become professional web developers.',
                'price' => 1500000,
                'quota' => 30,
                'start_date' => now()->addDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Data Science with Python',
                'description' => 'Master data science and machine learning with Python. Learn pandas, numpy, scikit-learn, and TensorFlow. Includes hands-on projects with real datasets.',
                'price' => 2000000,
                'quota' => 25,
                'start_date' => now()->addDays(14),
                'is_active' => true,
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Build native mobile applications for Android and iOS using Flutter. From basics to publishing on app stores.',
                'price' => 1800000,
                'quota' => 20,
                'start_date' => now()->addDays(10),
                'is_active' => true,
            ],
            [
                'title' => 'UI/UX Design Fundamentals',
                'description' => 'Learn the principles of user interface and user experience design. Master Figma, design systems, and user research methods.',
                'price' => 1200000,
                'quota' => 35,
                'start_date' => now()->addDays(5),
                'is_active' => true,
            ],
            [
                'title' => 'DevOps Engineering',
                'description' => 'Learn CI/CD, Docker, Kubernetes, and cloud deployment. Become a DevOps engineer with hands-on experience in AWS and GCP.',
                'price' => 2500000,
                'quota' => 15,
                'start_date' => now()->addDays(21),
                'is_active' => true,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
