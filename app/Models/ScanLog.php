<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $primaryKey = 'coupon_id';

    protected $fillable = [
        'coupon_code',
        'coupon_value',
        'coupon_date',
        'coupon_expiry',
        'coupon_status',
        'used_by',
        'status_date',
        'remarks',
    ];

    protected $casts = [
        'coupon_date' => 'date',
        'coupon_expiry' => 'date',
        'status_date' => 'date',
        'coupon_value' => 'decimal:2',
    ];

    /**
     * Optionally define the user relationship (if used_by is a foreign key).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'used_by');
    }

    /**
     * Check if the coupon is expired.
     */
    public function isExpired()
    {
        return now()->greaterThan($this->coupon_expiry);
    }

    /**
     * Scope for active coupons.
     */
    public function scopeActive($query)
    {
        return $query->where('coupon_status', 'active');
    }
}
