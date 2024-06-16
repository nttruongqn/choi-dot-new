<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAllWithRelations();
    public function getAllWithConditions(Request $request);
    public function getStatusByEmail($email);
    public function getById($id);
}
