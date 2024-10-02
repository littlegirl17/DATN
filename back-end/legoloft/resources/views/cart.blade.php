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
                @if (is_array($cart))
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
                @else
                    {{-- Tài show cart bằng DB ra chô này --}}
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
                    <div class="d-flex">
                        <input type="text" class="cart_right_coupon_input" placeholder="Nhập mã giảm giá" />
                        <button type="submit" class="detail_btn_cart">Áp mã</button>
                    </div>
                </div>
                <div class="cart_right_total">
                    <div class="cart_right_total_item">
                        <span>Thành tiền</span>
                        <span>{{ number_format($total, 0, ',', '.') . 'đ' }}</span>
                    </div>
                    <div class="cart_right_total_item">
                        <span>Mã giảm</span>
                        <span>50.000đ</span>
                    </div>
                    <div class="cart_right_total_item">
                        <h5>Tổng tiền</h5>
                        <span>{{ number_format($total, 0, ',', '.') . 'đ' }}</span>
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
