<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // cho phép insert vào các trường của bảng

    use SoftDeletes;

    protected $fillable = ['name','parent_id','slug'];
}