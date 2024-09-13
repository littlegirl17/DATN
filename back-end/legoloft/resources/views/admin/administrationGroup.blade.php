 @extends('admin.layout.layout')
 @Section('title', 'Admin | Nhóm người dùng')
 @Section('content')

     <div class="container-fluid">
         @if (session('error'))
             <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
         @endif
         @if (session('success'))
             <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
         @endif

         <form id="submitFormAdmin" method="">
             <div class="buttonProductForm">
                 <button class="btn btnF1">
                     <a href="{{ route('addAdminstrationGroup') }}" class="text-decoration-none text-light"><i
                             class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo Nhóm người dùng</a>
                 </button>
                 <button class="btn btnF2" type="button" onclick="">
                     <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                 </button>

             </div>

             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Nhóm người dùng</h4>
                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr>
                             <th class=" py-2"></th>
                             <th class=" py-2">Tên Nhóm người dùng</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="">
                         <tr class="">
                             <td>
                                 <input type="checkbox" name="" id="" value="">
                             </td>
                             <td class="nameAdmin">
                                 <p></p>
                             </td>
                             <td class="m-0 p-0">
                                 <div class="actionAdminProduct m-0 py-3">
                                     <button class="btnActionProductAdmin2">
                                         {{-- <a href="{{ route('editAdminstrationGroup') }}"
                                             class="text-decoration-none text-light">
                                             <i class="pe-2 fa-solid fa-pen" style="color: #ffffff;"></i>Sửa
                                             nhóm người dùng</a> --}}
                                     </button>
                                 </div>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </form>

         <nav class="navPhanTrang">
             <ul class="pagination">
             </ul>
         </nav>
     </div>


 @endsection
