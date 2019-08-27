<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    protected $table = 'product_categories';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'order', 'is_display'];

    public static function getProductDisplay($langSession = 'vn')
    {
        $selectTitle = $langSession == 'vn' ? "vn_title" : "en_title";
        return static::select('id', DB::raw($selectTitle. ' as title'))
            ->where('is_display', BaseHelper::DISPLAY_FLAG)
            ->orderBy('order')
            ->get();
    }

    public static function getCateById($id)
    {
        return static::where('id', $id)->first();
    }
}
