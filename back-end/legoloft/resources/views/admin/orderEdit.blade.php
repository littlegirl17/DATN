@extends('admin.layout.layout')
@Section('title', 'Admin | Sửa danh mục')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <h2 class="title-page ">
                Chỉnh sửa đơn hàng
            </h2>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('admin.order') }}">Quay lại</a>
        </div>

        <form action="{{ route('admin.orderUpdate', $order->id) }}" method="post" class="mt-5" enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm ">
                <button class="btn btnF3">
                    Lưu
                </button>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="row orderAdminTable">
                        <h4>Thông tin khách hàng</h4>
                        <div class="col-md-6 ">
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" name="name" value="{{ $order->name }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $order->email }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{ $order->phone }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="province" class="form-label">Tỉnh/Thành phố</label>
                                <input type="text" class="form-control" name="province" value="{{ $order->province }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="district" class="form-label">Quận/Huyện</label>
                                <input type="text" class="form-control" name="district" value="{{ $order->district }}"
                                    readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="ward" class="form-label">Phường/Xã</label>
                                <input type="text" class="form-control" name="ward" value="{{ $order->ward }}"
                                    readonly>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="col-md-2">

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 orderAdminTable">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderProducts as $index => $product)
                                <tr class="trProduct">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="d-flex justify-content-center border-0">
                                        <img src="{{ asset('img/' . $product->product->image) }}" alt=""
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td class="unit-price">{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                    <td>
                                        <input type="number" class="form-control quantity"
                                            name="productByOrderEdit[{{ $index }}][newQuantity]"
                                            value="{{ $product->quantity }}" min="1" readonly>
                                    </td>
                                    <td class="thanh-tien">
                                        {{ number_format($product->price * $product->quantity, 0, ',', '.') }} đ</td>
                                    <td class="total-orderProduct">
                                        {{ number_format($product->price * $product->quantity, 0, ',', '.') }} đ</td>
                                    <input type="hidden"
                                        name="productByOrderEdit[{{ $index }}][newTotalOrderProduct]"
                                        value="{{ $product->price * $product->quantity }}">
                                </tr>
                            @endforeach

                            <tr class="trOrder">
                                <td colspan="4">
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Phương thức thanh toán</label>
                                        <input type="text" class="form-control" name="payment"
                                            value="{{ $order->definePayment()[$order->payment] }}" readonly>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Trạng thái đơn hàng</label>
                                        <select class="form-select" aria-label="Default select example" name="status_id"
                                            id="" selected
                                            {{ $order->status == 1 ? 'Chờ xác nhận' : ($order->status == 2 ? 'Đã xác nhận' : ($order->status == 3 ? 'Đang vận chuyển' : ($order->status == 4 ? 'Hoàn thành' : 'Đã hủy'))) }}>

                                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Chờ xác nhận
                                            </option>
                                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã xác nhận
                                            </option>
                                            <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đang vận
                                                chuyển</option>
                                            <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Hoàn thành
                                            </option>
                                            <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Đã hủy
                                            </option>
                                        </select>
                                    </div>

                                </td>
                                <td colspan="1"></td>
                                <td colspan="2" class="total-order">
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Tạm tính</label>
                                        <input type="text" class="form-control" name=""
                                            value="{{ number_format($order->total, 0, ',', '.') }} đ" readonly>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Tổng tiền</label>
                                        <p id="displayedTotalOrder">{{ number_format($order->total, 0, ',', '.') }} đ</p>
                                        <input type="hidden" class="form-control" name="total" value="">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </form>
    </div>


    <!-- <script>
        // Kích hoạt khi trang web đã được tải hoàn toàn
        document.addEventListener('DOMContentLoaded', function() {
            function formatCurrency(amount) {
                // Định dạng lại thành chuẩn tiền tệ VN
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(amount);
            }

            // Lấy ra phần tử có class quantity
            const quantityInputs = document.querySelectorAll('.quantity');

            // Duyệt qua từng phần tử trong danh sách các phần tử quantity: một sự kiện input được gắn vào, nghĩa là khi người dùng nhập vào ô này, một hành động sẽ được thực hiện
            quantityInputs.forEach(function(quantityInput) {
                // Event Listener cho sự kiện input:
                quantityInput.addEventListener('input', function() {
                    // Khi giá trị trong ô nhập thay đổi, sự kiện này được kích hoạt.

                    // Đầu tiên, nó tìm phần tử cha gần nhất có lớp là trProduct. Điều này giúp xác định sản phẩm tương ứng với ô nhập số lượng. | closest tìm phần tử cha gần nhất
                    const trProduct = this.closest('.trProduct');

                    // Lấy phần tử hiển thị giá tiền của sản phẩm bằng cách sử dụng querySelector() với lớp .unit-price
                    const unitPriceElement = trProduct.querySelector('.unit-price');

                    // Dòng thứ hai lấy giá trị của phần tử đó, sau đó chuyển đổi nó từ chuỗi sang số dạng float.
                    const unitPrice = parseFloat(unitPriceElement.innerText.replace(/[^\d]+/g, ''));
                    // Một số xử lý chuỗi được thực hiện trước đó để loại bỏ ký tự không phải số.

                    // Lấy số lượng mới của sản phẩm
                    const newQuantity = parseInt(this.value);
                    // Lấy giá trị mới của ô nhập số lượng (this là ô nhập đang được thao tác) và chuyển đổi nó thành số nguyên bằng cách sử dụng parseInt().

                    // Tính toán tổng giá trị mới của sản phẩm:
                    const thanhTienElement = trProduct.querySelector('.thanh-tien');
                    const totalOrderProductElement = trProduct.querySelector('.total-orderProduct');

                    // Tính toán tổng giá trị mới của sản phẩm
                    const newThanhTien = unitPrice * newQuantity;

                    // Cập nhật hiển thị tổng giá trị của sản phẩm
                    thanhTienElement.innerText = formatCurrency(
                        newThanhTien
                    ); // formatCurrency() được sử dụng để định dạng giá trị theo định dạng tiền tệ mong muốn.

                    // Cập nhật hiển thị tổng giá trị đơn hàng product
                    totalOrderProductElement.innerText = formatCurrency(newThanhTien);

                    // Cập nhật giá trị trong trường input ẩn
                    const newTotalOrderProductInput = trProduct.querySelector(
                        'input[name*="[newTotalOrderProduct]"]');
                    newTotalOrderProductInput.value = newThanhTien.toFixed(
                        0
                    ); // toFixed(2) đảm bảo rằng giá trị được hiển thị với chính xác hai chữ số sau dấu thập phân.

                    // Code tính toán tổng tiền của đơn hàng và cập nhật giá trị vào ô nhập tổng tiền
                    let totalOrder = 0;
                    document.querySelectorAll('.total-orderProduct').forEach(function(
                        totalOrderProductElement) {
                        totalOrder += parseFloat(totalOrderProductElement.textContent
                            .replace(/[^\d]+/g, ''));
                    });

                    const totalOrderElement = document.querySelector(
                        '.total-order input[name="total"]');
                    totalOrderElement.value = formatCurrency(totalOrder);

                    // Cập nhật giá trị của thẻ <p id="displayedTotalOrder">
                    const displayedTotalOrderElement = document.getElementById(
                        'displayedTotalOrder');
                    displayedTotalOrderElement.textContent = formatCurrency(totalOrder);

                    const orderId = window.location.pathname.split('/')
                        .pop(); // Trích xuất orderId từ URL

                    // Gửi yêu cầu AJAX để cập nhật total của orderProduct vào DB
                    const productId = this.dataset.productId;
                    const requestData = {
                        productId: productId,
                        newQuantity: newQuantity,
                        newTotalOrderProduct: parseFloat(newThanhTien.toFixed(
                            0)), // Ensure it is a float with 2 decimal places
                    };

                    console.log('Dữ liệu yêu cầu:',
                        requestData); // Ghi log dữ liệu yêu cầu để kiểm tra

                    // Gửi yêu cầu AJAX
                    const xhr = new XMLHttpRequest();
                    xhr.open('PUT', '/edit-order/' + orderId, true);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            console.log('Cập nhật tổng tiền thành công!');
                        } else {
                            console.error('Cập nhật tổng tiền thất bại!');
                        }
                    };
                    xhr.send(JSON.stringify(requestData));
                });
            });
        });
    </script>

@endsection
