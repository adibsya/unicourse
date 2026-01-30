<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'quota',
        'start_date',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'start_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the enrollments for the course.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the number of available quota slots.
     */
    public function getAvailableQuotaAttribute(): int
    {
        return $this->quota - $this->enrollments()->whereIn('status', ['pending', 'active'])->count();
    }

    /**
     * Check if course quota is full.
     */
    public function isQuotaFull(): bool
    {
        return $this->available_quota <= 0;
    }

    /**
     * Scope for active courses.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
