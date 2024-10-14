<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
// use App\Models\CategoryArticle;
class CategoryArticleAdminController extends Controller
{
    private $categoryArticleModel;

    public function __construct()
    {
        $this->categoryArticleModel = new CategoryArticle();
    }

    public function categoryArticle()
    {
        $CA = CategoryArticle::orderBy('id', 'desc')->get();
        // dd($CA);
        return view('admin.categoryArticle',compact('CA'));
    }
// dữ liệu show thử ra đâu thấy có danh mục, là mình xử lí model với control đang sai, nên view nó ko show ra đc
    public function categoryArticleAdd(Request $request)
{
    if ($request->isMethod('post')) {
        // Xác thực dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'description_short' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Thêm mới bài viết
        $categoryArticle = new CategoryArticle();
        $categoryArticle->title = $request->title;
        $categoryArticle->description_short = $request->description_short;
        $categoryArticle->description = $request->description;
        $categoryArticle->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/articles'), $filename);
            $categoryArticle->image = $filename;
        }

        $categoryArticle->save();

    }

    // Hiển thị form khi là GET request
    return view('admin.categoryArticleAdd');
}


    public function categoryArticleEdit(Request $request, $id)
    {

        $categoryArticle = CategoryArticle::findOrFail($id); // Tìm danh mục theo ID

       $data = $request->only([
        'title',
        'image',
        'description_short',
        'description',
        'status']);

    // Xử lý hình ảnh nếu có
    if ($request->hasFile('image')) {
        // Xóa hình ảnh cũ nếu tồn tại
        if ($categoryArticle->image) {
            $oldImagePath = public_path('images/articles/' . $categoryArticle->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Xóa hình ảnh cũ
            }
        }

        // Lưu hình ảnh mới
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/articles'), $filename);
        $categoryArticle->image = $filename; // Cập nhật tên file
    }

        $categoryArticle->update($data);
        return view('admin.categoryArticleEdit',compact('categoryArticle'));
    }

    public function categoryArticleDel(Request $request, $id) {
        // Tìm danh mục theo ID
        $categoryArticle = CategoryArticle::findOrFail($id);
    
        // Xóa file hình ảnh nếu tồn tại
        if ($categoryArticle->image) {
            $imagePath = public_path('images/' . $categoryArticle->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file
            }
        }
    
        // Xóa danh mục
        $categoryArticle->delete();
    
        // Lấy lại danh sách danh mục
        $CA = CategoryArticle::orderBy('id', 'desc')->get();
    
        // Trả về view cùng với danh sách mới
        return redirect()->route('categoryArticle')->with('success', 'Danh mục đã được xóa thành công!');
    }
    
    
    
    public function categoryArticleUpdate() {}
}
