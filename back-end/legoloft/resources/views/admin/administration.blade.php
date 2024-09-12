 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thành viên')
 @Section('content')

     <div class="container-fluid">

         <div class="searchAdmin">
             <form id="filterFormAdministration" action="{{ route('searchAdministration') }}" method="GET">
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc theo tên đăng nhập</label>
                             <input class="form-control rounded-0" name="filter_name" placeholder="Tên đăng nhập"
                                 type="text" value="">
                         </div>
                     </div>

                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Lọc theo nhóm người dùng</label>
                             <select class="form-select rounded-0" aria-label="Default select example"
                                 name="filter_adminGroupId">
                                 <option value="">Tất cả</option>
                                 <option value="">
                                 </option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc người dùng
                     </button>
                 </div>
             </form>
         </div>

         <form id="submitFormAdmin">
             <div class="buttonProductForm mt-3">
                 <button class="btn btnF1">
                     <a href="{{ route('administrationAdd') }}" class="text-decoration-none text-light"><i
                             class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo mới người dùng</a>
                 </button>
                 <button class="btn btnF2" type="button" onclick="submitForm"><i class="pe-2 fa-solid fa-trash"
                         style="color: #ffffff;"></i>Xóa
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

                         <tr class="">
                             <td>
                                 <input type="checkbox" name="administration_id[]" value="{{ $item->id }}">
                             </td>
                             <td>Tên đăng nhập</td>
                             <td class="">
                                 <div class="form-check form-switch">
                                     <input class="form-check-input" type="checkbox" role="switch"
                                         data-id="{{ $item->id }}" id="flexSwitchCheckChecked">
                                     <label class="form-check-label" for="flexSwitchCheckChecked">Bật</label>
                                 </div>
                             </td>
                             <td>NHóm người dùng</td>
                             <td class="m-0 p-0">
                                 <div class="actionAdminProduct m-0 py-3">
                                     <button class="btnActionProductAdmin2"><a
                                             href="{{ route('administrationEdit', $item->id) }}"
                                             class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                 style="color: #ffffff;"></i>Chỉnh sửa người dùng</a></button>
                                 </div>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </form>
     </div>
 @endsection

 @section('scriptAdministration')
     <script>
         $(document).ready(function() {
             $('#filterFormAdministration').on('submit', function() {
                 var formData = $(this).serialize();

                 $.ajax({
                     url: '{{ route('searchAdministration') }}',
                     type: 'GET',
                     data: formData,
                     success: function(response) {
                         $('.table-body').html(response.html);
                     },
                     error: function(error) {
                         console.error('Lỗi khi lọc' + error);
                     }
                 })
             })
         })
     </script>
 @endsection
