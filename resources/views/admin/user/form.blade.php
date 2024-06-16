<form method="POST">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="username">Tên tài khoản</label>
                <input type="text" class="form-control" id="username" placeholder ="Nhập tên tài khoản" name="username"
                    value="{{ old('username', isset($user->username) ? $user->username : '') }}">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="role_id">Vị trí</label>
                <select name="role_id" id="" class="form-select">
                    <option value="">Vui lòng chọn vị trí</option>
                    @if (isset($roles))
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', isset($user->role_id) ? $user->role_id : '') == $role->id ? 'selected' : '' }}>
                                {{ strtolower($role->name) }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email"
                    value="{{ old('email', isset($user->email) ? $user->email : '') }}"
                    @if (isset($user)) disabled @endif>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" id="" class="form-select">
                    <option value="">Vui lòng chọn trạng thái</option>
                    @foreach (App\Enums\UserStatus::asSelectArray() as $key => $value)
                        <option value="{{ $key }}"
                            {{ old('status', isset($user->status) ? $user->status : '') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="py-2">
        <button type="submit" class="btn btn-secondary">Lưu</button>
        {{ csrf_field() }}
    </div>
</form>
