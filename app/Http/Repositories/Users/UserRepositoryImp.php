<?php

namespace App\Repositories\Default;

use App\Models\User;

Class DefaultRepositoryImp implements DefaultRepository{
    function index(){
        return User::all();
    }
}

?>