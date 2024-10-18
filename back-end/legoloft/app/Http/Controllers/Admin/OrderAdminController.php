<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderAdminController extends Controller
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new Order();
    }
    public function order(Request $request)
    {
        // Khởi tạo query builder cho Order
        $query = Order::with('orderProducts.product');

        // Lọc theo ID đơn hàng
        if ($request->filled('filter_iddh')) {
            $query->where('id', $request->filter_iddh);
        }

        // Lọc theo tên khách hàng
        // Lọc theo tên khách hàng
        if ($request->filled('filter_userName')) {
            $query->where('name', 'like', '%' . $request->filter_userName . '%');
        }

        // Lọc theo trạng thái đơn hàng
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }

        // Lọc theo tổng tiền
        if ($request->filled('filter_total')) {
            $query->where('total', '>=', $request->filter_total);
        }

        $statuses = $this->getOrderStatuses();
        $orderCounts = $this->getOrderCounts();
        // Lấy danh sách đơn hàng đã lọc
        $order = $query->orderBy('id', 'desc')->get();

        return view('admin.order', compact('order', 'statuses', 'orderCounts'));
    }

    // Phương thức để lấy trạng thái đơn hàng
    private function getOrderStatuses()
    {
        return [
            'all' => ['label' => 'Tất cả', 'color' => '#F38773'],
            1 => ['label' => 'Chờ xác nhận', 'color' => '#FFB356'],
            2 => ['label' => 'Đã xác nhận', 'color' => '#00bcd4'],
            3 => ['label' => 'Đang vận chuyển', 'color' => '#188DD1'],
            4 => ['label' => 'Hoàn thành', 'color' => '#07884B'],
            5 => ['label' => 'Đã hủy', 'color' => '#FF0000'],
        ];
    }

    private function getOrderCounts()
    {
        return [
            'all' => Order::count(),
            1 => Order::where('status', 1)->count(),
            2 => Order::where('status', 2)->count(),
            3 => Order::where('status', 3)->count(),
            4 => Order::where('status', 4)->count(),
            5 => Order::where('status', 5)->count(),
        ];
    }



    public function orderEdit($id)
    {
        $order = Order::with('orderProducts.product')->findOrFail($id); // Tải thông tin đơn hàng và các sản phẩm liên quan

        return view('admin.orderEdit', compact('order'));
    }

    public function orderUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'status_id' => 'required|integer|min:1|max:5', // Kiểm tra trạng thái phải nằm trong khoảng 1-5
        ]);

        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Cập nhật trạng thái
        $order->status = $request->status_id;

        // Lưu thay đổi
        $order->save();

        // Chuyển hướng hoặc trả về view
        return redirect()->route('admin.order')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
