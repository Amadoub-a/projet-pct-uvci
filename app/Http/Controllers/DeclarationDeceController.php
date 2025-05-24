<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DeclarationDece;

class DeclarationDeceController extends Controller
{
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
        $declaration->etat = 'Enregistrer';
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
}
