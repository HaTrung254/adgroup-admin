<?php

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use App\Models\Products;
use App\Models\Sliders;
use Illuminate\Support\Facades\Session;

class FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $lang = BaseHelper::LANG_VN;

    public function __construct()
    {
        if(Session::has(BaseHelper::LANG_SESSION_NAME)) {
            $this->lang = Session::get(BaseHelper::LANG_SESSION_NAME);
        }
    }

    public function index()
    {
        $lang = BaseHelper::LANG_VN;
        if(Session::has(BaseHelper::LANG_SESSION_NAME)) {
            $lang = Session::get(BaseHelper::LANG_SESSION_NAME);
        }
        $sliders = Sliders::getSliders($lang);
        $noibatProduct = Products::getProducts($lang, Products::NOI_BAT, Products::LIMIT_PRODUCT);
        $sancoProduct = Products::getProducts($lang, Products::SAN_CO, Products::LIMIT_PRODUCT);
        return view('frontend.index', compact('sliders', 'noibatProduct', 'sancoProduct'));
    }

    public function changeLanguage($lang)
    {
        Session::put(BaseHelper::LANG_SESSION_NAME, $lang);
        return redirect()->back();
    }
}