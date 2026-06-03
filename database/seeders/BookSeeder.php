<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class bookSeeder extends Seeder
{
    public function run(): void
    {
        Book::insert([
            [
                'category_id' => 1,
                'title' => 'Petualangan Nusantara',
                'author' => 'Andi',
                'publisher' => 'Gramedia',
                'publication_year' => 2022,
                'description' => 'Novel petualangan seru di Nusantara',
                'cover_image_path' => 'cover_buku/book1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'title' => 'Komik Superhero',
                'author' => 'Budi',
                'publisher' => 'Elex Media',
                'publication_year' => 2021,
                'description' => 'Komik superhero seru',
                'cover_image_path' => 'covers/book2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'title' => 'Teknologi Terkini',
                'author' => 'Citra',
                'publisher' => 'TechPress',
                'publication_year' => 2023,
                'description' => 'Buku tentang teknologi terbaru',
                'cover_image_path' => 'covers/book3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'title' => 'Pendidikan Modern',
                'author' => 'Dewi',
                'publisher' => 'EduBooks',
                'publication_year' => 2020,
                'description' => 'Buku tentang pendidikan modern',
                'cover_image_path' => 'covers/book4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'title' => 'Sejarah Dunia',
                'author' => 'Eko',
                'publisher' => 'HistoryPress',
                'publication_year' => 2019,
                'description' => 'Buku tentang sejarah dunia',
                'cover_image_path' => 'covers/book5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'publication_year' => 2005,
                'description' => 'Novel inspiratif tentang pendidikan di Belitung',
                'cover_image_path' => 'covers/book6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'title' => 'Naruto Vol. 1',
                'author' => 'Masashi Kishimoto',
                'publisher' => 'Elex Media',
                'publication_year' => 2000,
                'description' => 'Komik ninja populer dari Jepang',
                'cover_image_path' => 'covers/book7.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'title' => 'Kecerdasan Buatan',
                'author' => 'Rudi',
                'publisher' => 'TechPress',
                'publication_year' => 2023,
                'description' => 'Pengantar AI dan machine learning',
                'cover_image_path' => 'covers/book8.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'title' => 'Psikologi Belajar',
                'author' => 'Sari',
                'publisher' => 'EduBooks',
                'publication_year' => 2021,
                'description' => 'Memahami cara belajar yang efektif',
                'cover_image_path' => 'covers/book9.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'title' => 'Sejarah Indonesia Merdeka',
                'author' => 'Farhan',
                'publisher' => 'HistoryPress',
                'publication_year' => 2018,
                'description' => 'Perjalanan Indonesia menuju kemerdekaan',
                'cover_image_path' => 'covers/book10.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
