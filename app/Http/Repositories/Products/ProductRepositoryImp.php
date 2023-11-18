<?php

namespace App\Repositories\Products;

use App\Models\Product;
use App\Models\User;

Class ProductRepositoryImp implements ProductRepository{
    
    function showAllProducts($id){
        return Product::where('user_id', $id)->get();
    }
}

?>