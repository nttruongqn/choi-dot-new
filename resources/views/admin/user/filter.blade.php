<div class="my-4">
    <div class="row justify-content-between">
        <div class="col-9">
            <div class="filter">
                <form action="">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm tên tài khoản"
                                    name="user_search_value" value="{{ \Request::get('user_search_value') }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="filter_user_status" id="" class="form-select">
                                    <option value="">Tất cả trạng thái</option>
                                    @foreach (App\Enums\UserStatus::asSelectArray() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ \Request::get('filter_user_status') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="filter_user_role" id="" class="form-select">
                                    <option value="">Tất cả các vị trí</option>
                                    @if (isset($roles))
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ \Request::get('filter_user_role') == $role->id ? 'selected' : '' }}>
                                                {{ strtolower($role->name) }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-outline-secondary">Lọc</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-3">
            <div class="d-flex justify-content-end">
                <button class="btn btn-secondary" type="button">
                    <a href="{{ route('user.get.create') }}" class="nav-link">
                        Tạo tài khoản
                    </a>
                </button>
            </div>

        </div>
    </div>
</div>
