<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function services()
    {     
        return view("site.front.services");
    }

    public function declarationNaissance(){
        return view("site.front.declaration-naissance");
    }

    public function declarationMariage(){
        return view("site.front.declaration-mariage");
    }

    public function declarationDeces(){
        return view("site.front.declaration-deces");
    }

    public function declarationVie(){
        return view("site.front.declaration-vie");
    }

    public function legalisationDocument(){
        return view("site.front.legalisation-document");
    }

    public function copieActe(){
        return view("site.front.copie-acte");
    }

    public function tarifs()
    {     
        return view("site.front.tarifs");
    }

    public function about()
    {     
        return view("site.front.about");
    }

    public function contact()
    {     
        return view("site.front.contact");
    }

    public function signIn()
    {     
        return view("site.front.sign-in");
    }

    public function signUp()
    {     
        return view("site.front.sign-up");
    }
}
