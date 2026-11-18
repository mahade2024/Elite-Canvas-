<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    // Added 'variant_image' to the fillable array
    protected $fillable = [
        'product_id', 
        'variant_name', 
        'price', 
        'variant_image'
    ];

    // This connects the variant back to the main product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}