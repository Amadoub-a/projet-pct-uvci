<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $menuPrincipal = "Tableau de bord";
        $titleControlleur = "";
        $btnModalAjout = "FALSE";
        return view("home", compact('menuPrincipal','titleControlleur','btnModalAjout'));
    }
}
