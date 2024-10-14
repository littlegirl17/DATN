<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
class ArticleAdminController extends Controller
{
    private $articleModel;

    public function __construct()
    {
        $this->articleModel = new Article();
    }

    public function article()
    {
        $atc = Article::orderBy('id','desc')->get();
        // dd($article);
        return view('admin.article',compact('atc'));
    }

    public function articleAdd(Request $request)
{
    if ($request->isMethod('post')) {
        // Xác thực dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'description_short' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:category_articles,id', // Thêm xác thực cho category_id
        ]);

        // Thêm mới bài viết
        $Article = new Article();
        $Article->title = $request->title;
        $Article->description_short = $request->description_short;
        $Article->description = $request->description;
        $Article->status = $request->status ?? 1;
        $Article->categoryArticle_id = $request->category_id; // Lưu danh mục

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/articles'), $filename);
            $Article->image = $filename;
        }

        $Article->save();

        return redirect()->route('article')->with('success', 'Bài viết đã được thêm thành công!'); // Chuyển hướng sau khi thêm
    }
    $atc = Article::orderBy('id','desc')->get();

    $categoryArticle = CategoryArticle::all(); // Lấy tất cả danh mục
    
    // Hiển thị form khi là GET request       
    return view('admin.articleAdd', compact('categoryArticle','atc'));
}


public function articleEdit(Request $request, $id)
{
    $Article = Article::findOrFail($id); // Tìm bài viết theo ID

    // Xử lý dữ liệu từ form
    $data = $request->only([
        'title',
        'description_short',
        'description',
        'status',
        'categoryArticle_id' // Sửa lại tên này nếu bạn đã dùng categoryArticle_id trong view
    ]);

    // Xử lý hình ảnh nếu có
    if ($request->hasFile('image')) {
        // Xóa hình ảnh cũ nếu tồn tại
        if ($Article->image) {
            $oldImagePath = public_path('images/articles/' . $Article->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Xóa hình ảnh cũ
            }
        }

        // Lưu hình ảnh mới
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/articles'), $filename);
        $data['image'] = $filename; // Cập nhật tên file
    }

    $Article->update($data); // Cập nhật bài viết
    $categoryArticle = CategoryArticle::all(); // Lấy tất cả danh mục

    return view('admin.articleEdit',compact('Article','categoryArticle'))->with('success', 'Article updated successfully.'); // Redirect về danh sách bài viết
}

public function articleDel($id)  {
    $Article = Article::findOrFail($id);
    
        // Xóa file hình ảnh nếu tồn tại
        if ($Article->image) {
            $imagePath = public_path('images/' . $Article->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file
            }
        }
    
        // Xóa danh mục
        $Article->delete();
    
        // Lấy lại danh sách danh mục
        $CA = Article::orderBy('id', 'desc')->get();
    
        // Trả về view cùng với danh sách mới
        return redirect()->route('article')->with('success', 'Danh mục đã được xóa thành công!');
}


    public function articleUpdate() {}
}
