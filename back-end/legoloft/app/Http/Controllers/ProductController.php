<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    private $productModel;
    private $commentModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->commentModel = new Comment();
    }

    public function detail($slug)
    {
        $user_id = Auth::user()->id;
        $detail = $this->productModel->whereSlug($slug)->firstOrFail();
        $productRelated = $this->productModel->productRelated($detail);
        $productReview = $this->commentModel->productReview($detail, $user_id);

        return view('detail', compact('detail', 'productRelated', 'productReview'));
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
}
