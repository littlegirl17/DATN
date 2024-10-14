 @extends('admin.layout.layout')
 @Section('title', 'Admin | Bài viết')
 @Section('content')

     <div class="container-fluid">
         <div id="alert-message" class="alertDanger">
         </div>
         <div class="searchAdmin">
             <form id="filterFormCategory"  method="GET">
                 <div class="row d-flex flex-row justify-content-between align-items-center">
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Tiêu đề</label>
                             <input class="form-control rounded-0" name="filter_name" placeholder="Tiêu đề bài viết"
                                 type="text" value="">
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group mt-3">
                             <label for="title" class="form-label">Trạng thái</label>
                             <select class="form-select  rounded-0" aria-label="Default select example"
                                 name="filter_status">
                                 <option value="">Tất cả</option>
                                 <option value="1">Kích hoạt
                                 </option>
                                 <option value="0">Vô hiệu hóa
                                 </option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex justify-content-end align-items-end">
                     <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                             class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc bài viết</button>
                 </div>
             </form>
         </div>
         <form id="submitFormAdmin" >
             <div class="buttonProductForm mt-3">
                 <div class=""></div>
                 <div class="">
                     <button class="btn btnF1">
                         <a href="{{ route('articleAdd') }}" class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-plus"
                                 style="color: #ffffff;"></i>Tạo bài viết</a>
                     </button>
                     <button class="btn btnF2" type="button" onclick="">
                         <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa bài viết
                     </button>
                     
                 </div>

             </div>

             <div class="border p-2">
                 <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Bài Viết</h4>

                 <table class="table table-bordered pt-3">
                     <thead class="table-header">
                         <tr class="">
                             <th class=" py-2"></th>
                             <th class=" py-2">Danh mục</th>
                             <th class=" py-2">Tiêu đề</th>
                             <th class=" py-2">Ngày đăng</th>
                             <th class=" py-2">Trạng thái</th>
                             <th class=" py-2">Hành động</th>
                         </tr>
                     </thead>
                     <tbody class="table-body">
                        @foreach ($atc as $item)
                        <tr class="">
                            <td>
                                <input type="checkbox" name="category_id[]" id="" value="">
                            </td>
                            <td class="">{{$item->categoryArticle->title}}</td>
                            <td class="nameAdmin">
                                <p>{{$item->title}}</p>
                            </td>
                            <td class="">{{$item->created_at}}</td>
                            <td class="">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" data-id=""
                                        id="flexSwitchCheckChecked" style="font-size:20px; ">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                </div>
                            </td>
                            <td class="">
                                <div class="actionAdminProduct m-0 py-3">
                                    <button class="btnActionProductAdmin2"><a href="{{route('articleEdit', $item->id)}}"
                                            class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                style="color: #ffffff;"></i>Sửa lại
                                            bài viết</a></button>
                                </div>
                                <form action="{{ route('articleDel', ['id' => $item->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                     </tbody>

                 </table>
             </div>
         </form>

         <nav class="navPhanTrang">
             <ul class="pagination">
                 <li></li>
             </ul>
         </nav>
     </div>



 @endsection
