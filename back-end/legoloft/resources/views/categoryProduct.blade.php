@extends('layout.layout')
@section('title', 'Danh mục sản phẩm')
@section('content')
    <!-- START MAIN -->
    <div class="background_home">
        <div class="container pt-5">
            <div class="row theme_category_title">
                <h2>LEGO® {{ $categoryName->name }}</h2>
            </div>
            <div class="row theme_category_summary">
                <div class="col-md-6">
                    <h3>Hiển thị 99 sản phẩm</h3>
                </div>
                <div class="col-md-6 theme_category_summary_right">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Sắp xếp</option>
                        <option value="1">Từ A -> Z</option>
                        <option value="1">Từ Z -> A</option>
                        <option value="1">Giá giảm dần</option>
                        <option value="1">Giá tăng dần</option>
                    </select>
                </div>
            </div>
            <div class="category_product_main">
                <aside>
                    <div class="category_product_main_left">
                        <div class="category_product_main_left_1">
                            <div class="accordion">
                                <div class="accordion-header d-flex justify-content-between align-items-center">
                                    <p class="m-0 p-0">Tất cả chủ đề</p>
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div class="accordion-content">
                                    <div class="">
                                        <ul>
                                            @foreach ($categoryAll as $item)
                                                <li>
                                                    <a
                                                        href="{{ route('categoryProduct', $item->id) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="category_product_main_left_1">
                            <div class="accordion">
                                <div class="accordion-header d-flex justify-content-between align-items-center">
                                    <p class="m-0 p-0">Lọc giá</p>
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div class="accordion-content">
                                    <div class="accordion-content-item">
                                        <input type="checkbox" name="" id="" />
                                        <span>Dưới 100.000đ</span>
                                    </div>
                                    <div class="accordion-content-item">
                                        <input type="checkbox" name="" id="" />
                                        <span> 100.000đ - 200.000đ</span>
                                    </div>
                                    <div class="accordion-content-item">
                                        <input type="checkbox" name="" id="" />
                                        <span> 200.000đ - 300.000đ</span>
                                    </div>
                                    <div class="accordion-content-item">
                                        <input type="checkbox" name="" id="" />
                                        <span> 300.000đ - 400.000đ</span>
                                    </div>
                                    <div class="accordion-content-item">
                                        <input type="checkbox" name="" id="" />
                                        <span> Trên 500.000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="category_product_main_right">
                    <div class="row">
                        @foreach ($productCategory as $item)
                            @php
                                $userGroupDiscount = 0;
                                $userPriceModal = 0;
                                if ($user && Auth::check()) {
                                    // giá giảm nhóm người dùng đã đăng nhập
                                    // truy cập vào table user lấy ra user_group_id, để biết khách hàng đang thuốc nhóm nào(đồng, bạc, vàng)
                                    $userGroupId = $user->user_group_id;
                                    //$item biến đại diện cho từng sản phẩm, và các giảm giá liên quan đến sản phẩm đó, và lọc giá giảm theo nhóm người dùng cụ thể
                                    $userGroupDiscount = $item->productDiscount
                                        ->where('user_group_id', $userGroupId)
                                        ->first();
                                    // dùng để lấy được giá cho modal
                                    $userPriceModal = $userGroupDiscount ? $userGroupDiscount->price : null;
                                } else {
                                    // giá giảm nhóm người dùng không cần đăng nhập
                                    // $userGroupDefaultDiscount biến này đã đucợ xử lí bên controller và model nên chỉ cần gọi biến qua đây
                                    $userGroupDefaultDiscount = $item->productDiscount->first();
                                    // ràng buộc giá default mặc định
                                    $userPriceModal = $userGroupDefaultDiscount
                                        ? $userGroupDefaultDiscount->price
                                        : null;
                                }
                                // tính % giảm giá
                                $percent = ceil((($item->price - $userPriceModal) / $item->price) * 100);
                                $productImageCollect = $item->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                            @endphp
                            <div class="col-md-4 col-sm-6 col-12 category_product_main_right_item">
                                <a href="" class="text-black text-decoration-none">
                                    <div class="category_product_box">
                                        <div class="category_product_box_effect">
                                            @if (isset($userGroupDiscount) && isset($userGroupDefaultDiscount))
                                                <div class="categoryproduct_box_tag_sale_outstanding">{{ $percent }}%
                                                </div>
                                            @endif
                                            <div class="category_product_box_icon">
                                                <i class="fa-regular fa-heart"></i>
                                                <button type="button" class="outline-0 border-0 "
                                                    style="background-color: transparent"
                                                    onclick="showModalProduct(event,'{{ $item->id }}','{{ $item->image }}','{{ $item->name }}','{{ $item->price }}','{{ $userPriceModal }}','{{ json_encode($productImageCollect) }}')">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                                {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                                                <button type="button" onclick="addToCart('{{ $item->id }}', 1)"
                                                    class="outline-0 border-0 " style="background-color: transparent">
                                                    <i class="fa-solid fa-bag-shopping"></i>
                                                </button>
                                            </div>
                                            <div class="category_product_img">
                                                <img src="{{ asset('img/' . $item->image) }}" alt="" />
                                            </div>
                                            <div class="category_product_box_content_out">
                                                <div class="product_box_content">
                                                    <h3><a href="">{{ $item->name }}</a></h3>
                                                </div>
                                                @if ($user && Auth::check())
                                                    @if ($userGroupDiscount)
                                                        <div class="category_product_box_price">
                                                            <span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($userGroupDiscount->price, 0, ',', '.') . 'đ' }}
                                                        </div>
                                                    @else
                                                        <div class="category_product_box_price">
                                                            <span></span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($userGroupDefaultDiscount)
                                                        <div class="category_product_box_price">
                                                            <span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>{{ number_format($userGroupDefaultDiscount->price, 0, ',', '.') . 'đ' }}
                                                        </div>
                                                    @else
                                                        <div class="category_product_box_price">
                                                            <span></span>{{ number_format($item->price, 0, ',', '.') . 'đ' }}
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_home" class="modal_product_main">
    </div>
    <!-- END MAIN -->
@endsection
