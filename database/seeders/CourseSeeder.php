<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csDept = Department::where('code', 'CS')->first();
        $mathDept = Department::where('code', 'MATH')->first();
        $physDept = Department::where('code', 'PHYS')->first();
        $chemDept = Department::where('code', 'CHEM')->first();
        $bioDept = Department::where('code', 'BIO')->first();
        $engDept = Department::where('code', 'ENG')->first();
        $histDept = Department::where('code', 'HIST')->first();
        $busDept = Department::where('code', 'BUS')->first();

        $courses = [
            // Computer Science
            ['department_id' => $csDept->id, 'code' => 'CS101', 'name' => 'Introduction to Programming', 'description' => 'Fundamentals of programming using Python', 'credits' => 3],
            ['department_id' => $csDept->id, 'code' => 'CS201', 'name' => 'Data Structures and Algorithms', 'description' => 'Study of fundamental data structures and algorithm design', 'credits' => 4],
            ['department_id' => $csDept->id, 'code' => 'CS301', 'name' => 'Database Systems', 'description' => 'Introduction to database design and SQL', 'credits' => 3],
            ['department_id' => $csDept->id, 'code' => 'CS401', 'name' => 'Web Development', 'description' => 'Building dynamic web applications', 'credits' => 3],
            ['department_id' => $csDept->id, 'code' => 'CS501', 'name' => 'Machine Learning', 'description' => 'Introduction to machine learning algorithms', 'credits' => 4],

            // Mathematics
            ['department_id' => $mathDept->id, 'code' => 'MATH101', 'name' => 'Calculus I', 'description' => 'Differential and integral calculus', 'credits' => 4],
            ['department_id' => $mathDept->id, 'code' => 'MATH201', 'name' => 'Linear Algebra', 'description' => 'Vector spaces, matrices, and linear transformations', 'credits' => 3],
            ['department_id' => $mathDept->id, 'code' => 'MATH301', 'name' => 'Probability and Statistics', 'description' => 'Introduction to probability theory and statistical methods', 'credits' => 3],

            // Physics
            ['department_id' => $physDept->id, 'code' => 'PHYS101', 'name' => 'General Physics I', 'description' => 'Mechanics, waves, and thermodynamics', 'credits' => 4],
            ['department_id' => $physDept->id, 'code' => 'PHYS201', 'name' => 'General Physics II', 'description' => 'Electricity, magnetism, and optics', 'credits' => 4],

            // Chemistry
            ['department_id' => $chemDept->id, 'code' => 'CHEM101', 'name' => 'General Chemistry I', 'description' => 'Atomic structure, bonding, and reactions', 'credits' => 4],
            ['department_id' => $chemDept->id, 'code' => 'CHEM201', 'name' => 'Organic Chemistry', 'description' => 'Structure and reactions of organic compounds', 'credits' => 4],

            // Biology
            ['department_id' => $bioDept->id, 'code' => 'BIO101', 'name' => 'General Biology I', 'description' => 'Cell biology, genetics, and evolution', 'credits' => 4],
            ['department_id' => $bioDept->id, 'code' => 'BIO201', 'name' => 'Ecology', 'description' => 'Study of ecosystems and environmental interactions', 'credits' => 3],

            // English
            ['department_id' => $engDept->id, 'code' => 'ENG101', 'name' => 'Composition I', 'description' => 'Academic writing and research', 'credits' => 3],
            ['department_id' => $engDept->id, 'code' => 'ENG201', 'name' => 'World Literature', 'description' => 'Survey of world literature from ancient to modern times', 'credits' => 3],

            // History
            ['department_id' => $histDept->id, 'code' => 'HIST101', 'name' => 'World History I', 'description' => 'Ancient civilizations to 1500 CE', 'credits' => 3],
            ['department_id' => $histDept->id, 'code' => 'HIST201', 'name' => 'World History II', 'description' => '1500 CE to present', 'credits' => 3],

            // Business
            ['department_id' => $busDept->id, 'code' => 'BUS101', 'name' => 'Introduction to Business', 'description' => 'Overview of business principles and practices', 'credits' => 3],
            ['department_id' => $busDept->id, 'code' => 'BUS201', 'name' => 'Marketing Principles', 'description' => 'Fundamentals of marketing strategy', 'credits' => 3],
            ['department_id' => $busDept->id, 'code' => 'BUS301', 'name' => 'Financial Accounting', 'description' => 'Principles of financial accounting and reporting', 'credits' => 3],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
