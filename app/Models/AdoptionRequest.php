<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdoptionRequest extends Model
{
    protected $fillable = [
        'user_id',
        'pet_id',
        'shelter_id',
        'applicant_name',
        'applicant_email',
        'applicant_phone',
        'applicant_address',
        'occupation',
        'home_type',
        'has_yard',
        'experience',
        'why_adopt',
        'other_pets',
        'status',
        'admin_notes',
        'approved_at',
        'rejected_at',
        'completed_at',
    ];

    protected $casts = [
        'has_yard' => 'boolean',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    public function approve(): void
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        // Update pet status
        $this->pet->update(['status' => 'pending']);
    }

    public function reject(string $notes = null): void
    {
        $this->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'admin_notes' => $notes,
        ]);
    }

    public function complete(): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Update pet status
        $this->pet->update(['status' => 'adopted']);
    }
}
