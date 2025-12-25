<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Pet extends Model
{
    protected $fillable = [
        'shelter_id',
        'category_id',
        'owner_id',
        'name',
        'slug',
        'gender',
        'age_years',
        'age_months',
        'breed',
        'size',
        'color',
        'weight',
        'description',
        'health_info',
        'personality',
        'is_vaccinated',
        'is_neutered',
        'is_house_trained',
        'good_with_kids',
        'good_with_dogs',
        'good_with_cats',
        'primary_image',
        'images',
        'status',
        'views',
        'is_featured',
    ];

    protected $casts = [
        'is_vaccinated' => 'boolean',
        'is_neutered' => 'boolean',
        'is_house_trained' => 'boolean',
        'good_with_kids' => 'boolean',
        'good_with_dogs' => 'boolean',
        'good_with_cats' => 'boolean',
        'is_featured' => 'boolean',
        'images' => 'array',
        'weight' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pet) {
            if (empty($pet->slug)) {
                $pet->slug = Str::slug($pet->name . '-' . Str::random(6));
            }
        });
    }

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function adoptionRequests(): HasMany
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function getAgeAttribute(): string
    {
        $age = [];
        if ($this->age_years > 0) {
            $age[] = $this->age_years . ' tahun';
        }
        if ($this->age_months > 0) {
            $age[] = $this->age_months . ' bulan';
        }
        return implode(' ', $age) ?: '0 bulan';
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        if (!$this->primary_image) {
            return 'https://via.placeholder.com/600x600?text=Pet+Image';
        }

        if (Str::startsWith($this->primary_image, ['http://', 'https://'])) {
            return $this->primary_image;
        }

        if (Str::startsWith($this->primary_image, '/storage/')) {
            return $this->primary_image;
        }

        return asset('storage/' . ltrim($this->primary_image, '/'));
    }
}
