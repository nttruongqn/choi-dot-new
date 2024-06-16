<?php
namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;

class AuthService
{
    private $user_repo;

    public function __construct(UserRepositoryInterface $user_repo)
    {
        $this->user_repo = $user_repo;

    }

}
