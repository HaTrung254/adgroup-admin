<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sliders extends Model
{
    protected $table = 'post';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'vn_sub_title', 'en_sub_title', 'vn_vertical_title', 'en_vertical_title',
                    'vn_horizontal_title', 'en_horizontal_title', 'vn_content',
                    'en_content', 'image_url', 'is_display', 'order'];

    public static function getSliders($lang = 'vn')
    {
        return Sliders::select(DB::raw("
                    {$lang}_title as title,
                    {$lang}_sub_title as sub_title, 
                    {$lang}_vertical_title as vertical_title, 
                    {$lang}_horizontal_title as horizontal_title, 
                    {$lang}_content as content,
                    image_url"))
            ->where('is_display', '1')
            ->orderBy('order')
            ->get();
    }
}
