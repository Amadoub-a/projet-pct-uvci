<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CopieActe;
use Illuminate\Http\Request;
use App\Models\Parametre\Commune;

class CopieActeController extends Controller
{
    public function vueCopiesActes(){
        $communes = Commune::select('libelle_commune','id')->get();
        $menuPrincipal = "E-civil";
        $titleControlleur = "Demandes de copie d'acte";
        $btnModalAjout = "FALSE";

        return view("back.copie-acte.index",compact('communes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function storeCopieActe(Request $request){
        $request->validate([
            'type_acte' => 'required',
            'type_copie' => 'required',
            'numero_acte' => 'required',
            'nom' => 'required',
            'prenoms' => 'required',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required',
            'demander_par' => 'required',
            'nom_demandeur' => 'required',
            'prenom_demandeur' => 'required',
            'email_demandeur' => 'required',
            'contact_demandeur' => 'required',
            'adresse_demandeur' => 'required',
            'declaration_honneur' => 'required',
        ]);

        $data = $request->all();

        $demande = new CopieActe();
        $demande->numero_declaration = $demande->getNumeroDeclaration();
        $demande->etat = 'Enregistré';
        $demande->type_declaration = $data['type_acte'];
        $demande->date_declaration = now();
        $demande->montant_declaration = 1600;

        $demande->type_acte = $data['type_acte'];
        $demande->type_copie = $data['type_copie'];
        $demande->numero_acte = $data['numero_acte'];
        $demande->nom = $data['nom'];
        $demande->prenoms = $data['prenoms'];
        $demande->date_naissance = Carbon::createFromFormat('Y-m-d', $data["date_naissance"]);
        $demande->lieu_naissance = $data['lieu_naissance'];

        $demande->demander_par = $data['demander_par'];
        $demande->nom_demandeur = $data['nom_demandeur'];
        $demande->prenom_demandeur = $data['prenom_demandeur'];
        $demande->email_demandeur = $data['email_demandeur'];
        $demande->contact_demandeur = $data['contact_demandeur'];
        $demande->adresse_demandeur = $data['adresse_demandeur'];

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

    public function listeCopiesActes(){
        $copies = CopieActe::with('commune')->orderBy('id', 'DESC')->get();

        $jsonData["rows"] = $copies->toArray();
        $jsonData["total"] = $copies->count();
        return response()->json($jsonData);
    }
}
