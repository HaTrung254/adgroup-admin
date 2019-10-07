<?php

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use App\Models\Brands;
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
    const BRANDS = 6;
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

    public function sliders(Request $request){
        $key = $request->get('key');
        $sliders = !empty($request->get('key')) ?
            Sliders::where('vn_title', 'LIKE', "%{$key}%")
                ->orWhere('en_title', 'LIKE', "%{$key}%")
                ->orWhere('vn_sub_title', 'LIKE', "%{$key}%")
                ->orWhere('en_sub_title', 'LIKE', "%{$key}%")
                ->orWhere('vn_vertical_title', 'LIKE', "%{$key}%")
                ->orWhere('en_vertical_title', 'LIKE', "%{$key}%")
                ->orWhere('vn_horizontal_title', 'LIKE', "%{$key}%")
                ->orWhere('en_horizontal_title', 'LIKE', "%{$key}%")
                ->orderBy('order', 'desc')->paginate(15) :
            Sliders::orderBy('order', 'desc')->paginate(15);
        return view('sliders.list', ['sliders' => $sliders, 'title' => 'Sliders', 'navNumber' => static::SLIDERS,
            'hasSearch' => true,
            'routeCreate' => route('slider_create'),
            'routeSearch' => route('sliders'), 'key' => $key]);
    }

    public function setSliderValue($request)
    {
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
            'order' => $request->get('order'),
            'is_display' => $request->get('is_display') == "on" ? 1 : 0,
        ];
        if($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $fileName = "slider_". date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $value['image_url'] = static::FOLDER_UPLOAD."/".$fileName;
            $file->move(static::FOLDER_UPLOAD, $fileName);
        }
        return $value;
    }

    public function sliderCreate(Request $request){
        if($request->isMethod('POST')) {
            try{
                $value = $this->setSliderValue($request);
                Sliders::create($value);
                return redirect()->route('sliders')->withErrors("Thêm slider thành công!");
            } catch (\Exception $e) {
                return redirect()->route('slider_create')->withErrors(static::ERROR_500);
            }

        }
        return view('sliders.edit', ['title' => 'Thêm slider', 'navNumber' => static::SLIDERS]);
    }

    public function sliderEdit($id, Request $request){
        $id = !empty($id) ? $id : $request->get('id');
        $slider = Sliders::find($id);
        if($request->isMethod('POST')) {
            try{
                $value = $this->setSliderValue($request);
                $slider->update($value);
                return redirect()->route('sliders')->withErrors("Sửa slider thành công!");
            } catch (\Exception $e) {
                return redirect()->route('slider_edit', $id)->withErrors(static::ERROR_500);
            }

        }
        return view('sliders.edit', ['slider' => $slider, 'title' => 'Sửa slider', 'navNumber' => static::SLIDERS]);
    }

    public function sliderDelete($id){
        $slider = Sliders::find($id);
        if($slider != null) {
            $slider->delete();
        }

        return redirect()->route('sliders')->withErrors("Đã xóa 1 slider.");
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
        $vn_url = explode(' ', BaseHelper::convert_vi_to_en(strtolower($request->get('vn_title'))));
        $vn_url = implode('-', $vn_url);

        $en_url = explode(' ', BaseHelper::convert_vi_to_en(strtolower($request->get('en_title'))));
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
                $value = $this->setCategoryValue($request);
                $name = $value['vn_title'];
                if(Categories::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('category_create')->withErrors("Đã có danh mục này!");    
                }
                Categories::insert($value);
                return redirect()->route('categories')->withErrors("Thêm danh mục {$name} thành công!");
            } catch (\Exception $e) {
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
                    $name = $value['vn_title'];
                    if(Categories::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('category_edit', $id)->withErrors("Đã có danh mục này!");
                    }
                    if($value['is_display'] != $cate->is_display){
                        $product = new Products();
                        $product->where('category_id', $cate->id)->update(['is_display' => $value['is_display']]);  
                    }
                    
                    $cate->update($value);
                    DB::commit();
                    return redirect()->route('categories')->withErrors("Cập nhật danh mục {$name} thành công!");
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
        $name = $cate->vn_title;
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

        return redirect()->route('categories')->withErrors("Đã xóa danh mục {$name} và các sản phẩm thuộc danh mục này.");
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
        $vn_url = explode(' ', BaseHelper::convert_vi_to_en(strtolower($request->get('vn_title'))));
        $vn_url = implode('-', $vn_url);

        $en_url = explode(' ', BaseHelper::convert_vi_to_en(strtolower($request->get('en_title'))));
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
                $value = $this->setProductValue($request);
                $name = $value['vn_title'];
                if(Products::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('product_create')->withErrors("Đã có sản phẩm này!");
                }
                Products::insert($value);
                return redirect()->route('products')->withErrors("Thêm sản phẩm {$name} thành công!");
            } catch (\Exception $e) {
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
                    $value = $this->setProductValue($request);
                    $name = $value['vn_title'];
                    if(Products::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('product_edit', $id)->withErrors("Đã có sản phẩm này!");
                    }
                    $product->update($value);
                    return redirect()->route('products')->withErrors("Cập nhật sản phẩm {$name} thành công!");
                } catch (\Exception $e) {
                    return redirect()->route('product_edit', $id)->withErrors(static::ERROR_500);
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
        $name = $product->vn_title;
        if($product != null) {
            $product->delete();
        }

        return redirect()->route('products')->withErrors("Xóa sản phẩm {$name} thành công!");
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
                $value = $this->setCategoryValue($request);
                $name = $value['vn_title'];
                if(NewCategories::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('new_category_create')->withErrors("Đã có danh mục này!");
                }
                NewCategories::insert($value);
                return redirect()->route('new_categories')->withErrors("Cập nhật danh mục {$name} thành công!");
            } catch (\Exception $e) {
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
                    $value = $this->setCategoryValue($request);
                    $name = $value['vn_title'];
                    if(NewCategories::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('new_category_edit', $id)->withErrors("Đã có danh mục này!");
                    }
                    if($value['is_display'] != $cate->is_display){
                        $new = new News();
                        $new->where('category_id', $cate->id)->update(['is_display' => $value['is_display']]);  
                    }
                    
                    $cate->update($value);
                    return redirect()->route('new_categories')->withErrors("Cập nhật danh mục {$name} thành công!");
                } catch (\Exception $e) {
                    return redirect()->route('new_category_edit', $id)->withErrors(static::ERROR_500);
                }
            }
        }
        return view('newcategories.detail', ['category' => $cate,'navNumber' => static::CATEGORIES]);
    }

    public function newCategoryDelete($id){
        $cate = NewCategories::find($id);
        $name = $cate->vn_title;
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
        return redirect()->route('new_categories')->withErrors("Xóa danh mục {$name} thành công!");
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
        $vn_url = explode(' ', BaseHelper::convert_vi_to_en(strtolower($request->get('vn_title'))));
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
                $value = $this->setNewValue($request);
                if(News::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('new_create')->withErrors("Đã có bài viết này!");
                }
                News::insert($value);
                return redirect()->route('news')->withErrors("Thêm bài viết thành công!");
            } catch (\Exception $e) {
                return redirect()->route('new_create')->withErrors(static::ERROR_500);
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
                // try {
                    $value = $this->setNewValue($request);
                    if(News::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('new_edit', $id)->withErrors("Đã có bài viết này!");
                    }
                    $new->update($value);
                    return redirect()->route('news')->withErrors("Cập nhật bài viết thành công!");
                // } catch (\Exception $e) {
                //     return redirect()->route('new_edit', $id)->withErrors(static::ERROR_500);
                // }
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

        return redirect()->route('news')->withErrors("Xóa bài viết thành công!");
    }

    public function brands(Request $request){
        $key = $request->get('key');
        $news = !empty($request->get('key')) ?
            Brands::where('vn_title', 'LIKE', "%{$key}%")
                ->orWhere('en_title', 'LIKE', "%{$key}%")
                ->orderBy('order', 'desc')->paginate(10) :
            Brands::orderBy('order', 'desc')->paginate(10);
        $routeSearch = route('brands');
        return view('brands.list', ['brands' => $news, 'hasSearch' => true,
            'routeCreate' => route('brand_create'), 'navNumber' => static::BRANDS,
            'routeSearch' => $routeSearch, 'key' => $key]);
    }

    public function setBrandValue($request){
        $vn_url = explode(' ', BaseHelper::convert_vi_to_en(strtolower($request->get('vn_title'))));
        $vn_url = implode('-', $vn_url);

        $en_url = explode(' ', BaseHelper::convert_vi_to_en(strtolower($request->get('en_title'))));
        $en_url = implode('-', $en_url);

        $value = [
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title'),
            'vn_description' => $request->get('vn_description'),
            'en_description' => $request->get('en_description'),
            'vn_content' => $request->get('vn_content'),
            'en_content' => $request->get('en_content'),
            'is_display' => $request->get('is_display') == "on" ? 1 : 0,
            'vn_url' => $vn_url,
            'en_url' => $en_url,
            'order' => $request->get('order'),
        ];
        if($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $fileName = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $folderPath = static::FOLDER_UPLOAD ."/brands";
            $value['image_url'] = $folderPath ."/". $fileName;
            $file->move($folderPath, $fileName);
        }
        return $value;
    }

    public function brandCreate(Request $request){
        if($request->isMethod('POST')) {
           try{
                $value = $this->setBrandValue($request);
                $name = $value['vn_title'];
                if(Brands::checkExistDetailByUrl($value['vn_url'], $value['en_url'])) {
                    return redirect()->route('brand_create')->withErrors("Đã có nhãn hàng này!");
                }
                Brands::insert($value);
                return redirect()->route('brands')->withErrors("Thêm nhãn hàng {$name} thành công!");
           } catch (\Exception $e) {
               return redirect()->route('brand_create')->withErrors(static::ERROR_500);
           }
        }
        return view('brands.detail', ['navNumber' => static::BRANDS]);
    }

    public function brandEdit($id, Request $request){
        $id = !empty($id) ? $id : $request->get('id');
        $brand = Brands::find($id);
        if($request->isMethod('POST')) {
            if($brand) {
                try {
                    $value = $this->setBrandValue($request);
                    $name = $value['vn_title'];
                    if(Brands::checkExistDetailByUrl($value['vn_url'], $value['en_url'], $id)) {
                        return redirect()->route('brand_edit', $id)->withErrors("Đã có nhãn hàng này!");
                    }
                    $brand->update($value);
                    return redirect()->route('brands')->withErrors("Cập nhật nhãn hàng {$name} thành công!");
                } catch (\Exception $e) {
                    return redirect()->route('brand_edit', $id)->withErrors(static::ERROR_500);
                }
            }
        }
        return view('brands.detail', ['brand' => $brand, 'navNumber' => static::BRANDS]);
    }

    public function brandDelete($id){
        $brand = Brands::find($id);
        $name = $brand->vn_title;
        if($brand != null) {
            $brand->delete();
        }

        return redirect()->route('brands')->withErrors("Đã xóa nhãn hàng {$name} khỏi danh sách!");
    }
}
