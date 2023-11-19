<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        // Retrieve unprocessed carts for display in the admin panel
        $unprocessedCarts = Cart::with('items','user')->get();

        return Inertia::render('Dashboard', [
            "unprocessedCarts" => $unprocessedCarts
        ]);
    }

    public function updateCartStatus($id, Request $request)
    {
        // Update cart status based on the provided $id
        $status = $request->input('status') ?? $productId = $request->status;

        $cart = Cart::find($id);  
        if ($cart) {
            $cart->status = $status;
            $cart->save();

            return redirect()->back()->with('success', 'cart status updated successfully.');
        }

        return redirect()->back()->with('error', 'cart not found.');
    }

}
