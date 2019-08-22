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
        return view('sliders.list', ['sliders' => $sliders, 'title' => 'Sliders', 'hasSearch' => true]);
    }

    public function sliderEdit($id){
        $slider = Sliders::find($id);
        return view('sliders.edit', ['slider' => $slider, 'title' => 'Sửa slider']);
    }


    public function categories(){
        return view('categories.list');
    }

    public function products(){
        return view('products.list');
    }
}
