<?php

namespace App\Http\Controllers\admin;

use App\Models\Assembly;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssemblyAdminController extends Controller
{
    private $assemblyModel;
    private $employeeModel;

    public function __construct()
    {
        $this->assemblyModel = new Assembly();
        $this->employeeModel = new Employee();
    }

    public function assembly()
    {
        return view('admin.assembly');
    }
}
