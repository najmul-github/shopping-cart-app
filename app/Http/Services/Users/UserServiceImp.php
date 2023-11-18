<?php
namespace App\Services\Default;

use App\Repositories\Default\DefaultRepository;

class DefaultServiceImp implements DefaultService
{
    public $default;

    public function __construct(DefaultRepository $default) {
        $this->default = $default;
    }

    function index(){
        return $this->default->index();
    }
}

?>