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

    public function productSearch(Request $request)
    {
        $filter_iddm = $request->input('filter_iddm');
        $filter_name = $request->input('filter_name');
        $filter_price = $request->input('filter_price');
        $filter_status = $request->input('filter_status');

        $products = $this->productModel->searchProduct($filter_iddm, $filter_name, $filter_price, $filter_status);

        return view('admin.product', compact('products', 'filter_iddm', 'filter_name', 'filter_price', 'filter_status'));
    }

    public function product()
    {
        $products = $this->productModel->productAll();
        return view('admin.product', compact('products'));
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

    public function productEdit($id)
    {
        $product = $this->productModel->findOrFail($id);
        return view('admin.productEdit', compact('product'));
    }

    public function productUpdate(ProductAdminRequest $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        // $product->image = '';
        $product->status = $request->status;
        $product->view = $request->view;
        $product->outstanding = $request->outstanding;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "{$product->id}.{$image->getClientOriginalExtension()}";
            $image->move(public_path('img/'), $imageName);
            $product->image = $imageName;
        } else {
            $product->image = $product->image;
        }
        $product->save();
        return redirect()->route('product')->with('success', 'Câp nhật sản phẩm thành công');
    }

    public function productUpdateStatus(Request $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => true]);
    }

    public function productDeleteCheckbox(Request $request)
    {
        $product_id = $request->input('product_id');
        if ($product_id) {
            foreach ($product_id as $itemID) {
                $product = $this->productModel->findOrFail($itemID);
                $countProduct = $this->productModel->countProduct($itemID);
                if ($countProduct > 0) {
                    return redirect()->route('product')->with('error', 'Cảnh báo: Sản phẩm này không thể bị xóa vì nó hiện được chỉ định cho ' . $countProduct . ' danh mục!');
                } else {
                    $product->delete();
                    return redirect()->route('product')->with('success', 'Xóa sản phẩm thành công');
                }
            }
        }
    }
}