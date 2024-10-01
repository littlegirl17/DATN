<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_group_id',
        'price',
    ];

    public function productDiscountById($id)
    {
        return $this->where('product_id', $id)->orderBy('id', 'desc')->get();
    }

    public function productDiscount($product_id, $user_group_id)
    {
        return $this->where('product_id', $product_id)->where('user_group_id', $user_group_id)->first();
    }
}
