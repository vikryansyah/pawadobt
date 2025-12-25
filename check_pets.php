<?php

use App\Models\Pet;

$pets = Pet::all();
$storageDir = storage_path('app/public/pets');

echo "=== Checking Pet Images ===\n";

foreach ($pets as $pet) {
    $imageName = basename($pet->primary_image);
    $storagePath = $storageDir . '/' . $imageName;
    
    $exists = file_exists($storagePath);
    echo $pet->name . ": " . ($exists ? "✓ EXISTS" : "✗ MISSING") . " - " . $imageName . "\n";
}

echo "\n=== Files in storage/app/public/pets ===\n";
$files = scandir($storageDir);
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        $size = filesize($storageDir . '/' . $file);
        echo "- " . $file . " (" . $size . " bytes)\n";
    }
}
