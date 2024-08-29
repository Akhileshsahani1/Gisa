<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */
        //  MAIL_MAILER=smtp
        // MAIL_HOST=smtp.googlemail.com
        // MAIL_PORT=465
        //  MAIL_USERNAME=satendrap270@gmail.com
        //  MAIL_PASSWORD=myuxdiugdvrktgcr
        //  MAIL_ENCRYPTION=ssl
        //  MAIL_FROM_ADDRESS=satendrap270@gmail.com
        //  MAIL_FROM_NAME="Locum Tenense Connections"

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
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
        $this->middleware('auth');
    }
}
