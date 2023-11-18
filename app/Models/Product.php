<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'cart', 'product_id', 'user_id')
            ->withPivot('quantity');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }
}
