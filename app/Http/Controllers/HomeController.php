<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    const FOLDER_UPLOAD = 'upload/image';
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
        return view('sliders.list', ['sliders' => $sliders, 'title' => 'Sliders']);
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
        return view('sliders.edit', ['slider' => $slider, 'title' => 'Sửa slider']);
    }

    public function categories(){
        $cates = Categories::orderBy('order', 'desc')->paginate(15);
        return view('categories.list', ['cates' => $cates]);
    }

    public function setCategoryValue($request){
        return [
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title')
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
        return view('categories.detail');
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
        return view('categories.detail', ['category' => $cate]);
    }

    public function cateDelete($id){
        $cate = Categories::find($id);
        if($cate) {
            try{
                DB::beginTransaction();
                $cate->delete();
                DB::commit();
                return redirect()->route('categories')->withErrors("");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('category_edit', $id)->withErrors("");
            }
        }

        return redirect()->route('categories')->withErrors("");
    }

    public function products(){
        $products = Products::paginate(10);
        return view('products.list', ['products' => $products, 'hasSearch' => true,
            'routeCreate' => route('product_create')]);
    }

    public function setProductValue($request){
        $value = [
            'category_id' => $request->get('category_id'),
            'vn_title' => $request->get('vn_title'),
            'en_title' => $request->get('en_title'),
            'vn_content' => $request->get('vn_content'),
            'en_content' => $request->get('en_content'),
            'price' => $request->get('price'),
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
        return view('products.detail', ['productCates' => $productCates]);
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
        return view('products.detail', ['product' => $product, 'productCates' => $productCates]);
    }

    public function productDelete($id){
        $product = Products::find($id);
        if($product) {
            try{
                DB::beginTransaction();
                $product->delete();
                DB::commit();
                return redirect()->route('products')->withErrors("");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('product_edit', $id)->withErrors("");
            }
        }

        return redirect()->route('products')->withErrors("");
    }
}
