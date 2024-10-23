@extends('admin.layout.layout')
@Section('title', 'Admin | Dịch vụ lắp ráp Lego')
@Section('content')
    <div class="container-fluid">
        <form id="submitFormAdmin">
            <div class="buttonProductForm mt-3">
                <div class="">
                    @if (session('error'))
                        <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                    @endif
                </div>
                <div class=""></div>
            </div>
            <div class="border p-2 mt-3">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách sản phẩm lắp ráp</h4>
                <table class="table table-bordered  pt-3">
                    <thead class="table-header">
                        <tr class="">
                            <th class=" py-2"></th>
                            <th class=" py-2">Nhân viên lắp ráp</th>
                            <th class=" py-2">Sản phẩm</th>
                            <th class=" py-2">Phí lắp ráp</th>
                            <th class=" py-2">Trạng thái</th>
                            <th class=" py-2">Hành động</th>
                        </tr>
                    </thead>

                    <tbody class="table-body">
                        @foreach ($assemblys as $item)
                            <tr class="">
                                <td>
                                    <input class="" type="checkbox" name="assembly_id[]" value="">
                                    <p class=""></p>
                                </td>
                                <td class="nameAdmin">
                                    <p>{{ $item->employee->username }}</p>
                                </td>
                                <td class="">{{ $item->product->name }}</td>
                                <td class="">{{ number_format($item->fee, 0, ',', '.') . 'đ' }}</td>
                                <td>
                                    @switch($item->status)
                                        @case(1)
                                            <span class="assemblyNew">Đơn lắp mới</span>
                                        @break

                                        @case(2)
                                            <span class="assemblyDo">Đang trong quá trình lắp ráp</span>
                                        @break

                                        @case(3)
                                            <span class="assemblySuccess">Hoàn thành lắp ráp</span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="m-0
                                                p-0">
                                    <div class="actionAdminProduct">
                                        <div class="buttonProductForm m-0 py-3">
                                            <button type="button" class="btnActionProductAdmin2"><a
                                                    href="{{ route('editAssembly', $item->id) }}"
                                                    class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                        style="color: #ffffff;"></i>Chỉnh
                                                    sửa</a></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </form>
    </div>

@endsection
