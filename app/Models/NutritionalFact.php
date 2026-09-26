<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalFact extends Model
{
    use HasFactory;

    protected $table = 'nutritional_facts';

    protected $fillable = [
        'product_id',
        'nutrient',
        'amount',
        'daily_value',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
