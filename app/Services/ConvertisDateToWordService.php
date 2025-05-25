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
            '1900' => 'Mille neuf cent',
            '1901' => 'Mille neuf cent un',
            '1902' => 'Mille neuf cent deux',
            '1903' => 'Mille neuf cent trois',
            '1904' => 'Mille neuf cent quatre',
            '1905' => 'Mille neuf cent cinq',
            '1906' => 'Mille neuf cent six',
            '1907' => 'Mille neuf cent sept',
            '1908' => 'Mille neuf cent huit',
            '1909' => 'Mille neuf cent neuf',
            '1910' => 'Mille neuf cent dix',
            '1911' => 'Mille neuf cent onze',
            '1912' => 'Mille neuf cent douze',
            '1913' => 'Mille neuf cent treize',
            '1914' => 'Mille neuf cent quatorze',
            '1915' => 'Mille neuf cent quinze',
            '1916' => 'Mille neuf cent seize',
            '1917' => 'Mille neuf cent dix-sept',
            '1918' => 'Mille neuf cent dix-huit',
            '1919' => 'Mille neuf cent dix-neuf',
            '1920' => 'Mille neuf cent vingt',
            '1921' => 'Mille neuf cent vingt et un',
            '1922' => 'Mille neuf cent vingt-deux',
            '1923' => 'Mille neuf cent vingt-trois',
            '1924' => 'Mille neuf cent vingt-quatre',
            '1925' => 'Mille neuf cent vingt-cinq',
            '1926' => 'Mille neuf cent vingt-six',
            '1927' => 'Mille neuf cent vingt-sept',
            '1928' => 'Mille neuf cent vingt-huit',
            '1929' => 'Mille neuf cent vingt-neuf',
            '1930' => 'Mille neuf cent trente',
            '1931' => 'Mille neuf cent trente et un',
            '1932' => 'Mille neuf cent trente-deux',
            '1933' => 'Mille neuf cent trente-trois',
            '1934' => 'Mille neuf cent trente-quatre',
            '1935' => 'Mille neuf cent trente-cinq',
            '1936' => 'Mille neuf cent trente-six',
            '1937' => 'Mille neuf cent trente-sept',
            '1938' => 'Mille neuf cent trente-huit',
            '1939' => 'Mille neuf cent trente-neuf',
            '1940' => 'Mille neuf cent quarante',
            '1941' => 'Mille neuf cent quarante et un',
            '1942' => 'Mille neuf cent quarante-deux',
            '1943' => 'Mille neuf cent quarante-trois',
            '1944' => 'Mille neuf cent quarante-quatre',
            '1945' => 'Mille neuf cent quarante-cinq',
            '1946' => 'Mille neuf cent quarante-six',
            '1947' => 'Mille neuf cent quarante-sept',
            '1948' => 'Mille neuf cent quarante-huit',
            '1949' => 'Mille neuf cent quarante-neuf',
            '1950' => 'Mille neuf cent cinquante',
            '1951' => 'Mille neuf cent cinquante et un',
            '1952' => 'Mille neuf cent cinquante-deux',
            '1953' => 'Mille neuf cent cinquante-trois',
            '1954' => 'Mille neuf cent cinquante-quatre',
            '1955' => 'Mille neuf cent cinquante-cinq',
            '1956' => 'Mille neuf cent cinquante-six',
            '1957' => 'Mille neuf cent cinquante-sept',
            '1958' => 'Mille neuf cent cinquante-huit',
            '1959' => 'Mille neuf cent cinquante-neuf',
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