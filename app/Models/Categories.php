<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'product_categories';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'order'];
}
