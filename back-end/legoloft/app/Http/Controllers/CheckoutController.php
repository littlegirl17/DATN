<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    private $productModel;
    private $cartModel;
    private $productDiscountModel;
    private $orderModel;
    private $orderProductModel;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->cartModel = new Cart();
        $this->productDiscountModel = new ProductDiscount();
        $this->orderProductModel = new OrderProduct();
    }

    public function checkout(Request $request)
    {
        $products = $this->productModel;
        if (Auth::check()) {
            // Lưu vào DATABASE - CẦN LOGIN
            $user = Auth::check() ? Auth::user()->id : 0;
            $cart = $this->cartModel->getallcart($user);
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
        }
        return view('checkout', compact('cart', 'products'));
    }

    public function checkoutForm(Request $request)
    {

        // Fetch data from API
        $response = Http::get('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json');
        $dataFetch = $response->json();
        $provinceName = '';
        $districtName = '';
        $wardName = '';

        //Lặp qua dữ liệu để lấy tên tỉnh
        foreach ($dataFetch as $data) {

            if ($data['Id'] == $request->province) {

                $provinceName = $data['Name'];

                // Lặp qua các huyện trong tỉnh để lấy tên huyện
                foreach ($data['Districts'] as $district) {

                    if ($district['Id'] == $request->district) {
                        $districtName = $district['Name'];

                        // Đi qua các phường của quận để lấy tên phường
                        foreach ($district['Wards'] as $ward) {

                            if ($ward['Id'] == $request->ward) {
                                $wardName = $ward['Name'];
                                break;
                            }
                        }
                        break;
                    }
                }
                break;
            }
        }


        $order = new Order();
        $order->user_id = Auth::check() ? Auth::user()->id : null;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->province = $provinceName ?: $request->province; // toán tử elvis kiểm tra xem  (không rỗng, không phải null, không phải false)
        $order->district =  $districtName ?: $request->district;
        $order->ward = $wardName ?: $request->ward;
        $order->order_code = 'LEGOLOFT-' . rand(10000, 999999);
        $order->note = $request->note;
        $order->status = 1;
        $order->payment = 1;
        $order->total = $request->total;
        $order->save();
        $cart = [];
        if (Auth::check()) {
            // Lưu vào DATABASE - CẦN LOGIN
            $user = Auth::check() ? Auth::user()->id : 0;
            $cart = $this->cartModel->getallcart($user);
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
        }

        foreach ($cart as $item) {
            $product = $this->productModel->where('id', $item['product_id'])->first();
            $price = $product->price ?? null;
            $productDiscountPrice = $product->productDiscount->where('user_group_id', Auth::check() ? Auth::user()->user_group_id : 1)->first();
            if ($productDiscountPrice) {
                $price = $productDiscountPrice->price ?? null;
            }

            $intoMoney = $price * $item['quantity'];

            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $item['product_id'];
            $orderProduct->quantity = $item['quantity'];
            $orderProduct->name = $product->name;
            $orderProduct->price = $price;
            $orderProduct->total = $intoMoney;
            $orderProduct->save();
        }

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cart = $this->cartModel->where('user_id', $user_id)->delete();
        } else {
           return redirect()->route('order')->withCookie(cookie()->forget('cart')) ;
        }

        return redirect()->route('order');
    }


    /***/
    public function viewOrder()
    {
        return view('order', compact(''));
    }
}