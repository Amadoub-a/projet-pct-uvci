<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Traitement;
use App\Services\PdfService;
use Illuminate\Http\Request;
use App\Models\DeclarationDece;
use App\Models\Parametre\Commune;
use Illuminate\Support\Facades\Auth;
use App\Services\ConvertisDateToWordService;

class DeclarationDeceController extends Controller
{
    public function vueDeclarationsDeces(Request $request){
         if($request->query('id')){
            $id = $request->query('id');

            $deces = DeclarationDece::find($id);
            $deces->etat = "En cours";
            $deces->save();

            $traitement = Traitement::where('declaration_deces_id',$deces->id)->first();
            $traitement->etat = "En cours";
            $traitement->date_traitement = Now();
            $traitement->save();
        }

        $communes = Commune::select('libelle_commune','id')->get();
        $menuPrincipal = "E-civil";
        $titleControlleur = "Déclaration des décès";
        $btnModalAjout = "FALSE";

        return view("back.deces.declaration",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function acteDeces(){
        $communes = Commune::select('libelle_commune','id')->get();

        $menuPrincipal = "E-civil";
        $titleControlleur = "Acte de décès";
        $btnModalAjout = "FALSE";
        return view("back.deces.acte-deces",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }


    public function listeDeclarationsDeces(){
        $deces = DeclarationDece::with('commune')->orderBy('id', 'DESC')
                    ->whereNotIn('etat',['Disponible','Validé'])
                    ->get();

        $jsonData["rows"] = $deces->toArray();
        $jsonData["total"] = $deces->count();
        return response()->json($jsonData);
    }

    public function listeActeDeces(){
        $acteDeces = DeclarationDece::with('commune')
                        ->whereIn('etat',['Disponible','Validé'])
                        ->orderBy('id', 'DESC')->get();

        $jsonData["rows"] = $acteDeces->toArray();
        $jsonData["total"] = $acteDeces->count();
        return response()->json($jsonData);
    }
    
    public function storeDeclarationDeces(Request $request){
        
        $request->validate([
            'date_deces' => 'required',
            'heure_deces' => 'required',
            'lieu_deces' => 'required',
            'cause_deces' => 'required',
            'nom_defunt' => 'required',
            'prenoms_defunt' => 'required',
            'date_naissance_defunt' => 'required',
            'lieu_naissance_defunt' => 'required',
            'nationalite_defunt' => 'required',
            'sexe_defunt' => 'required',
            'situation_familiale_defunt' => 'required',
            'adresse_defunt' => 'required',
            'nom_declarant' => 'required',
            'prenoms_declarant' => 'required',
            'lien_parente' => 'required',
            'contact_declarant' => 'required',
            'adresse_declarant' => 'required',
            'certificat_deces' => 'required',
            'piece_identite_defunt' => 'required',
            'acte_naissance_defunt' => 'required',
            'piece_identite_declarant' => 'required',
            'declaration_honneur' => 'required',
        ]);

        $data = $request->all();

        $declaration = new DeclarationDece();
        $declaration->numero_declaration = $declaration->getNumeroDeclaration();
        $declaration->etat = 'Enregistré';
        $declaration->type_declaration = 'deces';
        $declaration->date_declaration = now();
        $declaration->montant_declaration = 2100;

        $declaration->date_deces = Carbon::createFromFormat('Y-m-d', $data["date_deces"]);
        $declaration->heure_deces = Carbon::createFromFormat('H:i', $data['heure_deces'])->format('H:i:s');
        $declaration->lieu_deces = $data['lieu_deces'];
        $declaration->etablissement_deces = $data['etablissement_deces'] ?? null;
        $declaration->cause_deces = $data['cause_deces'];

        $declaration->nom_defunt = $data['nom_defunt'];
        $declaration->prenoms_defunt = $data['prenoms_defunt'];
        $declaration->date_naissance_defunt = Carbon::createFromFormat('Y-m-d', $data["date_naissance_defunt"]);
        $declaration->lieu_naissance_defunt = $data['lieu_naissance_defunt'];
        $declaration->nationalite_defunt = $data['nationalite_defunt'];
        $declaration->sexe_defunt = $data['sexe_defunt'];
        $declaration->profession_defunt = $data['profession_defunt'] ?? null;
        $declaration->situation_familiale_defunt = $data['situation_familiale_defunt'];
        $declaration->adresse_defunt = $data['adresse_defunt'];

        $declaration->nom_declarant = $data['nom_declarant'];
        $declaration->prenoms_declarant = $data['prenoms_declarant'];
        $declaration->lien_parente = $data['lien_parente'];
        $declaration->contact_declarant = $data['contact_declarant'];
        $declaration->adresse_declarant = $data['adresse_declarant'];

        if (isset($data['certificat_deces'])) {
            $fichier = $request->file('certificat_deces');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'certificat_deces' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->certificat_deces = '/storage/documents/' . $filename;
        }

        if (isset($data['piece_identite_defunt'])) {
            $fichier = $request->file('piece_identite_defunt');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_identite_defunt' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->piece_identite_defunt = '/storage/documents/' . $filename;
        }

        if (isset($data['acte_naissance_defunt'])) {
            $fichier = $request->file('acte_naissance_defunt');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'acte_naissance_defunt' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->acte_naissance_defunt = '/storage/documents/' . $filename;
        }

         if (isset($data['piece_identite_declarant'])) {
            $fichier = $request->file('piece_identite_declarant');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_identite_declarant' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->piece_identite_declarant = '/storage/documents/' . $filename;
        }

        $declaration->created_by = $request->user()->id;
        $declaration->save();
        session(['declaration_id' => $declaration->id]);
        session(['service' => "déclaration de décès"]);

        return redirect()->route('choix-payement');
    }

    public function updateDeces(Request $request){
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];

        if ($request->isMethod('post') && $request->input('idDecesModifier')) {
            
            $data = $request->all();
           
            try {

                $deces = DeclarationDece::find($data['idDecesModifier']);

                if(!$deces){
                    return response()->json(["code" => 0, "msg" => "Document introuvable.", "data" => NULL]);
                }

                $deces->numero_extrait = $data['numero_extrait'];
                $deces->date_registre = isset($data['date_registre']) ? Carbon::createFromFormat('d-m-Y', $data["date_registre"]):null;
                $deces->date_delivrance = isset($data['date_delivrance']) ? Carbon::createFromFormat('d-m-Y', $data["date_delivrance"]):null;
                $deces->lieu_delivrance = $data['lieu_delivrance'];

                $traitement = Traitement::where('declaration_deces_id',$deces->id)->first();
                $traitement->etat = $data['etat'];
                $traitement->save();

                $deces->etat = $data['etat'];

                $deces->date_deces = Carbon::createFromFormat('d-m-Y', $data["date_deces"]);
                $deces->heure_deces = Carbon::createFromFormat('H:i:s', trim($data['heure_deces']));
                $deces->lieu_deces = $data['lieu_deces'];
                $deces->etablissement_deces = $data['etablissement_deces'] ?? null;
                $deces->cause_deces = $data['cause_deces'];

                $deces->nom_defunt = $data['nom_defunt'];
                $deces->prenoms_defunt = $data['prenoms_defunt'];
                $deces->date_naissance_defunt = Carbon::createFromFormat('d-m-Y', $data["date_naissance_defunt"]);
                $deces->lieu_naissance_defunt = $data['lieu_naissance_defunt'];
                $deces->nationalite_defunt = $data['nationalite_defunt'];
                $deces->sexe_defunt = $data['sexe_defunt'];
                $deces->profession_defunt = $data['profession_defunt'] ?? null;
                $deces->adresse_defunt = $data['adresse_defunt'];

                $deces->nom_declarant = $data['nom_declarant'];
                $deces->prenoms_declarant = $data['prenoms_declarant'];
                $deces->lien_parente = $data['lien_parente'];
                $deces->contact_declarant = $data['contact_declarant'];
                $deces->updated_by = $request->user()->id;
                $deces->save();

                $jsonData["data"] = json_decode($deces);
                return response()->json($jsonData);     

            }catch (Exception $exc) {
                $jsonData["code"] = -1;
                $jsonData["data"] = null;
                $jsonData["msg"] = $exc->getMessage();
                return response()->json($jsonData);
            }
        }

        return response()->json(["code" => 0, "msg" => "Saisie invalide", "data" => null]);
    }

    public function printActeDeces($idActe){
        $pdfService = new PdfService();
        $convertisDateService = new ConvertisDateToWordService();

        $acteDeces = DeclarationDece::with('commune','lieuDelivrance')->findOrFail($idActe);

        $dateDecesEnWord = $convertisDateService->convertDateToWords($acteDeces->date_deces);

        $template = view('back.deces.acte-deces-pdf', compact('acteDeces','dateDecesEnWord'))->render();
    
        return $pdfService->generatePdfFromHtml($template);
    }

    public function signerActeDeces(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Document signé avec succès."];

        if ($request->isMethod('post') && $request->input('idDecesModifier')) {
            $data = $request->all();

            $deces = DeclarationDece::find($data['idDecesModifier']);

            if (!$deces) {
                return response()->json(["code" => 0, "msg" => "Document introuvable.", "data" => null]);
            }

            try {
                
                if (empty($data['signature'])) {
                    return response()->json(["code" => 0, "msg" => "Aucune signature reçue.", "data" => null]);
                }

                $signatureData = $data['signature'];
                $imageData = base64_decode(explode(',', $signatureData)[1]);

                $fileName = 'signature_' . uniqid() . '.png';
                $path = storage_path('app/public/documents/' . $fileName);

                file_put_contents($path, $imageData);

                $deces->signature = '/storage/documents/' . $fileName;
                $deces->etat = "Disponible";
                $deces->save();
                
                $traitement = Traitement::where('declaration_deces_id',$deces->id)->first();
                $traitement->etat = "Disponible";
                $traitement->date_disponible = Now();
                $traitement->save();

                $jsonData["data"] = $deces;
                return response()->json($jsonData);

            } catch (Exception $exc) {
                $jsonData["code"] = -1;
                $jsonData["data"] = null;
                $jsonData["msg"] = $exc->getMessage();
                return response()->json($jsonData);
            }
        }

        return response()->json(["code" => 0, "msg" => "Problème survenu lors de la signature", "data" => null]);
    }

    public function updateStateDeces($id){
        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
        $deces = DeclarationDece::find($id);

        if($deces){
            try {

                $deces->etat = "En cours";
                $deces->created_by = Auth::id();
                $deces->save();

                $traitement = Traitement::where('declaration_deces_id',$deces->id)->first();
                $traitement->etat = "En cours";
                $traitement->save();

                $jsonData["data"] = json_decode($deces);

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
    
}
