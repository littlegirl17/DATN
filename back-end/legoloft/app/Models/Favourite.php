<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function favouriteFist($user_id, $product_id)
    {
        return $this->where('user_id', $user_id)->where('product_id', $product_id)->first();
    }

    public function favouriteGet($user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('id', 'desc')->paginate(4);
    }

    public function countFavourite($user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    public function favouriteAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function searchFavourite($filter_name, $filter_user, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_name)) {
            $query->where('product_id', '=', (int)$filter_name);
        }

        if (!is_null($filter_user)) {
            $query->whereHas('user', function ($i) use ($filter_user) {
                $i->where('name', 'LIKE', '%' . $filter_user . '%'); // Giả sử bạn có cột `name` trong bảng `users`
            });
        }


        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        return $query->paginate(10);
    }
}