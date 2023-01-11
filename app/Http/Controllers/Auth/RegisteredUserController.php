<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
 
    public function precheck()//仮登録画面表示
    {
        return view('auth.preregister');
    }

    public function precheck_store(Request $request)//仮登録
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);//userインスタンスを現在ログイン中のuserに

        event(new Registered($user));//$userがMustVerifyEmailのインスタンス
        return redirect()->route('verification.notice');//認証されていないなら確認mail、しているならHOMEに返す
    }

    public function store(Request $request)//本登録後保存
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'profile' => ['string', 'max:1000'],
        ]);

        $user = User::where('id',$request->user()->id)->firstOrFail();
        $user->name = $request->input('name');
        $user->profile = $request->input('profile');
        $user->save();

        return view('auth.register-accomplish');
    }

    public function guestLogin()//ゲストログイン、email_verified_atに時間入力して認証済みに
    {
        $user = User::create([
            'email' => Str::random(32)."@".Str::random(10),
            'password' => Str::random(32),
            'email_verified_at' => now(),
        ]);
        Auth::login($user);

        return redirect()->route('ryojo.index');
    }
}   
