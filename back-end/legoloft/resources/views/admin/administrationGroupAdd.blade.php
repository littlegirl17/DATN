@extends('admin.layout.layout')
@Section('title', 'Admin | Thêm nhóm người dùng')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Thêm nhóm người dùng
        </h3>
        <div class="formAdminAlert">
            <div class="alert alert-danger py-2"></div>
        </div>

        <form action="/admin/add-administrationGroup" method="post" class="formAdmin">
            <button class="btnFormAdd ">
                Lưu
            </button>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm người dùng</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên nhóm người dùng">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Thiết lập quền hạn </label>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input id="checkbox" type="checkbox" name="permission[]" value="banner" id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>Banner</p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="category" id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>Category </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="product" id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>Product </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="comment" id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>Comment </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="coupon" id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>Coupon </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="order" id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>Order </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="user" id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>User </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="userGroup" id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>UserGroup </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="administration"
                                    id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>Administration </p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="administrationGroup"
                                    id="">
                                <span class="checkmark"></span>
                            </label>
                            <p>AdministrationGroup </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Thiết lập quền hạn thêm sửa xóa</label>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="bannerAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="bannerEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="bannerCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="categoryAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="categoryEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="categoryCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="productAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="productEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="productCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="commentAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="commentEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="commentCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="couponAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="couponEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="couponCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="orderAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="orderEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="orderCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="userAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userCheckboxDelete"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="userGroupAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userGroupEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="userGroupCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="adminstrationAdd"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="adminstrationEdit"
                                        id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]"
                                        value="adminstrationGroupAdd" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationGroupEdit" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationGroupCheckboxDelete" id="">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection
