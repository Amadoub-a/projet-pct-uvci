<?php

namespace App\Models;

use League\Uri\BaseUri;
use App\Models\Parametre\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CopieActe extends BaseModele
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
           
            'type_acte',
            'type_copie',
            'numero_acte',

            'nom_enfant',
            'prenoms_enfant',
            'date_naissance_enfant',
            'lieu_naissance',

            'nom_defunt',
            'prenoms_defunt',
            'date_deces',
            'lieu_deces',

            'nom_complet_epoux',
            'nom_complet_epouse',
            'date_mariage',
            'lieu_mariage',

            'demander_par',
            'nom_demandeur',
            'prenom_demandeur',
            'email_demandeur',
            'contact_demandeur',
            'adresse_demandeur',

            'piece_identite_demandeur',
            'justificatif_lien',
            'procuration',

            'date_delivrance',
            'signature',

            'deces_id',
            'naissance_id',
            'mariage_id',
        ];
        
    }

    public function getCasts()
    {
        return [
            'date_declaration' => 'date',
            'date_payement' => 'date',
            'date_naissance_enfant' => 'date',
            'date_deces' => 'date',
            'date_mariage' => 'date',
            'date_delivrance' => 'date',
        ];
    }

    public function lieu_naissance(): BelongsTo
    {
        return $this->belongsTo(Commune::class,'lieu_naissance');
    }

    public function lieu_deces(): BelongsTo
    {
        return $this->belongsTo(Commune::class,'lieu_deces');
    }

    public function lieu_mariage(): BelongsTo
    {
        return $this->belongsTo(Commune::class,'lieu_mariage');
    }

    public function deces(): BelongsTo
    {
        return $this->belongsTo(DeclarationDece::class,'deces_id');
    }

    public function naissance(): BelongsTo
    {
        return $this->belongsTo(DeclarationNaissance::class,'naissance_id');
    }

    public function mariage(): BelongsTo
    {
        return $this->belongsTo(DeclarationMariage::class,'mariage_id');
    }

    public function getNumeroDeclaration(){
        $latestId = CopieActe::max('id') + 1;
        $date = now()->format('Ymd');
        return $date . '-' . str_pad($latestId, 5, '0', STR_PAD_LEFT);
    }
}
