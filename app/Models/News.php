<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    public $timestamps = false;
    public $fillable = ['category_id', 'vn_title', 'en_title', 'vn_content', 'en_content', 'is_display', 'release_at', 'image_url'];
}
