<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Ahmad Fauzan',
                'position' => 'Siswa STMKG 2025',
                'content' => 'Alhamdulillah berkat latihan di SpeedU, saya bisa lolos STMKG. Soal-soalnya mirip banget sama yang keluar di ujian! Pembahasan yang lengkap membantu saya memahami konsep dengan lebih baik.',
                'photo' => null,
                'rating' => 5,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'position' => 'Alumni STAN 2024',
                'content' => 'Platform terbaik untuk latihan CAT! Pembahasan lengkap dan mudah dipahami. Fitur ranking peserta juga memotivasi saya untuk terus belajar. Sangat recommended untuk semua yang mau masuk kedinasan!',
                'photo' => null,
                'rating' => 5,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Rizky Pratama',
                'position' => 'Peserta Try Out SKD',
                'content' => 'Fitur ranking peserta bikin saya makin semangat belajar. Bisa lihat progress dan saingan setiap hari! Sistem CAT-nya juga mirip banget sama yang asli, jadi pas ujian tidak kaget.',
                'photo' => null,
                'rating' => 5,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
