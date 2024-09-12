<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminstrationGroup extends Model
{
    use HasFactory;

    // Khi bạn thêm các trường của bảng vào $fillable thì chỉ những trường đó có thể update hàng loạt và những trường khác thì không.
    protected $fillable = [
        'name',
        'permission',
    ];
}