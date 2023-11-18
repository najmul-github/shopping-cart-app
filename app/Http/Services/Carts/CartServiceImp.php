<?php
namespace App\Services\Carts;

use App\Repositories\Carts\CartRepository;

class CartServiceImp implements CartService
{
    public $cart;

    public function __construct(CartRepository $cart) {
        $this->cart = $cart;
    }

    function index(){
        return $this->cart->index();
    }
}

?>