<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller //確認メールのリンク踏んだときの処理
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {//ログインuserのemail_verified_atの値が入力されていればtrue
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');//入力されていればHOMEへ
        }

        elseif ($request->user()->markEmailAsVerified()) {//save()の戻り値はboolean、saveが成功したらtrue
            event(new Verified($request->user()));//Verifiedに対応するリスナーは？
            return view('ryojo.home');//認証できたから本登録へ
        }
        //markEmailAsVerifiedの中身:public function markEmailAsVerified(){return $this->forceFill(['email_verified_at' => $this->freshTimestamp(),])->save();}

        
    }
}
