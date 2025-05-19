<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DeclarationMariage;

class DeclarationMariageController extends Controller
{
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
        $declaration->etat = 'Enregistrer';
        $declaration->type_declaration = 'mariage';
        $declaration->date_declaration = now();
        $declaration->montant_declaration = 5000;

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
}
