<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

$user = User::where('email', 'admin@example.com')->first();
echo "=== Admin User Info ===\n";
echo "Nama: " . $user->nama . "\n";
echo "Email: " . $user->email . "\n";
echo "is_admin: " . ($user->is_admin ? 'TRUE' : 'FALSE') . "\n";
echo "ID: " . $user->id . "\n";

// Test login
echo "\n=== Testing Auth Attempt ===\n";
$attempt = Auth::attempt([
    'email' => 'admin@example.com',
    'password' => 'admin123456'
]);

echo "Auth Attempt Result: " . ($attempt ? 'SUCCESS' : 'FAILED') . "\n";

if (Auth::check()) {
    echo "Logged in as: " . Auth::user()->nama . "\n";
    echo "Is Admin: " . (Auth::user()->is_admin ? 'YES' : 'NO') . "\n";
}
