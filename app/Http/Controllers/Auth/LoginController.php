<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
//     protected function redirectTo() {
//       if(! Auth::user()) {
//           return '/';
//       }
//       return route('mypage', ['user' => Auth::id()]);
//   }
    public function login(Request $request)
    {
        $users = User::where('email', $request->email)->get();
        if (count($users)>0) {
            if (password_verify($request->password, $users->first()->password)) {
                Auth::loginUsingId($users->first()->id);
                $user_id = Auth::id();
                Log::debug('Login Successed: ID:'. $user_id. " email:".$request->email);
                return redirect('/mypage');
            }
            Log::debug('Login Failed: email'. $request->email);
        }
        return back()->withInput()->withErrors(array('email' => '認証エラー: E-Mailまたはパスワードが違っています。'));
    }

}
