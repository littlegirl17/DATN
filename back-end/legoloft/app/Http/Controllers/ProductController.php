<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    private $productModel;
    private $commentModel;
    private $favouriteModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->commentModel = new Comment();
        $this->favouriteModel = new Favourite();
    }

    public function detail($slug)
    {
        $detail = $this->productModel->whereSlug($slug)->firstOrFail();
        $productRelated = $this->productModel->productRelated($detail);
        $productReview = $this->commentModel->productReview($detail);
        $productCountReview = $this->commentModel->productCountReview($detail);
        return view('detail', compact('detail', 'productRelated', 'productReview', 'productCountReview'));
    }

    public function commentReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'content' => 'required|string|max:500',
            'rating' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id =  Auth::user()->id;
        $comment->product_id = $request->product_id;
        $comment->content = $request->content;
        $comment->rating = $request->rating;
        $comment->save();

        return response()->json([
            'message' => 'Đánh giá đã được thêm thành công!',
            'comment' => $comment,
        ]);
    }

    public function favourite(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'status' => 'required',
        ]);

        $favouriteFist = $this->favouriteModel->favouriteFist(Auth::user()->id, $request->product_id);
        if (!$favouriteFist) {
            $favourite = new Favourite();
            $favourite->user_id =  Auth::user()->id;
            $favourite->product_id = $request->product_id;
            $favourite->status = 1;
            $favourite->save();

            return response()->json([
                'message' => 'Yêu thích thành công mỹ mãn',
                'is_favourite' => true
            ]);
        }
        // Nếu trạng thái là 0, xóa yêu thích
        if ($favouriteFist) {
            $favouriteFist->delete();
            return response()->json(['message' => 'Đã xóa yêu thích!', 'is_favourite' => false]);
        }
    }
}
