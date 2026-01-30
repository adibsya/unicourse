<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'enrollment_id',
        'amount',
        'payment_method',
        'reference_number',
        'notes',
        'status',
        'verified_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the enrollment that owns the payment.
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    /**
     * Scope for pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for paid payments.
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Mark payment as paid and activate enrollment.
     */
    public function markAsPaid(): void
    {
        $this->update([
            'status' => 'paid',
            'verified_at' => now(),
        ]);

        // Activate the enrollment
        $this->enrollment->update(['status' => 'active']);
    }

    /**
     * Reject the payment.
     */
    public function reject(): void
    {
        $this->update([
            'status' => 'rejected',
            'verified_at' => now(),
        ]);
    }
}
