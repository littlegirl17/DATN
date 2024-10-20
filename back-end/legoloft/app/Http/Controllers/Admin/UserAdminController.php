<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;

class UserAdminController extends Controller
{
    /*--------------------------------------Khách hàng----------------------------------------*/
    public function userAdmin()
    {
        $users = User::paginate(5);
        return view('admin.user', compact('users'));
    }

    public function deleteUser($id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);

        if ($user) {
            $user->carts()->delete();  //cai nay xoa cac ban ghi lien quan trong bang cart


            // Xóa người dùng
            $user->delete();
            return redirect()->back()->with('success', 'Người dùng đã được xóa thành công.');
        } else {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }
    }








    public function userAdd() {

    }

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
