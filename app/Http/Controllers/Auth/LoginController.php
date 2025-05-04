<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        //$config = Configuration::find(1);

        /*if($config && $config->expiration_licence){
            $nowDate = Carbon::now();
            //Si la licence est expirée
            if($nowDate > $config->expiration_licence && Auth::user()->role != 'Concepteur'){
                $user = Auth::user();
                $user->update(['etat_user' => 0]);
  
                $this->guard()->logout();
    
                $request->session()->invalidate();
    
                $request->session()->regenerateToken();
    
                if ($response = $this->loggedOut($request)) {
                    return $response;
                }
                return view('auth.expiration-licence');
            }
        }*/
        
        $user->update([
            'user_connected' => 1
        ]);

        /*switch ($user->role) {
            case 'Concepteur':
            case 'Administrateur':
                return redirect('/home');
            case 'Chef_atelier':
                return redirect('/chef-atelier');
            case 'Receptionniste':
                return redirect('/receptionniste');
            case 'Gestion_sortie_vehicule':
                return redirect('/gestion-sortie-vehicule');
            case 'Comptable':
                return redirect('/comptable');
            case 'Maintenancier':
                return redirect('/maintenancier');
            case 'Parc-auto':
                return redirect('/parc-auto');
            default:
                // Si aucun rôle ne correspond, vous pouvez ajouter une redirection ou un message d'erreur ici
                abort(403, 'Accès non autorisé.');
        }*/

        return redirect('/home');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            ['compte_is_actif' => 1],
            ['deleted_at' => null]
        );
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'last_login_at' => Carbon::now(),
            'last_login_ip' => $request->getClientIp(),
            'user_connected' => 0
        ]);

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }

}
