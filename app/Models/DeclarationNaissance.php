<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeclarationNaissance extends BaseModele
{
    use HasFactory;
    
    public function getFillable()
    {
        return [
            'etat',
            'paye',
            'nom_enfant',
            'prenoms_enfant',
            'date_naissance_enfant',
            'heure_naissance_enfant',
            'lieu_naissance_enfant',
            'etablissement_naissance_enfant',
            'nationalite_enfant',
            'sexe_enfant',
            'nom_pere',
            'prenoms_pere',
            'date_naissance_pere',
            'lieu_naissance_pere',
            'nationalite_pere',
            'profession_pere',
            'adresse_pere',
            'nom_mere',
            'prenoms_mere',
            'date_naissance_mere',
            'lieu_naissance_mere',
            'nationalite_mere',
            'profession_mere',
            'adresse_mere',
            'nom_declarant',
            'prenoms_declarant',
            'lien_avec_enfant',
            'contact_declarant',
            'certificat_naissance',
            'piece_identite_pere',
            'piece_identite_mere',
            'piece_identite_declarant',
            'type_declaration',
            'montant_declaration',
        ];
    }

    public function getCasts()
    {
        return [
            'date_naissance_enfant' => 'date',
            'date_naissance_pere' => 'date',
            'date_naissance_mere' => 'date',
        ];
    }
}
