<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserGroup;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;

class HomeController extends Controller
{
    private $productModel;
    private $userGroupModel;
    private $productDiscountModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->userGroupModel = new UserGroup();
        $this->productDiscountModel = new ProductDiscount();
    }

    public function index()
    {
        $productOutStanding = $this->productModel->productOutStanding();
        $userGroupDefaultDiscount = $this->productDiscountModel->userGroupDefaultDiscount();
        $productDiscountDiscount = $this->productDiscountModel->productDiscountDiscount();
        return view('home', compact('productOutStanding', 'userGroupDefaultDiscount', 'productDiscountDiscount'));
    }
}
