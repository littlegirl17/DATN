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
        $this->getallcart = new Cart();
    }

    public function getCart()
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
            // Lưu vào DATABASE - CẦN LOGIN
            $products = $this->productModel;
            $getallcart = $this->cartModel->getallcart();
            $cart = $this->cartModel;
            return view('cart', compact('cart','getallcart','products'));
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
          // Lấy thông tin sản phẩm từ request
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        if ($user > 0) {
             // Khi người dùng đã đăng nhập, lưu vào DB
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = $this->cartModel->where('user_id', $user)
        ->where('product_id', $product_id)
        ->first();
            if ($cartItem) {
            // Nếu đã có, tăng số lượng
            $cartItem->quantity += $quantity;
            $cartItem->save();
            } else {
            // Nếu chưa có, thêm mới
            $this->cartModel->create([
                'user_id' => $user,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
            }
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng'); // Thông báo thành công
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

            return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart)))->with('success', 'Sản phẩm đã được thêm vào giỏ hàng'); //withCookie :  cho phép bạn thêm một cookie vào phản hồi, Cookie này sẽ được gửi về trình duyệt của người dùng cùng với phản hồi, và trình duyệt sẽ lưu cookie này
        }
    }

    public function increaseQuantity($id)
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
             // Người dùng đã đăng nhập, cập nhật số lượng trong cơ sở dữ liệu
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Số lượng sản phẩm đã được tăng lên.');
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
            $cart = json_decode(request()->cookie('cart'), true) ?? [];

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            }
            return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart))); // withCookie :  cho phép bạn thêm một cookie vào phản hồi, Cookie này sẽ được gửi về trình duyệt của người dùng cùng với phản hồi, và trình duyệt sẽ lưu cookie này // cookie:  là một phương thức để tạo cookie,
        }
    }

    public function decreaseQuantity($id)
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
             // Người dùng đã đăng nhập, cập nhật số lượng trong cơ sở dữ liệu
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity--;
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Số lượng sản phẩm đã được tăng lên.');
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
            $cart  = json_decode(request()->cookie('cart'), true) ?? [];
            if (isset($cart[$id])) {
                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity']--;
                    return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart)));
                } else {
                    return redirect()->back()->with('error', 'Số lượng ít nhất một sản phẩm!');
                }
            }
        }
    }

    public function deleteItemCart($id)
    {
        if (Auth::check()) {
            // Tài làm chỗ này nha
            // Lấy giỏ hàng của người dùng hiện tại
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            // Xóa sản phẩm khỏi giỏ hàng
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            if (isset($cart[$id])) {
                unset($cart[$id]);
            }
            return redirect()->back()->withCookie(cookie()->forever('cart', json_encode($cart)));
        }
    }

    public function deleteAllCart()
    {
        if (Auth::check()) {
            // Xóa tất cả sản phẩm trong giỏ hàng của người dùng đã đăng nhập
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Giỏ hàng đã được xóa.');

        } else {
            // Lưu vào COOKIE - KHÔNG CẦN LOGIN
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            if (is_array($cart)) {
                return redirect()->back()->withCookie(cookie()->forget('cart', json_encode($cart)));
            }
        }
    }
}
