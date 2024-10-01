<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserGroup;
use App\Models\Categories;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;

class HomeController extends Controller
{
    private $productModel;
    private $userGroupModel;
    private $productDiscountModel;
    private $orderProduct;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->userGroupModel = new UserGroup();
        $this->productDiscountModel = new ProductDiscount();
        $this->orderProduct = new OrderProduct();
    }

    public function index()
    {
        $productOutStanding = $this->productModel->productOutStanding();
        $userGroupDefaultDiscount = $this->productDiscountModel->userGroupDefaultDiscount();
        $productDiscountSection = $this->productModel->productDiscountSection();
        $productBestseller =  $this->productModel->productBestseller();
        return view('home', compact('productOutStanding', 'userGroupDefaultDiscount', 'productDiscountSection', 'productBestseller'));
    }
}
