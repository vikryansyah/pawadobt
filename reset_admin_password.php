<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'admin@example.com')->first();
$newPassword = 'admin123456';

echo "=== Resetting Admin Password ===\n";
echo "Old password hash: " . substr($user->password, 0, 20) . "...\n";

$user->password = Hash::make($newPassword);
$user->save();

echo "New password hash: " . substr($user->password, 0, 20) . "...\n";
echo "Password: $newPassword\n";

// Verify with test
echo "\n=== Testing Auth After Reset ===\n";
$attempt = auth()->attempt([
    'email' => 'admin@example.com',
    'password' => $newPassword
]);

echo "Auth Attempt Result: " . ($attempt ? 'SUCCESS ✓' : 'FAILED ✗') . "\n";

if (auth()->check()) {
    echo "Logged in as: " . auth()->user()->nama . "\n";
    echo "Is Admin: " . (auth()->user()->is_admin ? 'YES ✓' : 'NO') . "\n";
}
