<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\CopieActe;
use App\Models\Traitement;
use App\Services\PdfService;
use Illuminate\Http\Request;
use App\Models\DeclarationDece;
use App\Models\Parametre\Commune;
use App\Models\DeclarationMariage;
use Illuminate\Support\Facades\DB;
use App\Models\DeclarationNaissance;
use Illuminate\Support\Facades\Auth;
use App\Services\ConvertisDateToWordService;

class CopieActeController extends Controller
{
    public function vueCopiesActes(Request $request){

        if($request->query('id')){
            $id = $request->query('id');

            $copie = CopieActe::find($id);
            $copie->etat = "En cours";
            $copie->save();

            $traitement = Traitement::where('copie_acte_id',$copie->id)->first();
            $traitement->etat = "En cours";
            $traitement->date_traitement = Now();
            $traitement->save();
        }

        $communes = Commune::select('libelle_commune','id')->get();
        $menuPrincipal = "E-civil";
        $titleControlleur = "Demandes de copie d'acte";
        $btnModalAjout = "FALSE";

        return view("back.copie-acte.index",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function copieActe(){
        $communes = Commune::select('libelle_commune','id')->get();

        $menuPrincipal = "E-civil";
        $titleControlleur = "Copie d'acte";
        $btnModalAjout = "FALSE";
        return view("back.copie-acte.copie",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }


    public function listeCopiesActes(){
        $copies = CopieActe::with('lieu_naissance','lieu_deces','lieu_mariage')->orderBy('id', 'DESC')
                            ->whereNotIn('etat',['Disponible','Validé'])
                            ->get();

        $jsonData["rows"] = $copies->toArray();
        $jsonData["total"] = $copies->count();
        return response()->json($jsonData);
    }

    public function rechercherActe($numero, $date, $lieu, $type)
    {
        $date = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

        $model = match ($type) {
            'naissance' => DeclarationNaissance::class,
            'deces'     => DeclarationDece::class,
            'mariage'   => DeclarationMariage::class,
            default     => null,
        };

        if (!$model) {
            return response()->json([
                'error' => 'Type d\'acte invalide.'
            ], 400);
        }

        $actes = $model::with("lieuDelivrance")->where('numero_extrait', $numero)
            ->where('lieu_delivrance', $lieu)
            ->whereDate('date_registre', $date)
            ->get();

        return response()->json([
            'rows' => $actes,
            'total' => $actes->count(),
        ]);
    }

    public function listeCopieActes(){
        $copieActes = CopieActe::with('deces','naissance','mariage')
                        ->whereIn('etat',['Disponible','Validé'])
                        ->orderBy('id', 'DESC')->get();

        $jsonData["rows"] = $copieActes->toArray();
        $jsonData["total"] = $copieActes->count();
        return response()->json($jsonData);
    }

    public function storeCopieActe(Request $request){
        $request->validate([
            'type_acte' => 'required',
            'type_copie' => 'required',
            'numero_acte' => 'required',
            'demander_par' => 'required',
            'declaration_honneur' => 'required',
            'piece_identite_demandeur' => 'required',
        ]);

        $data = $request->all();

        if($data['type_acte'] == "naissance"){
            $request->validate([
                'nom_enfant' => 'required',
                'prenoms_enfant' => 'required',
                'date_naissance_enfant' => 'required',
                'lieu_naissance' => 'required',
            ]);
        }

        if($data['type_acte'] == "mariage"){
            $request->validate([
                'nom_complet_epoux' => 'required',
                'nom_complet_epouse' => 'required',
                'date_mariage' => 'required',
                'lieu_mariage' => 'required',
            ]);
        }

        if($data['type_acte'] == "deces"){
            $request->validate([
                'nom_defunt' => 'required',
                'prenoms_defunt' => 'required',
                'date_deces' => 'required',
                'lieu_deces' => 'required',
            ]);
        }

        if($data['demander_par'] != "concerne"){
            $request->validate([
                'nom_demandeur' => 'required',
                'prenom_demandeur' => 'required',
                'contact_demandeur' => 'required',
                'adresse_demandeur' => 'required',
            ]);
        }

        if($data['demander_par'] == "autre"){
            $request->validate([
                'procuration' => 'required',
            ]);
        }

        if($data['demander_par'] == "parent"){
            $request->validate([
                'justificatif_lien' => 'required',
            ]);
        }

        $demande = new CopieActe();
        $demande->numero_declaration = $demande->getNumeroDeclaration();
        $demande->etat = 'Enregistré';
        $demande->type_declaration = $data['type_acte'];
        $demande->date_declaration = now();
        $demande->montant_declaration = 1600;

        $demande->type_acte = $data['type_acte'];
        $demande->type_copie = $data['type_copie'];
        $demande->numero_acte = $data['numero_acte'];
        $demande->demander_par = $data['demander_par'];

        $demande->nom_enfant = $data['nom_enfant'] ?? null;
        $demande->prenoms_enfant = $data['prenoms_enfant'] ?? null;
        $demande->date_naissance_enfant = isset($data['date_naissance_enfant']) ? Carbon::createFromFormat('Y-m-d', $data["date_naissance_enfant"]) : null;
        $demande->lieu_naissance = $data['lieu_naissance'] ?? null;

        $demande->nom_complet_epoux = $data['nom_complet_epoux'] ?? null;
        $demande->nom_complet_epouse = $data['nom_complet_epouse'] ?? null;
        $demande->date_mariage = isset($data['date_mariage']) ? Carbon::createFromFormat('Y-m-d', $data["date_mariage"]) : null;
        $demande->lieu_mariage = $data['lieu_mariage'] ?? null;

        $demande->nom_defunt = $data['nom_defunt'] ?? null;
        $demande->prenoms_defunt = $data['prenoms_defunt'] ?? null;
        $demande->date_deces = isset($data['date_deces']) ? Carbon::createFromFormat('Y-m-d', $data["date_deces"]) : null;
        $demande->lieu_deces = $data['lieu_deces'] ?? null;

        $demande->nom_demandeur = $data['nom_demandeur'] ?? null;
        $demande->prenom_demandeur = $data['prenom_demandeur'] ?? null;
        $demande->email_demandeur = $data['email_demandeur'] ?? null;
        $demande->contact_demandeur = $data['contact_demandeur'] ?? null;
        $demande->adresse_demandeur = $data['adresse_demandeur'] ?? null;

        if (isset($data['piece_identite_demandeur'])) {
            $fichier = $request->file('piece_identite_demandeur');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_identite_demandeur' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $demande->piece_identite_demandeur = '/storage/documents/' . $filename;
        }

        $demande->created_by = $request->user()->id;
        $demande->save();
        session(['declaration_id' => $demande->id]);
        session(['service' => "demande de copie d'acte de ".$demande->type_acte]);

        return redirect()->route('choix-payement');
    }

    public function updateCopieActe(Request $request){
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];

        if($request->isMethod('post') && $request->input('idDemandeModifier')) {
            
            $data = $request->all();

            try {
                //Debut de transaction
                DB::beginTransaction();
                
                $copie = CopieActe::find($data['idDemandeModifier']);

                if(!$copie){
                    return response()->json(["code" => 0, "msg" => "Document introuvable.", "data" => NULL]);
                }
            
                $acte = null;
                if($data['etat'] != "Rejeté"){
                    if(!empty($data['idActe']) && $data['idActe'] != null){
                        if($data['type_acte'] == 'naissance'){
                            $acte = DeclarationNaissance::where([["id",$data['idActe']],["etat","Disponible"]])->first();
                            $copie->naissance_id = $acte->id;
                        }
                        if($data['type_acte'] == 'deces'){
                            $acte = DeclarationDece::where([["id",$data['idActe']],["etat","Disponible"]])->first();
                            $copie->deces_id = $acte->id;
                        }
                        if($data['type_acte'] == 'mariage'){
                            $acte = DeclarationMariage::where([["id",$data['idActe']],["etat","Disponible"]])->first();
                            $copie->mariage_id = $acte->id;
                        }

                        if(!$acte){
                            return response()->json(["code" => 0, "msg" => "Cet acte n'est pas disponible.", "data" => NULL]);
                        }
                    }else{
                        return response()->json(["code" => 0, "msg" => "Cet acte n'est pas disponible.", "data" => NULL]);
                    }
                }

                $traitement = Traitement::where('copie_acte_id',$copie->id)->first();
                $traitement->etat = $data['etat'];
                $traitement->save();

                $copie->etat = $data['etat'];
                $copie->updated_by = $request->user()->id;
                $copie->save();
                
                $jsonData["data"] = json_decode($copie);

                //En cas de succes
                DB::commit();
                return response()->json($jsonData);   

            }catch (Exception $exc) {
                //En cas d'echec
                DB::rollBack();
                $jsonData["code"] = -1;
                $jsonData["data"] = null;
                $jsonData["msg"] = $exc->getMessage();
                return response()->json($jsonData);
            }
        }
    }

    public function signerCopieActe(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Document signé avec succès."];

        if ($request->isMethod('post') && $request->input('idCopieModifier')) {
            $data = $request->all();

            $copie = CopieActe::find($data['idCopieModifier']);

            if (!$copie) {
                return response()->json(["code" => 0, "msg" => "Document introuvable.", "data" => null]);
            }

            try {
                
                if (empty($data['signature'])) {
                    return response()->json(["code" => 0, "msg" => "Aucune signature reçue.", "data" => null]);
                }

                if (empty($data['date_delivrance'])) {
                    return response()->json(["code" => 0, "msg" => "La date de délivrance est obligatoire.", "data" => null]);
                }

                $signatureData = $data['signature'];
                $imageData = base64_decode(explode(',', $signatureData)[1]);

                $fileName = 'signature_' . uniqid() . '.png';
                $path = storage_path('app/public/documents/' . $fileName);

                file_put_contents($path, $imageData);
                
                $copie->date_delivrance = Carbon::createFromFormat('d-m-Y', $data["date_delivrance"]);
                $copie->signature = '/storage/documents/' . $fileName;
                $copie->etat = "Disponible";
                $copie->save();
                
                $traitement = Traitement::where('copie_acte_id',$copie->id)->first();
                $traitement->etat = "Disponible";
                $traitement->date_disponible = Now();
                $traitement->save();

                $jsonData["data"] = $copie;
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

    public function updateStateCopie($id){
        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
        $copie = CopieActe::find($id);

        if($copie){
            try {

                $copie->etat = "En cours";
                $copie->created_by = Auth::id();
                $copie->save();

                $traitement = Traitement::where('copie_acte_id',$copie->id)->first();
                $traitement->etat = "En cours";
                $traitement->save();

                $jsonData["data"] = json_decode($copie);

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

    public function printCopieActe($idActe, $typeCopie, $typeActe)
    {
        $pdfService = new PdfService();
        $convertisDateService = new ConvertisDateToWordService();

        $copie = CopieActe::findOrFail($idActe); // ID de la table copie_actes
        $template = null;

        if ($typeActe == "naissance" && $copie->naissance_id) {
            $acte = DeclarationNaissance::with('commune', 'lieuDelivrance')->findOrFail($copie->naissance_id);
            $dateEnWord = $convertisDateService->convertDateToWords($acte->date_naissance_enfant);
            $template = view('back.naissance.acte-naissance-pdf', [
                'acteNaissance' => $acte,
                'signatureCopie' => $copie->signature,
                'dateCopie' => $copie->date_delivrance,
                'dateNaissanceEnWord' => $dateEnWord
            ])->render();
        }

        if ($typeActe == "deces" && $copie->deces_id) {
            $acte = DeclarationDece::with('commune', 'lieuDelivrance')->findOrFail($copie->deces_id);
            $dateEnWord = $convertisDateService->convertDateToWords($acte->date_deces);
            $template = view('back.deces.acte-deces-pdf', [
                'acteDeces' => $acte,
                'signatureCopie' => $copie->signature,
                'dateCopie' => $copie->date_delivrance,
                'dateDecesEnWord' => $dateEnWord
            ])->render();
        }

        if ($typeActe == "mariage" && $copie->mariage_id) {
            $acte = DeclarationMariage::with('commune', 'lieuDelivrance')->findOrFail($copie->mariage_id);
            $dateEnWord = $convertisDateService->convertDateToWords($acte->date_mariage);
            $template = view('back.mariage.acte-mariage-pdf', [
                'acteMariage' => $acte,
                'signatureCopie' => $copie->signature,
                'dateCopie' => $copie->date_delivrance,
                'dateMariageEnWord' => $dateEnWord
            ])->render();
        }

        if (!$template) {
            return abort(404, "Acte non trouvé ou type invalide.");
        }

        return $pdfService->generatePdfFromHtml($template);
    }
}
