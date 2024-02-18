<?php

namespace App\Models\Traits\Method;

trait UserMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 'active' ? true : false;
    }
}