<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Traitement;
use App\Services\PdfService;

use Illuminate\Http\Request;
use App\Models\Parametre\Commune;
use App\Models\DeclarationNaissance;
use function Symfony\Component\Clock\now;
use App\Services\ConvertisDateToWordService;

class DeclarationNaissanceController extends Controller
{
    public function vueDeclarationsNaissances(){
        $communes = Commune::select('libelle_commune','id')->get();
        $menuPrincipal = "E-civil";
        $titleControlleur = "Déclaration des naissances";
        $btnModalAjout = "FALSE";

        return view("back.naissance.declaration",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function acteNaissance(){
        $communes = Commune::select('libelle_commune','id')->get();
        $menuPrincipal = "E-civil";
        $titleControlleur = "Acte de naissance";
        $btnModalAjout = "FALSE";
        return view("back.naissance.acte-naissance",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function listeDeclarationsNaissances(){
        $naissances = DeclarationNaissance::with('commune')->orderBy('id', 'DESC')
                     ->whereNotIn('etat',['Disponible','Validé'])
                     ->get();

        $jsonData["rows"] = $naissances->toArray();
        $jsonData["total"] = $naissances->count();
        return response()->json($jsonData);
    }

    public function listeActeNaissances(){
        $acteNaissances = DeclarationNaissance::with('commune')
                        ->whereIn('etat',['Disponible','Validé'])
                        ->orderBy('id', 'DESC')->get();

        $jsonData["rows"] = $acteNaissances->toArray();
        $jsonData["total"] = $acteNaissances->count();
        return response()->json($jsonData);
    }

    public function storeDeclarationNaissance(Request $request)
    {

        $request->validate([
            'nom_enfant' => 'required',
            'prenoms_enfant' => 'required',
            'date_naissance_enfant' => 'required',
            'heure_naissance_enfant' => 'required',
            'lieu_naissance_enfant' => 'required',
            'etablissement_naissance_enfant' => 'required',
            'nationalite_enfant' => 'required',
            'sexe_enfant' => 'required',
            'declarant' => 'required',
        ]);
        $data = $request->all();

        if ($data['declarant'] === 'Autre') {
            $request->validate([
                'nom_declarant' => 'required',
                'prenoms_declarant' => 'required',
                'lien_avec_enfant' => 'required',
                'contact_declarant' => 'required',
                'piece_identite_declarant' => 'file',
            ]);
        }

        $request->validate([
            'certificat_naissance' => 'required|file',
            'piece_identite_pere' => 'required|file',
            'piece_identite_mere' => 'required|file',
            'declaration_honneur' => 'required',
        ]);

        $declaration = new DeclarationNaissance();
        $declaration->numero_declaration = $declaration->getNumeroDeclaration();
        $declaration->etat = 'Enregistré';
        $declaration->type_declaration = 'naisance';
        $declaration->date_declaration = now();
        $declaration->montant_declaration = 2600;

        $declaration->nom_enfant = $data['nom_enfant'];
        $declaration->prenoms_enfant = $data['prenoms_enfant'];
        $declaration->date_naissance_enfant = Carbon::createFromFormat('Y-m-d', $data["date_naissance_enfant"]);
        $declaration->heure_naissance_enfant = Carbon::createFromFormat('H:i', $data['heure_naissance_enfant'])->format('H:i:s');
        $declaration->lieu_naissance_enfant = $data['lieu_naissance_enfant'];
        $declaration->etablissement_naissance_enfant = $data['etablissement_naissance_enfant'];
        $declaration->nationalite_enfant = $data['nationalite_enfant'];
        $declaration->sexe_enfant = $data['sexe_enfant'];

        $declaration->nom_pere = $data['nom_pere'] ?? null;
        $declaration->prenoms_pere = $data['prenoms_pere'] ?? null;
        $declaration->date_naissance_pere = isset($data["date_naissance_pere"]) ? Carbon::createFromFormat('Y-m-d', $data["date_naissance_pere"]) : NULL;
        $declaration->lieu_naissance_pere = $data['lieu_naissance_pere'] ?? null;
        $declaration->nationalite_pere = $data['nationalite_pere'] ?? null;
        $declaration->profession_pere = $data['profession_pere'] ?? null;
        $declaration->adresse_pere = $data['adresse_pere'] ?? null;

        $declaration->nom_mere = $data['nom_mere'] ?? null;
        $declaration->prenoms_mere = $data['prenoms_mere'] ?? null;
        $declaration->date_naissance_mere = isset($data["date_naissance_mere"]) ? Carbon::createFromFormat('Y-m-d', $data["date_naissance_mere"]) : NULL;
        $declaration->lieu_naissance_mere = $data['lieu_naissance_mere'] ?? null;
        $declaration->nationalite_mere = $data['nationalite_mere'] ?? null;
        $declaration->profession_mere = $data['profession_mere'] ?? null;
        $declaration->adresse_mere = $data['adresse_mere'] ?? null;

        $declaration->declarant = $data['declarant'];
        $declaration->nom_declarant = $data['nom_declarant'] ?? null;
        $declaration->prenoms_declarant = $data['prenoms_declarant'] ?? null;
        $declaration->lien_avec_enfant = $data['lien_avec_enfant'] ?? null;
        $declaration->contact_declarant = $data['contact_declarant'] ?? null;

        if (isset($data['certificat_naissance'])) {
            $fichier = $request->file('certificat_naissance');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'certificat_naissance' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->certificat_naissance = '/storage/documents/' . $filename;
        }

        if (isset($data['piece_identite_pere'])) {
            $fichier = $request->file('piece_identite_pere');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_identite_pere' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->piece_identite_pere = '/storage/documents/' . $filename;
        }

        if (isset($data['piece_identite_mere'])) {
            $fichier = $request->file('piece_identite_mere');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_identite_mere' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->piece_identite_mere = '/storage/documents/' . $filename;
        }

        if (isset($data['piece_identite_declarant'])) {
            $fichier = $request->file('piece_identite_declarant');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_identite_declarant_' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->piece_identite_declarant = '/storage/documents/' . $filename;
        }
        
        $declaration->created_by = $request->user()->id;
        $declaration->save();
        session(['declaration_id' => $declaration->id]);
        session(['service' => "déclaration de naissance"]);

        return redirect()->route('choix-payement');
    }

    public function updateNaissance(Request $request){
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];

        if ($request->isMethod('post') && $request->input('idNaissanceModifier')) {
            
            $data = $request->all();
           
            try {

                $naissance = DeclarationNaissance::find($data['idNaissanceModifier']);

                if(!$naissance){
                    return response()->json(["code" => 0, "msg" => "Document introuvable.", "data" => NULL]);
                }

                $naissance->numero_extrait = $data['numero_extrait'];
                $naissance->date_registre = isset($data['date_registre']) ? Carbon::createFromFormat('d-m-Y', $data["date_registre"]):null;
                $naissance->date_delivrance = isset($data['date_delivrance']) ? Carbon::createFromFormat('d-m-Y', $data["date_delivrance"]):null;
                $naissance->lieu_delivrance = $data['lieu_delivrance'];

                $traitement = Traitement::where('declaration_naissance_id',$naissance->id)->first();
                $traitement->etat = $data['etat'];
                $traitement->save();

                $naissance->etat = $data['etat'];

                $naissance->nom_enfant = $data['nom_enfant'];
                $naissance->prenoms_enfant = $data['prenoms_enfant'];
                $naissance->date_naissance_enfant = Carbon::createFromFormat('d-m-Y', $data["date_naissance_enfant"]);
                $naissance->heure_naissance_enfant = Carbon::createFromFormat('H:i:s', trim($data['heure_naissance_enfant']));
                $naissance->lieu_naissance_enfant = $data['lieu_naissance_enfant'];
                $naissance->etablissement_naissance_enfant = $data['etablissement_naissance_enfant'];
                $naissance->nationalite_enfant = $data['nationalite_enfant'];
                $naissance->sexe_enfant = $data['sexe_enfant'];

                $naissance->nom_pere = $data['nom_pere'] ?? null;
                $naissance->prenoms_pere = $data['prenoms_pere'] ?? null;
                $naissance->date_naissance_pere = isset($data["date_naissance_pere"]) ? Carbon::createFromFormat('d-m-Y', $data["date_naissance_pere"]) : NULL;
                $naissance->lieu_naissance_pere = $data['lieu_naissance_pere'] ?? null;
                $naissance->nationalite_pere = $data['nationalite_pere'] ?? null;
                $naissance->profession_pere = $data['profession_pere'] ?? null;
                $naissance->adresse_pere = $data['adresse_pere'] ?? null;

                $naissance->nom_mere = $data['nom_mere'] ?? null;
                $naissance->prenoms_mere = $data['prenoms_mere'] ?? null;
                $naissance->date_naissance_mere = isset($data["date_naissance_mere"]) ? Carbon::createFromFormat('d-m-Y', $data["date_naissance_mere"]) : NULL;
                $naissance->lieu_naissance_mere = $data['lieu_naissance_mere'] ?? null;
                $naissance->nationalite_mere = $data['nationalite_mere'] ?? null;
                $naissance->profession_mere = $data['profession_mere'] ?? null;
                $naissance->adresse_mere = $data['adresse_mere'] ?? null;

                $naissance->nom_declarant = $data['nom_declarant'] ?? null;
                $naissance->prenoms_declarant = $data['prenoms_declarant'] ?? null;
                $naissance->lien_avec_enfant = $data['lien_avec_enfant'] ?? null;
                $naissance->contact_declarant = $data['contact_declarant'] ?? null;

                $naissance->updated_by = $request->user()->id;
                $naissance->save();

                $jsonData["data"] = json_decode($naissance);
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
    
    public function printActeNaissance($idActe){
        $pdfService = new PdfService();
        $convertisDateService = new ConvertisDateToWordService();

        $acteNaissance = DeclarationNaissance::with('commune','lieuDelivrance')->findOrFail($idActe);

        $dateNaissanceEnWord = $convertisDateService->convertDateToWords($acteNaissance->date_naissance_enfant);

        $template = view('back.naissance.acte-naissance-pdf', compact('acteNaissance','dateNaissanceEnWord'))->render();
    
        return $pdfService->generatePdfFromHtml($template);
    }

    public function signerActeNaissance(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Document signé avec succès."];

        if ($request->isMethod('post') && $request->input('idNaissanceModifier')) {
            $data = $request->all();

            $naissance = DeclarationNaissance::find($data['idNaissanceModifier']);

            if (!$naissance) {
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

                $naissance->signature = '/storage/documents/' . $fileName;
                $naissance->etat = "Disponible";
                $naissance->save();
                
                $traitement = Traitement::where('declaration_naissance_id',$naissance->id)->first();
                $traitement->etat = "Disponible";
                $traitement->save();

                $jsonData["data"] = $naissance;
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

}
