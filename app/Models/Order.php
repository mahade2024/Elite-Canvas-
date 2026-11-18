<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // These fields must match your migration columns exactly
    protected $fillable = [
        'product_id', 'user_id', 'name', 'email', 'address', 
        'phone', 'delivery_area', 'payment_method', 
        'payment_status', 'status', 'note'
    ];
}