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

    public function favouriteFist($user_id,$product_id)
    {
        return $this->where('user_id', $user_id)->where('product_id', $product_id)->first();
    }
}