<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        $cart = Cart::with('items')->where('user_id', auth()->id())->first();

        $totalCalculatedPrice = $cart ? $cart->calculateTotal() : 0; // Calculate total if cart exists

        return Inertia::render('Products', [
            "products" => $products,
            "cart" => $cart,
            "totalCalculatedPrice" => $totalCalculatedPrice,
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['product' => $product], 200);
    }

}
