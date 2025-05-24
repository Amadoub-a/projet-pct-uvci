<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Legalisation;
use Illuminate\Http\Request;

class LegalisationController extends Controller
{
    public function storeLegalisation(Request $request){
        $request->validate([
            'nom_personne' => 'required',
            'prenoms_personne' => 'required',
            'date_naissance_personne' => 'required',
            'lieu_naissance_personne' => 'required',
            'nationalite_personne' => 'required',
            'contact_personne' => 'required',
            'adresse_personne' => 'required',
            'type_document' => 'required',
            'date_document' => 'required',
            'autorite' => 'required',
            'motif' => 'required',
            'nb_copies' => 'required',
            'document_original' => 'required',
            'piece_demandeur' => 'required',
            'justificatif_domicile' => 'required',
            'declaration_honneur' => 'required',
        ]);

        $data = $request->all();

        $declaration = new Legalisation();
        $declaration->numero_declaration = $declaration->getNumeroDeclaration();
        $declaration->etat = 'Enregistrer';
        $declaration->type_declaration = 'legalisation';
        $declaration->date_declaration = now();
        $declaration->montant_declaration = 1600;

        $declaration->nom_personne = $data['nom_personne'];
        $declaration->prenoms_personne = $data['prenoms_personne'];
        $declaration->date_naissance_personne = Carbon::createFromFormat('Y-m-d', $data["date_naissance_personne"]);
        $declaration->lieu_naissance_personne = $data['lieu_naissance_personne'];
        $declaration->nationalite_personne = $data['nationalite_personne'];
        $declaration->profession_personne = $data['profession_personne'] ?? null;
        $declaration->contact_personne = $data['contact_personne'];
        $declaration->email_personne = $data['email_personne'] ?? null;

        $declaration->adresse_personne = $data['adresse_personne'];
        $declaration->type_document = $data['type_document'];
        $declaration->autres = $data['autres'];
        $declaration->date_document = Carbon::createFromFormat('Y-m-d', $data["date_document"]);
        $declaration->autorite = $data['autorite'];
        $declaration->motif = $data['motif'];
        $declaration->nb_copies = $data['nb_copies'];

        if (isset($data['document_original'])) {
            $fichier = $request->file('document_original');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'document_original' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->document_original = '/storage/documents/' . $filename;
        }

        if (isset($data['piece_demandeur'])) {
            $fichier = $request->file('piece_demandeur');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'piece_demandeur' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->piece_demandeur = '/storage/documents/' . $filename;
        }

        if (isset($data['justificatif_domicile'])) {
            $fichier = $request->file('justificatif_domicile');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'justificatif_domicile' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->justificatif_domicile = '/storage/documents/' . $filename;
        }

        if (isset($data['procuration'])) {
            $fichier = $request->file('procuration');
            $extension = $fichier->getClientOriginalExtension();
            $filename = 'procuration' . now()->format('dmYHis') . '.' . $extension;
            // Stocker dans storage/app/public/documents
            $fichier->storeAs('public/documents', $filename);
            // Enregistrer le chemin accessible publiquement
            $declaration->procuration = '/storage/documents/' . $filename;
        }

        $declaration->created_by = $request->user()->id;
        $declaration->save();
        session(['declaration_id' => $declaration->id]);
        session(['service' => "légalisation"]);

        return redirect()->route('choix-payement');
    }
}
