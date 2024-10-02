<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserGroup;
use App\Models\Categories;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $productModel;
    private $userGroupModel;
    private $productDiscountModel;
    private $orderProduct;


    public function __construct()
    {
        $this->productModel = new Product();
        $this->userGroupModel = new UserGroup();
        $this->productDiscountModel = new ProductDiscount();
        $this->orderProduct = new OrderProduct();
    }

    public function index()
    {
        $productOutStanding = $this->productModel->productOutStanding();
        $productDiscountSection = $this->productModel->productDiscountSection();
        $productBestseller = $this->productModel->productBestseller();
        // Lấy danh sách các danh mục chính và danh mục con
        $categories = Categories::with(['categories_children', 'categories_children.product'])->whereNull('parent_id')->get();
        $productByCategory = []; //tạo mảng để lưu trữ sản phẩm theo danh mục con
        foreach ($categories as $category) { //Duyệt qua từng danh mục cha
            foreach ($category->categories_children as $child) { // Duyệt qua từng danh mục con của danh mục cha hiện tại //$child đại diện cho một danh mục con của danh mục cha hiện tại.
                // Lưu trữ sản phẩm cho từng danh mục con
                $productByCategory[$child->id] = $child->product;
            }
        }
        //
        $user = auth()->user();
        $userGroupDefaultDiscount = $this->productDiscountModel->userGroupDefaultDiscount();

        return view('home', compact('productOutStanding', 'userGroupDefaultDiscount', 'productDiscountSection', 'categories', 'productBestseller', 'productByCategory', 'user'));
    }
}
