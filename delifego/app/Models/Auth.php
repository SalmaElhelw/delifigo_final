<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password', 'phone_num', 'address', 'password', 'role', 'visa_number', 'visa_expiration_date', 'visa_cvv'];

    protected $hidden = ['password', 'remember_token', 'visa_cvv', 'visa_number', 'visa_expiration_date'];

    protected $casts = [
        'email_verified_at' => 'date_time',
    ];
}
