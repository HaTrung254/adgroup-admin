<?php

namespace App\Models;

use App\Helpers\BaseHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewCategories extends Model
{
    protected $table = 'new_categories';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title', 'order','is_display'];

    public static function queryList($langSession = 'vn')
    {
        $selectTitle = $langSession == 'vn' ? "new_categories.vn_title" : "new_categories.en_title";
        return static::select('new_categories.id', DB::raw($selectTitle. ' as title'),
            DB::raw('COUNT(news.id) as new_count'))
            ->join('news', function($join) {
                $join->on('new_categories.id', '=', 'news.category_id')
                ->where('release_at', '<=', date('Y-m-d'));
            })
            ->where('new_categories.is_display', BaseHelper::DISPLAY_FLAG)
            ->orderBy('new_categories.order')
            ->groupBy(['new_categories.id', 'new_categories.en_title', 'new_categories.vn_title']);
    }

    public static function getList($langSession = 'vn')
    {
        return static::queryList($langSession)->get();
    }
}
