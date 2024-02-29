<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidRoleException extends Exception
{
    protected $payload;

    /**
     * GeneralException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 401, $payload = [], Throwable $previous = null)
    {
        $message = $message ?: "Invalid role id";
        parent::__construct($message, $code, $previous);
        $this->payload = $payload;
    }
}
