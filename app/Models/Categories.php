<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    protected $table = 'product_categories';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'order', 'is_display', 'vn_url', 'en_url'];

    public static function getProductDisplay($langSession = 'vn')
    {
        return static::select('product_categories.id', DB::raw("product_categories.{$langSession}_title as title, product_categories.{$langSession}_url as url"),
            DB::raw('COUNT(products.id) as product_count'))
            ->leftJoin('products', function($join) {
                $join->on('product_categories.id', '=', 'products.category_id');
            })
            ->where('product_categories.is_display', BaseHelper::DISPLAY_FLAG)
            ->orderBy('product_categories.order')
            ->groupBy(['product_categories.id', 'product_categories.en_title', 'product_categories.vn_title', 'product_categories.en_url', 'product_categories.vn_url'])
            ->get();
    }

    public static function getCateById($id)
    {
        return static::where('id', $id)->first();
    }

    public static function getDetailByUrl($url)
    {
        return static::where('vn_url', $url)->orWhere('en_url', $url)->first();
    }

    public static function checkExistDetailByUrl($vn_url, $en_url, $id = null)
    {
        $query = static::whereRaw("(vn_url = '{$vn_url}' OR en_url = '{$en_url}')");
        if($id != null) {
            $query = $query->where('id', '<>', $id);
        }
        return $query->exists();
    }
}
