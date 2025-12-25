<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Buat akun admin untuk testing
$admin = User::firstOrCreate(
    ['email' => 'admin@example.com'],
    [
        'nama' => 'Admin User',
        'password' => Hash::make('admin123456'),
        'is_admin' => true,
    ]
);

echo "✅ Akun Admin berhasil dibuat/update:\n";
echo "Email: {$admin->email}\n";
echo "Password: admin123456\n";
echo "is_admin: " . ($admin->is_admin ? 'Ya' : 'Tidak') . "\n";

// Buat akun user biasa untuk testing
$user = User::firstOrCreate(
    ['email' => 'user@example.com'],
    [
        'nama' => 'Regular User',
        'password' => Hash::make('user123456'),
        'is_admin' => false,
    ]
);

echo "\n✅ Akun User berhasil dibuat/update:\n";
echo "Email: {$user->email}\n";
echo "Password: user123456\n";
echo "is_admin: " . ($user->is_admin ? 'Ya' : 'Tidak') . "\n";
