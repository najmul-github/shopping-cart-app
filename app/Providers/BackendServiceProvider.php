<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\Carts\CartService',
            'App\Services\Carts\CartServiceImp',
        );   
        $this->app->bind(
            'App\Services\Users\UserService',
            'App\Services\Users\UserServiceImp',
        );  
        $this->app->bind(
            'App\Services\Products\ProductService',
            'App\Services\Products\ProductServiceImp',
        );       
        
        $this->app->bind(
            'App\Repositories\Carts\CartRepository',
            'App\Repositories\Carts\CartRepositoryImp',
        );
        $this->app->bind(
            'App\Repositories\Users\UserRepository',
            'App\Repositories\Users\UserRepositoryImp',
        );
        $this->app->bind(
            'App\Repositories\Products\ProductRepository',
            'App\Repositories\Products\ProductRepositoryImp',
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
