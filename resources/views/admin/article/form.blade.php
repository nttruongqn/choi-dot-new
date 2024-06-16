<form method="POST" enctype="multipart/form-data">
    {{-- @include('errors.note') --}}
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label for="name">Tiêu đề bài viết</label>
                <input type="text" class="form-control" id="name" placeholder ="Nhập tên bài viết" name="title"
                    value="{{ old('name', isset($article->title) ? $article->title : '') }}">
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label for="name">Tác giả</label>
                <input type="text" class="form-control" id="author" placeholder ="Nhập tên tác giả" name="author"
                    value="{{ old('author', isset($article->author) ? $article->author : '') }}">
            </div>
        </div>
        <input type="hidden" value="false" name="isDeleteAvatarArticle" id="iDAI">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                @if (isset($article) && $article->image)
                    <img src="{{ asset(config('app.url') . '/' . $article->image) }}" alt="" id="output_article"
                        style="width: 140px; height:140px; object-fit: contain">
                @else
                    <img src="assets/images/no_image.png" id="output_article"
                        style="width: 200px; height:200px; object-fit: contain">
                @endif

                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="avatar">Ảnh tiêu đề</label>
                        <span style="font-size: 12px" onclick="removeImageArticle()">Xóa ảnh</span>
                    </div>
                    <input type="file" onchange="loadFileImageArticle(event)" class="form-control" name="image"
                        id="image_title" value="{{ old('image', isset($article->image) ? $article->image : '') }}">
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="content">Nội dung bài viết</label>
                <textarea class="form-control" name="content" id="content-article-custom" cols="30" rows="10"
                    placeholder="Nội dung bài viết">{{ old('content', isset($article->content) ? $article->content : '') }}</textarea>
            </div>
        </div>
    </div>
    <div class="py-2">
        <button type="submit" class="btn btn-secondary">Lưu</button>
        {{ csrf_field() }}
    </div>
</form>
