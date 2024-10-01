<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $productModel;
    private $cartModel;
    private $productDiscountModel;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->cartModel = new Cart();
        $this->productDiscountModel = new ProductDiscount();
    }

    public function getCart()
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
            // Lưu vào DATABASE - CẦN LOGIN
            $cart = $this->cartModel;
            return view('cart', compact('cart'));
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            $products = $this->productModel;
            $userGroupDefaultDiscount = $this->productDiscountModel->userGroupDefaultDiscount();

            return view('cart', compact('cart', 'products', 'userGroupDefaultDiscount'));
        }
    }

    public function cartAdd(Request $request)
    {
        $user = Auth::check() ? Auth::user()->id : 0;
        if ($user > 0) {
            // Tài làm chỗ này nha
            //  lưu vào db
        } else {
            // lưu vào cookie
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            $product_id = $request->product_id;
            if (isset($cart[$product_id])) {
                $cart[$product_id]['quantity'] += $request->quantity;
            } else {
                $cart[$product_id] = [
                    'product_id' => $product_id,
                    'quantity' => $request->quantity,
                ];
            }

            return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart)))->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
        }
    }

    public function increaseQuantity($id)
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
        }
    }

    public function decreaseQuantity($id)
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
        }
    }

    public function deleteItemCart($id)
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
        }
    }

    public function deleteAllCart($id)
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
        }
    }
}
