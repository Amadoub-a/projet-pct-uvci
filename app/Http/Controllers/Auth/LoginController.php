<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Configuration\InfoEntreprise;
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

    public function definirPassword(Request $request){
        $this->validate($request, [
            'password' => 'required',
            'password-confirmation' => 'required',
        ]);

        $data = $request->all();

        if($data["password"] != $data["password-confirmation"]){
            return redirect()->back()->with([
                'email' => $data["email"],
                'msg' => 'Vérifier que le mot de passe et la confirmation soient les mêmes.'
            ]);       
        }

        $user = User::where('email',$data["email"])->first();

        if($user){
            $user->confirmation_token = null;
            $user->password = bcrypt($data["password"]);
            $user->save();

            return redirect('/admin');
        }
        return redirect()->back()->with('msg'," Votre compte n'existe pas");
    }

    protected function authenticated(Request $request, $user)
    {
         // Si l'utilisateur n'a pas confirmé son compte
        if ($user->confirmation_token) {
            return $this->logoutAndRedirect($request, '/confirm-compte', ['email' => $user->email]);
        }
        
        if(!$user->compte_is_actif){
            return $this->logoutAndRedirect($request, 'auth.compte-user-suspendu');
        }

        $user->update(['user_connected' => 1]);

        return match ($user->role) {
            'super-admin', 'admin' => redirect('/home'),
            'superviseur' => redirect('/superviseur'),
            default => abort(403, 'Accès non autorisé.'),
        };
    }


    /**
    * Déconnecte l'utilisateur et redirige vers une vue ou une URL donnée.
    */
    private function logoutAndRedirect(Request $request, string $redirect, array $withData = [])
    {
        Auth::user()->update(['etat_user' => 0]);

        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return is_string($redirect) && str_starts_with($redirect, '/') 
            ? redirect($redirect)->with($withData) 
            : view($redirect);
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
            : redirect('/admin');
    }

}
