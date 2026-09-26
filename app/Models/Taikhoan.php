<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Taikhoan extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'phone',
        'password',
        'fullname',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
