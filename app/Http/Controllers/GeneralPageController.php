<?php

namespace App\Http\Controllers;

use App\Models\ChatBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralPageController extends Controller
{
    public function termsAndConditions(Request $request)
    {
        if(Auth::user())
        {
            return view('terms_and_condition');
        }
        return view('terms_and_condition2');
    }

    public function aboutUs(Request $request)
    {
        if (Auth::user()) {
            return view('about_us');
        }
        return view('auth.about_us');
    }
    public function help(Request $request)
    {
        $chatBoxAllMessages = ChatBox::where('user_id', Auth::user()->id)->get();
        return view('help', ['chatBoxAllMessages' => $chatBoxAllMessages]);
    }
}
