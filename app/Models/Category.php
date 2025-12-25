<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function activePets(): HasMany
    {
        return $this->hasMany(Pet::class)->where('status', 'available');
    }
}
