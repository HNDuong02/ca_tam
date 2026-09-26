<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $table = 'product_reviews';

    protected $fillable = [
        'product_id',
        'customer_name',
        'rating',
        'comment',
        'images',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
