<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getLogin()
    {
        return view("admin.login");
    }

    public function postLogin(Request $request)
    {
        $admin_role_id = $this->roleRepository->getAdminRoleId();
        $arr = ['email' => $request->email, 'password' => $request->password, 'role_id' => $admin_role_id];
        if ($request->rember = "on") {
            $remember = true;
        } else {
            $remember = false;
        }
        if (\Auth::attempt($arr, $remember)) {
            return redirect()->intended("admin/categories");
        } else {
            return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không hợp lệ');
        }
    }
    public function getLogout()
    {
        \Auth::logout();
        return redirect()->intended('admin/login');
    }
}
