<?php

use App\Models\Pet;

// Fix pet images path from old public/images to new storage path
$pets = Pet::all();

foreach ($pets as $pet) {
    if ($pet->primary_image && strpos($pet->primary_image, '/images/') === 0) {
        // Convert old path to new storage path
        $filename = basename($pet->primary_image);
        $pet->primary_image = 'pets/' . $filename;
        $pet->save();
        echo "✓ Updated {$pet->name}: {$pet->primary_image}\n";
    }
}

echo "\n=== Verification ===\n";
$pet = Pet::first();
if ($pet) {
    echo "First Pet: {$pet->name}\n";
    echo "Primary Image: {$pet->primary_image}\n";
    echo "Image URL: {$pet->primary_image_url}\n";
}
