<?php

try {
    $count = \App\Models\AdoptionRequest::count();
    echo "AdoptionRequest count: $count\n\n";
    $latest = \App\Models\AdoptionRequest::latest()->take(10)->get();
    echo "Latest items:\n";
    print_r($latest->toArray());
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
