<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

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

    public $timestamps = true;

    /**
     * The user who used this coupon.
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
        return now()->gt($this->coupon_expiry);
    }

    /**
     * Scope to get only active coupons.
     */
    public function scopeActive($query)
    {
        return $query->where('coupon_status', 'active');
    }

    /**
     * Scope to get expired coupons.
     */
    public function scopeExpired($query)
    {
        return $query->where('coupon_expiry', '<', now());
    }
}
