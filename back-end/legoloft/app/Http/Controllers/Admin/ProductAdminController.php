<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProductAdminRequest;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    private $productModel;
    private $categoryModel;
    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Categories();
    }

    public function product()
    {
        $products = $this->productModel->productAll();
        $categories = $this->categoryModel->categoryAll();
        return view('admin.product', compact('categories', 'products'));
    }

    public function productAdd(ProductAdminRequest $request)
    {

        if ($request->isMethod('post')) {
            $product = $this->productModel;
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->image = $request->image;
            $product->status = $request->status;
            $product->view = $request->view;
            $product->outstanding = $request->outstanding;
            $product->save();
            if ($request->hasFile('image')) {
                // lấy ảnh gửi lên
                $image = $request->file('image');
                // Đặt tên cho file bằng id của sản phẩm
                $imageName = "{$product->id}.{$image->getClientOriginalExtension()}";
                // Di chuyển ảnh vào thư mục IMG
                $image->move(public_path('img/'), $imageName);
                // gán biến cho thuộc tính $product để lưu vào DB
                $product->image = $imageName;
                // lưu
                $product->save();
            }
            return redirect()->route('product')->with('success', 'Thêm sản phẩm thành công');
        }

        $categories = $this->categoryModel->categoryAll();
        return view('admin.productAdd', compact('categories'));
    }

    public function productUpdateStatus(Request $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => true]);
    }
}
