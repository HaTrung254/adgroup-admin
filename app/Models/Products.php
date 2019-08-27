<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;

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

    public $fillable = ['vn_title', 'en_title', 'vn_content', 'en_content', 'price', 'image_url', 'type', 'is_display'];

    public static function scopeSelectWithLang($query, $lang){
        return $query->select("{$lang}_title as title, price, image_url");
    }

    public static function getProducts($lang, $type = null, $limit = null)
    {
        $query = static::selectWithLang($lang)
            ->where('is_display', BaseHelper::DISPLAY_FLAG);
        if($type != null){
            $query = $query->where('type', $type);
        }

        if ($limit != null) {
            $query = $query->limit($limit);
        }

        return $query->get();
    }

}
