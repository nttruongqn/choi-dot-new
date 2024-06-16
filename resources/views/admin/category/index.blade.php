@extends('admin.master')
@section('main')
@section('title', 'Danh mục')
<div>
    <div class="pages-title-add d-flex align-items-center gap-2">
        <span>Quản lý danh mục</span>
        <a href="{{route('category.get.create')}}">
            <span class="icon"><i class="fa-solid fa-plus"></i></span>
        </a>
    </div>

    <div class="pages-filter w-100 border rounded my-3 py-3 px-1">
            <div class="row">
                <div class="col-md-5 d-flex align-items-center">
                        <input type="text" class="form-control" placeholder="Nhập tên danh mục" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="col-md-3  d-flex align-items-center">
                    <select name="filter_category_parent_id" id="" class="form-select">
                        <option value="">Danh mục cha</option>
                        @if (isset($categories_is_parent_id))
                            @foreach ($categories_is_parent_id as $category)
                                <option value="{{ $category->id }}"
                                    {{ \Request::get('filter_category_parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="pages-filter-search-icon d-flex align-items-center col-md-1">
                    <span><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
            </div>
    </div>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Danh mục cha</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key => $item)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td class="align-middle">{{ $item->id }}</td>
                    <td class="align-middle">{{ $item->name }}</td>
                    <td class="align-middle">{{ $item->parent ? $item->parent->name : 'Trống' }}</td>
                    <td class="align-middle">
                        <button class="btn btn-custom-edit">
                            <a href="{{ route('category.get.edit', [$item->id]) }}" class="nav-link">
                                <i class="ri-pencil-fill"></i>
                                <span>Sửa</span>
                            </a>
                        </button>
                        <button class="btn btn-custom-delete">
                            <a href="{{ route('category.get.delete', [$item->id]) }}" class="nav-link" onclick="return confirm('Bạn có muốn xóa ?')">
                                <i class="ri-pencil-fill"></i>
                                <span>Xóa</span>
                            </a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation">
        {{ $categories->links('pagination::bootstrap-4') }}
    </nav>
</div>
@endsection()
