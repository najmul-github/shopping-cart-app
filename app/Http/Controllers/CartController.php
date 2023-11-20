<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    

    public function addToCart(Request $request)
    {
        // Retrieve product details from the form submission
        // $productId = $request->input('product_id');
        $productId = $request->id;

        // Check if the user has an existing cart or create a new one
        $cart = auth()->user()->cart ?? new Cart();
        $cart->user_id = auth()->id();
        $cart->status  = 'pending';
        $cart->save();
        // Check if the product is already in the cart for the current user
        $existingCart = $cart->items()->where('product_id', $productId)->first();
        if ($existingCart) {
            // If the product is already in the cart item, increment the quantity
            $existingCart->pivot->increment('quantity');
        } else {
            // DB::beginTransaction();
            // try {
            $cart->items()->attach($productId, [
                'quantity' => 1, // Initial quantity
                'cart_id' => $cart->id,
                'product_id' => $productId,
            ]);

            // Fetch the pivot data for the added product
            $pivotData = $cart->items()->where('product_id', $productId)->first()->pivot;

            // Get the ID of the newly added cart item
            $cartItemId = $pivotData->id;
            // } catch (\Exception $e) {
            //     DB::rollback();
            //     // Handle exception (log or throw further)
            //     return redirect()->back()->with('error', 'Failed to add product to cart.');
            // }
            return response()->json(['cartItemId' => $cartItemId]);
        }

        // Redirect to the home page or the cart page after adding the product
        return redirect()->route('home')->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart($id)
    {
        // Find the cart item and remove it
        $cartItem = auth()->user()->cart->items()->where('cart_items.id', $id)->first();

        if ($cartItem) {
            DB::beginTransaction();
        
            try {
                $cartItem->pivot->delete();
            
                // Update cart totals
                // auth()->user()->cart->calculateTotal();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                // Handle exception (log or throw further)
                return redirect()->back()->with('error', 'Failed to remove item from cart.');
            }

            return redirect()->route('home')->with('success', 'Item removed from cart successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }  

    public function editCartItem(Request $request,$id)
    {
        $newQuantity = $request->input('new_quantity');

        try{
            // Find the cart item and update its new quantity
            $cartItem = auth()->user()->cart->items()->where('cart_items.id', $id)->first();

            if ($cartItem) {
                $cartItem->pivot->update(['quantity' => $newQuantity]);
                
                // Update cart totals
                // auth()->user()->cart->calculateTotal();
            }
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to update cart item.');
        }
        
        return redirect()->route('home')->with('success', 'Cart item updated successfully!');
    }

}
