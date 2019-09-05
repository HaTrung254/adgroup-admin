<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    const LIMIT_PRODUCT = 5;
    const NOI_BAT = 1;
    const SAN_CO = 2;
    const KHAC = 3;

    public static function typeProductArr(){
        return [
            static::NOI_BAT => 'Nổi bật',
            static::SAN_CO => 'Sẵn có',
            static::KHAC => 'Khác'
        ];
    }

    public $fillable = ['category_id', 'vn_title', 'en_title', 'vn_description', 'en_description', 'vn_content', 'en_content', 'brand', 'vn_price', 'en_price', 'image_url', 'type', 'is_display', 'vn_url', 'en_url'];


    public static function queryProduct($lang, $type = null, $limit = null, $cate = null, $ignoreId = null, $where = '')
    {
        $query = static::select(DB::raw("products.id, products.{$lang}_title as title, products.image_url, products.{$lang}_price as price, products.category_id, products.{$lang}_url as url, product_categories.{$lang}_url as cate_url"))
            ->leftJoin('product_categories', function($join) {
                $join->on('product_categories.id', '=', 'products.category_id')
                    ->where('new_categories.is_display', BaseHelper::DISPLAY_FLAG);
            })
            ->where('products.is_display', BaseHelper::DISPLAY_FLAG);

        if($cate != null){
            $query = $query->where('products.category_id', $cate);
        }

        if($type != null){
            $query = $query->where('products.type', $type);
        }

        if($ignoreId != null) {
            $query = $query->where('products.id', '<>', $ignoreId);
        }

        if($where != '') {
            $query = $query->whereRaw($where);
        }

        if ($limit != null) {
            $query = $query->limit($limit);
        }

        return $query;
    }

    public static function getProducts($lang, $type = null, $limit = null, $cate = null, $ignoreId = null, $where = '')
    {
        return static::queryProduct($lang, $type, $limit, $cate, $ignoreId, $where)->get();
    }

    public static function getDetail($lang, $id)
    {
        return static::select(DB::raw("id, {$lang}_content as content, {$lang}_title as title, {$lang}_price as price, image_url, category_id, {$lang}_description as description, brand"))
        ->where('id', $id)
        ->first();
    }

    public static function getDetailByUrl($lang, $url)
    {
        return static::select(DB::raw("id, {$lang}_content as content, {$lang}_title as title, {$lang}_price as price, image_url, category_id, {$lang}_description as description, brand"))
        ->where('vn_url', $url)->orWhere('en_url', $url)
        ->first();
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
