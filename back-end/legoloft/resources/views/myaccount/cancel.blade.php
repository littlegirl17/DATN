@extends('myaccount.layout.layout')
@section('title', 'Đơn hàng đã hủy')
@section('content_myaccount')
    <div class="container">
        <div class="layout_member">
            <div class="layout_member_left">
                @include('myaccount.menuLeftAccount')
            </div>
            <div class="layout_member_right">
                <form action="">
                    <div class="container-account-right-item">
                        <div class="row">
                            <h4 class="m-0 ps-3">Đơn hàng đã hủy</h4>
                        </div>
                        <div class="">
                            @foreach ($orderUser as $item)
                                <div class="account_purchase">
                                    <div class="account_purchase_header">
                                        <div class="account_purchase_header_left">
                                            <h5>Mã đơn hàng: #{{ $item->order_code }}</h5>
                                        </div>
                                        <div class="account_purchase_header_right">
                                            <p class="account_purchase_header_right_1">
                                                <button class="account_purchase_header_right_cancel"><a
                                                        href="javascript:void(0);" onclick="noticeCancel();"
                                                        class="">Đơn hàng đã bị hủy</a></button>
                                            </p>
                                            <a href="{{ route('inforPurchase', $item->id) }}" class="text-decoration-none">
                                                <p class="account_purchase_header_right_2">Chi tiết</p>
                                            </a>
                                        </div>
                                    </div>
                                    @php
                                        $orderProducts = $orderProductUser[$item->id]->toArray(); // Chuyển đổi thành mảng;
                                        $orderProductSlice = array_slice($orderProducts, 0, 2); // array_slice : lấy đi 1 phần của mảng,vế 1 là mảng bạn muốn cắt, vế 2 là vị trí bắt đầu, vế 3 là số lượng muốn lấy
                                        $orderProductShow = count($orderProducts) > 2;
                                    @endphp

                                    @foreach ($orderProductSlice as $orderProduct)
                                        <div class="row checkout_row_right">
                                            <div class="col-md-3 col-sm-3 col-4">
                                                <div class="img_checkout_product">
                                                    <img src="{{ asset('img/' . $orderProduct['product']['image']) }}"
                                                        alt="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-9 col-8">
                                                <h5>{{ $orderProduct['name'] }}</h5>
                                                <p class="">Số lượng: {{ $orderProduct['quantity'] }}</p>
                                                <p class="pricecheckout_mobile">
                                                    <span></span>{{ number_format($orderProduct['price'], 0, ',', '.') . 'đ' }}
                                                </p>
                                            </div>
                                            <div class="col-md-3 col-12 checkout_right_price">
                                                <div class="product_box_price">
                                                    <span></span>{{ number_format($orderProduct['price'], 0, ',', '.') . 'đ' }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($orderProductShow)
                                        <div class="more-products" style="display: none;">
                                            {{-- Lấy tất cả các phần tử từ chỉ số 2 trở đi cho đến hết mảng $orderProducts --}}
                                            @foreach (array_slice($orderProducts, 2) as $orderProduct)
                                                <div class="row checkout_row_right">
                                                    <div class="col-md-3 col-sm-3 col-4">
                                                        <div class="img_checkout_product">
                                                            <img src="{{ asset('img/' . $orderProduct['product']['image']) }}"
                                                                alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-9 col-8">
                                                        <h5>{{ $orderProduct['name'] }}</h5>
                                                        <p class="">Số lượng: {{ $orderProduct['quantity'] }}</p>
                                                        <p class="pricecheckout_mobile">
                                                            <span></span>{{ number_format($orderProduct['price'], 0, ',', '.') . 'đ' }}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3 col-12 checkout_right_price">
                                                        <div class="product_box_price">
                                                            <span></span>{{ number_format($orderProduct['price'], 0, ',', '.') . 'đ' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="seeMore">
                                            <p class="show-more">Xem thêm <i class="fa-solid fa-chevron-down"></i>
                                            </p>
                                        </div>
                                    @endif
                                    <hr />
                                    <div class="row account_purchase_thanhtien">
                                        <div class="col-md-12">
                                            <p class="px-1">Thành tiền:</p>
                                            <h4>{{ number_format($item->total, 0, ',', '.') . 'đ' }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.show-more').forEach(button => {
            button.addEventListener('click', function() {
                // truy cập vào thẻ div.moreProducts nơi chứa các sản phẩm muốn hiển thị or ẩn đi
                const moreProducts = this.parentElement
                    .previousElementSibling; // this:đại diện cho phần tử mà sự kiện xảy ra, trong trường hợp này là <p class="show-more">. // this.parentElement sẽ trả về phần tử cha của <p class="show-more">, tức là <div class="seeMore">. // this.parentElement.previousElementSibling sẽ trả về phần tử trước phần tử cha, tức là <div class="more-products">.

                moreProducts.style.display = moreProducts.style.display === 'none' || moreProducts.style
                    .display === '' ? 'block' : 'none';

                this.textContent = moreProducts.style.display === 'none' ? 'Xem thêm ' : 'Thu lại ';
            });
        });
    </script>
    <script>
        function noticeCancel() {
            Swal.fire({
                imageUrl: "{{ asset('img/cancel.png') }}",
                imageHeight: 200,
                imageWidth: 200,
                imageAlt: "A tall image",
                title: "Bạn đã hủy đơn hàng!",
                showConfirmButton: false, // Ẩn nút OK
                timer: 2000, // Tự động tắt sau 2 giây
                width: '350px',
                customClass: {
                    title: 'custom-title' // Thêm lớp tùy chỉnh cho tiêu đề
                }
            });
        }
    </script>
@endsection
