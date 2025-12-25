<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shelter;
use App\Models\User;

class ShelterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users for shelters first if they don't exist
        $user1 = User::firstOrCreate(
            ['email' => 'shelter1@example.com'],
            [
                'nama' => 'Jakarta Animal Shelter',
                'password' => bcrypt('password'),
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'shelter2@example.com'],
            [
                'nama' => 'Bandung Pet Care',
                'password' => bcrypt('password'),
            ]
        );

        $user3 = User::firstOrCreate(
            ['email' => 'shelter3@example.com'],
            [
                'nama' => 'Surabaya Animal Rescue',
                'password' => bcrypt('password'),
            ]
        );

        $shelters = [
            [
                'user_id' => $user1->id,
                'name' => 'Jakarta Animal Shelter',
                'email' => 'info@jakartaanimalshelter.id',
                'phone' => '021-12345678',
                'address' => 'Jl. Sudirman No. 123',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12190',
                'description' => 'Jakarta Animal Shelter adalah organisasi nirlaba yang berdedikasi untuk menyelamatkan dan merawat hewan terlantar. Kami memiliki fasilitas modern dan tim medis berpengalaman.',
                'website' => 'https://jakartaanimalshelter.id',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'is_verified' => true,
                'is_active' => true,
            ],
            [
                'user_id' => $user2->id,
                'name' => 'Bandung Pet Care Center',
                'email' => 'contact@bandungpetcare.com',
                'phone' => '022-87654321',
                'address' => 'Jl. Dago No. 45',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40135',
                'description' => 'Bandung Pet Care Center fokus pada rehabilitasi hewan yang mengalami trauma dan penyakit. Kami menyediakan perawatan medis lengkap dan program adopsi yang komprehensif.',
                'website' => 'https://bandungpetcare.com',
                'latitude' => -6.9175,
                'longitude' => 107.6191,
                'is_verified' => true,
                'is_active' => true,
            ],
            [
                'user_id' => $user3->id,
                'name' => 'Surabaya Animal Rescue',
                'email' => 'help@surabayarescue.org',
                'phone' => '031-11223344',
                'address' => 'Jl. Pemuda No. 67',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60271',
                'description' => 'Surabaya Animal Rescue adalah komunitas pecinta hewan yang aktif menyelamatkan hewan jalanan. Kami bekerja sama dengan klinik hewan untuk memberikan perawatan terbaik.',
                'website' => 'https://surabayarescue.org',
                'latitude' => -7.2575,
                'longitude' => 112.7521,
                'is_verified' => true,
                'is_active' => true,
            ],
            [
                'user_id' => null,
                'name' => 'Yogyakarta Animal Friends',
                'email' => 'info@yogyaanimalfriends.id',
                'phone' => '0274-556677',
                'address' => 'Jl. Malioboro No. 89',
                'city' => 'Yogyakarta',
                'province' => 'DI Yogyakarta',
                'postal_code' => '55213',
                'description' => 'Yogyakarta Animal Friends adalah shelter yang berfokus pada edukasi masyarakat tentang kepemilikan hewan yang bertanggung jawab.',
                'website' => null,
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'is_verified' => false,
                'is_active' => true,
            ],
            [
                'user_id' => null,
                'name' => 'Bali Pet Sanctuary',
                'email' => 'sanctuary@balipets.com',
                'phone' => '0361-998877',
                'address' => 'Jl. Sunset Road No. 12',
                'city' => 'Denpasar',
                'province' => 'Bali',
                'postal_code' => '80361',
                'description' => 'Bali Pet Sanctuary menyediakan rumah aman untuk hewan-hewan yang membutuhkan. Kami memiliki program volunteer dan kunjungan edukasi.',
                'website' => 'https://balipetsanctuary.com',
                'latitude' => -8.6705,
                'longitude' => 115.2126,
                'is_verified' => true,
                'is_active' => true,
            ],
            [
                'user_id' => null,
                'name' => 'Community Listings',
                'email' => 'community@shelter.local',
                'phone' => '000-0000000',
                'address' => 'Online only',
                'city' => 'Virtual',
                'province' => 'N/A',
                'postal_code' => null,
                'description' => 'Shelter placeholder untuk pemilik individu yang ingin menaruh hewan mereka.',
                'website' => null,
                'latitude' => null,
                'longitude' => null,
                'is_verified' => true,
                'is_active' => true,
            ],
        ];

        foreach ($shelters as $shelter) {
            Shelter::create($shelter);
        }
    }
}
