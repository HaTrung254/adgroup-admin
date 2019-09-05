<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('classActivePath')) {
    function classActivePath($segment, $value)
    {
        if(!is_array($value)) {
            return Request::segment($segment) == $value ? ' menu-open' : '';
        }
        foreach ($value as $v) {
            if(Request::segment($segment) == $v) return ' menu-open';
        }
        return '';
    }
}

if (!function_exists('classActiveSegment')) {
    function classActiveSegment($segment, $value)
    {
        if(!is_array($value)) {
            return Request::segment($segment) == $value ? 'active' : '';
        }
        foreach ($value as $v) {
            if(Request::segment($segment) == $v) return 'active';
        }
        return '';
    }
}

if (!function_exists('routeLangWithParams')) {
    function routeLangWithParams($route, $params)
    {
        $lang = Session::has('lang') ? Session::get('lang') : "vn";
        return route($lang.'_'.$route, $params);
    }
}

if (!function_exists('routeLang')) {
    function routeLang($route)
    {
        $lang = Session::has('lang') ? Session::get('lang') : "vn";
        return route($lang.'_'.$route);
    }
}