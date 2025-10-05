<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'username', 'email', 'full_name', 'phone_number', 'country_code',
        'referral_code', 'source', 'password', 'email_verification_code',
        'face_id_enabled', 'selfie_url', 'identity_verified',
        'fingerprint_enabled', 'onboarding_completed_at'
    ];

    protected $hidden = ['password', 'remember_token', 'email_verification_code'];
}