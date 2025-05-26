<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Kompetisi UX Design Challenge 2025',
                'description' => 'Kompetisi desain UX terbesar di Indonesia untuk mahasiswa. Dapatkan pengalaman berharga dan hadiah jutaan rupiah!',
                'category' => 'Competition',
                'date' => Carbon::now()->addDays(30),
                'location' => 'Bandung, Jawa Barat',
                'participants_count' => 1250,
            ],
            [
                'title' => 'Seminar Nasional: Future of Technology',
                'description' => 'Seminar tentang perkembangan teknologi masa depan dengan pembicara dari Google, Microsoft, dan startup unicorn Indonesia.',
                'category' => 'Seminar',
                'date' => Carbon::now()->addDays(15),
                'location' => 'Jakarta Convention Center',
                'participants_count' => 2500,
            ],
            [
                'title' => 'Workshop Machine Learning for Beginners',
                'description' => 'Workshop intensif 2 hari untuk mempelajari dasar-dasar machine learning dengan Python dan TensorFlow.',
                'category' => 'Workshop',
                'date' => Carbon::now()->addDays(20),
                'location' => 'Universitas Gadjah Mada, Yogyakarta',
                'participants_count' => 450,
            ],
            [
                'title' => 'Hackathon Smart City Solutions',
                'description' => 'Kompetisi 48 jam untuk menciptakan solusi teknologi yang mendukung konsep smart city.',
                'category' => 'Competition',
                'date' => Carbon::now()->addDays(45),
                'location' => 'Institut Teknologi Bandung',
                'participants_count' => 800,
            ],
            [
                'title' => 'Webinar: Digital Marketing Strategy 2025',
                'description' => 'Pelajari strategi digital marketing terkini untuk meningkatkan bisnis di era digital.',
                'category' => 'Seminar',
                'date' => Carbon::now()->addDays(10),
                'location' => 'Online Event',
                'participants_count' => 1800,
            ],
            [
                'title' => 'Workshop Mobile App Development',
                'description' => 'Workshop pengembangan aplikasi mobile menggunakan Flutter untuk Android dan iOS.',
                'category' => 'Workshop',
                'date' => Carbon::now()->addDays(25),
                'location' => 'Universitas Indonesia, Depok',
                'participants_count' => 320,
            ],
            [
                'title' => 'StartUp Pitch Competition 2025',
                'description' => 'Kompetisi pitch startup untuk mahasiswa dengan total hadiah 500 juta rupiah dan mentorship dari investor.',
                'category' => 'Competition',
                'date' => Carbon::now()->addDays(60),
                'location' => 'Surabaya Convention Hall',
                'participants_count' => 650,
            ],
            [
                'title' => 'Data Science Bootcamp',
                'description' => 'Bootcamp intensif data science dengan sertifikasi internasional dan job guarantee program.',
                'category' => 'Workshop',
                'date' => Carbon::now()->addDays(35),
                'location' => 'Bali International Convention Centre',
                'participants_count' => 280,
            ],
            [
                'title' => 'Seminar Cyber Security Awareness',
                'description' => 'Seminar tentang pentingnya keamanan siber di era digital dengan praktisi dari berbagai perusahaan teknologi.',
                'category' => 'Seminar',
                'date' => Carbon::now()->addDays(18),
                'location' => 'Universitas Brawijaya, Malang',
                'participants_count' => 950,
            ],
            [
                'title' => 'IoT Innovation Challenge',
                'description' => 'Kompetisi inovasi Internet of Things untuk menciptakan solusi pintar dalam kehidupan sehari-hari.',
                'category' => 'Competition',
                'date' => Carbon::now()->addDays(50),
                'location' => 'Medan Convention Center',
                'participants_count' => 420,
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}