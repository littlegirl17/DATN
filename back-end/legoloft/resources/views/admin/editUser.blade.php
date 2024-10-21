@extends('admin.layout.layout')
@section('title', 'Chỉnh sửa người dùng')
@section('content')

    <div class="container-fluid">
        <h4 class="my-2"><i class="pe-2 fa-solid fa-edit"></i> Chỉnh sửa người dùng</h4>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tên người dùng</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" maxlength="15">
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_group_id" class="form-label">Hạng thành viên</label>
                <select class="form-select" id="user_group_id" name="user_group_id" required>
                    @foreach ($userGroups as $userGroup)
                        <option value="{{ $userGroup->id }}" {{ old('user_group_id', $user->user_group_id) == $userGroup->id ? 'selected' : '' }}>
                            {{ $userGroup->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_group_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới (nếu có)">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="{{ asset('storage/' . $user->image) }}" alt="Hình ảnh người dùng" class="mt-2" style="width: 80px; border-radius: 50%;">
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('userAdmin') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>

@endsection
