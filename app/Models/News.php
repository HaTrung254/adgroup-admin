<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $table = 'news';
    public $timestamps = false;
    public $fillable = ['category_id', 'vn_title', 'en_title', 'vn_content', 'en_content', 'is_display', 'release_at', 'image_url', 'vn_url', 'en_url'];

    public static function queryNews($lang, $type = null, $limit = null, $cate = null, $ignoreId = null, $where = null)
    {
        $query = static::select(DB::raw("news.id, news.{$lang}_title as title, news.{$lang}_content as content, news.image_url, news.category_id, news.release_at, news.{$lang}_url as url, new_categories.{$lang}_url as cate_url"))
            ->leftJoin('new_categories', function($join) {
                $join->on('new_categories.id', '=', 'news.category_id')
                ->where('new_categories.is_display', BaseHelper::DISPLAY_FLAG);
            })
            ->where('news.is_display', BaseHelper::DISPLAY_FLAG);
        if($cate != null){
            $query = $query->where('news.category_id', $cate);
        }

        if($type != null){
            $query = $query->where('news.type', $type);
        }

        if($ignoreId != null) {
            $query = $query->where('news.id', '<>', $ignoreId);
        }

        if($where != null) {
            $query = $query->whereRaw($where);
        }

        $query = $query->where('news.release_at', '<=', date('Y-m-d'));

        if ($limit != null) {
            $query = $query->limit($limit);
        }

        return $query->orderBy('news.release_at', 'desc');
    }

    public static function getNews($lang, $type = null, $limit = null, $cate = null, $ignoreId = null, $where = null)
    {
        return static::queryNews($lang, $type, $limit, $cate, $ignoreId, $where)->get();
    }

    public static function getDetail($lang, $id)
    {
        return static::select(DB::raw("id, {$lang}_content as content, {$lang}_title as title, image_url, category_id, release_at"))
        ->where('id', $id)
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
