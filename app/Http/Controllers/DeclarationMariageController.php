<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Traitement;
use App\Services\PdfService;
use Illuminate\Http\Request;
use App\Models\Parametre\Commune;
use App\Models\DeclarationMariage;
use Illuminate\Support\Facades\Auth;
use App\Services\ConvertisDateToWordService;

class DeclarationMariageController extends Controller
{
    public function vueDeclarationsMariages(Request $request){
        if($request->query('id')){
            $id = $request->query('id');

            $mariage = DeclarationMariage::find($id);
            $mariage->etat = "En cours";
            $mariage->save();

            $traitement = Traitement::where('declaration_mariage_id',$mariage->id)->first();
            $traitement->etat = "En cours";
            $traitement->date_traitement = Now();
            $traitement->save();
        }

        $communes = Commune::select('libelle_commune','id')->get();
        $menuPrincipal = "E-civil";
        $titleControlleur = "Déclaration des mariages";
        $btnModalAjout = "FALSE";

        return view("back.mariage.declaration",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function acteMariage(){
        $communes = Commune::select('libelle_commune','id')->get();

        $menuPrincipal = "E-civil";
        $titleControlleur = "Acte de mariage";
        $btnModalAjout = "FALSE";
        return view("back.mariage.acte-mariage",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function listeDeclarationsMariages(){
        $naissances = DeclarationMariage::with('commune')->orderBy('id', 'DESC')
                     ->whereNotIn('etat',['Disponible','Validé'])
                     ->get();

        $jsonData["rows"] = $naissances->toArray();
        $jsonData["total"] = $naissances->count();
        return response()->json($jsonData);
    }

    public function listeActeMariages(){
        $acteNaissances = DeclarationMariage::with('commune')
                        ->whereIn('etat',['Disponible','Validé'])
                        ->orderBy('id', 'DESC')->get();

        $jsonData["rows"] = $acteNaissances->toArray();
        $jsonData["total"] = $acteNaissances->count();
        return response()->json($jsonData);
    }

    public function storeDeclarationMariage(Request $request){
        $request->validate([
            'date_mariage' => 'required',
            'lieu_mariage' => 'required',
            'regime_matrimonial' => 'required',
            'officier_etat_civil' => 'required',
            'nom_epoux' => 'required',
            'prenoms_epoux' => 'required',
            'date_naissance_epoux' => 'required',
            'lieu_naissance_epoux' => 'required',
            'nationalite_epoux' => 'required',
            'adresse_epoux' => 'required',
            'nom_epouse' => 'required',
            'prenoms_epouse' => 'required',
            'date_naissance_epouse' => 'required',
            'lieu_naissance_epouse' => 'required',
            'nationalite_epouse' => 'required',
            'adresse_epouse' => 'required',
            'nom_complet_temoins_1' => 'required',
            'contact_temoins_1' => 'required',
            'nom_complet_temoins_2' => 'required',
            'contact_temoins_2' => 'required',
            'piece_identite_epoux' => 'required',
            'piece_identite_epouse' => 'required',
            'acte_naissance_epoux' => 'required',
            'acte_naissance_epouse' => 'required',
            'certificats_celibat_ou_coutume' => 'required',
            'declaration_honneur' => 'required',
        ]);

        $data = $request->all();

        $declaration = new DeclarationMariage();
        $declaration->numero_declaration = $declaration->getNumeroDeclaration();
        $declaration->etat = 'Enregistré';
        $declaration->type_declaration = 'mariage';
        $declaration->date_declaration = now();
        $declaration->montant_declaration = 5100;

        $declaration->date_mariage = Carbon::createFromFormat('Y-m-d', $data["date_mariage"]);
        $declaration->lieu_mariage = $data['lieu_mariage'];
        $declaration->regime_matrimonial = $data['regime_matrimonial'];
        $declaration->officier_etat_civil = $data['officier_etat_civil'];

        $declaration->nom_epoux = $data['nom_epoux'];
        $declaration->prenoms_epoux = $data['prenoms_epoux'];
        $declaration->date_naissance_epoux = Carbon::createFromFormat('Y-m-d', $data["date_naissance_epoux"]);
        $declaration->lieu_naissance_epoux = $data['lieu_naissance_epoux'];
        $declaration->nationalite_epoux = $data['nationalite_epoux'];
        $declaration->profession_epoux = $data['profession_epoux'] ?? null;
        $declaration->adresse_epoux = $data['adresse_epoux'];

        $declaration->nom_epouse = $data['nom_epouse'];
        $declaration->prenoms_epouse = $data['prenoms_epouse'];
        $declaration->date_naissance_epouse =  Carbon::createFromFormat('Y-m-d', $data["date_naissance_epouse"]);
        $declaration->lieu_naissance_epouse = $data['lieu_naissance_epouse'];
        $declaration->nationalite_epouse = $data['nationalite_epouse'];
        $declaration->profession_epouse = $data['profession_epouse'] ?? null;
        $declaration->adresse_epouse = $data['adresse_epouse'];

        $declaration->nom_complet_temoins_1 = $data['nom_complet_temoins_1'];
        $declaration->contact_temoins_1 = $data['contact_temoins_1'];
        $declaration->nom_complet_temoins_2 = $data['nom_complet_temoins_2'];
        $declaration->contact_temoins_2 = $data['contact_temoins_2'];

        if (isset($data['piece_identite_epoux'])) {
            $fichier = $request->file('piece_identite_epoux');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_identite_epoux' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->piece_identite_epoux = '/storage/documents/' . $filename;
        }

        if (isset($data['piece_identite_epouse'])) {
            $fichier = $request->file('piece_identite_epouse');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_identite_epouse' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->piece_identite_epouse = '/storage/documents/' . $filename;
        }

        if (isset($data['acte_naissance_epoux'])) {
            $fichier = $request->file('acte_naissance_epoux');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'acte_naissance_epoux' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->acte_naissance_epoux = '/storage/documents/' . $filename;
        }

        if (isset($data['acte_naissance_epouse'])) {
            $fichier = $request->file('acte_naissance_epouse');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'acte_naissance_epouse' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->acte_naissance_epouse = '/storage/documents/' . $filename;
        }

        if (isset($data['certificats_celibat_ou_coutume'])) {
            $fichier = $request->file('certificats_celibat_ou_coutume');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'certificats_celibat_ou_coutume' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->certificats_celibat_ou_coutume = '/storage/documents/' . $filename;
        }

        if (isset($data['contrat_mariage'])) {
            $fichier = $request->file('contrat_mariage');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'contrat_mariage' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->contrat_mariage = '/storage/documents/' . $filename;
        }
        $declaration->created_by = $request->user()->id;
        $declaration->save();
        session(['declaration_id' => $declaration->id]);
        session(['service' => "déclaration de mariage"]);

        return redirect()->route('choix-payement');

    }

    public function updateMariage(Request $request){
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];

        if ($request->isMethod('post') && $request->input('idMariageModifier')) {
            
            $data = $request->all();
           
            try {

                $mariage = DeclarationMariage::find($data['idMariageModifier']);

                if(!$mariage){
                    return response()->json(["code" => 0, "msg" => "Document introuvable.", "data" => NULL]);
                }

                $mariage->numero_extrait = $data['numero_extrait'];
                $mariage->date_registre = isset($data['date_registre']) ? Carbon::createFromFormat('d-m-Y', $data["date_registre"]):null;
                $mariage->date_delivrance = isset($data['date_delivrance']) ? Carbon::createFromFormat('d-m-Y', $data["date_delivrance"]):null;
                $mariage->lieu_delivrance = $data['lieu_delivrance'];

                $traitement = Traitement::where('declaration_mariage_id',$mariage->id)->first();
                $traitement->etat = $data['etat'];
                $traitement->save();

                $mariage->etat = $data['etat'];

                $mariage->date_mariage = Carbon::createFromFormat('d-m-Y', $data["date_mariage"]);
                $mariage->lieu_mariage = $data['lieu_mariage'];
                $mariage->regime_matrimonial = $data['regime_matrimonial'];
                $mariage->officier_etat_civil = $data['officier_etat_civil'];

                $mariage->nom_epoux = $data['nom_epoux'];
                $mariage->prenoms_epoux = $data['prenoms_epoux'];
                $mariage->date_naissance_epoux = Carbon::createFromFormat('d-m-Y', $data["date_naissance_epoux"]);
                $mariage->lieu_naissance_epoux = $data['lieu_naissance_epoux'];
                $mariage->nationalite_epoux = $data['nationalite_epoux'];
                $mariage->profession_epoux = $data['profession_epoux'] ?? null;
                $mariage->adresse_epoux = $data['adresse_epoux'];

                $mariage->nom_epouse = $data['nom_epouse'];
                $mariage->prenoms_epouse = $data['prenoms_epouse'];
                $mariage->date_naissance_epouse =  Carbon::createFromFormat('d-m-Y', $data["date_naissance_epouse"]);
                $mariage->lieu_naissance_epouse = $data['lieu_naissance_epouse'];
                $mariage->nationalite_epouse = $data['nationalite_epouse'];
                $mariage->profession_epouse = $data['profession_epouse'] ?? null;
                $mariage->adresse_epouse = $data['adresse_epouse'];

                $mariage->nom_complet_temoins_1 = $data['nom_complet_temoins_1'];
                $mariage->contact_temoins_1 = $data['contact_temoins_1'];
                $mariage->nom_complet_temoins_2 = $data['nom_complet_temoins_2'];
                $mariage->contact_temoins_2 = $data['contact_temoins_2'];
                $mariage->updated_by = $request->user()->id;
                $mariage->save();

                $jsonData["data"] = json_decode($mariage);
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

    public function printActeMariage($idActe){
        $pdfService = new PdfService();
        $convertisDateService = new ConvertisDateToWordService();

        $acteMariage = DeclarationMariage::with('commune','lieuDelivrance')->findOrFail($idActe);

        $dateMariageEnWord = $convertisDateService->convertDateToWords($acteMariage->date_mariage);

        $template = view('back.mariage.acte-mariage-pdf', compact('acteMariage','dateMariageEnWord'))->render();
    
        return $pdfService->generatePdfFromHtml($template);
    }

    public function signerActeMariage(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Document signé avec succès."];

        if ($request->isMethod('post') && $request->input('idMariageModifier')) {
            $data = $request->all();

            $mariage = DeclarationMariage::find($data['idMariageModifier']);

            if (!$mariage) {
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

                $mariage->signature = '/storage/documents/' . $fileName;
                $mariage->etat = "Disponible";
                $mariage->save();
                
                $traitement = Traitement::where('declaration_mariage_id',$mariage->id)->first();
                $traitement->etat = "Disponible";
                $traitement->date_disponible = Now();
                $traitement->save();

                $jsonData["data"] = $mariage;
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

    public function updateStateMariage($id){
        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
        $mariage = DeclarationMariage::find($id);

        if($mariage){
            try {

                $mariage->etat = "En cours";
                $mariage->created_by = Auth::id();
                $mariage->save();

                $traitement = Traitement::where('declaration_mariage_id',$mariage->id)->first();
                $traitement->etat = "En cours";
                $traitement->save();

                $jsonData["data"] = json_decode($mariage);

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
