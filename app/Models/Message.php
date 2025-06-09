<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'title',
        'description',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
