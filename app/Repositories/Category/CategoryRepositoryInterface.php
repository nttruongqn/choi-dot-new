<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getAllWithConditions($request);
    public function getListCategoryIsParentId();
    public function getAll();

    public function getAllWithNotSelfId($id);

    public function getPhoneCategoryId();
    public function getLaptopCategoryId();
    public function getChildCategories($parent_id);
}
