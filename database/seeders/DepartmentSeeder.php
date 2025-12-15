<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Computer Science',
                'name_en' => 'Computer Science',
                'name_ar' => 'علوم الحاسب',
                'code' => 'CS',
                'description' => 'Department of Computer Science and Engineering',
            ],
            [
                'name' => 'Mathematics',
                'name_en' => 'Mathematics',
                'name_ar' => 'الرياضيات',
                'code' => 'MATH',
                'description' => 'Department of Mathematics',
            ],
            [
                'name' => 'Physics',
                'name_en' => 'Physics',
                'name_ar' => 'الفيزياء',
                'code' => 'PHYS',
                'description' => 'Department of Physics',
            ],
            [
                'name' => 'Chemistry',
                'name_en' => 'Chemistry',
                'name_ar' => 'الكيمياء',
                'code' => 'CHEM',
                'description' => 'Department of Chemistry',
            ],
            [
                'name' => 'Biology',
                'name_en' => 'Biology',
                'name_ar' => 'الأحياء',
                'code' => 'BIO',
                'description' => 'Department of Biology',
            ],
            [
                'name' => 'English',
                'name_en' => 'English',
                'name_ar' => 'اللغة الإنجليزية',
                'code' => 'ENG',
                'description' => 'Department of English Literature',
            ],
            [
                'name' => 'History',
                'name_en' => 'History',
                'name_ar' => 'التاريخ',
                'code' => 'HIST',
                'description' => 'Department of History',
            ],
            [
                'name' => 'Business Administration',
                'name_en' => 'Business Administration',
                'name_ar' => 'إدارة الأعمال',
                'code' => 'BUS',
                'description' => 'School of Business Administration',
            ],
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(
                ['code' => $department['code']],
                $department
            );
        }
    }
}
