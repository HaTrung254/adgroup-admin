<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brands extends Model
{
	protected $table = 'brands';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'vn_description', 'en_description', 'vn_content', 'en_content', 'order','is_display', 'vn_url', 'en_url', 'image_url'];

    public static function queryList($langSession = 'vn', $where = '')
    {
        $query = static::select('brands.id', DB::raw("{$langSession}_title as title, {$langSession}_description as description, {$langSession}_url as url, image_url"))
            ->where('brands.is_display', BaseHelper::DISPLAY_FLAG);

        if($where != '') {
            $query = $query->whereRaw($where);
        }

        return $query->orderBy('brands.order');
    }

    public static function getList($langSession = 'vn')
    {
        return static::queryList($langSession)->get();
    }

    public static function getDetailByUrl($lang, $url)
    {
        return static::select(DB::raw("id, {$lang}_content as content, {$lang}_description as description, {$lang}_title as title, image_url"))
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
