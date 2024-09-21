<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Categories::with('categories_children')->whereNull('parent_id')->get(); // with được sử dụng để tải trước mối quan hệ // whereNull lấy các danh mục mà trường parent_id là null
        return view('home', compact('categories'));
    }
}
