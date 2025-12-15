<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $courses = Course::all();

        $sampleComments = [
            'مادة رائعة! المحاضر كان على دراية كبيرة والمواد كانت منظمة بشكل جيد.',
            'محتوى ممتاز وتفسيرات واضحة. أنصح بشدة بهذه المادة.',
            'مادة جيدة بشكل عام، لكن يمكن استخدام المزيد من الأمثلة العملية.',
            'المادة كانت صعبة لكنها مجزية. تعلمت الكثير!',
            'مادة متوسطة. بعض المواضيع تم تغطيتها بسرعة كبيرة.',
            'مدرس متميز ومنهج شامل. واحدة من أفضل المواد التي أخذتها.',
            'محتوى المادة كان مثيراً للاهتمام، لكن الواجبات كانت صعبة جداً.',
            'مفيدة جداً ومثيرة للاهتمام. الأستاذ جعل المواضيع المعقدة سهلة الفهم.',
            'مادة لائقة، لكن توقعت عمقاً أكثر في بعض المجالات.',
            'مادة رائعة! المشاريع كانت عملية وساعدت في تعزيز المفاهيم.',
            'المادة كانت جيدة، لكن الكتاب المدرسي كان قديماً.',
            'تجربة تعليمية مذهلة. النهج العملي ساعدني حقاً في فهم المادة.',
            'مادة أساسية جيدة. مثالية للمبتدئين.',
            'المادة غطت الكثير من المواضيع، أحياناً بسرعة كبيرة. بشكل عام جيدة.',
            'مادة ممتازة مع تطبيقات من العالم الحقيقي. راضٍ جداً!',
        ];

        // Create reviews for each course from different users
        foreach ($courses as $course) {
            $numReviews = rand(3, 8); // 3-8 reviews per course
            $selectedUsers = $users->random(min($numReviews, $users->count()));

            foreach ($selectedUsers as $user) {
                Review::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'rating' => rand(3, 5), // Ratings between 3-5 for demo
                    'comment' => $sampleComments[array_rand($sampleComments)],
                ]);
            }
        }
    }
}
