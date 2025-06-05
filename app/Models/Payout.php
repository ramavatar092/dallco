<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = [
        'payout_date',
        'user_id',
        'amount',
        'transfer_date',
        'transfer_mode',
        'transfer_remarks',
        'status',
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
