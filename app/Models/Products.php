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

    public $fillable = ['category_id', 'vn_title', 'en_title', 'vn_description', 'en_description', 'vn_content', 'en_content', 'brand', 'vn_price', 'en_price', 'image_url', 'type', 'is_display'];


    public static function getProducts($lang, $type = null, $limit = null, $cate = null, $ignoreId = null, $where = '')
    {
        $query = static::select(DB::raw("id, {$lang}_title as title, image_url, {$lang}_price as price, category_id"))
            ->where('is_display', BaseHelper::DISPLAY_FLAG);
        if($cate != null){
            $query = $query->where('category_id', $cate);
        }

        if($type != null){
            $query = $query->where('type', $type);
        }

        if($ignoreId != null) {
            $query = $query->where('id', '<>', $ignoreId);
        }

        if($where != '') {
            $query = $query->whereRaw($where);
        }

        if ($limit != null) {
            $query = $query->limit($limit);
        }

        return $query->get();
    }

    public static function getDetail($lang, $id)
    {
        return static::select(DB::raw("id, {$lang}_content as content, {$lang}_title as title, {$lang}_price as price, image_url, category_id, {$lang}_description as description, brand"))
        ->where('id', $id)
        ->first();
    }

}
