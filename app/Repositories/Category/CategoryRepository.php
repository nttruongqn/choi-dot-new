<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getAllWithConditions($request)
    {
        $categories = $this->model;

        if ($request) {
            if ($request->category_search_value) {
                $categories = $categories->where("name", "like", "%" . $request->category_search_value . "%");
            }
            if ($request->filter_category_parent_id) {
                $categories = $categories->where("parent_id", $request->filter_category_parent_id);
            }
        }
        return $categories->paginate(8);
        ;
    }

    public function getListCategoryIsParentId()
    {
        return $this->model::with('children')->where('parent_id', null)->get();
    }

    public function getAll()
    {
        return $this->model::all();
    }

    public function getAllWithNotSelfId($id) {
        return $this->model::where('id', '!=', $id)->get();
    }

    public function getPhoneCategoryId()
    {
        return $this->model->where('name', 'Điện thoại')->first()->id;
    }

    public function getLaptopCategoryId()
    {
        return $this->model->where('name', 'Máy tính')->first()->id;
    }

    public function getChildCategories($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)->get();
    }

}


