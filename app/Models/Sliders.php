<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $table = 'post';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'vn_vertical_title', 'en_vertical_title',
                    'vn_horizontal_title', 'en_horizontal_title', 'vn_content',
                    'en_content', 'image_url'];
}
