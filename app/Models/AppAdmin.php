<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AppAdmin extends Authenticatable
{
    use Notifiable;

    protected $table = 'app_admins';

    protected $fillable = ['username', 'password', 'last_login', 'last_login_ip'];

    protected $hidden = ['password'];

    /**
     * Override to use "username" instead of "email".
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
