<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Sliders;
use App\Models\News;
use App\Models\NewCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    const FOLDER_UPLOAD = 'upload/image';

    const SLIDERS = 1;
    const CATEGORIES = 2;
    const PRODUCTS = 3;
    const NEW_CATEGORIES = 4;
    const NEWS = 5;
    const ERROR_500 = "Có lỗi xảy ra. Vui lòng thử lại!";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function sliders(){
        $sliders = Sliders::all();
        return view('sliders.list', ['sliders' => $sliders, 'title' => 'Sliders', 'navNumber' => static::SLIDERS]);
    }

    public function sliderEdit($id, Request $request){
        $id = !empty($id) ? $id : $request->get('id');
        $slider = Sliders::find($id);    
        if($request->isMethod('POST')) {
            try{
                DB::beginTransaction();
                $value = [
                    'vn_title' => $request->get('vn_title'),
                    'en_title' => $request->get('en_title'),
                    'vn_sub_title' => $request->get('vn_sub_title'),
                    'en_sub_title' => $request->get('en_sub_title'),
                    'vn_vertical_title' => $request->get('vn_vertical_title'),
                    'en_vertical_title' => $request->get('en_vertical_title'),
                    'vn_horizontal_title' => $request->get('vn_horizontal_title'),
                    'en_horizontal_title' => $request->get('en_horizontal_title'),
                    'vn_content' => $request->get('vn_content'),
                    'en_content' => $request->get('en_content'),
                ];
                if($request->hasFile('image_url')) {
                    $file = $request->file('image_url');
                    $fileName = "slider_". $id . '.' . $file->getClientOriginalExtension();
                    $value['image_url'] = static::FOLDER_UPLOAD."/".$fileName;
                    try{
                        $file->move(static::FOLDER_UPLOAD, $fileName);
                    } catch (\Exception $e) {
                        return redirect()->route('slider_edit', $id)->withErrors("");
                    }
                }
                $slider->update($value);
                DB::commit();
                return redirect()->route('sliders')->withErrors("");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('slider_edit', $id)->withErrors("");
            }

        }
        return view('sliders.edit', ['slider' => $slider, 'title' => 'Sửa slider', 'navNumber' => static::SLIDERS]);
    }

    public function categories(Request $request){
        $key = $request->get('key');
        $cates = !empty($request->get('key')) ? 
                Categories::where('vn_title', 'LIKE', "%{$key}%")
                        ->orWhere('en_title', 'LIKE', "%{$key}%")
                        ->orderBy('order', 'desc')->paginate(15) : 
                Categories::orderBy('order', 'desc')->paginate(15);
        $routeSearch = route('categories');
        return view('categories.list', ['cates' => $cates, 'hasSearch' => true, 
            'routeCreate' => route('category_create'), 'navNumber' => static::CATEGORIES, 
            'routeSearch' => $routeSearch, 'key' => $key]);
    }

    public function setCategoryValue($request){
        $vn_url = explode(' ', strtolower($request->get('vn_title')));
        $vn_url = implode('-', $vn_url);

        $en_url = explode(' ', strtolower($request->get('en_title')));
        $en_url = implode('-', $en_url);

        return [
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title'),
            'order' => $request->get('order'),
            'is_display' => $request->get('is_display') == "on" ? 1 : 0,
            'vn_url' => $vn_url,
            'en_url' => $en_url,
        ];
    }

    public function categoryCreate(Request $request){
        if($request->isMethod('POST')) {
            try{
                DB::beginTransaction();
                $value = $this->setCategoryValue($request);
                if(Categories::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('category_create')->withErrors("Đã có danh mục này!");    
                }
                Categories::insert($value);
                DB::commit();
                return redirect()->route('categories')->withErrors("");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('category_create')->withErrors(static::ERROR_500);
            }
        }
        return view('categories.detail', ['navNumber' => static::CATEGORIES]);
    }

    public function categoryEdit($id, Request $request){
        $id = !empty($id) ? $id : $request->get('id');
        $cate = Categories::find($id);
        if($request->isMethod('POST')) {
            if($cate) {
                try {
                    DB::beginTransaction();
                    $value = $this->setCategoryValue($request);
                    if(Categories::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('category_edit', $id)->withErrors("Đã có danh mục này!");
                    }
                    if($value['is_display'] != $cate->is_display){
                        $product = new Products();
                        $product->where('category_id', $cate->id)->update(['is_display' => $value['is_display']]);  
                    }
                    
                    $cate->update($value);
                    DB::commit();
                    return redirect()->route('categories')->withErrors("");
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->route('category_edit', $id)->withErrors(static::ERROR_500);
                }
            }
        }
        return view('categories.detail', ['category' => $cate,'navNumber' => static::CATEGORIES]);
    }

    public function categoryDelete($id){
        $cate = Categories::find($id);
        if($cate != null) {
            try {
                DB::beginTransaction();
                $cate->delete();
                $product = new Products();
                $product->where('category_id', $id)->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }

        return redirect()->route('categories')->withErrors("");
    }

    public function products(Request $request){
        $key = $request->get('key');
        $products = !empty($request->get('key')) ? 
                Products::where('vn_title', 'LIKE', "%{$key}%")
                        ->orWhere('en_title', 'LIKE', "%{$key}%")
                        ->orWhere('brand', 'LIKE', "%{$key}%")
                        ->orderBy('id', 'desc')->paginate(10) : 
                Products::orderBy('id', 'desc')->paginate(10);
        $routeSearch = route('products');
        return view('products.list', ['products' => $products, 'hasSearch' => true,
            'routeCreate' => route('product_create'), 'navNumber' => static::PRODUCTS, 
            'routeSearch' => $routeSearch, 'key' => $key]);
    }

    public function setProductValue($request){
        $vn_url = explode(' ', strtolower($request->get('vn_title')));
        $vn_url = implode('-', $vn_url);

        $en_url = explode(' ', strtolower($request->get('en_title')));
        $en_url = implode('-', $en_url);

        $value = [
            'category_id' => $request->get('category_id'),
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title'),
            'vn_description' => $request->get('vn_description'),
            'en_description' => $request->get('en_description'),
            'vn_content' => $request->get('vn_content'),
            'en_content' => $request->get('en_content'),
            'brand' => $request->get('brand'),
            'vn_price' => $request->get('vn_price'),
            'en_price' => $request->get('en_price'),
            'type' => $request->get('type'),
            'is_display' => $request->get('is_display') == "on" ? 1 : 0,
            'vn_url' => $vn_url,
            'en_url' => $en_url,
        ];
        if($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $fileName = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $folderPath = static::FOLDER_UPLOAD ."/products";
            $value['image_url'] = $folderPath ."/". $fileName;
            $file->move($folderPath, $fileName);
        }
        return $value;
    }

    public function productCreate(Request $request){
        if($request->isMethod('POST')) {
            try{

                DB::beginTransaction();
                $value = $this->setProductValue($request);
                if(Products::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('product_create')->withErrors("Đã có sản phẩm này!");
                }
                Products::insert($value);
                DB::commit();
                return redirect()->route('products')->withErrors("Cập nhật sản phẩm thành công!");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('product_create')->withErrors(static::ERROR_500);
            }
        }
        $productCates = Categories::all();
        $productTypes = Products::typeProductArr();
        return view('products.detail', ['productCates' => $productCates, 'navNumber' => static::PRODUCTS,
            'productTypes' => $productTypes]);
    }

    public function productEdit($id, Request $request){
        $id = !empty($id) ? $id : $request->get('id');
        $product = Products::find($id);
        if($request->isMethod('POST')) {
            if($product) {
                try {
                    DB::beginTransaction();
                    $value = $this->setProductValue($request);
                    if(Products::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('product_edit', $id)->withErrors("Đã có sản phẩm này!");
                    }
                    $product->update($value);
                    DB::commit();
                    return redirect()->route('products')->withErrors("");
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->route('product_edit', $id)->withErrors("");
                }
            }
        }
        $productCates = Categories::all();
        $productTypes = Products::typeProductArr();
        return view('products.detail', ['product' => $product, 'productCates' => $productCates, 'navNumber' => static::PRODUCTS,
            'productTypes' => $productTypes]);
    }

    public function productDelete($id){
        $product = Products::find($id);
        if($product != null) {
            $product->delete();
        }

        return redirect()->route('products')->withErrors("");
    }

    public function newCategories(Request $request){
        $key = $request->get('key');
        $cates = !empty($request->get('key')) ? 
                NewCategories::where('vn_title', 'LIKE', "%{$key}%")
                        ->orWhere('en_title', 'LIKE', "%{$key}%")
                        ->orderBy('order', 'desc')->paginate(15) : 
                NewCategories::orderBy('order', 'desc')->paginate(15);
        $routeSearch = route('new_categories');
        return view('newcategories.list', ['cates' => $cates, 'hasSearch' => true,
            'routeCreate' => route('new_category_create'), 'navNumber' => static::NEW_CATEGORIES,
            'routeSearch' => $routeSearch, 'key' => $key]);
    }

    public function newCategoryCreate(Request $request){
        if($request->isMethod('POST')) {
            try{
                DB::beginTransaction();
                $value = $this->setCategoryValue($request);
                if(NewCategories::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('new_category_create')->withErrors("Đã có danh mục này!");
                }
                $cate = new NewCategories();
                $cate->insert($value);
                DB::commit();
                return redirect()->route('new_categories')->withErrors("Cập nhật danh mục thành công!");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('new_category_create')->withErrors(static::ERROR_500);
            }
        }
        return view('newcategories.detail', ['navNumber' => static::NEW_CATEGORIES]);
    }

    public function newCategoryEdit($id, Request $request){
        $id = !empty($id) ? $id : $request->get('id');
        $cate = NewCategories::find($id);
        if($request->isMethod('POST')) {
            if($cate) {
                try {
                    DB::beginTransaction();
                    $value = $this->setCategoryValue($request);
                    if(NewCategories::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('new_category_edit', $id)->withErrors("Đã có danh mục này!");
                    }
                    if($value['is_display'] != $cate->is_display){
                        $new = new News();
                        $new->where('category_id', $cate->id)->update(['is_display' => $value['is_display']]);  
                    }
                    
                    $cate->update($value);

                    DB::commit();
                    return redirect()->route('new_categories')->withErrors("Cập nhật danh mục thành công!");
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->route('new_category_edit', $id)->withErrors(static::ERROR_500);
                }
            }
        }
        return view('newcategories.detail', ['category' => $cate,'navNumber' => static::CATEGORIES]);
    }

    public function newCategoryDelete($id){
        $cate = NewCategories::find($id);
        if($cate != null) {
            try {
                DB::beginTransaction();
                $cate->delete();
                $new = new News();
                $new->where('category_id', $id)->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }
        return redirect()->route('new_categories')->withErrors("");
    }

    public function news(Request $request){
        $key = $request->get('key');
        $news = !empty($request->get('key')) ? 
                News::where('vn_title', 'LIKE', "%{$key}%")
                        ->orWhere('en_title', 'LIKE', "%{$key}%")
                        ->orderBy('release_at', 'desc')->paginate(10) : 
                News::orderBy('release_at', 'desc')->paginate(10);
        $routeSearch = route('news');
        return view('news.list', ['news' => $news, 'hasSearch' => true,
            'routeCreate' => route('new_create'), 'navNumber' => static::NEWS, 
            'routeSearch' => $routeSearch, 'key' => $key]);
    }

    public function setNewValue($request){
        $vn_url = explode(' ', strtolower($request->get('vn_title')));
        $vn_url = implode('-', $vn_url);

        $en_url = explode(' ', strtolower($request->get('en_title')));
        $en_url = implode('-', $en_url);

        $dateArr = explode('/', $request->get('release_at'));
        $value = [
            'category_id' => $request->get('category_id'),
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title'),
            'vn_content' => $request->get('vn_content'),
            'en_content' => $request->get('en_content'),
            'is_display' => $request->get('is_display') == "on" ? 1 : 0,
            'release_at' => $dateArr[2].'-'.$dateArr[1].'-'.$dateArr[0],
            'vn_url' => $vn_url,
            'en_url' => $en_url,
        ];
        if($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $fileName = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $folderPath = static::FOLDER_UPLOAD ."/news";
            $value['image_url'] = $folderPath ."/". $fileName;
            $file->move($folderPath, $fileName);
        }
        return $value;
    }

    public function newCreate(Request $request){
        if($request->isMethod('POST')) {
            try{
                DB::beginTransaction();
                $value = $this->setNewValue($request);
                if(News::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('new_create')->withErrors("Đã có bài viết này!");
                }
                $new = new News();
                $new->insert($value);
                DB::commit();
                return redirect()->route('news')->withErrors("");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('new_create')->withErrors("");
            }
        }
        $newCates = NewCategories::all();
        return view('news.detail', ['newCates' => $newCates, 'navNumber' => static::NEWS]);
    }

    public function newEdit($id, Request $request){
        $id = !empty($id) ? $id : $request->get('id');
        $new = News::find($id);
        if($request->isMethod('POST')) {
            if($new) {
                try {
                    DB::beginTransaction();
                    $value = $this->setNewValue($request);
                    if(News::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('new_edit', $id)->withErrors("Đã có bài viết này!");
                    }
                    $new->update($value);
                    DB::commit();
                    return redirect()->route('news')->withErrors("");
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->route('new_edit', $id)->withErrors("");
                }
            }
        }
        $newCates = NewCategories::all();
        return view('news.detail', ['new' => $new, 'newCates' => $newCates, 'navNumber' => static::NEWS]);
    }

    public function newDelete($id){
        $new = News::find($id);
        if($new != null) {
            $new->delete();
        }

        return redirect()->route('news')->withErrors("");
    }
}
