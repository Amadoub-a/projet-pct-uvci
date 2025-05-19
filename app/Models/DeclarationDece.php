<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclarationDece extends Model
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
            'date_deces',
            'heure_deces',
            'lieu_deces',
            'etablissement_deces',
            'cause_deces',
            'nom_defunt',
            'prenoms_defunt',
            'date_naissance_defunt',
            'lieu_naissance_defunt',
            'nationalite_defunt',
            'sexe_defunt',
            'profession_defunt',
            'situation_familiale_defunt',
            'adresse_defunt',
            'nom_declarant',
            'prenoms_declarant',
            'lien_parente',
            'contact_declarant',
            'adresse_declarant',
            'certificat_deces',
            'piece_identite_defunt',
            'acte_naissance_defunt',
            'piece_identite_declarant',
        ];
    }

    public function getCasts()
    {
        return [
            'date_deces' => 'date',
            'date_naissance_defunt' => 'date',
            'date_declaration' => 'date',
            'date_payement' => 'date',
        ];
    }

    public function getNumeroDeclaration(){
        $latestId = DeclarationDece::max('id') + 1;
        $date = now()->format('Ymd');
        return $date . '-' . str_pad($latestId, 5, '0', STR_PAD_LEFT);
    }
}
