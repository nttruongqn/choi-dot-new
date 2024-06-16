<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getAllWithRelations()
    {
        return $this->model->with('role:id,name')->get();
    }

    public function getAllWithConditions(Request $request)
    {
        $users = $this->model::with('role:id,name');
        if ($request->user_search_value) {
            $users->where('username', 'like', '%' . $request->user_search_value . '%');
        }
        if ($request->filter_user_status) {
            $users->where('status', $request->filter_user_status);
        }
        if ($request->filter_user_role) {
            $users->where('role_id', $request->filter_user_role);
        }
        $users = $users->paginate(8)->appends($request->all());
        ;
        return $users;

    }

    public function getStatusByEmail($email)
    {
        return $this->model->where('email', $email)->first()->status;
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

}
