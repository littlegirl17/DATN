<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'price',
        'image',
        'status',
        'view',
        'outstanding'
    ];

    public function categories()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }

    public function productDiscount()
    {
        return $this->hasMany(ProductDiscount::class, 'product_id');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'product_id');
    }

    public function productImage()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function productAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function searchProduct($filter_iddm, $filter_name, $filter_price, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_iddm)) {
            $query->where('category_id', $filter_iddm);
        }

        if (!is_null($filter_name)) {
            $query->where('name', "LIKE", "%{$filter_name}%");
        }

        if (!is_null($filter_price)) {
            $query->where('price', '=', (int)$filter_price);
        }

        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        return $query->paginate(10);
    }

    public function productOutStanding()
    {
        return $this->where('outstanding', 1)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function productDiscountSection()
    {
        return $this
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function productBestseller()
    {
        $quantityTotal = (new OrderProduct)->getQuantityProduct(); //trả về một tập hợp các bản ghi chứa product_id và tổng số lượng (total_quantity) của từng sản phẩm.
        return $this->whereIn('id', $quantityTotal->pluck('product_id'))->get(); //>whereIn('id':  lọc những sản phẩm từ bảng sản phẩm có id nằm trong danh sách các product_id này.  //pluck('product_id') sẽ lấy ra tất cả các product_id từ tập hợp kết quả đó, tạo thành một danh sách (mảng) các product_id.
    }
}
