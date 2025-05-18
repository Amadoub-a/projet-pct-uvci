<?php

namespace App\Http\Controllers;

use App\Models\DeclarationNaissance;
use Illuminate\Http\Request;

class PayementController extends Controller
{
    public function choixPayement()
    {
        $service = session('service');
        $prestation = [];

        $idDeclaration = session('declaration_id');
        $idDemande = session('demande_id');

        if ($idDemande) {
            $demande = DeclarationNaissance::find($idDemande);

            if ($demande) {
                $prestation = [
                    'id' => $demande->id,
                    'numero' => $demande->numero_demande,
                    'montant' => $demande->montant_demande,
                ];
            }
        }

        if ($idDeclaration) {
            $declaration = DeclarationNaissance::find($idDeclaration);

            if ($declaration) {
                $prestation = [
                    'id' => $declaration->id,
                    'numero' => $declaration->numero_declaration,
                    'montant' => $declaration->montant_declaration,
                ];
            }
        }

        return view("site.front.payment", compact('prestation', 'service'));
    }


    public function makePayement(Request $request){

    }
}
