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
            ['department_id' => $csDept->id, 'code' => 'CS101', 'name' => 'Introduction to Programming', 'name_ar' => 'مقدمة في البرمجة', 'description' => 'Fundamentals of programming using Python', 'description_ar' => 'أساسيات البرمجة باستخدام Python', 'credits' => 3],
            ['department_id' => $csDept->id, 'code' => 'CS201', 'name' => 'Data Structures and Algorithms', 'name_ar' => 'هياكل البيانات والخوارزميات', 'description' => 'Study of fundamental data structures and algorithm design', 'description_ar' => 'دراسة هياكل البيانات الأساسية وتصميم الخوارزميات', 'credits' => 4],
            ['department_id' => $csDept->id, 'code' => 'CS301', 'name' => 'Database Systems', 'name_ar' => 'أنظمة قواعد البيانات', 'description' => 'Introduction to database design and SQL', 'description_ar' => 'مقدمة في تصميم قواعد البيانات و SQL', 'credits' => 3],
            ['department_id' => $csDept->id, 'code' => 'CS401', 'name' => 'Web Development', 'name_ar' => 'تطوير الويب', 'description' => 'Building dynamic web applications', 'description_ar' => 'بناء تطبيقات الويب الديناميكية', 'credits' => 3],
            ['department_id' => $csDept->id, 'code' => 'CS501', 'name' => 'Machine Learning', 'name_ar' => 'تعلم الآلة', 'description' => 'Introduction to machine learning algorithms', 'description_ar' => 'مقدمة في خوارزميات تعلم الآلة', 'credits' => 4],

            // Mathematics
            ['department_id' => $mathDept->id, 'code' => 'MATH101', 'name' => 'Calculus I', 'name_ar' => 'التفاضل والتكامل الأول', 'description' => 'Differential and integral calculus', 'description_ar' => 'التفاضل والتكامل', 'credits' => 4],
            ['department_id' => $mathDept->id, 'code' => 'MATH201', 'name' => 'Linear Algebra', 'name_ar' => 'الجبر الخطي', 'description' => 'Vector spaces, matrices, and linear transformations', 'description_ar' => 'الفضاءات المتجهة والمصفوفات والتحويلات الخطية', 'credits' => 3],
            ['department_id' => $mathDept->id, 'code' => 'MATH301', 'name' => 'Probability and Statistics', 'name_ar' => 'الاحتمالات والإحصاء', 'description' => 'Introduction to probability theory and statistical methods', 'description_ar' => 'مقدمة في نظرية الاحتمالات والطرق الإحصائية', 'credits' => 3],

            // Physics
            ['department_id' => $physDept->id, 'code' => 'PHYS101', 'name' => 'General Physics I', 'name_ar' => 'الفيزياء العامة الأولى', 'description' => 'Mechanics, waves, and thermodynamics', 'description_ar' => 'الميكانيكا والموجات والديناميكا الحرارية', 'credits' => 4],
            ['department_id' => $physDept->id, 'code' => 'PHYS201', 'name' => 'General Physics II', 'name_ar' => 'الفيزياء العامة الثانية', 'description' => 'Electricity, magnetism, and optics', 'description_ar' => 'الكهرباء والمغناطيسية والبصريات', 'credits' => 4],

            // Chemistry
            ['department_id' => $chemDept->id, 'code' => 'CHEM101', 'name' => 'General Chemistry I', 'name_ar' => 'الكيمياء العامة الأولى', 'description' => 'Atomic structure, bonding, and reactions', 'description_ar' => 'البنية الذرية والروابط والتفاعلات', 'credits' => 4],
            ['department_id' => $chemDept->id, 'code' => 'CHEM201', 'name' => 'Organic Chemistry', 'name_ar' => 'الكيمياء العضوية', 'description' => 'Structure and reactions of organic compounds', 'description_ar' => 'بنية وتفاعلات المركبات العضوية', 'credits' => 4],

            // Biology
            ['department_id' => $bioDept->id, 'code' => 'BIO101', 'name' => 'General Biology I', 'name_ar' => 'الأحياء العامة الأولى', 'description' => 'Cell biology, genetics, and evolution', 'description_ar' => 'بيولوجيا الخلية والوراثة والتطور', 'credits' => 4],
            ['department_id' => $bioDept->id, 'code' => 'BIO201', 'name' => 'Ecology', 'name_ar' => 'علم البيئة', 'description' => 'Study of ecosystems and environmental interactions', 'description_ar' => 'دراسة النظم البيئية والتفاعلات البيئية', 'credits' => 3],

            // English
            ['department_id' => $engDept->id, 'code' => 'ENG101', 'name' => 'Composition I', 'name_ar' => 'التأليف الأول', 'description' => 'Academic writing and research', 'description_ar' => 'الكتابة الأكاديمية والبحث', 'credits' => 3],
            ['department_id' => $engDept->id, 'code' => 'ENG201', 'name' => 'World Literature', 'name_ar' => 'الأدب العالمي', 'description' => 'Survey of world literature from ancient to modern times', 'description_ar' => 'نظرة عامة على الأدب العالمي من العصور القديمة إلى العصر الحديث', 'credits' => 3],

            // History
            ['department_id' => $histDept->id, 'code' => 'HIST101', 'name' => 'World History I', 'name_ar' => 'التاريخ العالمي الأول', 'description' => 'Ancient civilizations to 1500 CE', 'description_ar' => 'الحضارات القديمة حتى عام 1500 ميلادي', 'credits' => 3],
            ['department_id' => $histDept->id, 'code' => 'HIST201', 'name' => 'World History II', 'name_ar' => 'التاريخ العالمي الثاني', 'description' => '1500 CE to present', 'description_ar' => 'من عام 1500 ميلادي حتى الوقت الحاضر', 'credits' => 3],

            // Business
            ['department_id' => $busDept->id, 'code' => 'BUS101', 'name' => 'Introduction to Business', 'name_ar' => 'مقدمة في الأعمال', 'description' => 'Overview of business principles and practices', 'description_ar' => 'نظرة عامة على مبادئ وممارسات الأعمال', 'credits' => 3],
            ['department_id' => $busDept->id, 'code' => 'BUS201', 'name' => 'Marketing Principles', 'name_ar' => 'مبادئ التسويق', 'description' => 'Fundamentals of marketing strategy', 'description_ar' => 'أساسيات استراتيجية التسويق', 'credits' => 3],
            ['department_id' => $busDept->id, 'code' => 'BUS301', 'name' => 'Financial Accounting', 'name_ar' => 'المحاسبة المالية', 'description' => 'Principles of financial accounting and reporting', 'description_ar' => 'مبادئ المحاسبة المالية والإبلاغ', 'credits' => 3],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
