<?php

namespace App\Http\Controllers;

use App\Http\Traits\FlashTrait;
use App\Http\Traits\ApiResponsesTrait;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    use ApiResponsesTrait, FlashTrait;

    /**
     * @var array
     */
    public $params = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->params[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->params[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->params[$name]);
    }
}
