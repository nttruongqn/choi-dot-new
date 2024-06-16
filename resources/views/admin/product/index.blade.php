@extends('admin.master')
@section('main')
@section('title', 'Sản phẩm')
<div>
    <div class="pages-title-add d-flex align-items-center gap-2">
        <span>Quản lý sản phẩm</span>
        <a href="{{ route('product.get.create') }}">
            <span class="icon"><i class="fa-solid fa-plus"></i></span>
        </a>
    </div>
    <div class="pages-filter w-100 border rounded my-3 py-3 px-1">
        <div class="row">
            <div class="col-md-5 d-flex align-items-center">
                <input type="text" class="form-control" placeholder="Nhập tên danh mục" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
            <div class="col-md-3  d-flex align-items-center">
                <select name="filter_category_id" id="" class="form-select">
                    <option value="">Tất cả danh mục</option>
                    @if (isset($categories))
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ \Request::get('filter_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    @else
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
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Giá tiền</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $item)
                <tr class="align-middle ">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price, 0, '', '.') }} vnđ</td>
                    <td>
                        @if (isset($item->avatar))
                            <img src="{{ asset(config('app.url') . '/' . $item->avatar) }}" alt=""
                                style="width: 100px; height:100px; object-fit: contain">
                        @else
                            <span>Trống</span>
                        @endif
                    </td>
                    <td>{{ $item->category->name }}</td>
                    <td class="align-middle">
                        <button class="btn btn-custom-edit">
                            <a href="{{ route('product.get.edit', [$item->id]) }}" class="nav-link">
                                <i class="ri-pencil-fill"></i>
                                <span>Sửa</span>
                            </a>
                        </button>
                        <button class="btn btn-custom-delete">
                            <a href="{{ route('product.get.delete', [$item->id]) }}" class="nav-link"
                                onclick="return confirm('Bạn có muốn xóa ?')">
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
        {{ $products->links('pagination::bootstrap-4') }}
    </nav>
</div>
@endsection()
