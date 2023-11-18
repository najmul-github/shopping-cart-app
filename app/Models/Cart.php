<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id','status', 'product_id', 'quantity']; // Fillable fields

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    public function items()
    {
        return $this->belongsToMany(Product::class, 'cart_items')->withPivot('quantity','cart_id','product_id','id');
    }

    public function calculateTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->price * $item->pivot->quantity;
        }

        return $total;
    }
}
