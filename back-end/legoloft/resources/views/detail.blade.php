@extends('layout.layout')
@section('title', 'Chi tiết')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="detail_product_left">
                    <div class="detail_product_left_img_item">
                        <ul>
                            @foreach ($detail->productImage as $item)
                                <li><img src="{{ asset('img/' . $item->images) }}" alt="" /></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="detail_product_left_img">
                        <img src="{{ asset('img/' . $detail->image) }}" alt="" />
                        <div class="detail_prev_next">
                            <button class="prev_detail_img" id="prevBtn">
                                < </button>
                                    <button class="next_detail_img" id="nextBtn">></button>
                        </div>
                        <div class="detail_product_left_img_item_res">
                            <ul>
                                @foreach ($detail->productImage as $item)
                                    <li><img src="{{ asset('img/' . $item->images) }}" alt="" /></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $priceDiscount = 0;
                $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                $productDiscountPrice = $detail->productDiscount->where('user_group_id', $userGroupId)->first();

                $price = $detail->price ? $detail->price : null;

                if ($productDiscountPrice) {
                    $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                }

            @endphp
            <div class="col-md-4 col-12">
                <div class="detail_product_right">
                    <div class="detail_product_right_one">
                        @if ($detail->status >= 1)
                            <span class="inStock">Còn hàng</span>
                        @else
                            <span class="outStock">Hết hàng</span>
                        @endif
                    </div>
                    <div class="detail_product_right_two">
                        <h1>{{ $detail->name }}</h1>
                    </div>
                    <div class="detail_product_right_three">
                        @if ($productDiscountPrice)
                            <span>{{ number_format($detail->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',', '.') . 'đ' }}
                        @else
                            <span></span>{{ number_format($detail->price, 0, ',', '.') . 'đ' }}
                        @endif
                    </div>
                    <div class="detail_product_right_four">
                        <div class="detail_product_right_four_item">
                            <button class="right_four_item_decrease" onclick="decreaseQuantity()">-</button>
                            <input type="text" class="right_four_item_number" id="inputQuantity" value="1"
                                disabled />
                            <button class="right_four_item_increase" onclick="increaseQuantity()">+</button>
                        </div>
                        {{-- <div class="detail_product_right_four_span">
                            <span>Giới hạn 5</span>
                        </div> --}}
                    </div>
                    <div class="detail_product_right_five">
                        <div class="right_five_bnt">
                            <button class="detail_btn">Mua ngay</button>
                            <button class="detail_btn">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 accordion-section">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Thông số kỹ thuật
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-9 col-sm-8 col-12">

                                @php
                                    $description = $detail->description;
                                    // Tách theo dấu chấm để lấy từng câu
                                    $sentences = preg_split('/(?<=[.?!])\s+/', $description);
                                    $paragraphs = [];
                                    $temp = '';

                                    foreach ($sentences as $index => $sentence) {
                                        $temp .= trim($sentence) . ' ';

                                        // Khi đã có 3 câu, thêm vào mảng đoạn
                                        if (($index + 1) % 3 == 0) {
                                            $paragraphs[] = trim($temp);
                                            $temp = ''; // Reset cho đoạn tiếp theo
                                        }
                                    }

                                    // Nếu còn câu thừa, thêm vào đoạn cuối
                                    if (!empty($temp)) {
                                        $paragraphs[] = trim($temp);
                                    }
                                @endphp
                                @foreach ($paragraphs as $paragraph)
                                    @if (trim($paragraph))
                                        <!-- Kiểm tra không rỗng -->
                                        <p>{{ $paragraph }}</p>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-3 col-sm-4 col-12">
                                <div class="detail_accordion_img">
                                    <img src="{{ asset('img/' . $detail->image) }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Phản hồi khách hàng (10) đánh giá
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="product_review">
                            <ul>
                                <li>
                                    <p>Ngày 6 tháng 3 năm 2022</p>
                                    <span class="product_review_name">HuynhKha</span>
                                    <span class="product_review_content">Tôi thực sự thích bản dựng này, hệ thống treo
                                        thanh đẩy
                                        được triển khai rất tốt, thiết kế rất phù hợp với chiếc xe
                                        thật, là một người hâm mộ F1 lớn, đây là điều bắt buộc,
                                        bản dựng khá nhanh nhưng sản phẩm cuối cùng trông thật
                                        tuyệt vời.</span>
                                    <div class="product_review_img">
                                        <button class="product_review_imgbtn">
                                            <img src="img/city-product-1.webp" alt="" />
                                        </button>
                                        <button class="product_review_imgbtn">
                                            <img src="img/city-product-5.webp" alt="" />
                                        </button>
                                        <button class="product_review_imgbtn">
                                            <img src="img/city-product-1.webp" alt="" />
                                        </button>
                                        <button class="product_review_imgbtn">
                                            <img src="img/city-product-4.webp" alt="" />
                                        </button>
                                        <button class="product_review_imgbtn">
                                            <img src="img/city-product-3.webp" alt="" />
                                        </button>
                                    </div>
                                </li>
                                <li>
                                    <p>Ngày 6 tháng 3 năm 2022</p>
                                    <span class="product_review_name">HuynhKha</span>
                                    <span class="product_review_content">Tôi thực sự thích bản dựng này, hệ thống treo
                                        thanh đẩy
                                        được triển khai rất tốt, thiết kế rất phù hợp với chiếc xe
                                        thật, là một người hâm mộ F1 lớn, đây là điều bắt buộc,
                                        bản dựng khá nhanh nhưng sản phẩm cuối cùng trông thật
                                        tuyệt vời.</span>
                                    <div class="product_review_img">
                                        <button class="product_review_imgbtn">
                                            <img src="img/city-product-1.webp" alt="" />
                                        </button>
                                    </div>
                                </li>
                                <li>
                                    <p>Ngày 6 tháng 3 năm 2022</p>
                                    <span class="product_review_name">HuynhKha</span>
                                    <span class="product_review_content">Tôi thực sự thích bản dựng này, hệ thống treo
                                        thanh đẩy
                                        được triển khai rất tốt, thiết kế rất phù hợp với chiếc xe
                                        thật, là một người hâm mộ F1 lớn, đây là điều bắt buộc,
                                        bản dựng khá nhanh nhưng sản phẩm cuối cùng trông thật
                                        tuyệt vời.</span>
                                    <div class="product_review_img">
                                        <button class="product_review_imgbtn">
                                            <img src="img/city-product-1.webp" alt="" />
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="product_review">
                            <form id="commentReview" action="{{ route('commentReview') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="product_id" value="{{ $detail->id }}">
                                <div class="product_review_content">
                                    <span>Đánh giá</span>
                                    <p class="stars">
                                        <span class="stars_span">
                                            <a class="star" data-rating="1" href="javascript:void(0);">1</a>
                                            <a class="star" data-rating="2" href="javascript:void(0);">2</a>
                                            <a class="star" data-rating="3" href="javascript:void(0);">3</a>
                                            <a class="star" data-rating="4" href="javascript:void(0);">4</a>
                                            <a class="star" data-rating="5" href="javascript:void(0);">5</a>
                                        </span>
                                    </p>

                                    <input type="hidden" name="rating" id="rating" value="">
                                </div>
                                <div class="product_review_content">
                                    <span class="text-black">Nội dung đánh giá</span>
                                    <textarea class="form-control" name="content" id="" cols="30" rows="15"></textarea>
                                </div>
                                <div class="">
                                    <button type="submit" class="detail_btn_cart">Gửi đánh giá</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <section class="detail_product_section">
        <div class="container">
            <div class="title_home">
                <h2 class="">Đề xuất cho bạn</h2>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach ($productRelated as $item)
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
                    @endphp

                    <div class="item">
                        <div class="product_box">
                            <div class="product_box_effect">
                                <div class="product_box_tag">Nổi bật </div>
                                @if (isset($productDiscountPrice))
                                    <div class="product_box_tag_sale_outstanding">{{ $percent }}%</div>
                                @endif
                                <div class="product_box_icon">
                                    <i class="fa-regular fa-heart"></i>
                                    <button type="button" class="outline-0 border-0 "
                                        style="background-color: transparent"
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
        </div>
    </section>

    <div id="modal_review" class="modal_review">
        <div class="modal_review_box">
            <span class="close my-0">&times;</span>
            <div id="modal_review_box_img"></div>
        </div>
    </div>




@endsection
