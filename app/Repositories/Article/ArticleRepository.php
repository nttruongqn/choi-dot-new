<?php
namespace App\Repositories\Article;
use App\Models\Article;
use App\Repositories\BaseRepository;
use App\Repositories\Article\ArticleRepositoryInterface;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    public function getModel()
    {
        return Article::class;
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
}
