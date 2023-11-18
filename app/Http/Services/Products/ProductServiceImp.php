<?php
namespace App\Services\Products;

use App\Repositories\Products\ProductRepository;

class ProductServiceImp implements ProductService
{
    public $Product;

    public function __construct(ProductRepository $Product) {
        $this->Product = $Product;
    }

    function showAllProducts($id){
        return $this->Product->showAllProducts($id);
    }
}

?>