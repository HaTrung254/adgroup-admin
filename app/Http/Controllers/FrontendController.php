<?php

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use App\Models\News;
use App\Models\NewCategories;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Sliders;
use Illuminate\Http\Request;
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

    public function productSearch(Request $request)
    {
        $lang = $this->getLang();
        $keySearch = $request->get('key');
        $where = !empty($keySearch) ? "(products.{$lang}_title LIKE '%{$keySearch}%' or products.{$lang}_content LIKE '%{$keySearch}%')" : "";
        $products = Products::queryProduct($lang,null,null, null,null, $where)->paginate(12);
        return view('frontend.products.list', compact('products', 'keySearch'));
    }

    public function productCateList($cateUrl)
    {
        $lang = $this->getLang();
        $products = Products::queryProduct($lang,null,null, null,null, "(product_categories.en_url = '{$cateUrl}' or product_categories.vn_url = '{$cateUrl}')")->paginate(12);
        return view('frontend.products.list', compact('products'));
    }

    public function productOutStanding()
    {
        $lang = $this->getLang();
        $products = Products::queryProduct($lang,Products::NOI_BAT)->paginate(12);
        return view('frontend.products.list', compact('products'));
    }

    public function productAvailable()
    {
        $lang = $this->getLang();
        $products = Products::queryProduct($lang,Products::SAN_CO)->paginate(12);
        return view('frontend.products.list', compact('products'));
    }

    public function productDetail($cate_url, $product_url)
    {
        $lang = $this->getLang();
        $product = Products::getDetailByUrl($lang, $product_url);
        $category = Categories::getDetailByUrl($cate_url);
        $lienquanProducts = Products::getProducts($lang, null, 4, $category->id, $product->id);
        return view('frontend.products.detail', compact('product', 'lienquanProducts'));
    }

    public function newList(Request $request)
    {
        $lang = $this->getLang();
        $key = $request->get('key');
        $where = !empty($key) ? "({$lang}_title LIKE '%{$key}%' or {$lang}_content LIKE '%{$key}%')" : "";
        $news = News::queryNews($lang,null,null,null,null, $where)->paginate(6);
        $newCates = NewCategories::getList($lang);
        $recentCates = array_slice($news->toArray()['data'], -3, 3, true);
        return view('frontend.news.list', compact('news', 'newCates', 'recentCates', 'key'));
    }

    public function newCategoryList($cateUrl)
    {
        $lang = $this->getLang();
        $news = News::queryNews($lang,null,null,null,null, "(new_categories.en_url = '{$cateUrl}' or new_categories.vn_url = '{$cateUrl}')")->paginate(6);
        $newCates = NewCategories::getList($lang);
        $recentCates = array_slice($news->toArray()['data'], -3, 3, true);
        return view('frontend.news.list', compact('news', 'newCates', 'recentCates'));
    }

    public function newDetail($id)
    {
        $lang = $this->getLang();
        $new = News::getDetail($lang, $id);
        $newCates = NewCategories::getList($lang);
        $recentCates = News::getNews($lang, null, 3, $new->category_id, $new->id);
        return view('frontend.news.detail', compact('new', 'newCates', 'recentCates'));
    }

    public function changeLanguage($lang)
    {
        Session::put(BaseHelper::LANG_SESSION_NAME, $lang);
        return redirect()->back();
    }
}