@extends('layout.layout')
@section('title', 'Sản phẩm yêu thích')
@section('content')
    <!-- START MAIN -->
    <section class="product pt_mobile background_home">
        <div class="container">
            <div class="title_home">
                <h2 class="favourite_title">Sản phẩm yêu thích</h2>
            </div>
            @if (count($favourite) > 0)
                <div class="row">
                    @foreach ($favourite as $item)
                        @php
                            $product = $products->where('id', $item['product_id'])->first();
                            $priceDiscount = 0;
                            $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                            $productDiscountPrice = $product->productDiscount
                                ->where('user_group_id', $userGroupId)
                                ->first();

                            $price = $product->price ? $product->price : null;

                            if ($productDiscountPrice) {
                                $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                            }

                            $percent = ceil((($product->price - $priceDiscount) / $product->price) * 100);
                            $productImageCollect = $product->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                            if (Auth::check()) {
                                $isFavourite = $product->favourite->contains('product_id', $item['product_id']); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                            } else {
                                $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                                // Lấy danh sách tất cả các product_id từ mảng $favourite
                                $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                                // Kiểm tra xem $id có nằm trong danh sách product_id không
                                $isFavourite =
                                    is_array($productIds) && in_array((string) $item['product_id'], $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                            }
                        @endphp

                        <div class="col-md-3 col-sm-4 col-12 mt-4">
                            <div class="product_box">
                                <div class="product_box_effect">
                                    @if ($product->outstanding == 1)
                                        <div class="product_box_tag">Nổi bật </div>
                                    @endif
                                    @if (isset($productDiscountPrice))
                                        <div class="product_box_tag_sale_outstanding">{{ $percent }}%</div>
                                    @endif
                                    <div class="favourite_box_icon">
                                        <button onclick="addFavourite('{{ $item['product_id'] }}')"
                                            class="outline-0 border-0" style="background-color: transparent">
                                            <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }}"
                                                id="favourite-{{ $item['product_id'] }}"></i>
                                        </button>
                                        <button type="button" class="outline-0 border-0 "
                                            style="background-color: transparent"
                                            onclick="showModalProduct(event,'{{ $item['product_id'] }}','{{ $product->image }}','{{ $product->name }}','{{ $product->price }}','{{ $priceDiscount }}','{{ json_encode($productImageCollect) }}')">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                                        <button type="button" onclick="addToCart('{{ $item['product_id'] }}', 1)"
                                            class="outline-0 border-0 " style="background-color: transparent">
                                            <i class="fa-solid fa-bag-shopping"></i>
                                        </button>
                                    </div>
                                    <div class="product_box_image">
                                        <img src="{{ asset('img/' . $product->image) }}" alt="" />
                                    </div>
                                    <div class="product_box_content_out">
                                        <div class="product_box_content">
                                            <h3><a href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                        </div>
                                        @if ($productDiscountPrice)
                                            <div class="product_box_price">
                                                <span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',', '.') . 'đ' }}
                                            </div>
                                        @else
                                            <div class="product_box_price">
                                                <span></span>{{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="div_favourite">
                    <div class="div_favourite_main">
                        <div class="div_favourite_img">
                            <img src="{{ asset('img/heartview.jpg') }}" alt="">
                        </div>
                        <div class="div_favourite_contain">
                            <span>Chưa có sản phẩm yêu thích</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if (Auth::check())
            <div class="div_nav_pagination mt-5">
                <nav class="nav_pagination">
                    <ul class="pagination">
                        <li>{{ $favourite->links() }}</li>
                    </ul>
                </nav>
            </div>
        @else
        @endif

    </section>
    <!-- END MAIN -->
@endsection
