<?php

use App\Models\Pet;
use Illuminate\Support\Facades\Storage;

$pets = Pet::all();
$sourceDir = public_path('images');
$destDir = storage_path('app/public/pets');

// Mapping nama file dari public/images
$petImageMap = [
    'Max' => 'Dog01.png',
    'Buddy' => 'Dog02.png', 
    'Luna' => 'dog03.png',
    'Rocky' => 'Golden_Retriever_Puppy-removebg-preview.png',
    'Whiskers' => 'cat02.png',
    'Milo' => 'Cat01.png',
    'Bella' => 'Cartoon_Tabby_Cat-removebg-preview.png',
    'Shadow' => 'dog02.png',
    'Fluffy' => 'Stylized_Cat_Character-removebg-preview.png',
    'Snowball' => 'Cartoon_Bunny_Illustration-removebg-preview.png',
];

echo "=== Copying Images to Storage ===\n";

foreach ($pets as $pet) {
    $sourceImage = $petImageMap[$pet->name] ?? 'Dog01.png';
    $sourcePath = $sourceDir . '/' . $sourceImage;
    
    if (file_exists($sourcePath)) {
        // Create new filename
        $ext = pathinfo($sourceImage, PATHINFO_EXTENSION);
        $newFilename = strtolower($pet->name) . '.' . $ext;
        $destPath = $destDir . '/' . $newFilename;
        
        // Copy file
        if (copy($sourcePath, $destPath)) {
            // Update database
            $pet->primary_image = 'pets/' . $newFilename;
            $pet->save();
            echo "✓ " . $pet->name . ": " . $sourceImage . " -> " . $newFilename . "\n";
        } else {
            echo "✗ " . $pet->name . ": Failed to copy\n";
        }
    } else {
        echo "✗ " . $pet->name . ": Source not found - " . $sourceImage . "\n";
    }
}

echo "\n=== Verification ===\n";
$pet = Pet::first();
echo "First Pet: " . $pet->name . "\n";
echo "Primary Image: " . $pet->primary_image . "\n";
echo "Image URL: " . $pet->primary_image_url . "\n";
