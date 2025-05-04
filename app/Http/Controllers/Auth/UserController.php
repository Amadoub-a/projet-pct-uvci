<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $menuPrincipal = "Utilisateurs";
        $titleControlleur = "Gestion des comptes utilisateurs";
        $btnModalAjout = "TRUE";
        
        return view("users.index", compact('menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function listeUsers()
    {
        $users = User::with('depot','unite','unites')->where('role','!=','super-admin')->orderBy('users.name', 'ASC')->get();

        $jsonData["rows"] = $users->toArray();
        $jsonData["total"] = $users->count();
        return response()->json($jsonData);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];
        
        if ($request->isMethod('post') && $request->input('name')) {

                $data = $request->all(); 
               
            try {

                $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'role' => 'required',
                    'contact' => 'required',
                ]);

                //Debut de transaction
                DB::beginTransaction();

                $User = User::where('email', $data['email'])->orWhere('contact', $data['contact'])->exists();
                if($User){
                    return response()->json(["code" => 0, "msg" => "Cet utilisateur existe déjà dans la base, vérifier l'adresse mail ou le contact", "data" => NULL]);
                }
                $password = Str::random(10);

                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->role = $data['role'];
                $user->contact = $data['contact'];
                $user->password = bcrypt($password); 
                $user->created_by = $request->user()->id;
                $user->save();

                $jsonData["data"] = json_decode($user);
                //En cas de succes
                DB::commit();
                return response()->json($jsonData);

            } catch (Exception $exc) {
                //En cas d'echec
                DB::rollBack();
                $jsonData["code"] = -1;
                $jsonData["data"] = NULL;
                $jsonData["msg"] = $exc->getMessage();
                return response()->json($jsonData); 
            }
        }
        return response()->json(["code" => 0, "msg" => "Saisie invalide", "data" => NULL]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $jsonData = ["code" => 1, "msg" => "Modification effectuée avec succès."];

        $user = User::find($id);

        if ($user) {
            $data = $request->all();
            try {

                $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'role' => 'required',
                    'contact' => 'required',
                ]);
                $oldEmail = $user->email;

                //Debut de transaction
                DB::beginTransaction();
                
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->role = $data['role'];
                $user->contact = $data['contact'];
                $user->updated_by = $request->user()->id;
                $user->save();

                if(isset($data['unites'])){
                    $user->unites()->sync($data['unites']);
                }


                //Si l'email differe de l'ancien on reprend le processus de creation du compte
                if($oldEmail != $data['email']){
                    $password = Str::random(10);
                    $user->password = bcrypt($password); 
                    $user->save();
                }

                $jsonData["data"] = json_decode($user);
                
                //En cas de succes
                DB::commit();
                return response()->json($jsonData);
            } catch (Exception $exc) {
                //En cas d'echec
                DB::rollBack();
                $jsonData["code"] = -1;
                $jsonData["data"] = null;
                $jsonData["msg"] = $exc->getMessage();
                return response()->json($jsonData);
            }
        }
        return response()->json(["code" => 0, "msg" => "Echec de modification", "data" => null]);
    }

    /**
     * Activer ou désactiver un utilisateur.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];

        try {
            $user = User::find($id);
           
            if ($user->compte_is_actif) {
                $user->compte_is_actif = FALSE;
            } else {
                $user->compte_is_actif = TRUE;
            }

            $user->deleted_by = auth()->user()->id;
            $user->save();
            $jsonData["data"] = json_decode($user);
            return response()->json($jsonData);
        } catch (Exception $exc) {
            $jsonData["code"] = -1;
            $jsonData["data"] = null;
            $jsonData["msg"] = $exc->getMessage();
            return response()->json($jsonData);
        }
    }
}
