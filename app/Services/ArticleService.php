<?php
namespace App\Services;

use App\Repositories\Article\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use DOMDocument;
use Illuminate\Support\Facades\File;


class ArticleService
{
    private $article_repo;

    public function __construct(ArticleRepositoryInterface $article_repo)
    {
        $this->article_repo = $article_repo;
    }

    public function index(Request $request)
    {
        $articles = $this->article_repo->getAllWithConditions($request);
        return view('admin.article.index', compact('articles'));
    }

    public function getAllWithConditions($request)
    {
        return $this->article_repo->getAllWithConditions($request);
    }

    public function getAll()
    {
        return $this->article_repo->getAll();
    }

    public function getCreate()
    {
        return view("admin.article.create");
    }

    public function create(Request $request)
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
            "title" => $request->title,
            "slug" => str_slug($request->title),
            "content" => $content,
            "author" => $request->author,
        ];
        $article = $this->article_repo->create($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $folder_name = $article->id . '-' . $article->created_at->format('Y-m-d');
            $file_name = $article->title . '-' . $article->created_at->format('Y-m-d') . '.' . $image->getClientOriginalExtension();

            $folder_path = public_path('article-images/' . $folder_name);
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0755, true, true);
            }

            $image->move($folder_path, $file_name);
            $article->image = 'article-images/' . $folder_name . '/' . $file_name;
            $article->save();
        }

        return redirect()->route('article.index');
    }

    public function getEdit($id)
    {
        $article = $this->article_repo->find($id);
        return view('admin.article.edit', compact('article'));
    }


    public function postEdit(Request $request, $id)
    {
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
            "title" => $request->title,
            "slug" => str_slug($request->title),
            "content" => $content,
            "author" => $request->author,
        ];
        $article = $this->article_repo->find($id);

        if ($request->isDeleteAvatarArticle === 'true') {
            if ($article->image != null) {
                $avatar_path = public_path($article->image);
                if (File::exists($avatar_path)) {
                    File::delete($avatar_path);
                }
            }
            $article->image = null;
            $article->save();
        }
        $this->article_repo->update($id, $data);

        if ($request->hasFile('image') && $request->isDeleteAvatarArticle === 'false') {
            if ($article->image != null) {
                $image_path = public_path($article->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $image = $request->file('image');
            $folder_name = $article->id . '-' . $article->created_at->format('Y-m-d');
            $file_name = $article->title . '-' . $article->created_at->format('Y-m-d') . '.' . $image->getClientOriginalExtension();

            $folder_path = public_path('article-images/' . $folder_name);
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0755, true, true);
            }

            $image->move($folder_path, $file_name);
            $article->image = 'article-images/' . $folder_name . '/' . $file_name;
            $article->save();
        }
        return redirect()->route('article.index');


    }

    public function delete($id)
    {
        $this->article_repo->delete($id);
        return redirect()->route('article.index');
    }

}

