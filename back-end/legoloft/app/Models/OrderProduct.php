<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'quantity',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Tính tổng số lượng các sản phẩm trong bảng OrderProduct và lọc ra những sản phẩm có tổng số lượng lớn hơn 100.
    public function getQuantityProduct()
    {
        return $this->selectRaw('product_id, SUM(quantity) as total_quantity') //selectRaw thực hiện các hàm SQL như SUM(), AVG(), COUNT()
            ->groupBy('product_id') //groupBy Nhóm các kết quả dựa trên một hoặc nhiều cột.
            ->having('total_quantity', '>', 100) //having thêm các điều kiện lọc dữ liệu sau khi đã nhóm lại - Thường được sử dụng cùng với groupBy()
            ->orderBy('total_quantity', 'desc');
    }
}
