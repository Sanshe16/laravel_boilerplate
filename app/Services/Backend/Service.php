<?php

namespace App\Services\Backend;

use Illuminate\Foundation\Validation\ValidatesRequests;

class Service{
    use ValidatesRequests;

    /**
     * return static initialization of current class
     * @return static
     */
    public static function make() {
        return new static();
    }

}
