<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $table = 'news';
    public $timestamps = false;
    public $fillable = ['category_id', 'vn_title', 'en_title', 'vn_content', 'en_content', 'is_display', 'release_at', 'image_url'];

    public static function getNews($lang, $type = null, $limit = null, $cate = null, $ignoreId = null, $where = null)
    {
        $query = static::select(DB::raw("id, {$lang}_title as title, {$lang}_content as content, image_url, category_id, release_at"))
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

        if($where != null) {
            $query = $query->whereRaw($where);
        }

        $query = $query->where('release_at', '<=', date('Y-m-d'));

        if ($limit != null) {
            $query = $query->limit($limit);
        }

        return $query->orderBy('release_at', 'desc')->get();
    }

    public static function getDetail($lang, $id)
    {
        return static::select(DB::raw("id, {$lang}_content as content, {$lang}_title as title, image_url, category_id, release_at"))
        ->where('id', $id)
        ->first();
    }
}
