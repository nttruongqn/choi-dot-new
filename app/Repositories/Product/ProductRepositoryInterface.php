<?php
namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getById($id);
    public function getBySlug($slug);
    public function getAllWithRelations();
    public function getAllWithConditions(Request $request);
    public function getAllWithClientConditions(Request $request);
    public function getNewProducts();
    public function getSaleProducts();
    public function getHotProducts();
    public function getByCategoryId($category_id, $limit = null);
    public function getByParentId($parent_id, $limit = null);
    public function getHotProductsByCategoryId($category_id, $limit = null);

}
