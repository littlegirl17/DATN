<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;

class CategoryArticleAdminController extends Controller
{
    private $categoryArticleModel;

    public function __construct()
    {
        $this->categoryArticleModel = new CategoryArticle();
    }

    public function categoryArticle()
    {

        return view('admin.categoryArticle');
    }

    public function categoryArticleAdd()
    {

        return view('admin.categoryArticleAdd');
    }

    public function categoryArticleEdit()
    {

        return view('admin.categoryArticleEdit');
    }

    public function categoryArticleUpdate() {}
}
