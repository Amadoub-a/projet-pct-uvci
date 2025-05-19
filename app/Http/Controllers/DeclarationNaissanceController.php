<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DeclarationNaissance;

use function Symfony\Component\Clock\now;

class DeclarationNaissanceController extends Controller
{
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
        $declaration->etat = 'Enregistrer';
        $declaration->type_declaration = 'naisance';
        $declaration->date_declaration = now();
        $declaration->montant_declaration = 5000;

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
}
