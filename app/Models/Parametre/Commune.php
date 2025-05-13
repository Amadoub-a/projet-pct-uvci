<?php

namespace App\Models\Parametre;

use App\Models\BaseModele;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commune extends BaseModele
{
     use HasFactory;

    public function getFillable()
    {
        return [
            'libelle_commune',
        ];
    }
}
