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

    public function orderUser($user_id, $status = null)
    {
        $query = $this->where('user_id', $user_id);
        if (!is_null($status)) {
            $query = $this->where('status', $status);
        }
        return $query->get();
    }


    public function definePayment()
    {
        return [
            1 => 'Thanh toán bằng tiền mặt',
            2 => 'Thanh toán VNPAY',
            3 => 'Thanh toán MoMo',
        ];
    }

    public function viewOrderUser($id_order)
    {
        return $this->where('id', $id_order->id)->first();
    }
}
