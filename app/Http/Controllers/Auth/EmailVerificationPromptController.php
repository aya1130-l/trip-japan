<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()//ログインuserのemail_verified_atの値がnullならfalse
                    ? redirect()->intended(RouteServiceProvider::HOME)//すでに認証済み
                    : view('auth.verify-email');//メール確認
    }
}
