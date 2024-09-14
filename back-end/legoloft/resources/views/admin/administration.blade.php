 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thành viên')
 @Section('content')
     <div class="container-fluid">



         <form id="submitFormAdmin">
             @csrf
             <div class="buttonProductForm mt-3">
                 <button type="button" class="btn btnF1" onclick="window.location.href='{{ route('addAdminstration') }}'">
                     <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo mới người dùng
                 </button>
                 <button class="btn btnF2" type="button" onclick="submitForm('{{ route('deleteAdminstration') }}','post')"><i
                         class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                     người dùng</button>
             </div>
             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách người dùng</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class="py-2"></th>
                             <th class="py-2">Tên đăng nhập</th>
                             <th class="py-2">Trạng thái</th>
                             <th class="py-2">Nhóm người dùng</th>
                             <th class="py-2">Hành động</th>

                         </tr>
                     </thead>
                     <tbody class="table-body">
                         @foreach ($administration as $item)
                             <tr class="">
                                 <td>
                                     <div class="d-flex justify-content-center align-items-center">
                                         <input type="checkbox" id="cbx" class="hidden-xs-up"
                                             name="administration_id[]" value="{{ $item->id }}">
                                         <label for="cbx" class="cbx"></label>
                                     </div>
                                 </td>
                                 <td>{{ $item->username }}</td>
                                 <td class="">
                                     <div class="form-check form-switch">
                                         <input class="form-check-input" type="checkbox" role="switch"
                                             data-id="{{ $item->id }}" id="flexSwitchCheckChecked">
                                         <label class="form-check-label" for="flexSwitchCheckChecked">Bật</label>
                                     </div>
                                 </td>
                                 <td>{{ $item->administrationGroup->name }}</td>
                                 <td class="m-0 p-0">
                                     <div class="actionAdminProduct m-0 py-3">
                                         <button type="button" class="btnActionProductAdmin2"><a
                                                 href="{{ route('editAdminstration', $item->id) }}"
                                                 class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                     style="color: #ffffff;"></i>Chỉnh sửa người dùng</a></button>
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
