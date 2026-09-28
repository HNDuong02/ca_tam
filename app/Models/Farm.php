<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $table = 'farms';

    protected $fillable = [
        'name', 'slug', 'address', 'area', 'description', 'content', 'images', 'video', 'status'
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
