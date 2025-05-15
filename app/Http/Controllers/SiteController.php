<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
                'user_connected' => 1,
            ]);

            return redirect()->intended(
                $user->role === 'client' ? '/' : '/admin'
            );
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->withInput($request->except('password'));
    }
}
