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
}
