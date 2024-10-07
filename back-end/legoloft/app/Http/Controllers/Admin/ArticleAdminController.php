<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleAdminController extends Controller
{
    private $articleModel;

    public function __construct()
    {
        $this->articleModel = new Article();
    }

    public function article()
    {
        return view('admin.article');
    }

    public function articleAdd()
    {
        return view('admin.articleAdd');
    }

    public function articleEdit()
    {
        return view('admin.articleEdit');
    }

    public function articleUpdate() {}
}
