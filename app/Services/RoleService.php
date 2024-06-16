<?php
namespace App\Services;
use App\Repositories\Role\RoleRepositoryInterface;



class RoleService
{
    private $role_repo;

    public function __construct(RoleRepositoryInterface $role_repo)
    {
        $this->role_repo = $role_repo;
    }


}
