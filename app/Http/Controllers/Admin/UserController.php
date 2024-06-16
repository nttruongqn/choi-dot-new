<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function index(Request $request)
    {
       return $this->user_service->index($request);
    }


    public function getCreate()
    {
        return $this->user_service->getCreate();
    }

    public function postCreate(AddUserRequest $request)
    {
        return $this->user_service->postCreate($request);

    }

    public function getEdit($id)
    {
       return $this->user_service->getEdit($id);
    }

    public function postEdit(EditUserRequest $request, $id)
    {
       return $this->user_service->postEdit($request, $id);
    }

    public function delete($id)
    {
        return $this->user_service->delete($id);
    }

}
