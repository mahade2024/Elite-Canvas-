<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // Allows these to be saved via the Admin Panel
    protected $fillable = ['product_id', 'image_path'];

    // Tells Laravel this image belongs to a specific Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}