<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin and test user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nama' => 'Admin',
                'password' => Hash::make('admin1234'),
                'is_admin' => true,
            ]
        );

        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Run all seeders in order
        $this->call([
            CategorySeeder::class,
            ShelterSeeder::class,
            PetSeeder::class,
        ]);
    }
}
