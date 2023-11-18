<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarItem extends Model
{
    use HasFactory;

    protected $table    =   'cart_items';

    protected $fillable = ['cart_id', 'product_id', 'quantity']; // Fillable fields

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function cart() {
        return $this->belongsTo(Cart::class, 'id', 'cart_id');
    }
}
