<?php

namespace App\Http\Controllers;

use App\Models\CopieActe;
use App\Models\DeclarationDece;
use App\Models\DeclarationMariage;
use App\Models\DeclarationNaissance;
use App\Models\Legalisation;
use App\Models\Traitement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraitementController extends Controller
{
    public function listeDemandesCours()
    {
        $traitements = Traitement::where(function ($query) {
            $query->where("etat", "Enregistré")
                ->orWhere("etat", "En cours")
                ->orWhere("etat", "Rejeté");
        })
            ->where('client_id', Auth::id())
            ->get();

        $declarations = [];

        foreach ($traitements as $traitement) {
           
            $declarationTypes = [
                'declaration_naissance_id' => 'Déclaration de naissance',
                'declaration_mariage_id' => 'Déclaration de mariage',
                'declaration_deces_id' => 'Déclaration de décès',
                'legalisation_id' => 'Légalisation de document',
                'copie_acte_id' => "Demande de copie d'acte"
            ];

            foreach ($declarationTypes as $field => $type) {
                if ($traitement->$field) {
                   
                    $declarationModel = null;
                    $referenceField = 'numero_declaration';
                    $dateField = 'date_declaration';

                    switch ($field) {
                        case 'declaration_naissance_id':
                            $declarationModel = DeclarationNaissance::find($traitement->$field);
                            break;
                        case 'declaration_mariage_id':
                            $declarationModel = DeclarationMariage::find($traitement->$field);
                            break;
                        case 'declaration_deces_id':
                            $declarationModel = DeclarationDece::find($traitement->$field);
                            break;
                        case 'legalisation_id':
                            $declarationModel = Legalisation::find($traitement->$field);
                            break;
                        case 'copie_acte_id':
                            $declarationModel = CopieActe::find($traitement->$field);
                            break;
                    }

                    if ($declarationModel) {
                        $declarations[] = [
                            'etat' => $declarationModel->etat,
                            'type' => $type,
                            'reference' => $declarationModel->$referenceField,
                            'date_declaration' => $declarationModel->$dateField
                        ];
                    }
                }
            }
        }

        $jsonData = [
            "rows" => $declarations,
            "total" => count($declarations)
        ];

        return response()->json($jsonData);
    }

    public function listeDemandesTraitees(){
        $traitements = Traitement::where([
                        ['etat', '=', 'Disponible'],
                        ['client_id', '=', Auth::id()]
                    ])->orWhere("etat", "Validé")->get();


        $declarations = [];

        foreach ($traitements as $traitement) {
           
            $declarationTypes = [
                'declaration_naissance_id' => 'Déclaration de naissance',
                'declaration_mariage_id' => 'Déclaration de mariage',
                'declaration_deces_id' => 'Déclaration de décès',
                'legalisation_id' => 'Légalisation de document',
                'copie_acte_id' => "Demande de copie d'acte"
            ];

            foreach ($declarationTypes as $field => $type) {
                if ($traitement->$field) {
                   
                    $declarationModel = null;
                    $referenceField = 'numero_declaration';
                    $dateField = 'date_declaration';

                    switch ($field) {
                        case 'declaration_naissance_id':
                            $declarationModel = DeclarationNaissance::find($traitement->$field);
                            break;
                        case 'declaration_mariage_id':
                            $declarationModel = DeclarationMariage::find($traitement->$field);
                            break;
                        case 'declaration_deces_id':
                            $declarationModel = DeclarationDece::find($traitement->$field);
                            break;
                        case 'legalisation_id':
                            $declarationModel = Legalisation::find($traitement->$field);
                            break;
                        case 'copie_acte_id':
                            $declarationModel = CopieActe::find($traitement->$field);
                            break;
                    }

                    if ($declarationModel) {
                        $declarations[] = [
                            'traitement_id' => $traitement->$field,
                            'etat' => $traitement->etat,
                            'date_traitement' => $traitement->date_traitement,
                            'date_disponible' => $traitement->date_disponible,
                            'type' => $type,
                            'reference' => $declarationModel->$referenceField,
                            'date_declaration' => $declarationModel->$dateField
                        ];
                    }
                }
            }
        }

        $jsonData = [
            "rows" => $declarations,
            "total" => count($declarations)
        ];

        return response()->json($jsonData);
    }

    public function listeNouvelleDemandes(){
        $traitements = Traitement::where('etat', '=', 'Enregistré')->get();

        $declarations = [];

        foreach ($traitements as $traitement) {
           
            $declarationTypes = [
                'declaration_naissance_id' => 'Déclaration de naissance',
                'declaration_mariage_id' => 'Déclaration de mariage',
                'declaration_deces_id' => 'Déclaration de décès',
                'legalisation_id' => 'Légalisation de document',
                'copie_acte_id' => "Demande de copie d'acte"
            ];

            foreach ($declarationTypes as $field => $type) {
                if ($traitement->$field) {
                   
                    $declarationModel = null;
                    $referenceField = 'numero_declaration';
                    $dateField = 'date_declaration';

                    switch ($field) {
                        case 'declaration_naissance_id':
                            $declarationModel = DeclarationNaissance::find($traitement->$field);
                            break;
                        case 'declaration_mariage_id':
                            $declarationModel = DeclarationMariage::find($traitement->$field);
                            break;
                        case 'declaration_deces_id':
                            $declarationModel = DeclarationDece::find($traitement->$field);
                            break;
                        case 'legalisation_id':
                            $declarationModel = Legalisation::find($traitement->$field);
                            break;
                        case 'copie_acte_id':
                            $declarationModel = CopieActe::find($traitement->$field);
                            break;
                    }

                    if ($declarationModel) {
                        $declarations[] = [
                            'traitement_id' => $declarationModel->id,
                            'etat' => $traitement->etat,
                            'date_traitement' => $traitement->date_traitement,
                            'date_disponible' => $traitement->date_disponible,
                            'type' => $type,
                            'reference' => $declarationModel->$referenceField,
                            'date_declaration' => $declarationModel->$dateField
                        ];
                    }
                }
            }
        }

        $jsonData = [
            "rows" => $declarations,
            "total" => count($declarations)
        ];

        return response()->json($jsonData);
    }
}
