<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category() { return $this->belongsTo(Category::class); }

    public function nutritionalFacts()
    {
        return $this->hasMany(NutritionalFact::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
