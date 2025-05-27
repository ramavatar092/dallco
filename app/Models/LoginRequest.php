<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginRequest extends Model
{
  protected $fillable = ['user_mobile', 'date', 'mobile_iemi'];
}
