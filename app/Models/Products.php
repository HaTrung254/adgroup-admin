<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'vn_content', 'en_content', 'price', 'image_url','is_display'];

}
