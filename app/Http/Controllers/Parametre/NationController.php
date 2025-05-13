<?php

namespace App\Http\Controllers\Parametre;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Parametre\Nation;
use App\Http\Controllers\Controller;
use App\Models\Personnel\Fournisseur;

class NationController extends Controller
{
    public function index()
    {
        $menuPrincipal = "Paramètre";
        $titleControlleur = "Gestion des pays";
        $btnModalAjout = "FALSE";

        return view("parametre.nation.index", compact('menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function listeNations()
    {
        $nations = Nation::orderBy('libelle_nation', 'ASC')->get();

        $jsonData["rows"] = $nations->toArray();
        $jsonData["total"] = $nations->count();
        return response()->json($jsonData); 
    }

    public function store(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];
        
        if ($request->isMethod('post') && $request->input('libelle_nation')) {

                $data = $request->all(); 
               
            try {

                $request->validate([
                    'libelle_nation' => 'required',
                ]);

                $Nation = Nation::where('libelle_nation', $data['libelle_nation'])->exists();
                if($Nation){
                    return response()->json(["code" => 0, "msg" => "Cet enregistrement existe déjà dans la base.", "data" => NULL]);
                }

                $nation = new Nation;
                $nation->libelle_nation = $data['libelle_nation'];
                $nation->created_by = $request->user()->id;
                $nation->save();

                $jsonData["data"] = json_decode($nation);
              
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

        $nation = Nation::find($id);

        if ($nation) {
            $data = $request->all();
            try {

                $request->validate([
                    'libelle_nation' => ['required',
                        Rule::unique('nations')->ignore($id)->whereNull('deleted_at'),
                    ]
                ]);

                $nation->libelle_nation = $data['libelle_nation'];
                $nation->updated_by = $request->user()->id;
                $nation->save();
                
                $jsonData["data"] = json_decode($nation);
                
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
        $nation = Nation::find($id);

        if($nation){
            try {
                
                /*Ne pas laisser supprimer si cet enregistrement est lié à un engin
                $Fournisseur = Fournisseur::where('nation_id', $nation->id)->exists();
                if($Fournisseur){
                    return response()->json(["code" => -1, "msg" => "Impossible de supprimer cet enregistrement. Contactez l'admin svp!", "data" => NULL]);
                }*/

                $nation->softDeleteWithUser(auth()->user()->id);

                $jsonData["data"] = json_decode($nation);

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
