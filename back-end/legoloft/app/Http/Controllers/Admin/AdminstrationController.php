<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\AdministrationGroup;
use App\Http\Controllers\Controller;

class AdminstrationController extends Controller
{
    private $administrationModel;
    private $administrationGroupModel;

    public function __construct()
    {
        $this->administrationModel = new Administration();
        $this->administrationGroupModel = new AdministrationGroup();
    }

    public function adminstration()
    {
        $administration = $this->administrationModel->administrationAll();

        return view('admin.administration', compact('administration'));
    }
    public function adminstrationAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'fullname' => 'required | string | max:255',
                'username' => 'required | string | unique:administrations,username',
                'admin_group_id' => 'required | exists:administration_groups,id',
                'email' => 'required | email | unique:administrations,email',
                'password' => 'required | string | confirmed',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required | in:0,1',
            ]);
            try {
                $administration = $this->administrationModel;
                $administration->fullname = $request->fullname;
                $administration->username = $request->username;
                $administration->admin_group_id = $request->admin_group_id;
                $administration->email = $request->email;
                $administration->password = bcrypt($request->password);
                $administration->image = '';
                $administration->status = $request->status;
                $administration->save();

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = "{$administration->id}.{$image->getClientOriginalExtension()}";
                    $image->move(public_path('img/'), $imageName);
                    $administration->image = $imageName;
                    $administration->save();
                }

                return redirect()->route('adminstration')->with('success', 'Thêm người dùng thành công');
            } catch (\Throwable $th) {
                $error = $th->getMessage();
                return redirect()->back()->with(['error' => $error]);
            }
        }
        return view('admin.administrationAdd');
    }
    public function adminstrationEdit()
    {
        return view('admin.administrationEdit');
    }

    public function adminstrationUpdate() {}

    public function adminstrationDeleteCheckbox() {}

    /* ----------------------------------------------------------------------Quản trị nhóm người dùng-----------------------------------------------------------------*/
    public function adminstrationGroup()
    {
        $administrationGroup = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administrationGroup', compact('administrationGroup'));
    }

    public function adminstrationGroupAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required | string',
                'permission' => 'required',
            ]);

            try {
                $adminstrationGroup = $this->administrationGroupModel;
                $adminstrationGroup->name  = $request->name;
                $adminstrationGroup->permission  = json_encode($request->permission); // chuyển array thành string
                $adminstrationGroup->save();
                return redirect()->route('adminstrationGroup')->with('success', 'Thêm nhóm người dùng thành công.');
            } catch (\Throwable $th) {
                return back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
            }
        }
        return view('admin.administrationGroupAdd');
    }

    public function adminstrationGroupEdit($id)
    {
        $administrationGroup = $this->administrationGroupModel->findOrFail($id);
        $permissionGroupGet = json_decode($administrationGroup->permission, true) ?? [];
        return view('admin.administrationGroupEdit', compact('administrationGroup', 'permissionGroupGet')); // Giai mã một chuôi JSON thành 1 mảng liên kết or đối tượng PHP

    }

    public function adminstrationGroupUpdate(Request $request, $id)
    {
        $administrationGroup = $this->administrationGroupModel->findOrFail($id);
        $administrationGroup->name = $request->name;
        $administrationGroup->permission = json_encode($request->permission);
        $administrationGroup->save();
        return redirect()->route('adminstrationGroup');
    }

    public function adminstrationGroupDeleteCheckbox(Request $request)
    {
        $administrationGroup_id = $request->input('administrationGroup_id');
        if ($administrationGroup_id) {
            foreach ($administrationGroup_id as $itemID) {
                $administrationGroup = $this->administrationGroupModel->findOrFail($itemID);
                $countAdministrationGroup = $this->administrationModel->countAdministrationGroup($itemID);
                if ($countAdministrationGroup > 0) {
                    return redirect()->route('adminstrationGroup')->with('danger', ' Cảnh báo: Nhóm người dùng này không thể bị xóa vì nó hiện được chỉ định cho ' . $countAdministrationGroup . ' người dùng!');
                } else {
                    $administrationGroup->delete();
                    return redirect()->route('adminstrationGroup')->with('success', ' Thành công: Nhóm người dùng này đã được xóa');
                }
            }
        }
        return redirect()->route('adminstrationGroup')->with('success', 'Xóa nhóm người dùng thành công.');
    }
}