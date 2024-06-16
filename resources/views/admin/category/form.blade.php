<form method="POST">
    {{-- @include('errors.note') --}}
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" id="name" placeholder ="Nhập tên danh mục" name="name"
                    value="{{ old('name', isset($category->name) ? $category->name : '') }}">
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <div class="form-group">
                <label for="parent_id">Danh mục cha</label>
                <select name="parent_id" class="form-select" id="parent_id">
                    <option value="">Không có</option>
                    @if (isset($categories))
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}"
                                {{ old('parent_id', isset($category->parent_id) ? $category->parent_id : '') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="py-2">
        <button type="submit" class="btn btn-secondary">Lưu</button>
        {{ csrf_field() }}
    </div>
</form>
