<?php

namespace App\Repositories\Carts;

use App\Models\User;

Class CartRepositoryImp implements CartRepository{
    function index(){
        return User::all();
    }
}

?>