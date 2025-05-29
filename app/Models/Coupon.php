<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
     protected $fillable = [
        'coupon_code', 'coupon_value', 'coupon_date', 'coupon_expiry',
        'coupon_status', 'used_by', 'status_date', 'remarks',
    ];
}
