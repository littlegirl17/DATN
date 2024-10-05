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
        return $this->getProductOrder(4);
    }

    // đơn hàng đang chờ xác nhận
    public function pendingPurchase()
    {
        return $this->getProductOrder(1);
    }

    // đơn hàng đã xác nhận
    public function waitConfirmation()
    {
        return $this->getProductOrder(2);
    }

    // đơn hàng đang được vận chuyển
    public function shipping()
    {
        return $this->getProductOrder(3);
    }

    // đơn hàng đã hủy
    public function cancel()
    {
        return $this->getProductOrder(5);
    }

    public function cancelConfirmation(Request $request, $id)
    {
        $order =  $this->orderModel->findOrFail($id);
        $order->status = 5;
        $order->save();
        return redirect()->back();
    }

    public function getProductOrder($status)
    {
        $user_id = auth()->user()->id;
        $orderUser = $this->orderModel->orderUser($user_id, $status);
        $orderProductUser = [];
        // foreach ra
        foreach ($orderUser as $item) {
            // lấy id của bảng order
            $orderProductUser[$item->id] = $this->orderProductModel->orderProductUser($item->id)->load('product'); //Eager Loading để giảm số lượng truy vấn đến cơ sở dữ liệu, tải sẵn các sản phẩm liên quan đến đơn hàng.
        }
        $view = $this->viewMyaacountStatus($status);
        return view($view, compact('orderUser', 'orderProductUser'));
    }

    public function viewMyaacountStatus($status)
    {
        switch ($status) {
            case '1':
                return 'myaccount.pendingPurchase';
                break;
            case '2':
                return 'myaccount.waitConfirmation';
                break;
            case '3':
                return 'myaccount.shipping';
                break;
            case '4':
                return 'myaccount.purchase';
                break;
            case '5':
                return 'myaccount.cancel';
                break;

            default:
                # code...
                break;
        }
    }

    // thông tin chi tiết của 1 đơn hàng
    public function inforPurchase($id)
    {
        $order = $this->orderModel->findOrFail($id);
        return view('myaccount.informationPurchase', compact('order'));
    }
}
