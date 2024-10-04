<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    /*--------------------------------------Khách hàng----------------------------------------*/
    public function userAdmin()
    {
        return view('admin.user');
    }

    public function userAdd() {}

    public function userEdit() {}

    public function userCheckboxDelete() {}

    // Còn mấy function tự nhìn thêm dô nhen Nghị đặt tên cho nó chuẩn xíu nhen giống thg adminstration

    /*-------------------------------------- nhóm Khách hàng----------------------------------------*/


    public function userGroup()
    {
        return view('admin.userGroup');
    }

    public function userGroupAdd() {}

    public function userGroupEdit() {}

    public function userGroupCheckboxDelete() {}
}
