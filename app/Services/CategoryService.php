<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService
{
    private $category_repo;

    public function __construct(CategoryRepositoryInterface $category_repo)
    {
        $this->category_repo = $category_repo;
    }

    public function index(Request $request)
    {
        $categories = $this->category_repo->getAllWithConditions($request);
        $categories_is_parent_id = $this->category_repo->getListCategoryIsParentId();
        return view("admin.category.index", compact("categories", "categories_is_parent_id"));        return view('admin.category.index', compact('categories'));
    }

    private function insertData(Request $request)
    {
        $data = $request->only('name', 'parent_id');
        if ($request->name) {
            $data["slug"] = str_slug($request->name);
        }
        return $data;
    }

    public function getAllWithConditions($request) {
        return $this->category_repo->getAllWithConditions($request);
    }

    public function getAll() {
        return $this->category_repo->getAll();
    }

    public function getCreate()
    {
        $categories = $this->getAll();
        return view("admin.category.create", compact("categories"));
    }


    public function create(Request $request) {
        $data = $this->insertData($request);
        $this->category_repo->create($data);
        return redirect()->route('category.index');
    }

    public function getEdit($id)
    {
        $categories = $this->category_repo->getAllWithNotSelfId($id);
        $category = $this->category_repo->find($id);
        return view('admin.category.edit', compact('category', 'categories'));
    }


    public function postEdit(Request $request, $id)
    {
        $data = $this->insertData($request);
        $this->category_repo->update($id, $data);
        return redirect()->route('category.index');
    }

    public function delete($id)
    {
        $this->category_repo->delete($id);
        return redirect()->route('category.index');
    }

}
