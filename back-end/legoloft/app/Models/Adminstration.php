<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Adminstration extends Authenticatable
//kế thừa Authenticatable mục đích là xác thực người dùng
{
    use HasFactory, Notifiable;

    // Khi bạn thêm các trường của bảng vào $fillable thì chỉ những trường đó có thể update hàng loạt và những trường khác thì không.
    protected $fillable = [
        'admin_group_id',
        'fullname',
        'username',
        'email',
        'password',
        'image',
        'status',
    ];
}