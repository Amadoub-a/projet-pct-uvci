<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        ];
    }

    public function getCasts()
    {
        return [
            'date_traitement' => 'date',
            'date_disponible' => 'date',
        ];
    }
}
