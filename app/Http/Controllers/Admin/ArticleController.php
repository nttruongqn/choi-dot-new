<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    private $article_service;

    public function __construct(ArticleService $article_service)
    {
        $this->article_service = $article_service;
    }

    public function index(Request $request)
    {
        return $this->article_service->index($request);
    }

    public function getCreate()
    {
        return $this->article_service->getCreate();
    }

    public function postCreate(Request $request)
    {
        return $this->article_service->create($request);
    }

    public function getEdit($id)
    {
        return $this->article_service->getEdit($id);
    }

    public function postEdit(Request $request, $id)
    {
        return $this->article_service->postEdit($request, $id);
    }

    public function delete($id)
    {
        return $this->article_service->delete($id);
    }
}
