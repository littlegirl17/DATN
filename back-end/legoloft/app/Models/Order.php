<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'province',
        'district',
        'ward',
        'total',
        'payment',
        'status',
        'coupon_code',
        'note',
        'order_code'
    ];

    public function orderUser($userId)
    {
        return $this->where('user_id', $userId)->get();
    }

    public function definePayment()
    {
        return [
            1 => 'Thanh toán bằng tiền mặt',
            2 => 'Chuyển khoản ngân hàng',
            3 => 'Thanh toán VNPAY',
            4 => 'Thanh toán MoMo',
        ];
    }
}
