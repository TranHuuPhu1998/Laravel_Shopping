<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // cho phép insert vào các trường của bảng

    protected $fillable = ['name','parent_id','slug'];
}