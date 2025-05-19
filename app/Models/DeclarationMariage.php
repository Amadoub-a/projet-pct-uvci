<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclarationMariage extends Model
{
   // protected $table = 'declaration_mariages';

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
            'date_mariage',
            'lieu_mariage',
            'regime_matrimonial',
            'officier_etat_civil',
            'nom_epoux',
            'prenoms_epoux',
            'date_naissance_epoux',
            'lieu_naissance_epoux',
            'nationalite_epoux',
            'profession_epoux',
            'adresse_epoux',
            'nom_epouse',
            'prenoms_epouse',
            'date_naissance_epouse',
            'lieu_naissance_epouse',
            'nationalite_epouse',
            'profession_epouse',
            'adresse_epouse',
            'nom_complet_temoins_1',
            'contact_temoins_1',
            'nom_complet_temoins_2',
            'contact_temoins_2',
            'piece_identite_epoux',
            'piece_identite_epouse',
            'acte_naissance_epoux',
            'acte_naissance_epouse',
            'certificats_celibat_ou_coutume',
            'contrat_mariage',
        ];
    }

    public function getCasts()
    {
        return [
            'date_declaration' => 'date',
            'date_mariage' => 'date',
            'date_naissance_epoux' => 'date',
            'date_naissance_epouse' => 'date',
        ];
    }

    public function getNumeroDeclaration(){
        $latestId = DeclarationMariage::max('id') + 1;
        $date = now()->format('Ymd');
        return $date . '-' . str_pad($latestId, 5, '0', STR_PAD_LEFT);
    }
}
