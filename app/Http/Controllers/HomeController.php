<?php

namespace App\Http\Controllers;

use App\Models\DeclarationDece;
use App\Models\DeclarationMariage;
use App\Models\DeclarationNaissance;
use App\Models\Traitement;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {     
        $demandeCours = Traitement::where('etat', '=', 'En cours')->orWhere('etat', '=', 'Enregistré')->count();
        $demandeTraitees = Traitement::where('etat', '=', 'Disponible')->count();
        $demandeRejetees = Traitement::where('etat', '=', 'Rejeté')->count();
        $demandes = Traitement::all()->count();
        
        $nbNaissanceParCommune = DeclarationNaissance::whereIn("etat",["Disponible","Validé"])
                                    ->selectRaw('lieu_naissance_enfant, COUNT(*) as total')
                                    ->groupBy('lieu_naissance_enfant')
                                    ->with('commune')
                                    ->get();

        $nbMariageParCommune = DeclarationMariage::whereIn("etat",["Disponible","Validé"])
                                    ->selectRaw('lieu_mariage, COUNT(*) as total')
                                    ->groupBy('lieu_mariage')
                                    ->with('commune')
                                    ->get();

        $nbDecesParCommune = DeclarationDece::whereIn("etat",["Disponible","Validé"])
                                    ->selectRaw('lieu_deces, COUNT(*) as total')
                                    ->groupBy('lieu_deces')
                                    ->with('commune')
                                    ->get();

        $menuPrincipal = "Tableau de bord";
        $titleControlleur = "";
        $btnModalAjout = "FALSE";
        return view("home", compact('nbDecesParCommune','nbMariageParCommune','nbNaissanceParCommune','demandeCours','demandeTraitees','demandeRejetees','demandes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function superviseur()
    {     
        $menuPrincipal = "Tableau de bord";
        $titleControlleur = "";
        $btnModalAjout = "FALSE";
        return view("superviseur", compact('menuPrincipal','titleControlleur','btnModalAjout'));
    }
}
