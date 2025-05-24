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
            'nom',
            'prenoms',
            'date_naissance',
            'lieu_naissance',

            'demander_par',
            'nom_demandeur',
            'prenom_demandeur',
            'email_demandeur',
            'contact_demandeur',
            'adresse_demandeur',
            'piece_identite_demandeur',
        ];
        
    }

    public function getCasts()
    {
        return [
            'date_declaration' => 'date',
            'date_payement' => 'date',
            'date_naissance' => 'date',
        ];
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class,'lieu_naissance');
    }
    public function getNumeroDeclaration(){
        $latestId = CopieActe::max('id') + 1;
        $date = now()->format('Ymd');
        return $date . '-' . str_pad($latestId, 5, '0', STR_PAD_LEFT);
    }
}
