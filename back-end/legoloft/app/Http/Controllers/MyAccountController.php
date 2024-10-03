<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserGroup;
use App\Models\Categories;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\ProductDiscount;

class MyAccountController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $productImageModel;
    private $productDiscountModel;
    private $userGroupModel;
    private $orderModel;
    private $orderProductModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Categories();
        $this->productImageModel = new ProductImages();
        $this->productDiscountModel = new ProductDiscount();
        $this->userGroupModel = new UserGroup();
        $this->orderModel = new Order();
        $this->orderProductModel = new OrderProduct();
    }
    public function member()
    {
        return view('myaccount.member');
    }
    public function purchase()
    {
        $user_id = auth()->user()->id;
        // check thông tin user_id trong bảng order
        $orderUser = $this->orderModel->orderUser($user_id);
        $orderProductUser = [];
        // foreach ra
        foreach ($orderUser as $item) {
            // lấy id của bảng order
            $orderProductUser[$item->id] = $this->orderProductModel->orderProductUser($item->id);
        }
        return view('myaccount.purchase', compact('orderUser', 'orderUser', 'orderProductUser'));
    }
}
