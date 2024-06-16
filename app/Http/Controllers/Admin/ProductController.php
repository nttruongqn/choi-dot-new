<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private $product_service;

    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }

    public function index(Request $request)
    {
        return $this->product_service->index($request);

    }

    public function getCreate()
    {
        return $this->product_service->getCreate();

    }

    public function postCreate(ProductRequest $request)
    {
        return $this->product_service->postCreate($request);
    }

    public function getEdit($id)
    {
        return $this->product_service->getEdit($id);
    }

    public function postEdit(ProductRequest $request, $id)
    {
        return $this->product_service->postEdit($request, $id);
    }

    public function delete($id)
    {
        return $this->product_service->delete($id);
    }
}
