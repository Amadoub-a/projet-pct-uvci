<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legalisation extends BaseModele
{
    public function getFillable()
    {
        return [
            'numero_declaration',
            'etat',
            'paye',
            'type_declaration',
            'date_declaration',
            'montant_declaration',
            'date_payement',
           
            'nom_personne',
            'prenoms_personne',
            'date_naissance_personne',
            'lieu_naissance_personne',
            'nationalite_personne',
            'profession_personne',
            'contact_personne',
            'email_personne',
            'adresse_personne',

            'type_document',
            'autres',
            'date_document',
            'autorite',
            'motif',
            'nb_copies',

            'document_original',
            'piece_demandeur',
            'justificatif_domicil',
            'procuration',
        ];
    }

    public function getCasts()
    {
        return [
            'date_declaration' => 'date',
            'date_payement' => 'date',
            'date_naissance_personne' => 'date',
            'date_document' => 'date',
        ];
    }

    public function getNumeroDeclaration(){
        $latestId = Legalisation::max('id') + 1;
        $date = now()->format('Ymd');
        return $date . '-' . str_pad($latestId, 5, '0', STR_PAD_LEFT);
    }
}
