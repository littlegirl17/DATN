@extends('admin.layout.layout')
@section('title', 'Admin | Người dùng')
@section('content')

    <div class="container-fluid">
        <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Người Dùng</h4>

        <div class="mb-3">
            <a href="{{ route('user.add') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Thêm Người Dùng
            </a>
        </div>

        <div class="border p-2">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered pt-3">
                <thead class="table-header">
                <tr>
                    <th class="py-2"></th>
                    <th class="py-2">Hình ảnh</th>
                    <th class="py-2">Tên người dùng</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Hạng thành viên</th>
                    <th class="py-2">Trạng thái</th>
                    <th class="py-2">Hành động</th>
                </tr>
                </thead>

                <tbody class="table-body">
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <input type="checkbox" name="user_id[]" value="{{ $user->id }}">
                        </td>
                        <td>
                            <img src="{{ asset('img/' . $user->image) }}" alt=""
                                 style="width: 80px; border-radius: 50%; height: 80px; object-fit: cover;">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->userGroup->name ?? 'Chưa có nhóm' }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                       data-id="{{ $user->id }}" id="flexSwitchCheckChecked"
                                    {{ $user->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckChecked">
                                    {{ $user->status == 1 ? 'Hoạt động' : 'Vô hiệu hóa' }}
                                </label>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info"
                                onclick="window.location.href='{{ route('user.edit', $user->id) }}'">
                                <i class="fa-solid fa-pen"></i> Sửa
                            </button>

                            <!-- Form Xóa Người Dùng -->
                            <form action="{{ route('user.deleteUser', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Hiển thị phân trang -->
            <nav class="navPhanTrang">
                {{ $users->links() }}
            </nav>
        </div>
    </div>

@endsection
