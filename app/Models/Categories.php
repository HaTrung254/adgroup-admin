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
        $selectTitle = $langSession == 'vn' ? "product_categories.vn_title" : "product_categories.en_title";
        return static::select('product_categories.id', DB::raw($selectTitle. ' as title'),
            DB::raw('COUNT(products.id) as product_count'))
            ->join('products', function($join) {
                $join->on('product_categories.id', '=', 'products.category_id');
            })
            ->where('product_categories.is_display', BaseHelper::DISPLAY_FLAG)
            ->orderBy('product_categories.order')
            ->groupBy(['product_categories.id', 'product_categories.en_title', 'product_categories.vn_title'])
            ->get();
    }

    public static function getCateById($id)
    {
        return static::where('id', $id)->first();
    }
}
