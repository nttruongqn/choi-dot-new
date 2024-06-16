<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $category_service;

    public function __construct(CategoryService $category_service) {
        $this->category_service = $category_service;
    }

    public function index(Request $request)
    {
       return $this->category_service->index($request);
    }

    public function getCreate()
    {
        return $this->category_service->getCreate();
    }

    public function postCreate(Request $request)
    {
        return $this->category_service->create($request);
    }

    public function getEdit($id)
    {
        return $this->category_service->getEdit($id);
    }

    public function postEdit(Request $request, $id)
    {
        return $this->category_service->postEdit($request, $id);
    }

    public function delete($id)
    {
        return $this->category_service->delete($id);
    }
}
