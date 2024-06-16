<?php
namespace App\Repositories\Role;
use App\Constants\RoleConstant;
use App\Models\Role;
use App\Repositories\BaseRepository;


class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function getModel()
    {
        return Role::class;
    }

    public function getCustomerRoleId()
    {
        return $this->model::where("name", RoleConstant::CUSTOMER)->first()->id;
    }

    public function getAdminRoleId()
    {
        return $this->model::where("name", RoleConstant::ADMIN)->first()->id;
    }
}
