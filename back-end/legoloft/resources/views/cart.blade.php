@extends('layout.layout')
@section('title', 'Giỏ hàng')
@section('content')
    <!-- START MAIN -->
    <div class="container cart_container">
        <div class="cart_title">
            <h2>Giỏ hàng</h2>
        </div>

        <div class="cart_box">
            <div class="">
                @php
                    $total = 0;
                    $intoMoney = 0;
                    $amount = 0;
                @endphp
                @if (is_array($cart) && !empty($cart))
                    {{-- SHOW CART COOKIE --}}
                    @foreach ($cart as $item)
                        @php
                            // dùng để truy xuất vao bảng product thông qua product_id  để show thông tin của 1 san phẩm trong cart
                            $product = $products->where('id', $item['product_id'])->first();
                            // ta tiếp tục dùng $product để truy xuất vào  quan hệ   productDiscount để tìm giá giảm tương ứng với nhóm người dùng hiện tại. //  lọc theo user_group_id của người dùng hiện tại. Nếu người dùng chưa đăng nhập, mặc định nhóm người dùng là 1.
                            $userGroupDefaultDiscount = $product->productDiscount
                                ->where('user_group_id', Auth::check() ? Auth::user()->user_group_id : 1)
                                ->first();

                            $amount = $product ? $product->price : 0;
                            if ($userGroupDefaultDiscount) {
                                $amount = $userGroupDefaultDiscount ? $userGroupDefaultDiscount->price : 0;
                            }
                            // thành tiền
                            $intoMoney = $amount * $item['quantity'];
                            // tổng tiền
                            $total += $intoMoney;
                        @endphp
                        <div class="cart_item">
                            <div class="cart_item_img">
                                <img src="{{ asset('img/' . $product->image) }}" alt="" />
                            </div>
                            <div class="cart_item_content">
                                <div class="cart_item_content_name">
                                    <h2>{{ $product->name }}</h2>
                                </div>
                                @if ($userGroupDefaultDiscount)
                                    <div class="cart_item_content_price">
                                        <span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($userGroupDefaultDiscount->price, 0, ',', '.') . 'đ' }}
                                    </div>
                                @else
                                    <div class="cart_item_content_price">
                                        <span></span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                    </div>
                                @endif

                                <div class="cart_item_content_quantity">
                                    <button class="cart_quantity_decrease"><a
                                            href="{{ route('decreaseQuantity', $item['product_id']) }}">-</a></button>
                                    <input type="text" value="{{ $item['quantity'] }}" class="cart_quantity_number" />
                                    <button class="cart_quantity_increase"><a
                                            href="{{ route('increaseQuantity', $item['product_id']) }}">+</a></button>
                                </div>
                            </div>
                            <div class="cart_item_close">
                                <a href="{{ route('deleteItemCart', $item['product_id']) }}">
                                    <i class="fa-solid fa-xmark text-black"></i></a>
                            </div>
                            
                        </div>
                    @endforeach
                    {{-- ----------------------------------------------------------- --}}
                @elseif(isset($getallcart) && $getallcart->isNotEmpty())
                    {{-- Tài show cart bằng DB ra chô này --}}
                    @forEach($getallcart as $item)
                        @php
                            // dùng để truy xuất vao bảng product thông qua product_id  để show thông tin của 1 san phẩm trong cart
                            $product = $products->where('id', $item['product_id'])->first();
                            // ta tiếp tục dùng $product để truy xuất vào  quan hệ   productDiscount để tìm giá giảm tương ứng với nhóm người dùng hiện tại. //  lọc theo user_group_id của người dùng hiện tại. Nếu người dùng chưa đăng nhập, mặc định nhóm người dùng là 1.
                            $userGroupDefaultDiscount = $product->productDiscount
                                ->where('user_group_id', Auth::check() ? Auth::user()->user_group_id : 1)
                                ->first();

                            $amount = $product ? $product->price : 0;
                            if ($userGroupDefaultDiscount) {
                                $amount = $userGroupDefaultDiscount ? $userGroupDefaultDiscount->price : 0;
                            }
                            // thành tiền
                            $intoMoney = $amount * $item['quantity'];
                            // tổng tiền
                            $total += $intoMoney;
                        @endphp
                        <div class="cart_item">
                            <div class="cart_item_img">
                                <img src="{{ asset('img/' . $product->image) }}"  alt="" />
                            </div>
                            <div class="cart_item_content">
                                <div class="cart_item_content_name">
                                    <h2>{{ $item->product->name }}</h2>
                                </div>
                                <div class="cart_item_content_price">
                                    Số Lượng Mua : 
                                <h5>{{ $item->quantity}}</h5>
                                </div>
                                @if ($userGroupDefaultDiscount)
                                        <div class="cart_item_content_price">
                                            <span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($userGroupDefaultDiscount->price, 0, ',', '.') . 'đ' }}
                                        </div>
                                    @else
                                        <div class="cart_item_content_price">
                                            <span></span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                        </div>
                                    @endif
                                <div class="cart_item_content_quantity">
                                    <button class="cart_quantity_decrease" 
                                    {{-- khi giảm tới 0 sẽ bị vô hiệu hóa nút giảm --}}
                                        @if ($item['quantity'] <= 0) disabled @endif>
                                        <a href="{{ $item['quantity'] > 0 ? route('decreaseQuantity', $item['product_id']) : '#' }}">-</a>
                                    </button>

                                    <input type="text" value="{{ $item['quantity'] }}" class="cart_quantity_number" readonly />

                                    <button class="cart_quantity_increase" 
                                    {{-- khi tăng tới 100 thì vô hiệu hóa, hoặc kha muốn làm thêm instock tồn kho thì thêm vào --}}
                                            @if ($item['quantity'] >= 100) disabled @endif>
                                        <a href="{{ $item['quantity'] < 100 ? route('increaseQuantity', $item['product_id']) : '#' }}">+</a>
                                    </button>
                                </div>
                            </div>
                                <div class="cart_item_close">
                                    <a href="{{ route('deleteItemCart', $item['product_id']) }}">
                                        <i class="fa-solid fa-xmark text-black"></i></a>
                                </div>
                        </div>
                    @endforeach
                @else
                    {{-- Thông báo khi giỏ hàng trống --}}
                    <div class="alert alert-warning" role="alert">
                        Bạn chưa có sản phẩm nào trong giỏ hàng. Hãy đi mua hàng ngay!
                    </div>
                @endif


                <div class="btn_two_cart">
                    <a href="/" class="btn_goon_cart">Tiếp tục mua sắm</a>

                    <a href="{{ route('deleteAllCart') }}" class="btn_remove_cart">Xóa hết giỏ hàng</a>
                </div>
            </div>

            <div class="cart_item_right">
                <div class="cart_right_coupon">
                    <div class="coupon_title">
                        <h3>Nhập mã giảm giá</h3>
                    </div>
                    <form action="{{ route('couponForm') }}" method="post">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="cart_right_coupon_input" name="code"
                                placeholder="Nhập mã giảm giá" />
                            @if (Session::get('coupon'))
                                <button type="button" class="detail_btn_coupon"><a href="{{ route('couponDelete') }}"
                                        class="text-decoration-none text-light">Xóa mã</a></button>
                            @else
                                <button type="submit" class="detail_btn_cart">Áp mã</button>
                            @endif

                        </div>
                        <div class="pt-2">
                            @if (session('error'))
                                <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                            @endif
                            @if (session('success'))
                                <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                            @endif
                        </div>

                    </form>
                </div>
                <div class="cart_right_total">
                    <div class="cart_right_total_item">
                        <span>Thành tiền</span>
                        <span>{{ number_format($total, 0, ',', '.') . 'đ' }}</span>
                    </div>
                    <div class="cart_right_total_item">
                        <span>Mã giảm</span>
                        @if (Session::has('coupon'))
                            @foreach (Session::get('coupon') as $item)
                                @if (isset($item['type']))
                                    @if ($item['type'] == 0)
                                        {{-- giảm theo phần trăm --}}
                                        @php
                                            // Tổng số tiền giảm giá phần trăm
                                            $total_coupon = ($total * $item['discount']) / 100;
                                        @endphp
                                        <span>{{ number_format($total - $total_coupon, 0, ',', '.') . 'đ' }}
                                            ({{ $item['discount'] }}%)
                                        </span>
                                    @else
                                        {{-- giảm theo số tiền --}}
                                        @php
                                            $total_coupon = $total * $item['discount'];
                                        @endphp
                                        <span> {{ number_format($item['discount'], 0, ',', '.') . 'đ' }}
                                        </span>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="cart_right_total_item">
                        <h5>Tổng tiền</h5>
                        @if (Session::has('coupon'))
                            @php
                                if ($item['type'] == 0) {
                                    // nếu giảm theo %, thì lấu tổng tiền trừ đi cho số tiền giảm % đã tính ở trên
                                    $totalFinalCoupon = $total - $total_coupon;
                                } else {
                                    // nếu giảm theo số tiền thì lấy tổng tiền trừ cho số tiền giảm
                                    $totalFinalCoupon = $total - $item['discount'];
                                }
                            @endphp
                            <span>{{ number_format($totalFinalCoupon, 0, ',', '.') . 'đ' }}</span>
                        @else
                            <span>{{ number_format($total, 0, ',', '.') . 'đ' }}</span>
                        @endif
                    </div>
                    <div class="row_btn_checkout">
                        <a href="" class="btn_checkout">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
@endsection
