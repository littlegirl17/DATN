 @extends('admin.layout.layout')
 @Section('title', 'Admin | Thêm bài viết')
 @Section('content')

     <div class="container-fluid">
         <h3 class="title-page ">
             Thêm bài viết
         </h3>

         <form action="/admin/add-post" method="post" class="formAdmin" enctype="multipart/form-data">
             <div class="buttonProductForm">
                 <div class="">
                     @if (session('error'))
                         <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                     @endif
                 </div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>
             <div class="form-group mt-3">
                 <label for="exampleInputFile" class="form-label">Ảnh danh mục
                     <div class="custom-file">
                         <input type="file" name="image" id="HinhAnh">
                         <div id="preview"></div>
                     </div>
                 </label>
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Tiêu đề</label>
                 <input type="text" class="form-control" name="title" placeholder="Nhập danh mục bài viết">
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Danh mục</label>
                 <select name="category_id" id="" class="form-select mt-3">
                     <option value=""></option>
                 </select>
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Mô tả ngắn</label>
                 <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Mô tả</label>
                 <textarea class="form-control" name="description" id="" cols="30" rows="15"></textarea>
             </div>
             <div class="form-group mt-3">
                 <label for="title" class="form-label">Trạng thái</label>
                 <select class="form-select " aria-label="Default select example" name="status">
                     <option selected>Trang thái</option>
                     <option value="1">Bật</option>
                     <option value="0">Tắt</option>
                 </select>
             </div>
         </form>
     </div>


 @endsection
