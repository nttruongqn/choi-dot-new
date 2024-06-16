<?php
namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function getAllWithRelations()
    {
        return $this->model::with('category')->get();
    }

    public function getAllWithConditions(Request $request)
    {
        $products = $this->model::with('category');
        if ($request->product_search_value) {
            $products->where('name', 'like', '%' . $request->product_search_value . '%');
        }
        if ($request->filter_category_id) {
            $products->where('category_id', $request->filter_category_id);
        }
        $products = $products->paginate(8)->appends($request->all());
        ;
        return $products;
    }

    public function getAllWithClientConditions(Request $request)
    {
        // dd($request->all());
        $products = $this->model::with('category');
        if ($request->product_search_value) {
            $products->where('name', 'like', '%' . $request->product_search_value . '%');
        }

        if ($request->filter_category_id) {
            $products->where('category_id', $request->filter_category_id);
        }

        if ($request->filter_categories) {
            if (!in_array(null, ($request->filter_categories))) {
                $products->whereIn('category_id', function ($query) use ($request) {
                    $query->select('id')
                        ->from('categories')
                        ->whereIn('parent_id', $request->filter_categories)
                        ->orWhere('id', $request->filter_categories)
                    ;
                });
            }

        }

        if ($request->filter_prices) {
            $products->where(function ($query) use ($request) {
                foreach ($request->filter_prices as $filter_price) {
                    if ($filter_price == "[0, 5000000]") {
                        $query->orWhereBetween('price', [0, 5000000]);
                    } elseif ($filter_price == "[5000000, 15000000]") {
                        $query->orWhereBetween('price', [5000000, 15000000]);
                    } elseif ($filter_price == "[15000000, 25000000]") {
                        $query->orWhereBetween('price', [15000000, 25000000]);
                    } elseif ($filter_price == "[min-25000000]") {
                        $query->orWhere('price', '>', '25000000');
                    }
                }
            });
        }
        if (($request->brands)) {
            $products->join('categories', 'products.category_id', '=', 'categories.id')
                ->whereIn('categories.name', $request->brands)
                ->select('products.*')
                ->with('category:id,name');
        }

        if ($request->sort_select === "name_sort_asc") {
            $products->orderBy('name', 'asc');
        }
        if ($request->sort_select === "name_sort_desc") {
            $products->orderBy('name', 'desc');
        }

        if ($request->sort_select === "price_sort_asc") {
            $products->orderBy('price', 'asc');
        }
        if ($request->sort_select === "price_sort_desc") {
            $products->orderBy('price', 'desc');
        }

        $products = $products->with('category:id,name')->paginate(6)->appends($request->all());
        return $products;
    }


    public function getNewProducts()
    {
        return $this->model->with('category:id,name')->inRandomOrder()->orderBy('created_at', 'desc')->take(6)->get();
    }
    public function getSaleProducts()
    {
        return $this->model->with('category:id,name')->where('is_sale', true)->inRandomOrder()->take(6)->get();
    }
    public function getHotProducts()
    {
        return $this->model->with('category:id,name')->where('is_hot', true)->inRandomOrder()->take(6)->get();
    }

    public function getByCategoryId($category_id, $limit = null)
    {
        $products = $this->model->where('category_id', $category_id);
        if ($limit) {
            $products = $products->inRandomOrder()->take($limit);
        }
        return $products->get();
    }

    public function getByParentId($parent_id, $limit = null)
    {
        $query = $this->model->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('categories.parent_id', $parent_id)
            ->select('products.*')
            ->with('category:id,name');

        if ($limit !== null) {
            $query->inRandomOrder()->take($limit);
        }
        return $query->get();
    }

    public function getHotProductsByCategoryId($parent_id, $limit = null)
    {
        $query = $this->model->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.is_hot', true)
            ->where('categories.parent_id', $parent_id)
            ->select('products.*')
            ->with('category:id,name');

        if ($limit !== null) {
            $query->inRandomOrder()->take($limit);
        }
        return $query->get();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('category')->first();
    }
}
