<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // This relationship allows the Detail page to find the SAT, SUN, MON menu items
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function galleryImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}