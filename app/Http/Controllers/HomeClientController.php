<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeClientController extends Controller
{
    public function clientHome(){
        return view("site.front.client-home");
    }

    public function monProfil(){
        return view("site.front.mon-profil");
    }

    public function modifierProfile(Request $request){
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];
        
        if ($request->isMethod('post') && $request->input('email')) {

            $data = $request->all(); 
            
            try {

                $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'contact' => 'required',
                ]);

                $user = User::find($data['idUser']);

                if(!$user){
                    return response()->json(["code" => 0, "msg" => "Votre compte à un probleme. Contactez le service client svp.", "data" => NULL]);
                }

                if($user->email != $data['email']){
                    $doublon = User::where([['email', $data['email']],['compte_is_actif', 1]])->exists();
                    if($doublon){
                        return response()->json(["code" => 0, "msg" => "Cet adresse mail est deja utilisée.", "data" => NULL]);
                    }
                }

                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->contact = $data['contact'];
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
        return response()->json(["code" => 0, "msg" => "Saisie invalide", "data" => NULL]);
    }

    public function modifierPassword(Request $request){
        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès"];
             
        $user = User::find($request->input(key: 'idUser'));
       
        if($user){ 
            try {

                $request->validate([
                    'new_password' => 'required',
                    'confirm_new_password' => 'required',
                ]);

                if(!Hash::check($request->get('actuelle_password'), $user->password)) 
                {
                    return response()->json(["code" => 0, "msg" => "Le mot de passe actuel que vous avez saisi est incorrect.", "data" => NULL]); 
                }

                if (strcmp($request->get('new_password'), $request->password) == 0) 
                {
                    return response()->json(["code" => 0, "msg" => "Le nouveau mot de passe ne peut pas être identique à votre mot de passe actuel.", "data" => NULL]); 
                }

                if (!hash_equals($request->get('new_password'), $request->get('confirm_new_password'))) {
                    return response()->json(["code" => 0, "msg" => "Le mot de passe et sa confirmation ne correspondent pas..", "data" => NULL]); 
                }

                $user->password = Hash::make($request->get('new_password'));
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
}
