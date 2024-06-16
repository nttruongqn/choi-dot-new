@extends('admin.master')
@section('main')
@section('title', 'Tài khoản')
<div>
    <div class="pages-title-add d-flex align-items-center gap-2">
        <span>Quản lý tài khoản</span>
        <a href="{{ route('user.get.create') }}">
            <span class="icon"><i class="fa-solid fa-plus"></i></span>
        </a>
    </div>

    <div class="pages-filter w-100 border rounded my-3 py-3 px-1">
        <div class="row">
            <div class="col-md-5 d-flex align-items-center">
                <input type="text" class="form-control" placeholder="Nhập tên tài khoản" aria-label="Username"
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
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $item)
                <tr class="align-middle">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ strtolower($item->role->name) }}</td>
                    <td><span
                            class="{{ $item->getStatusClass($item->status)['class'] }}">{{ \App\Enums\UserStatus::getDescription($item->status) }}</span>
                    </td>
                    <td>
                        <button class="btn btn-custom-edit">
                            <a href="{{ route('user.get.edit', [$item->id]) }}" class="nav-link">
                                <i class="ri-pencil-fill"></i>
                                <span>Sửa</span>
                            </a>
                        </button>
                        <button class="btn btn-custom-delete">
                            <a href="{{ route('user.get.delete', [$item->id]) }}" class="nav-link"
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
        {{ $users->links('pagination::bootstrap-4') }}
    </nav>
</div>
@endsection()
