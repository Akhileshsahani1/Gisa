<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Administrator;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:administrator')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required|min:6'
        ]);


        if (Auth::guard('administrator')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $user_id = Auth::guard('administrator')->user()->id;

            $user = Administrator::where('id', $user_id)->first();

            $lastSeen = Carbon::parse($user->login_count_date)->format('Y-m-d');
            $now = Carbon::now();
            $formattedDate = $now->format('Y-m-d');

            if ($lastSeen != $formattedDate) {
                $user->login_count = 1;
            } else {
                $user->increment('login_count');
            }

            $user->login_count_date = $formattedDate;
            $user->is_active = 1;
            $user->save();                  

            return redirect()->intended(route('admin.dashboard'));
        } else {

            return $this->sendFailedLoginResponse($request);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        if (Auth::guard('administrator')->check()) 
        {
            $user_id = Auth::guard('administrator')->user()->id;
            $user = Administrator::where('id', $user_id)->first();
            $user->is_active = 0;
            $user->save();
            Auth::guard('administrator')->logout();
            return redirect()->route('admin.login');
        }
    }
}
