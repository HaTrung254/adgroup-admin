<?php

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function about(){
        return view('frontend.pages.about');
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
}
