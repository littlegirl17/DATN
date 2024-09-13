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

    public function adminstration() {}
    public function adminstrationAdd() {}
    public function adminstrationEdit() {}
    public function adminstrationUpdate() {}
    public function adminstrationDeleteCheckbox() {}

    /* Quản trị nhóm người dùng */
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

    public function adminstrationGroupEdit()
    {
        return view('admin.administrationGroupEdit');
    }

    public function adminstrationGroupUpdate() {}

    public function adminstrationGroupDeleteCheckbox() {}
}