<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScanLog extends Model
{
    use HasFactory;

    // Automatically manage created_at and updated_at
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'coupon_id',
        'scan_amount',
    ];

    /**
     * Get the user that owns the scan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the coupon that was scanned.
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
