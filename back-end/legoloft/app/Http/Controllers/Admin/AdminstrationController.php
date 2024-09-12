<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminstrationGroup;
use App\Http\Controllers\Controller;
use App\Models\Adminstration;

class AdminstrationController extends Controller
{
    private $adminstration;
    private $adminstrationGroup;

    public function __construct()
    {
        $this->adminstration = new Adminstration();
        $this->adminstration = new AdminstrationGroup();
    }

    public function adminstration() {}
    public function adminstrationAdd() {}
    public function adminstrationEdit() {}
    public function adminstrationUpdate() {}
    public function adminstrationDeleteCheckbox() {}

    /* Quản trị nhóm người dùng */
    public function adminstrationGroup() {}
    public function adminstrationGroupAdd() {}
    public function adminstrationGroupEdit() {}
    public function adminstrationGroupUpdate() {}
    public function adminstrationGroupDeleteCheckbox() {}
}