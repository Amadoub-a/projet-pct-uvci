<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Traitement extends BaseModele
{
    public function getFillable()
    {
        return [
            'declaration_naissance_id',
            'declaration_mariage_id',
            'declaration_deces_id',
            'legalisation_id',
            'copie_acte_id',
            'etat',
            'date_traitement',
            'date_disponible',
            'client_id',
            'admin_id'
        ];
    }

    public function getCasts()
    {
        return [
            'date_traitement' => 'date',
            'date_disponible' => 'date',
        ];
    }

    public function copie_acte(): BelongsTo
    {
        return $this->belongsTo(CopieActe::class);
    }

    public function legalisation(): BelongsTo
    {
        return $this->belongsTo(Legalisation::class);
    }

    public function declaration_deces(): BelongsTo
    {
        return $this->belongsTo(DeclarationDece::class);
    }

    public function declaration_mariage(): BelongsTo
    {
        return $this->belongsTo(DeclarationMariage::class);
    }

    public function declaration_naissance(): BelongsTo
    {
        return $this->belongsTo(DeclarationNaissance::class);
    }
}
