<?php

namespace App\Http\Controllers;

use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
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
                    $file = $request->image_url;
                    $value['image_url'] = "upload\image\\". $file->getClientOriginalName();
                    try{
                        $file->move('upload/image', $file->getClientOriginalName());
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
        return view('categories.list');
    }

    public function products(){
        return view('products.list');
    }
}
