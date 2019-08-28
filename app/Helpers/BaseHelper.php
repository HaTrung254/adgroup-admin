<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Session;

class BaseHelper
{
    const DISPLAY_FLAG = 1;
    const LANG_SESSION_NAME = 'lang';
    const LANG_VN = 'vn';
    const LANG_EN = 'en';

    public static function weekDayArr()
    {
        return [
            'Mon' => 'Thứ hai',
            'Tue' => 'Thứ ba',
            'Wed' => 'Thứ tư',
            'Thu' => 'Thứ năm',
            'Fri' => 'Thứ sáu',
            'Sat' => 'Thứ bảy',
            'Sun' => 'Chủ nhật'
        ];
    }

    public static function dateTimeFormat($date)
    {
        $weekDayArr = static::weekDayArr();
        $enDay = date('D', strtotime($date));
        $language = BaseHelper::LANG_VN;
            if(Session::has(BaseHelper::LANG_SESSION_NAME))
                $language = Session::get(BaseHelper::LANG_SESSION_NAME);
        return $language == static::LANG_EN ? $enDay . ", " . date('d M Y', strtotime($date)) :
            $weekDayArr[$enDay] . ", " . date('d/m/Y', strtotime($date));
    }

    public static function echoLang($expression){
        $language = static::LANG_VN;
        if(Session::has(BaseHelper::LANG_SESSION_NAME))
            $language = Session::get(BaseHelper::LANG_SESSION_NAME);
        return app('translator')->getFromJson($expression, [], $language);
    }

}