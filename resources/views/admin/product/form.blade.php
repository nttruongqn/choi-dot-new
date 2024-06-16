<form method="POST" enctype="multipart/form-data">
    {{-- @include('errors.note') --}}
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" placeholder ="Nhập tên sản phẩm" name="name"
                    value="{{ old('name', isset($product->name) ? $product->name : '') }}">
            </div>
            @if ($errors->has('name'))
                <div class="error-text">
                    <p class="text-danger"> {{ $errors->first('name') }}</p>
                </div>
            @endif
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="name">Loại sản phẩm</label>
                <select name="category_id" id="" class="form-select">
                    <option value="">--Vui lòng chọn danh mục--</option>
                    @if (isset($categories))
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', isset($product->category_id) ? $product->category_id : '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('category_id'))
                    <div class="text-danger">
                        {{ $errors->first('category_id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="price">Giá tiền</label>
                <input type="text" class="form-control" id="price" placeholder ="Nhập giá tiền" name="price"
                    value="{{ old('price', isset($product->price) ? $product->price : '') }}">
            </div>
            @if ($errors->has('price'))
                <div class="text-danger">
                    {{ $errors->first('price') }}
                </div>
            @endif
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="price">% Khuyến mãi</label>
                <input type="text" class="form-control" id="sale" placeholder ="% Khuyến mãi" name="sale"
                    value="{{ old('price', isset($product->sale) ? $product->sale : '') }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control" id="title" placeholder ="Tiêu đề sản phẩm" name="title"
                    value="{{ old('title', isset($product->title) ? $product->title : '') }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="content">Nội dung bài viết</label>
                <textarea class="form-control" name="content" id="content-custom" cols="30" rows="10"
                    placeholder="Nội dung sản phẩm">{{ old('content', isset($product->content) ? $product->content : '') }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_hot"
                    @if (isset($product)) {{ old('is_hot', isset($product->is_hot) ? $product->is_hot : '') == $product->is_hot ? 'checked' : '' }}> @endif
                    <label class="form-check-label" for="exampleCheck1">Nổi bật</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                @if (isset($product) && $product->avatar)
                    <img src="{{ asset(config('app.url') . '/' . $product->avatar) }}" alt="" id="output"
                        style="width: 140px; height:140px; object-fit: contain">
                @else
                    <img src="assets/images/no_image.png" id="output"
                        style="width: 200px; height:200px; object-fit: contain">
                @endif

            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="avatar">Avatar</label>
                    <span style="font-size: 12px" onclick="removeAvatar()">Xóa ảnh</span>
                </div>
                <input type="hidden" value="false" name="isDeleteAvatar" id="isDeleteAvatar">
                <input type="file" onchange="loadFile(event)" class="form-control" name="avatar" id="avatar"
                    value="{{ old('avatar', isset($product->avatar) ? $product->avatar : '') }}">
            </div>
        </div>
        <div class="col-12 my-4">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <input type="hidden" value="false" name="isDeleteFC" id="isDeleteFC">
                        <input type="hidden" value="false" name="isDeleteSC" id="isDeleteSC">
                        @if (isset($product) && $product->image_list !== null)
                            @php
                                $list_image = json_decode($product->image_list);
                                if (isset($list_image)) {
                                    $avatar_first_child = $list_image->avatar_first_child;
                                    $avatar_first_child_url = asset(config('app.url') . '/' . $avatar_first_child);
                                }
                            @endphp
                            @if (isset($avatar_first_child_url) && $avatar_first_child !== null)
                                <img src="{{ $avatar_first_child_url }}" alt="" id="output_first"
                                    style=" height: 140px; width:140px; object-fit: contain;">
                            @else
                                <img src="assets/images/no_image.png" alt="" id="output_first"
                                    style=" height: 140px; width:140px; object-fit: contain;">
                            @endif
                        @else
                            <img src="assets/images/no_image.png" id="output_first"
                                style=" height: 140px; width:140px; object-fit: contain;">
                        @endif
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="avatar_first_child">Ảnh bổ sung 1</label>
                                <span style="font-size: 12px" onclick="removeFC()">Xóa ảnh</span>
                            </div>
                            <input type="file" onchange="loadFileChildrenFirst(event)" class="form-control"
                                name="avatar_first_child" id="avatar_first_child"
                                value="{{ old('avatar', isset($avatar_first_child) ? $avatar_first_child : '') }}">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        @if (isset($product) && $product->image_list !== null)
                            @php
                                $list_image = json_decode($product->image_list);
                                if (isset($list_image)) {
                                    $avatar_second_child = $list_image->avatar_second_child;
                                    $avatar_second_child_url = asset(config('app.url') . '/' . $avatar_second_child);
                                }
                            @endphp
                            @if (isset($avatar_second_child_url) && $avatar_second_child !== null)
                                <img src="{{ $avatar_second_child_url }}" alt="" id="output_second"
                                    style=" height: 140px; width:140px; object-fit: contain;">
                            @else
                                <img src="assets/images/no_image.png" alt="" id="output_second"
                                    style=" height: 140px; width:140px; object-fit: contain;">
                            @endif
                        @else
                            <img src="assets/images/no_image.png" id="output_second"
                                style=" height: 140px; width:140px; object-fit: contain;">
                        @endif
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="avatar_second_child">Ảnh bổ sung 2</label>
                                <span style="font-size: 12px" onclick="removeSC()">Xóa ảnh</span>
                            </div> <input type="file" onchange="loadFileChildrenSecond(event)"
                                class="form-control" name="avatar_second_child" id="avatar_second_child"
                                value="{{ old('avatar', isset($avatar_second_child) ? $avatar_second_child : '') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-2">
        <button type="submit" class="btn btn-secondary">Lưu</button>
        {{ csrf_field() }}
    </div>
</form>

@section('script')
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', {
            filebrowserImageBrowseUrl: '../laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '../laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '../laravel-filemanager?type=Files',
            filebrowserUploadUrl: '../laravel-filemanager/upload?type=Files&_token='
        })
    </script>
@endsection
