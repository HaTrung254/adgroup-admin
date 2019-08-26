<?php

namespace App\Helpers;


class BaseHelper
{
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

    public static function dateTimeFormat($date, $isEn = false)
    {
        $weekDayArr = static::weekDayArr();
        $enDay = date('D', strtotime($date));
        return $isEn ? $enDay . ", " . date('Y/m/d', strtotime($date)) :
            $weekDayArr[$enDay] . ", " . date('d/m/Y', strtotime($date));
    }

}