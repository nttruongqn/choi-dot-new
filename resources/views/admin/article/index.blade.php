@extends('admin.master')
@section('main')
@section('title', 'Bài viết')
<div>
    <div class="pages-title-add d-flex align-items-center gap-2">
        <span>Quản lý bài viết</span>
        <a href="{{ route('article.get.create') }}">
            <span class="icon"><i class="fa-solid fa-plus"></i></span>
        </a>
    </div>
    <div class="pages-filter w-100 border rounded my-3 py-3 px-1">
        <div class="row">
            <div class="col-md-5 d-flex align-items-center">
                <input type="text" class="form-control" placeholder="Nhập tiêu đề bài viết" aria-label="Username"
                    aria-describedby="basic-addon1">
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
                <th scope="col">Tiêu đề bài viết</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Tác giả</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $key => $item)
                <tr class="align-middle ">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        @if (isset($item->image))
                            <img src="{{ asset(config('app.url') . '/' . $item->image) }}" alt=""
                                style="width: 100px; height:100px; object-fit: contain">
                        @else
                            <span>Trống</span>
                        @endif
                    </td>
                    <td>{{ $item->author }}</td>
                    <td class="align-middle">
                        <button class="btn btn-custom-edit">
                            <a href="{{ route('article.get.edit', [$item->id]) }}" class="nav-link">
                                <i class="ri-pencil-fill"></i>
                                <span>Sửa</span>
                            </a>
                        </button>
                        <button class="btn btn-custom-delete">
                            <a href="{{ route('article.get.delete', [$item->id]) }}" class="nav-link"
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
        {{ $articles->links('pagination::bootstrap-4') }}
    </nav>
</div>
@endsection()
