<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    // list of columns that can be updated create database
    // protected $guarded = ['created'];

    // use create update delete
    protected $fillable =  ['name','parent_id','slug'];
    use SoftDeletes;
}