@extends('layout.layout')
@section('title', 'Tìm kiểm sản phẩm')
@section('content')
    <!-- START MAIN -->
    <section class="product pt_mobile">
        <div class="container">
            <div class="title_home">
                <p>Tìm thấy {{ count($searchProduct) }} kết quả với từ khóa <i>"{{ $name }}"...</i></p>

            </div>
            <div class="row">
                @foreach ($searchProduct as $item)
                    @php
                        $priceDiscount = 0;
                        $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                        $productDiscountPrice = $item->productDiscount->where('user_group_id', $userGroupId)->first();

                        $price = $item->price ? $item->price : null;

                        if ($productDiscountPrice) {
                            $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                        }

                        $percent = ceil((($item->price - $priceDiscount) / $item->price) * 100);
                        $productImageCollect = $item->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                        $isFavourite = $item->favourite->contains('product_id', $item->id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                    @endphp

                    <div class="col-md-3 col-sm-4 col-12">
                        <div class="product_box">
                            <div class="product_box_effect">
                                @if ($item->outstanding == 1)
                                    <div class="product_box_tag">Nổi bật </div>
                                @endif
                                @if (isset($productDiscountPrice))
                                    <div class="product_box_tag_sale_outstanding">{{ $percent }}%</div>
                                @endif
                                <div class="product_box_icon">
                                    <button onclick="addFavourite('{{ $item->id }}')" class="outline-0 border-0"
                                        style="background-color: transparent">
                                        <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }}"
                                            id="favourite-{{ $item->id }}"></i>
                                    </button>
                                    <button type="button" class="outline-0 border-0 " style="background-color: transparent"
                                        onclick="showModalProduct(event,'{{ $item->id }}','{{ $item->image }}','{{ $item->name }}','{{ $item->price }}','{{ $priceDiscount }}','{{ json_encode($productImageCollect) }}')">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                    {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                                    <button type="button" onclick="addToCart('{{ $item->id }}', 1)"
                                        class="outline-0 border-0 " style="background-color: transparent">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </button>
                                </div>
                                <div class="product_box_image">
                                    <img src="{{ asset('img/' . $item->image) }}" alt="" />
                                </div>
                                <div class="product_box_content_out">
                                    <div class="product_box_content">
                                        <h3><a href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                        </h3>
                                    </div>
                                    @if ($productDiscountPrice)
                                        <div class="product_box_price">
                                            <span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',', '.') . 'đ' }}
                                        </div>
                                    @else
                                        <div class="product_box_price">
                                            <span></span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="div_nav_pagination my-3">
                <nav class="nav_pagination">
                    <ul class="pagination">
                        <li>{{ $searchProduct->links() }}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <!-- END MAIN -->
@endsection
