<?php

namespace App\Http\Controllers;

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
        $demandeTraitees = Traitement::where('etat', '=', 'Traité')->count();
        $demandeRejetees = Traitement::where('etat', '=', 'Rejeté')->count();
        $demandes = Traitement::all()->count();
        
        $menuPrincipal = "Tableau de bord";
        $titleControlleur = "";
        $btnModalAjout = "FALSE";
        return view("home", compact('demandeCours','demandeTraitees','demandeRejetees','demandes','menuPrincipal','titleControlleur','btnModalAjout'));
    }

    public function superviseur()
    {     
        $menuPrincipal = "Tableau de bord";
        $titleControlleur = "";
        $btnModalAjout = "FALSE";
        return view("superviseur", compact('menuPrincipal','titleControlleur','btnModalAjout'));
    }
}
