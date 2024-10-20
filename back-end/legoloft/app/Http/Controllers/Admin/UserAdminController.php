<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\UserGroup;

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

        $user = User::find($id);

        if ($user) {
            $user->carts()
                ->delete();  //cai nay xoa cac ban ghi lien quan trong bang cart


            // Xóa người dùng
            $user->delete();
            return redirect()->back()
                ->with('success', 'Người dùng đã được xóa thành công.');
        } else {
            return redirect()->back()
                ->with('error', 'Người dùng không tồn tại.');
        }
    }


    public function userAdd()
    {
        return view('admin.addUser'); // Chuyển đến view thêm người dùng

    }

    public function userStore(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tạo người dùng mới
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);

        // Xử lý upload hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->route('userAdmin')->with('success', 'Người dùng đã được thêm thành công.');
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        $userGroups = UserGroup::all();
        return view('admin.editUser', compact('user','userGroups'));
    }

    public function userUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'user_group_id' => 'required|exists:user_groups,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id); // Tìm người dùng theo ID
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_group_id = $request->user_group_id;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->phone = $request->phone;

        // Xử lý upload hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->route('userAdmin')->with('success', 'Người dùng đã được cập nhật thành công.');
    }

    public function userCheckboxDelete()
    {
    }

    // Còn mấy function tự nhìn thêm dô nhen Nghị đặt tên cho nó chuẩn xíu nhen giống thg adminstration

    /*-------------------------------------- nhóm Khách hàng----------------------------------------*/


    public function userGroup()
    {
        return view('admin.userGroup');
    }

    public function userGroupAdd()
    {
    }

    public function userGroupEdit()
    {
    }

    public function userGroupCheckboxDelete()
    {
    }
}
