<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewCategories extends Model
{
    protected $table = 'new_categories';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'order','is_display', 'vn_url', 'en_url'];

    public static function queryList($langSession = 'vn')
    {
        return static::select('new_categories.id', DB::raw("new_categories.{$langSession}_title as title, new_categories.{$langSession}_url as url"),
            DB::raw('COUNT(news.id) as new_count'))
            ->join('news', function($join) {
                $join->on('new_categories.id', '=', 'news.category_id')
                ->where('release_at', '<=', date('Y-m-d'));
            })
            ->where('new_categories.is_display', BaseHelper::DISPLAY_FLAG)
            ->orderBy('new_categories.order')
            ->groupBy(['new_categories.id', 'new_categories.en_title', 'new_categories.vn_title', 'new_categories.vn_url','new_categories.en_url']);
    }

    public static function getList($langSession = 'vn')
    {
        return static::queryList($langSession)->get();
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
