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
        $this->orderModel = new Order();
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
        if (count($cart) == 0) {
            return redirect()->route('cart');
        }
        return view('checkout', compact('cart', 'products'));
    }

    public function checkoutForm(CheckoutRequest $request)
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
        $order->coupon_code = $request->coupon_code;
        $order->note = $request->note;
        $order->status = 1;
        $order->payment = $request->payment;
        $order->total = $request->total;
        $order->save();
        session()->put('iddh', $order);

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
            return redirect()->route('order')->withCookie(cookie()->forget('cart'));
        }

        if ($order->payment == 3) { // payment momo
            return $this->momo($order->order_code, $order->total);
        } elseif ($request->payment == 2) { // payment vnpay
            return $this->vnPay($order->order_code, $order->total);
        } elseif ($order->payment == 1) {  // payment cash
            return redirect()->route('order');
        }

        return redirect()->route('order');
    }

    public function vnPay($order_code, $total)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/order";
        $vnp_TmnCode = "9KKE7C2Q"; //Mã website tại VNPAY
        $vnp_HashSecret = "BWUHEEXHJGAUKSTBVRWFMQXIFHFEVPAC"; //Chuỗi bí mật


        $vnp_TxnRef = $order_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này
        $vnp_OrderInfo = "Thanh toán cho đơn hàng: " . $order_code; // Thông tin đơn hàng
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $total * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['payment'])) {
            return redirect($vnp_Url); // Sử dụng redirect thay vì header
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function momo($order_code, $total)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = $total;
        $orderId = $order_code;
        $redirectUrl = "http://127.0.0.1:8000/order";
        $ipnUrl = "http://127.0.0.1:8000/order";
        $extraData = "";


        $partnerCode = $partnerCode;
        $accessKey = $accessKey;
        $serectkey = $secretKey;
        $orderId = $orderId; // Mã đơn hàng
        $orderInfo = $orderInfo;
        $amount = $amount;
        $ipnUrl = $ipnUrl;
        $redirectUrl = $redirectUrl;
        $extraData = $extraData;

        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        // Gửi yêu cầu POST
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->timeout(5)
            ->post($endpoint, $data);

        $jsonResult = $response->json();

        // Chuyển hướng đến URL thanh toán
        return redirect($jsonResult['payUrl']);
    }
    /***/
    public function viewOrder()
    {
        $id_order = session()->get('iddh', []);
        if (empty($id_order)) {
            return redirect('/');
        }
        $orderUser = $this->orderModel->viewOrderUser($id_order);
        $orderProductUser = $this->orderProductModel->orderProductUserGet($id_order);
        session()->forget('iddh');
        return view('order', compact('orderUser', 'orderProductUser'));
    }
}
