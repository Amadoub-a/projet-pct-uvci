<?php

namespace App\Http\Controllers\Parametre;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Parametre\Commune;
use App\Http\Controllers\Controller;

class CommuneController extends Controller
{
    public function index()
    {
        $menuPrincipal = "Paramètre";
        $titleControlleur = "Gestion des communes et sous-préfectures";
        $btnModalAjout = "FALSE";

        return view("parametre.commune.index", compact('menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function listeCommunes()
    {
        $communes = Commune::orderBy('libelle_commune', 'ASC')->get();

        $jsonData["rows"] = $communes->toArray();
        $jsonData["total"] = $communes->count();
        return response()->json($jsonData); 
    }

    public function store(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];
        
        if ($request->isMethod('post') && $request->input('libelle_commune')) {

                $data = $request->all(); 
               
            try {

                $request->validate([
                    'libelle_commune' => 'required',
                ]);

                $Commune = Commune::where('libelle_commune', $data['libelle_commune'])->exists();
                if($Commune){
                    return response()->json(["code" => 0, "msg" => "Cet enregistrement existe déjà dans la base.", "data" => NULL]);
                }

                $commune = new Commune;
                $commune->libelle_commune = $data['libelle_commune'];
                $commune->created_by = $request->user()->id;
                $commune->save();

                $jsonData["data"] = json_decode($commune);
              
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

    public function update(Request $request, $id)
    {
        $jsonData = ["code" => 1, "msg" => "Modification effectuée avec succès."];

        $commune = Commune::find($id);

        if ($commune) {
            $data = $request->all();
            try {

                $request->validate([
                    'libelle_commune' => ['required',
                        Rule::unique('communes')->ignore($id)->whereNull('deleted_at'),
                    ]
                ]);

                $commune->libelle_commune = $data['libelle_commune'];
                $commune->updated_by = $request->user()->id;
                $commune->save();
                
                $jsonData["data"] = json_decode($commune);
                
                return response()->json($jsonData);
            } catch (Exception $exc) {
                $jsonData["code"] = -1;
                $jsonData["data"] = null;
                $jsonData["msg"] = $exc->getMessage();
                return response()->json($jsonData);
            }
        }
        return response()->json(["code" => 0, "msg" => "Echec de modification", "data" => null]);
    }

    public function destroy($id)
    {
        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
        $commune = Commune::find($id);

        if($commune){
            try {
                
                /*Ne pas laisser supprimer si cet enregistrement est lié à un engin
                $Fournisseur = Fournisseur::where('nation_id', $nation->id)->exists();
                if($Fournisseur){
                    return response()->json(["code" => -1, "msg" => "Impossible de supprimer cet enregistrement. Contactez l'admin svp!", "data" => NULL]);
                }*/

                $commune->softDeleteWithUser(auth()->user()->id);

                $jsonData["data"] = json_decode($commune);

                return response()->json($jsonData);
            } catch (Exception $exc) {
                $jsonData["code"] = -1;
                $jsonData["data"] = null;
                $jsonData["msg"] = $exc->getMessage();
                return response()->json($jsonData);
            }
        }
        return response()->json(["code" => 0, "msg" => "Echec de suppression", "data" => null]);
    }

}
