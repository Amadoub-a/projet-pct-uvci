<?php

namespace App\Services;

use Spatie\Browsershot\Browsershot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ConvertisDateToWordService
{
    public function convertDateToWords($date)
    {
        // Table des mois en français
        $months = [
            '01' => 'Janvier',
            '02' => 'Février',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Août',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Décembre'
        ];

        // Table des jours en français
        $days = [
            '01' => 'Premier',
            '02' => 'Deux',
            '03' => 'Trois',
            '04' => 'Quatre',
            '05' => 'Cinq',
            '06' => 'Six',
            '07' => 'Sept',
            '08' => 'Huit',
            '09' => 'Neuf',
            '10' => 'Dix',
            '11' => 'Onze',
            '12' => 'Douze',
            '13' => 'Treize',
            '14' => 'Quatorze',
            '15' => 'Quinze',
            '16' => 'Seize',
            '17' => 'Dix-sept',
            '18' => 'Dix-huit',
            '19' => 'Dix-neuf',
            '20' => 'Vingt',
            '21' => 'Vingt et un',
            '22' => 'Vingt-deux',
            '23' => 'Vingt-trois',
            '24' => 'Vingt-quatre',
            '25' => 'Vingt-cinq',
            '26' => 'Vingt-six',
            '27' => 'Vingt-sept',
            '28' => 'Vingt-huit',
            '29' => 'Vingt-neuf',
            '30' => 'Trente',
            '31' => 'Trente et un'
        ];

        // Extraire le jour, le mois et l'année de la date
        $day = Carbon::parse($date)->format('d');  // Le jour
        $month = Carbon::parse($date)->format('m'); // Le mois
        $year = Carbon::parse($date)->format('Y'); // L'année

        // Convertir en lettres
        $dayInWords = isset($days[$day]) ? $days[$day] : $day; // Convertir le jour en lettres
        $monthInWords = isset($months[$month]) ? $months[$month] : $month; // Convertir le mois en lettres
        $yearInWords = $this->convertYearToWords($year); // Convertir l'année en lettres

        return $dayInWords . ' ' . $monthInWords . ' ' . $yearInWords;
    }

    public function convertYearToWords($year)
    {
        $words = [
            '1960' => 'Mille neuf cent soixante',
            '1961' => 'Mille neuf cent soixante et un',
            '1962' => 'Mille neuf cent soixante-deux',
            '1963' => 'Mille neuf cent soixante-trois',
            '1964' => 'Mille neuf cent soixante-quatre',
            '1965' => 'Mille neuf cent soixante-cinq',
            '1966' => 'Mille neuf cent soixante-six',
            '1967' => 'Mille neuf cent soixante-sept',
            '1968' => 'Mille neuf cent soixante-huit',
            '1969' => 'Mille neuf cent soixante-neuf',
            '1970' => 'Mille neuf cent soixante-dix',
            '1971' => 'Mille neuf cent soixante et onze',
            '1972' => 'Mille neuf cent soixante-douze',
            '1973' => 'Mille neuf cent soixante-treize',
            '1974' => 'Mille neuf cent soixante-quatorze',
            '1975' => 'Mille neuf cent soixante-quinze',
            '1976' => 'Mille neuf cent soixante-seize',
            '1977' => 'Mille neuf cent soixante-dix-sept',
            '1978' => 'Mille neuf cent soixante-dix-huit',
            '1979' => 'Mille neuf cent soixante-dix-neuf',
            '1980' => 'Mille neuf cent quatre-vingts',
            '1981' => 'Mille neuf cent quatre-vingt un',
            '1982' => 'Mille neuf cent quatre-vingt-deux',
            '1983' => 'Mille neuf cent quatre-vingt trois',
            '1984' => 'Mille neuf cent quatre-vingt quatre',
            '1985' => 'Mille neuf cent quatre-vingt cinq',
            '1986' => 'Mille neuf cent quatre-vingt six',
            '1987' => 'Mille neuf cent quatre-vingt sept',
            '1988' => 'Mille neuf cent quatre-vingt huit',
            '1989' => 'Mille neuf cent quatre-vingt neuf',
            '1990' => 'Mille neuf cent quatre-vingts dix',
            '1991' => 'Mille neuf cent quatre-vingt onze',
            '1992' => 'Mille neuf cent quatre-vingt douze',
            '1993' => 'Mille neuf cent quatre-vingt treize',
            '1994' => 'Mille neuf cent quatre-vingt quatorze',
            '1995' => 'Mille neuf cent quatre-vingt quinze',
            '1996' => 'Mille neuf cent quatre-vingt seize',
            '1997' => 'Mille neuf cent quatre-vingt dix-sept',
            '1998' => 'Mille neuf cent quatre-vingt dix-huit',
            '1999' => 'Mille neuf cent quatre-vingt dix-neuf',
            '2000' => 'Deux mille',
            '2001' => 'Deux mille un',
            '2002' => 'Deux mille deux',
            '2003' => 'Deux mille trois',
            '2004' => 'Deux mille quatre',
            '2005' => 'Deux mille cinq',
            '2006' => 'Deux mille six',
            '2007' => 'Deux mille sept',
            '2008' => 'Deux mille huit',
            '2009' => 'Deux mille neuf',
            '2010' => 'Deux mille dix',
            '2011' => 'Deux mille onze',
            '2012' => 'Deux mille douze',
            '2013' => 'Deux mille treize',
            '2014' => 'Deux mille quatorze',
            '2015' => 'Deux mille quinze',
            '2016' => 'Deux mille seize',
            '2017' => 'Deux mille dix-sept',
            '2018' => 'Deux mille dix-huit',
            '2019' => 'Deux mille dix-neuf',
            '2020' => 'Deux mille vingt',
            '2021' => 'Deux mille vingt et un',
            '2022' => 'Deux mille vingt-deux',
            '2023' => 'Deux mille vingt-trois',
            '2024' => 'Deux mille vingt-quatre',
            '2025' => 'Deux mille vingt-cinq',
        ];

        return isset($words[$year]) ? $words[$year] : $year; // Retourner l'année en mots
    }
}