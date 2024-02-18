<?php

namespace App\Models\Traits\Scope;

/**
 * Class UserScope.
 */
trait UserScope
{
    public function scopeWhereEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeWhereStatus($query, $status = 'active')
    {
        return $query->where('status', $status);
    }
}