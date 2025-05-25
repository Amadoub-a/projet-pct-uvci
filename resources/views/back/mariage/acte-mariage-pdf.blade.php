<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acte de Mariage - {{ $acteMariage->numero_extrait }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 12px; /* Augmenté légèrement */
            line-height: 1.4; /* Augmenté légèrement pour la lisibilité */
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .document-container {
            width: 21cm;
            margin: 15px auto; /* Marge externe un peu plus grande */
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 1.5cm 2cm; /* Marges internes augmentées */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légèrement plus prononcée */
            position: relative;
            box-sizing: border-box;
        }

        header {
            text-align: center;
            margin-bottom: 20px; /* Marge sous l'en-tête augmentée */
        }

        header h1 {
            font-family: 'Merriweather', serif;
            font-size: 23px; /* Taille du titre augmentée */
            text-transform: uppercase;
            color: #000;
            margin-bottom: 8px; /* Marge légèrement augmentée */
            text-decoration: underline;
        }

        header p {
            font-size: 13px; /* Taille de police pour les paragraphes de l'en-tête augmentée */
            margin-bottom: 4px;
        }

        .section-block {
            margin-bottom: 15px; /* Espacement entre les sections augmenté */
            padding-bottom: 10px; /* Padding légèrement augmenté */
            border-bottom: 1px dashed #eee;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 100px; /* Largeur pour les libellés ajustée */
        }

        .main-details strong {
            font-size: 14px; /* Taille pour les noms des époux augmentée */
        }

        .text-emphasis {
            font-weight: bold;
            color: #000;
        }

        .official-stamp-text {
            text-align: center;
            margin: 25px 0 20px 0; /* Marge supérieure et inférieure augmentées */
            font-style: italic;
            font-size: 13px; /* Taille de police augmentée */
            color: #444;
        }

        .signature-area {
            text-align: right;
            margin-top: 30px; /* Marge supérieure augmentée */
            padding-top: 15px; /* Padding légèrement augmenté */
        }

        .signature-area p {
            margin-bottom: 4px;
            font-size: 13px; /* Taille de police augmentée */
        }

        .signature-area img {
            max-width: 160px; /* Taille maximale de la signature augmentée */
            height: auto;
            margin-top: 8px; /* Marge légèrement augmentée */
            display: block;
            margin-left: auto;
        }

        .logo-placeholder {
            float: left;
            width: 80px; /* Taille du logo augmentée */
            height: 80px;
            border: 1px dashed #ccc;
            text-align: center;
            line-height: 80px;
            font-size: 10px;
            color: #888;
            margin-right: 15px;
            margin-top: -5px; /* Ajusté légèrement */
            box-sizing: border-box;
        }

        .cachet-placeholder {
            position: absolute;
            bottom: 35px; /* Remonté pour prendre moins de place en bas */
            left: 2cm; /* Aligné avec la marge de gauche */
            width: 100px; /* Taille du cachet augmentée */
            height: 100px;
            border: 2px dashed #bbb;
            border-radius: 50%;
            text-align: center;
            line-height: 90px;
            font-size: 10px;
            color: #888;
            box-sizing: border-box;
            opacity: 0.7;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 5px;
        }

        .cachet-placeholder span {
            display: block;
            line-height: 1.2; /* Interligne ajusté pour le cachet */
        }

        /* Styles spécifiques pour l'impression PDF */
        @media print {
            body {
                background-color: #fff;
                -webkit-print-color-adjust: exact;
            }

            .document-container {
                margin: 0;
                border: none;
                box-shadow: none;
                width: 100%;
                min-height: auto;
                padding: 1.5cm 2cm; /* Marge d'impression finale augmentée */
            }

            .logo-placeholder,
            .cachet-placeholder {
                border-color: #888;
            }
        }
    </style>
</head>

<body>
    <div class="document-container">
        <div class="logo-placeholder">
            Logo Ici
        </div>
        <header>
            <p><strong>République de Côte d'Ivoire</strong></p>
            <p><strong>Union - Discipline - Travail</strong></p>
            <p>***</p>
            <h1>Extrait d'Acte de Mariage</h1>
            <p>Du registre des actes de l'État Civil pour l'année <span class="text-emphasis">{{ \Carbon\Carbon::parse($acteMariage->date_registre)->format('Y') }}</span></p>
        </header>

        <div class="row">
            <div class="col-5">
                <div class="section-block">
                    <p><span class="info-label">Centre de :</span> {{ $acteMariage->lieuDelivrance->libelle_commune }}</p>
                    <p><span class="info-label">Sous-préfecture :</span> {{ $acteMariage->lieuDelivrance->libelle_commune }}</p>
                    <p><span class="info-label">Circonscription :</span> {{ $acteMariage->lieuDelivrance->libelle_commune }}</p>
                </div>
                <div class="section-block">
                    <p><span class="info-label">N° Extrait :</span> <span class="text-emphasis">{{ $acteMariage->numero_extrait }}</span></p>
                    <p><span class="info-label">Date Registre :</span> <span class="text-emphasis">{{ \Carbon\Carbon::parse($acteMariage->date_registre)->format('d/m/Y') }}</span></p>
                </div>
                <div class="section-block main-details">
                    <p>
                        Mariage entre :<br>
                        <span class="text-emphasis">{{ $acteMariage->prenoms_epoux." ".$acteMariage->nom_epoux }}</span><br>
                        Et :<br>
                        <span class="text-emphasis">{{ $acteMariage->prenoms_epouse." ".$acteMariage->nom_epouse }}</span>
                    </p>
                </div>
            </div>
            <div class="col-7">
                <p class="official-stamp-text">
                    <span class="text-emphasis">Le {{ $dateMariageEnWord }}</span>, a eu lieu la célébration du mariage entre :
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="section-block">
                            <p>
                                <span class="text-emphasis">{{ $acteMariage->prenoms_epoux." ".$acteMariage->nom_epoux }}</span> né le
                                <span class="text-emphasis">{{ \Carbon\Carbon::parse($acteMariage->date_naissance_epoux)->format('d/m/Y') }}</span> à
                                <span class="text-emphasis">{{ $acteMariage->lieu_naissance_epoux }}</span>, de profession
                                <span class="text-emphasis">{{ $acteMariage->profession_epoux ?? "Néant" }}</span>.
                            </p>
                            <p class="mt-2"> Et
                            </p>
                            <p>
                                <span class="text-emphasis">{{ $acteMariage->prenoms_epouse." ".$acteMariage->nom_epouse }}</span> née le
                                <span class="text-emphasis">{{ \Carbon\Carbon::parse($acteMariage->date_naissance_epouse)->format('d/m/Y') }}</span> à
                                <span class="text-emphasis">{{ $acteMariage->lieu_naissance_epouse }}</span>, de profession
                                <span class="text-emphasis">{{ $acteMariage->profession_epouse ?? "Néant"}}</span>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="official-stamp-text">Certifie le présent extrait conforme aux indications portées aux registres.</p>
        <div class="signature-area">
            <i>Délivré à {{ $acteMariage->lieuDelivrance->libelle_commune }}, le {{ \Carbon\Carbon::parse($acteMariage->date_delivrance)->format('d/m/Y') }}</i>
            <p><strong>L'Officier de l'État Civil</strong></p>
            @if($acteMariage->signature)
            <img src="{{ public_path($acteMariage->signature) }}" alt="Signature">
            @else
            <p><em>[Espace pour la signature manuelle ou numérique]</em></p>
            @endif
        </div>

        <div class="cachet-placeholder">
            <span>Cachet</span>
            <span>Officiel</span>
        </div>
    </div>
</body>

</html>