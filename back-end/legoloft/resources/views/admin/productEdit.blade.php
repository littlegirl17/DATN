 @extends('admin.layout.layout')
 @Section('title', 'Admin | Sửa sản phẩm')
 @Section('content')

     <div class="container-fluid">


         <h3 class="title-page ">
             Chỉnh sửa sản phẩm
         </h3>

         <form action="{{ route('editProduct', $product->id) }}" method="post" class="formAdmin" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="buttonProductForm">
                 <div class=""></div>
                 <div class="">
                     <button type="submit" class="btnFormAdd">
                         <p class="text m-0 p-0">Lưu</p>
                     </button>
                 </div>
             </div>


             <ul class="nav nav-tabs" id="myTab" role="tablist">
                 <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                         type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Chung</button>
                 </li>
                 <li class="nav-item" role="presentation">
                     <button class="nav-link" id="discount-tab" data-bs-toggle="tab" data-bs-target="#discount-tab-pane"
                         type="button" role="tab" aria-controls="discount-tab-pane" aria-selected="false">Giảm
                         giá</button>
                 </li>
                 <li class="nav-item" role="presentation">
                     <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                         type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Hình
                         ảnh</button>
                 </li>
             </ul>

             <div class="tab-content" id="myTabContent">
                 <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                     tabindex="0">
                     <div class="form-group mt-3">
                         <label for="name" class="form-label">Tên sản phẩm</label>
                         <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="name"
                             value="{{ $product->name }}">
                     </div>
                     <div class="form-group mt-3">
                         <label for="slug" class="form-label">Slug</label>
                         <input type="text" class="form-control" id="convert_slug" name="slug"
                             value="{{ $product->slug }}">
                     </div>
                     <div class="form-group mt-3">
                         <label for="description" class="form-label">Nội dung chi tiết sản phẩm</label>
                         <textarea class="form-control" id="editor1" name="description" rows="3">{{ $product->description }}
                    </textarea>
                     </div>

                     <div class="form-group mt-3">
                         <label for="description" class="form-label">Chọn danh mục của sản phẩm</label>
                         <select class="form-select " name="category_id">
                             @foreach ($categories as $category)
                                 @foreach ($category->categories_children as $item)
                                     <option value="{{ $item->id }}" {{ $product->id == $item->id ? 'selected' : 0 }}>
                                         {{ $item->name }}
                                     </option>
                                 @endforeach
                             @endforeach

                         </select>
                     </div>
                     <div class="form-group mt-3">
                         <label for="price" class="form-label">Giá sản phẩm</label>
                         <input type="number" class="form-control" id="price" name="price"
                             value="{{ $product->price }}">
                     </div>

                     <div class="form-group mt-3">
                         <label for="price" class="form-label">Lượt xem</label>
                         <input type="number" class="form-control" id="view" name="view"
                             value="{{ $product->view }}">
                     </div>
                     <div class="form-group mt-3">
                         <label for="">Nổi bật</label>
                         <select class="form-select mt-3" aria-label="Default select example" name="outstanding">
                             <option value="0" {{ $product->outstanding == 0 ? 'selected' : '' }}>Tắt</option>
                             <option value="1" {{ $product->outstanding == 1 ? 'selected' : '' }}>Bật</option>
                         </select>
                     </div>

                     <div class="form-group mt-3">
                         <label for="">Trạng thái</label>
                         <select class="form-select mt-3" aria-label="Default select example" name="status">
                             <option value="0"{{ $product->status == 0 ? 'selected' : '' }}>Tắt</option>
                             <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Bật</option>
                         </select>
                     </div>
                 </div>
                 {{-- <div class="tab-pane fade" id="discount-tab-pane" role="tabpanel" aria-labelledby="discount-tab"
                     tabindex="0">
                     <table class="table table-bordered mt-3 pt-3">
                         <thead>
                             <tr>
                                 <th>Nhóm khách hàng</th>
                                 <th>Số lượng</th>
                                 <th>Giá</th>
                             </tr>
                         </thead>
                         <tbody class="discount-product">
                             <tr>
                                 <td>
                                     <select class="form-select" aria-label="Default select example"
                                         name="user_group_id[]">
                                         <option value="{{ $userGroupItem->id }}">
                                         </option>
                                     </select>
                                 </td>
                                 <td><input class="form-control" type="number"
                                         name="quantityUserGroup[{{ $item->user_group_id }}]" value="">
                                 </td>
                                 <td><input class="form-control" type="number"
                                         name="priceUserGroup[{{ $item->user_group_id }}]" value=""></td>
                             </tr>
                         </tbody>
                     </table>
                     <div class="row mb-3">
                         <div class="col-md-12">
                             <button type="button" class="btn btn-primary add-discount-btn">Thêm mức giảm
                                 giá</button>
                         </div>
                     </div>
                 </div> --}}
                 <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                     tabindex="0">
                     <div class="form-group  mt-3">
                         <h4 class="label_admin">Ảnh sản phẩm</h4>
                         <div class="custom-file imageAdd p-3 ">
                             <input type="file" name="image" id="HinhAnh" class="inputFile">
                             <img src="{{ asset('img/' . $product->image) }}" alt=""
                                 style="width:80px; height:80px; object-fit:cover;">
                         </div>

                     </div>
                     <div class="form-group mt-3">
                         <h4>Hình ảnh bổ sung</h4>
                         <div class="row bannnerImagesEdit">
                             <div class="col-md-12 productImagePut">
                                 <div class="row row_product">
                                     <div class="col-md-6 col-sm-12 col-12">
                                         <label for="exampleInputFile" class="label_admin">Ảnh banner</label>
                                         <div class="custom-file">
                                             <input type="file" name="image[]" id="HinhAnh" multiple
                                                 class="inputFile">
                                             <div id="preview"></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-12 col-12">
                                         <label for="title" class="form-label">Tiêu đề</label>
                                         <input type="text" class="form-control" name="title"
                                             aria-describedby="title" placeholder="Nhập tiêu đề hình ảnh ">
                                     </div>
                                     <div class="col-md-2 col-sm-12 col-12">
                                         <label for="title" class="form-label">Thứ tự xuất hiện</label>
                                         <input type="number" class="form-control" name="sort_order" id=""
                                             aria-describedby="" placeholder="">
                                     </div>
                                     <div class="col-md-1 col-sm-12 col-12">
                                         <button class="remove_bannerImages_add remove_productImages"
                                             href="">Xóa</button>
                                     </div>
                                 </div>
                             </div>

                             <div class="row m-0 p-0">
                                 <button type="button" class="btn btn-primary  btn-ProductImagesAdd">Thêm hình
                                     ảnh</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </form>
     </div>
 @endsection

 @section('productEditAdminScript')
     <script>
         $(document).ready(function() {
             let productImages = `
         <div class="col-md-12 productImagePut">
            <div class="row row_product">
                <div class="col-md-6 col-sm-12 col-12">
                    <label for="exampleInputFile" class="label_admin">Ảnh banner</label>
                    <div class="custom-file">
                        <input type="file" name="image[]" id="HinhAnh" multiple class="inputFile">
                        <div id="preview"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-12">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="title"
                        aria-describedby="title" placeholder="Nhập tiêu đề hình ảnh ">
                </div>
                <div class="col-md-2 col-sm-12 col-12">
                    <label for="title" class="form-label">Thứ tự xuất hiện</label>
                    <input type="number" class="form-control" name="sort_order" id=""
                        aria-describedby="" placeholder="">
                </div>
               <div class="col-md-1 col-sm-12 col-12">
                    <button class="remove_bannerImages_add remove_productImages" href="">Xóa</button>
                </div>
            </div>
        </div>
        `;
             $('.btn-ProductImagesAdd').click(function() {
                 $('.productImagePut').append(productImages.trim());
             });
             //append  sử dụng để thêm nội dung vào cuối của một phần tử đã chọn // trim dùng để loại bỏ khoảng trắng ở đầu và cuối chuỗi // closest tìm phần tử cha gần nhất (ancestor) khớp với bộ chọn được cung cấp
             $(document).on('click', '.remove_productImages', function() {
                 $(this).closest('.row_product').remove();
             })
         })
     </script>
 @endsection
 {{--
@section('productDiscountUserGroup')
    <script>
        $(document).ready(function() {
            let discountRowTemplate = `
                <tr class="discount-row">
                    <td>
                        <select class="form-select" aria-label="Default select example" name="user_group_id[]">
                            @foreach ($userGroup as $userGroupItem)
                                <option value="{{ $userGroupItem->id }}">{{ $userGroupItem->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="number" name="quantityUserGroup[]" >
                    </td>
                    <td>
                        <input class="form-control" type="number" name="priceUserGroup[]" >
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-discount-btn">Xóa</button>
                    </td>
                </tr>
            `;

            $('.add-discount-btn').click(function() {
                $('.discount-product').append(discountRowTemplate.trim());
            });

            $(document).on('click', '.remove-discount-btn', function() {
                $(this).closest('.discount-row').remove();
            });
        });
    </script>
@endsection --}}
