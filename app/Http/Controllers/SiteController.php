<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\SimpleMessage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller
{
    public function services()
    {
        return view("site.front.services");
    }

    public function declarationNaissance(){
        return view("site.front.declaration-naissance");
    }

    public function declarationMariage(){
        return view("site.front.declaration-mariage");
    }

    public function declarationDeces(){
        return view("site.front.declaration-deces");
    }

    public function declarationVie(){
        return view("site.front.declaration-vie");
    }

    public function legalisationDocument(){
        return view("site.front.legalisation-document");
    }

    public function copieActe(){
        return view("site.front.copie-acte");
    }

    public function tarifs()
    {
        return view("site.front.tarifs");
    }

    public function about()
    {
        return view("site.front.about");
    }

    public function contact()
    {
        return view("site.front.contact");
    }

    public function signIn()
    {
        return view("site.front.sign-in");
    }

    public function signUp()
    {
        return view("site.front.sign-up");
    }

    public function clientPasswordRequest(){
        return view("site.front.password-reset");
    }

    public function definirPassword(){
        return view("site.front.definir-password");
    }

    public function inscription(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'nom' => 'required',
            'prenoms' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'terms' => 'accepted',
        ]);

        if (!hash_equals($data['password'], $data['password_confirmation'])) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors([
                    'password_test' => 'Le mot de passe et sa confirmation ne correspondent pas.',
                ]);
        }

        $User = User::where('email', $data['email'])->exists();
        if($User){
            return back()
                ->withInput()
                ->withErrors([
                    'duplicate_email' => 'Cette adresse e-mail existe deja.',
                ]);
        }

        User::create([
            'name' => $data['prenoms'] . ' ' . $data['nom'],
            'email' => $data['email'],
            'contact' => $data['telephone'],
            'role' => 'client',
            'confirmation_token' => null,
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('sign-in')->with('success', 'Inscription réussie !');
    }

    public function connexion(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Si l'utilisateur n'a pas défini un mot de passe après réinitialisation
            if ($user->confirmation_token) {
                return $this->logoutAndRedirect($request, 'client-definir-password', ['email' => $user->email]);
            }

            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
                'user_connected' => 1,
            ]);

            return redirect()->intended('/client-home');
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->withInput($request->except('password'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where([
            ['email', $request->input('email')],
            ['compte_is_actif', 1],
        ])->first();

        if (!$user) {
            return Redirect::back()->withErrors(['email' => "Aucun compte actif ne correspond à cette adresse e-mail."]);
        }

        try {
            DB::beginTransaction();

            $newPassword = Str::random(16);

            $user->password = bcrypt($newPassword);
            $user->confirmation_token = str_replace('/', '', bcrypt(Str::random(16)));
            $user->save();

            $subject = "RÉINITIALISATION DE VOTRE MOT DE PASSE";
            $appUrl = config('app.url');
            $body = "Bonjour <strong>{$user->name}</strong>, <br/><br/>"
                . "Vous avez demandé à réinitialiser votre mot de passe.<br/>"
                . "Un nouveau mot de passe a été généré pour vous : <strong>{$newPassword}</strong><br/><br/>"
                . "Veuillez vous connecter pour changer ce mot de passe.<br/>"
                . "👉 <a href='{$appUrl}/se-connecter' style='color: blue; font-weight: bold;'>Se connecter</a><br/><br/>"
                . "Merci !";

            Mail::to($user->email)->send((new SimpleMessage($subject, $body))->onQueue('notifications'));

            DB::commit();

            return redirect()->back()->with('status', 'Votre mot de passe a été réinitialisé avec succès. Vérifiez votre boîte mail.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['email' => "Une erreur est survenue. Veuillez réessayer plus tard."]);
        }
    }

    public function redefnirPassword(Request $request){

        $this->validate($request, [
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        $data = $request->all();

        if(!hash_equals($data['password'], $data['password_confirmation'])) {
            return back()
                ->withErrors([
                    'password_test' => 'Le mot de passe et sa confirmation ne correspondent pas.',
                ]);
        }

        $user = User::where('email',$data["email"])->first();

        if($user){
            $user->confirmation_token = null;
            $user->password = bcrypt($data["password"]);
            $user->save();
            return redirect('/se-connecter');
        }
        return redirect()->back()->withErrors('msg'," Votre compte n'existe pas.");
    }

    protected function logoutAndRedirect($request, $route, $params = [])
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($route, $params);
    }
}
