<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    // Relationship
    protected $guarded = [];
    // mối quan hệ 1-n => 1 sản phẩm có nhiều hình ảnh , 1 hình thuộc 1 sản phẩm
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }

    // mối quan hệ 1 - n => 1 sản phẩm có nhiều category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // mối quan hệ 1-n => 1 sản phẩm có nhiều hình ảnh
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
