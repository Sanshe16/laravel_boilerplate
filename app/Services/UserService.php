<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var $iserRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $UserRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}