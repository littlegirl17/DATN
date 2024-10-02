<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function userGroupAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function userGroupDefault()
    {
        return $this->where('id', 1)->first();
    }
}
