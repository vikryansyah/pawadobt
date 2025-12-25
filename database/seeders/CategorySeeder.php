<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Anjing',
                'slug' => 'anjing',
                'icon' => 'dog',
                'description' => 'Anjing adalah sahabat setia manusia. Temukan anjing yang cocok untuk keluarga Anda.',
                'is_active' => true,
            ],
            [
                'name' => 'Kucing',
                'slug' => 'kucing',
                'icon' => 'cat',
                'description' => 'Kucing adalah hewan peliharaan yang mandiri dan penyayang. Adopsi kucing kesayangan Anda.',
                'is_active' => true,
            ],
            [
                'name' => 'Kelinci',
                'slug' => 'kelinci',
                'icon' => 'rabbit',
                'description' => 'Kelinci adalah hewan yang lucu dan menggemaskan. Cocok untuk keluarga dengan anak-anak.',
                'is_active' => true,
            ],
            [
                'name' => 'Burung',
                'slug' => 'burung',
                'icon' => 'bird',
                'description' => 'Burung dengan berbagai warna dan suara indah. Temukan burung peliharaan Anda.',
                'is_active' => true,
            ],
            [
                'name' => 'Hamster',
                'slug' => 'hamster',
                'icon' => 'hamster',
                'description' => 'Hamster adalah hewan kecil yang lucu dan mudah dirawat.',
                'is_active' => true,
            ],
            [
                'name' => 'Reptil',
                'slug' => 'reptil',
                'icon' => 'reptile',
                'description' => 'Reptil seperti kura-kura, iguana, dan lainnya untuk pecinta hewan eksotis.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
