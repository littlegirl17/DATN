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

    public function productAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function categories()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
}
