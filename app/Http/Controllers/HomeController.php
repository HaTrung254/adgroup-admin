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

    public function categories(){
        $cates = Categories::orderBy('order', 'desc')->paginate(15);
        return view('categories.list', ['cates' => $cates, 'hasSearch' => true, 
            'routeCreate' => route('category_create'), 'navNumber' => static::CATEGORIES]);
    }

    public function setCategoryValue($request){
        return [
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title'),
            'order' => $request->get('order'),
            'is_display' => $request->get('is_display') == "on" ? 1 : 0
        ];
    }

    public function categoryCreate(Request $request){
        if($request->isMethod('POST')) {
            try{
                DB::beginTransaction();
                $value = $this->setCategoryValue($request);
                $cate = new Categories();
                $cate->insert($value);
                DB::commit();
                return redirect()->route('categories')->withErrors("");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('category_create')->withErrors("");
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
                    $cate->update($value);
                    DB::commit();
                    return redirect()->route('categories')->withErrors("");
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->route('category_edit', $id)->withErrors("");
                }
            }
        }
        return view('categories.detail', ['category' => $cate,'navNumber' => static::CATEGORIES]);
    }

    public function cateDelete($id){
        $cate = Categories::find($id);
        if($cate != null) {
            $cate->delete();
        }

        return redirect()->route('categories')->withErrors("");
    }

    public function products(){
        $products = Products::paginate(10);
        return view('products.list', ['products' => $products, 'hasSearch' => true,
            'routeCreate' => route('product_create'), 'navNumber' => static::PRODUCTS]);
    }

    public function setProductValue($request){
        $value = [
            'category_id' => $request->get('category_id'),
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title'),
            'vn_content' => $request->get('vn_content'),
            'en_content' => $request->get('en_content'),
            'price' => $request->get('price'),
            'type' => $request->get('type'),
            'is_display' => $request->get('is_display') == "on" ? 1 : 0
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
                $product = new Products();
                $product->insert($value);
                DB::commit();
                return redirect()->route('products')->withErrors("");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('product_create')->withErrors("");
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

    public function newCategories(){
        $cates = NewCategories::orderBy('order', 'desc')->paginate(15);
        return view('newcategories.list', ['cates' => $cates, 'hasSearch' => true,
            'routeCreate' => route('new_category_create'), 'navNumber' => static::NEW_CATEGORIES]);
    }

    public function newCategoryCreate(Request $request){
        if($request->isMethod('POST')) {
            try{
                DB::beginTransaction();
                $value = $this->setCategoryValue($request);
                $cate = new NewCategories();
                $cate->insert($value);
                DB::commit();
                return redirect()->route('new_categories')->withErrors("");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('new_category_create')->withErrors("");
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
                    $cate->update($value);
                    DB::commit();
                    return redirect()->route('new_categories')->withErrors("");
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->route('new_category_edit', $id)->withErrors("");
                }
            }
        }
        return view('newcategories.detail', ['category' => $cate,'navNumber' => static::CATEGORIES]);
    }

    public function newCategoryDelete($id){
        $cate = NewCategories::find($id);
        if($cate != null) {
            $cate->delete();
        }

        return redirect()->route('new_categories')->withErrors("");
    }

    public function news(){
        $news = News::paginate(10);
        return view('news.list', ['news' => $news, 'hasSearch' => true,
            'routeCreate' => route('new_create'), 'navNumber' => static::NEWS]);
    }

    public function setNewValue($request){
        $dateArr = explode('/', $request->get('release_at'));
        $value = [
            'category_id' => $request->get('category_id'),
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title'),
            'vn_content' => $request->get('vn_content'),
            'en_content' => $request->get('en_content'),
            'is_display' => $request->get('is_display') == "on" ? 1 : 0,
            'release_at' => $dateArr[2].'-'.$dateArr[1].'-'.$dateArr[0]
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
