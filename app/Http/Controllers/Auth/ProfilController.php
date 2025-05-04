<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Mail\SimpleMessage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ProfilController extends Controller
{
    public function profil(){
        $user = auth()->user();
        $menuPrincipal = "Utilisateurs";
        $titleControlleur = "Mon profil";
        $btnModalAjout = "FALSE";

        return view("users.profil", compact('user','menuPrincipal','titleControlleur','btnModalAjout'));
 
    }

    public function edit(){
        $user = auth()->user();
        $menuPrincipal = "Utilisateurs";
        $titleControlleur = "Mon profil";
        $btnModalAjout = "FALSE";

        return view("users.edit-profil", compact('user','menuPrincipal','titleControlleur','btnModalAjout'));
 
    }


    public function updateProfil(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
        ]);

        $data = $request->all();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->contact = $data['contact'];
        $user->updated_by = $request->user()->id;
        $user->save();

        return redirect()->route('auth.profil');
    }

    public function updatePassword(Request $request, $id){
        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès"];
             
        $user = User::find($id);
       
        if($user){ 
            try {

                if(!Hash::check($request->get('password'), $user->password)) 
                {
                    return $jsonData = ["code" => -1, "msg" => "Le mot de passe actuel que vous avez saisi est incorrect."];
                }

                if (strcmp($request->get('password'), $request->new_password) == 0) 
                {
                    return $jsonData = ["code" => -1, "msg" => "Le nouveau mot de passe ne peut pas être identique à votre mot de passe actuel."];
                }

                $request->validate([
                    'password' => 'required',
                    'new_password' => 'required|confirmed',
                ]);

                $user->password = Hash::make($request->get('new_password'));
                $user->updated_by = $user->id;
                $user->save();
                $jsonData["data"] = json_decode($user);

                return response()->json($jsonData);
            } catch (Exception $exc) {
                   $jsonData["code"] = -1;
                   $jsonData["data"] = NULL;
                   $jsonData["msg"] = $exc->getMessage();
                   return response()->json($jsonData); 
            }
        }
        return response()->json(["code" => 0, "msg" => "Ce compte n'existe pas ou a été fermé !", "data" => NULL]);
    }

    public function resetePassword(Request $request){
        
        $request->validate([
            'email' => 'required',
        ]);

        $data = $request->all();

        $user = User::where([['email',$data['email']],['compte_is_actif',1]])->first();
       
        if($user){
            try {
                //Debut de transaction
                DB::beginTransaction();
                
                $password = Str::random(16);
                $user->password = bcrypt($password); 
                $user->save();
                
                //Puis on envoie un email de création de compte
                $subject = "REINITIALISATION DE VOTRE MOT DE PASSE";
                $body = "Bonjour <strong>".$user->name."</strong>, <br/>Vous avez demandé à réinitialiser votre mot de passe.<br/> Un nouveau mot de passe a été généré pour vous : <strong>".$password."</strong><br/>Veillez vous connectz pour changer cet mot de passe.<br/> Merci !";
                Mail::to($user->email)->send((new SimpleMessage($subject, $body))->onQueue('notifications'));
              
                //En cas de succes
                DB::commit();
               
                return Redirect::back()->withErrors(['success' => "Mot de réinitialiser avec succès . Verifiez votre boite mail."]);
            } catch (Exception $exc) {
                //En cas d'echec
                DB::rollBack();
            }
        }    
        return Redirect::back()->withErrors(['error' => "Ce compte n'existe pas ou a été fermé. Veillez contacter votre administrateur."]);
    }
}
