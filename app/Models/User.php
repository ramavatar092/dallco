<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Carbon\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_mobile', 'name', 'city', 'address', 'state', 'register_date',
        'pincode', 'bank_ifsc', 'account_number', 'upi_code',
        'mobile_notification_code', 'mobile_iemi', 'account_balance', 'total_payout', 'total_earnings', 'remarks', 'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRegisterDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    public function latestPaidPayout()
    {
        return $this->hasOne(Payout::class)
                    ->where('status', 'paid')
                    ->latestOfMany();
    }

    public function latestUnpaidPayout()
    {
        return $this->hasOne(Payout::class)
                    ->where('status', 'unpaid')
                    ->latestOfMany(); // Gets the most recent unpaid payout
    }

}
