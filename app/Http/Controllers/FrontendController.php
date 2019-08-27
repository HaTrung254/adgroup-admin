<?php

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use App\Models\News;
use App\Models\NewCategories;
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

    public function getLang()
    {
        $lang = BaseHelper::LANG_VN;
        if(Session::has(BaseHelper::LANG_SESSION_NAME)) {
            $lang = Session::get(BaseHelper::LANG_SESSION_NAME);
        }
        return $lang;
    }

    public function index()
    {
        $lang = $this->getLang();
        $sliders = Sliders::getSliders($lang);
        $noibatProduct = Products::getProducts($lang, Products::NOI_BAT, Products::LIMIT_PRODUCT);
        $sancoProduct = Products::getProducts($lang, Products::SAN_CO, Products::LIMIT_PRODUCT);
        return view('frontend.index', compact('sliders', 'noibatProduct', 'sancoProduct'));
    }

    public function productList($cateId)
    {
        $lang = $this->getLang();
        $products = Products::getProducts($lang,null,null, $cateId);
        return view('frontend.products.list', compact('products'));
    }

    public function productDetail($id)
    {
        $lang = $this->getLang();
        $product = Products::getDetail($lang, $id);
        $lienquanProducts = Products::getProducts($lang, null, 4, $product->category_id, $product->id);
        return view('frontend.products.detail', compact('product', 'lienquanProducts'));
    }

    public function newList()
    {
        $lang = $this->getLang();
        $news = News::getNews($lang);
        $newCates = NewCategories::getList($lang);
        $recentCates = array_slice($news->toArray(), -3, 3, true);
        return view('frontend.news.list', compact('news', 'newCates', 'recentCates'));
    }

    public function newCategoryList($id)
    {
        $lang = $this->getLang();
        $news = News::getNews($lang,null,null,$id);
        $newCates = NewCategories::getList($lang);
        $recentCates = array_slice($news->toArray(), -3, 3, true);
        return view('frontend.news.list', compact('news', 'newCates', 'recentCates'));
    }

    public function newDetail($id)
    {
        $lang = $this->getLang();
        $product = Products::getDetail($lang, $id);
        $lienquanProducts = Products::getProducts($lang, null, 4, $product->category_id, $product->id);
        return view('frontend.products.detail', compact('product', 'lienquanProducts'));
    }

    public function changeLanguage($lang)
    {
        Session::put(BaseHelper::LANG_SESSION_NAME, $lang);
        return redirect()->back();
    }
}