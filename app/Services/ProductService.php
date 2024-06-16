<?php
namespace App\Services;

use DOMDocument;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\File;


class ProductService
{
    private $product_repo;
    protected $category_repo;

    public function __construct(
        ProductRepositoryInterface $product_repo,
        CategoryRepositoryInterface $category_repo
    ) {
        $this->product_repo = $product_repo;
        $this->category_repo = $category_repo;
    }


    public function index(Request $request)
    {
        $categories = $this->category_repo->getAll();
        $products = $this->product_repo->getAllWithConditions($request);
        return view("admin.product.index", compact("products", "categories"));
    }

    public function getCreate()
    {
        $categories = $this->category_repo->getAll();
        return view("admin.product.create", compact("categories"));
    }

    public function postCreate(ProductRequest $request)
    {
        $content = null;
        if ($request->content) {
            $content = $request->content;
            $dom = new DOMDocument();
            $dom->loadHTML($content, 9);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . time() . $key . '.png';
                file_put_contents(public_path() . $image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
            $content = $dom->saveHTML();
        }
        $data = [
            "name" => $request->name,
            "slug" => str_slug($request->name),
            "price" => $request->price,
            "title" => $request->title,
            "content" => $content,
            "sale" => $request->sale,
            "category_id" => $request->category_id
        ];

        if ($request->sale > 0) {
            $is_sale = true;
            $data['is_sale'] = $is_sale;
        }
        if ($request->is_hot === "on") {
            $is_hot = true;
            $data['is_hot'] = $is_hot;
        }
        $product = $this->product_repo->create($data);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $folder_name = $product->id . '-' . $product->created_at->format('Y-m-d');
            $file_name = $product->name . '-' . $product->created_at->format('Y-m-d') . '.' . $avatar->getClientOriginalExtension();

            $folder_path = public_path('avatar/' . $folder_name);
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0755, true, true);
            }

            $avatar->move($folder_path, $file_name);
            $product->avatar = 'avatar/' . $folder_name . '/' . $file_name;
            $product->save();
        }

        $child_avatars = null;
        if ($request->hasFile('avatar_first_child') && $request->isDeleteFC === 'false') {
            $avatar_first_child_file = $request->file('avatar_first_child');
            $folder_name = $product->id . '-' . $product->created_at->format('Y-m-d');
            $file_name = $product->name . '-' . $product->created_at->format('Y-m-d') . '.' . $avatar_first_child_file->getClientOriginalExtension();

            $folder_path = public_path('avatar/fc/' . $folder_name);
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0755, true, true);
            }
            $avatar_first_child_file->move($folder_path, $file_name);
            $child_avatars['avatar_first_child'] = 'avatar/fc/' . $folder_name . '/' . $file_name;
        }

        if ($request->hasFile('avatar_second_child')) {
            $avatar_second_child_file = $request->file('avatar_second_child');
            $folder_name = $product->id . '-' . $product->created_at->format('Y-m-d');
            $file_name = $product->name . '-' . $product->created_at->format('Y-m-d') . '.' . $avatar_second_child_file->getClientOriginalExtension();

            $folder_path = public_path('avatar/sc/' . $folder_name);
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0755, true, true);
            }
            $avatar_second_child_file->move($folder_path, $file_name);
            $child_avatars['avatar_second_child'] = 'avatar/sc/' . $folder_name . '/' . $file_name;
        }
        if ($request->isDeleteAvatar === 'true') {
            $product->avatar = null;
        }
        if ($request->isDeleteFC === 'true') {
            $child_avatars['avatar_first_child'] = null;
        }
        if ($request->isDeleteSC === 'true') {
            $child_avatars['avatar_second_child'] = null;

        }

        $avatar_child_json = json_encode($child_avatars);
        $product->image_list = $avatar_child_json;
        $product->save();

        return redirect()->route("product.index");
    }

    public function getDelete($id)
    {
        $product = $this->product_repo->find($id);
        $product->delete();
        return redirect()->route("product.index");
    }

    public function getDeleteAll(Request $request)
    {
        return redirect()->route("product.index");
    }

    public function getEdit($id)
    {
        $categories = $this->category_repo->getAll();
        $product = $this->product_repo->find($id);
        return view("admin.product.edit", compact("categories", "product"));
    }


    public function postEdit(ProductRequest $request, $productId)
    {
        if (isset($request->sale) && ($request->sale > 0)) {
            $is_sale = true;
        } else {
            $is_sale = false;
        }

        if (isset($request->is_hot) && $request->is_hot === "on") {
            $is_hot = true;
        } else {
            $is_hot = false;
        }

        if (isset($avatar)) {
            $data["avatar"] = $avatar;
        }

        $content = null;

        if ($request->content) {
            $content = $request->content;
            $dom = new DOMDocument();
            $dom->loadHTML($content, 9);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                if (strpos($img->getAttribute('src'), 'data:image/') === 0) {

                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = "/upload/" . time() . $key . '.png';
                    file_put_contents(public_path() . $image_name, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }

            }
            $content = $dom->saveHTML();
        }

        $data = [
            "name" => $request->name,
            "slug" => str_slug($request->name),
            "price" => $request->price,
            "title" => $request->title,
            "content" => $content,
            "sale" => $request->sale,
            "is_sale" => $is_sale,
            "is_hot" => $is_hot,
            "category_id" => $request->category_id
        ];

        $this->product_repo->update($productId, $data);
        $product = $this->product_repo->find($productId);
        if ($request->isDeleteAvatar === 'true') {
            if ($product->avatar != null) {
                $avatar_path = public_path($product->avatar);
                if (File::exists($avatar_path)) {
                    File::delete($avatar_path);
                }
            }
            $product->avatar = null;
            $product->save();
        }

        if ($request->hasFile('avatar')) {
            if ($product->avatar != null) {
                $avatar_path = public_path($product->avatar);
                if (File::exists($avatar_path)) {
                    File::delete($avatar_path);
                }
            }
            $avatar = $request->file('avatar');
            $folder_name = $product->id . '-' . $product->created_at->format('Y-m-d');
            $file_name = $product->nickname . '-' . $product->created_at->format('Y-m-d') . '.' . $avatar->getClientOriginalExtension();

            $folder_path = public_path('avatar/' . $folder_name);
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0755, true, true);
            }

            $avatar->move($folder_path, $file_name);
            $product->avatar = 'avatar/' . $folder_name . '/' . $file_name;
            $product->save();
        }

        $child_avatars_origin = json_decode($product->image_list, true);
        $child_avatars = null;

        if ($request->isDeleteFC === 'true') {
            if ($child_avatars_origin && $child_avatars_origin['avatar_first_child'] !== null) {
                $avatar_path = public_path($child_avatars_origin['avatar_first_child']);
                if (File::exists($avatar_path)) {
                    File::delete($avatar_path);
                }
            }
            $child_avatars['avatar_first_child'] = null;
        }

        if ($request->isDeleteSC === 'true') {
            if ($child_avatars_origin && $child_avatars_origin['avatar_second_child'] !== null) {
                $avatar_path = public_path($child_avatars_origin['avatar_second_child']);
                if (File::exists($avatar_path)) {
                    File::delete($avatar_path);
                }
            }
            $child_avatars['avatar_second_child'] = null;
        }

        if (
            !$request->hasFile('avatar_first_child') && !$request->hasFile('avatar_second_child')
            && $request->isDeleteFC === 'false' &&
            $request->isDeleteSC === 'false'
        ) {
            $child_avatars = $child_avatars_origin ?? null;
        }

        if (!$request->hasFile('avatar_first_child') && $request->isDeleteFC !== 'true') {
            $child_avatars['avatar_first_child'] = $child_avatars_origin['avatar_first_child'] ?? null;
        }

        if (!$request->hasFile('avatar_second_child') && $request->isDeleteSC !== 'true') {
            $child_avatars['avatar_second_child'] = $child_avatars_origin['avatar_second_child'] ?? null;
        }

        if ($request->hasFile('avatar_first_child') && $request->isDeleteFC === 'false') {
            if ($child_avatars_origin['avatar_first_child'] !== null) {
                $avatar_path = public_path($child_avatars_origin['avatar_first_child']);
                if (File::exists($avatar_path)) {
                    File::delete($avatar_path);
                }
            }
            $avatar_first_child_file = $request->file('avatar_first_child');
            $folder_name = $product->id . '-' . $product->created_at->format('Y-m-d');
            $file_name = $product->name . '-' . $product->created_at->format('Y-m-d') . '.' . $avatar_first_child_file->getClientOriginalExtension();

            $folder_path = public_path('avatar/fc/' . $folder_name);
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0755, true, true);
            }
            $avatar_first_child_file->move($folder_path, $file_name);

            $child_avatars['avatar_first_child'] = 'avatar/fc/' . $folder_name . '/' . $file_name;
        }

        if ($request->hasFile('avatar_second_child')) {
            if ($child_avatars_origin['avatar_second_child'] != null) {
                $avatar_path = public_path($child_avatars_origin['avatar_second_child']);
                if (File::exists($avatar_path)) {
                    File::delete($avatar_path);
                }
            }
            $avatar_second_child_file = $request->file('avatar_second_child');
            $folder_name = $product->id . '-' . $product->created_at->format('Y-m-d');
            $file_name = $product->name . '-' . $product->created_at->format('Y-m-d') . '.' . $avatar_second_child_file->getClientOriginalExtension();

            $folder_path = public_path('avatar/sc/' . $folder_name);
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0755, true, true);
            }
            $avatar_second_child_file->move($folder_path, $file_name);
            $child_avatars['avatar_second_child'] = 'avatar/sc/' . $folder_name . '/' . $file_name;
        }
        $avatar_child_json = json_encode($child_avatars);
        $product->image_list = $avatar_child_json;
        $product->save();

        return redirect()->route("product.index");
    }

    public function delete($id)
    {
        $this->product_repo->delete($id);
        return redirect()->route('product.index');
    }

}
