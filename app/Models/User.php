<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'padi_tag',
        'phone',
        'sex',
        'dob',
        'occupation',
        'state_of_origin',
        'country',
        'home_address',
        'wallet_balance',
        'profile_picture',
        'transaction_pin',
        'referral_padi_tag',
        'security_login_otp',
        'login_otp_expires_at',
        'email_verification_otp',
        'email_verified_status',
        'email_verified_at',
        'forgot_password_code',
        'forgot_password_token',
        'forget_password_otp_expires_at',
        'phone_verified_status',
        'kyc_status',
        'kyc_id_type',
        'kyc_document',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $table ='users';
    protected $primaryKey ='id';

    public function topups()
    {
        return $this->hasMany(Topup::class);
    }

    public function airtimes()
    {
        return $this->hasMany(Airtime::class);
    }
}
