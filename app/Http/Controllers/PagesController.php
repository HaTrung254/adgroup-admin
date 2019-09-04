<?php

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    protected $lang = BaseHelper::LANG_VN;

    public function __construct()
    {
        if(Session::has(BaseHelper::LANG_SESSION_NAME)) {
            $this->lang = Session::get(BaseHelper::LANG_SESSION_NAME);
        }
    }

    public function about(){
        $isAbout = 1;
        return view('frontend.pages.about', compact('isAbout'));
    }

    public function mailContact(Request $request)
    {
        try {
            $input = $request->all();
            $mail = env('MAIL_USERNAME');
            $title = BaseHelper::echoLang('title.mail_title');
            Mail::send('frontend.mailTemplate', $input, function ($message) use ($mail, $title) {
                $message->to($mail, 'Visitor')->subject($title);
            });
        } catch (\Exception $e) {
            return redirect()->route('about')->withErrors(['mail_send' => BaseHelper::echoLang('title.mail_fail')]);
        }

        return redirect()->route('about')->withErrors(['mail_send' => BaseHelper::echoLang('title.mail_success')]);

    }

    public function checkout($productId)
    {
        $isAbout = 0;
        $product = Products::getDetail($this->lang, $productId);
        return view('frontend.pages.about', compact('isAbout', 'product'));
    }

    public function checkoutPost(Request $request)
    {
        $input = $request->all();
        try {
            $mail = env('MAIL_USERNAME');
            $title = BaseHelper::echoLang('title.mail_title');
            Mail::send('frontend.mailTemplate', $input, function ($message) use ($mail, $title) {
                $message->to($mail, 'Visitor')->subject($title);
            });
        } catch (\Exception $e) {
            return redirect()->route('checkout', $input['product_id'])
                ->withErrors(['mail_send' => BaseHelper::echoLang('title.mail_fail')]);
        }

        return redirect()->route('checkout', $input['product_id'])
            ->withErrors(['mail_send' => BaseHelper::echoLang('title.mail_success')]);

    }
}
