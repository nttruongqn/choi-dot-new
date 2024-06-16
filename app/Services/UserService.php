<?php
namespace App\Services;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserService {
    private $user_repo;
    private $role_repo;

    public function __construct(UserRepositoryInterface $user_repo, RoleRepositoryInterface $role_repo)
    {
        $this->user_repo = $user_repo;
        $this->role_repo = $role_repo;
    }

    public function index(Request $request)
    {
        $roles = $this->role_repo->getAll();
        $users = $this->user_repo->getAllWithConditions($request);
        return view("admin.user.index", compact("users", "roles"));
    }


    public function getCreate()
    {
        $roles = $this->role_repo->getAll();
        return view("admin.user.create", compact("roles"));
    }

    public function postCreate(AddUserRequest $request)
    {
        $data = filterNullValues($request->only('username', 'role_id', 'email'));
        $data['password'] = bcrypt(123456);
        $this->user_repo->create($data);

        return redirect()->route("user.index");
    }

    public function getEdit($id)
    {
        $user = $this->user_repo->find($id);
        $roles = $this->role_repo->getAll();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function postEdit(EditUserRequest $request, $id)
    {
        $data = filterNullValues($request->only('username', 'role_id', 'status'));
        $this->user_repo->update($id, $data);
        return redirect()->route('user.index');
    }

    public function delete($id)
    {
        $this->user_repo->delete($id);
        return redirect()->route('user.index');

    }

}
