<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeclarationNaissanceController extends Controller
{
    public function sendDeclarationNaissance(Request $request){
        
        $request->validate([
            'nom_enfant' => 'required',
            'prenoms_enfant' => 'required',
            'date_naissance_enfant' => 'required',
            'heure_naissance_enfant' => 'required',
            'lieu_naissance_enfant' => 'required',
            'etablissement_naissance_enfant' => 'required',
            'nationalite_enfant' => 'required',
            'sexe_enfant' => 'required',
            'declarant' => 'required',
            'certificat_naissance' => 'required',
            'piece_identite_pere' => 'required',
            'piece_identite_mere' => 'required',
            'declaration_honneur' => 'required',
        ]);


    }
}
