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


    public static function convert_vi_to_en($str) {
            if(!$str) return false;

            $utf8 = array(

                'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

                'd'=>'đ|Đ',

                'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

                'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

                'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

                'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

                'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

            );

            foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

            return $str;
    }
}