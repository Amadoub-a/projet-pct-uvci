<?php

namespace App\Models;

use App\Models\Parametre\Commune;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeclarationNaissance extends BaseModele
{
    protected $table = 'declarations_naissances';
    
    public function getFillable()
    {
        return [
            'numero_declaration',
            'montant_declaration',
            'type_declaration',
            'date_payement',
            'date_declaration',
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
            'numero_extrait',
            'date_registre',
            'date_delivrance',
            'signature',
            'lieu_delivrance'
        ];
    }

    public function getCasts()
    {
        return [
            'date_naissance_enfant' => 'date',
            'date_naissance_pere' => 'date',
            'date_naissance_mere' => 'date',
            'date_payement' => 'date',
            'date_declaration' => 'date',
            'date_registre' => 'date',
            'date_delivrance' => 'date',
        ];
    }
    
    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class,'lieu_naissance_enfant');
    }

    public function lieuDelivrance(): BelongsTo
    {
        return $this->belongsTo(Commune::class,'lieu_delivrance');
    }

    public function getNumeroDeclaration(){
        $latestId = DeclarationNaissance::max('id') + 1;
        $date = now()->format('Ymd');
        return $date . '-' . str_pad($latestId, 5, '0', STR_PAD_LEFT);
    }
}
