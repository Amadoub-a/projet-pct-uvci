<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acte de Naissance - {{ $acteNaissance->numero_extrait }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 12px; /* Taille de police par défaut pour le corps */
            line-height: 1.4; /* Interligne légèrement réduit */
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .document-container {
            width: 21cm; /* Taille A4 standard */
            margin: 15px auto; /* Marge externe */
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 1.5cm 2cm; /* Marges internes pour le contenu */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            box-sizing: border-box;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-family: 'Merriweather', serif;
            font-size: 23px; /* Taille du titre principal */
            text-transform: uppercase;
            color: #000;
            margin-bottom: 8px;
            text-decoration: underline;
        }

        header p {
            font-size: 13px; /* Taille de police pour les paragraphes d'en-tête */
            margin-bottom: 4px;
        }

        .section-block {
            margin-bottom: 15px; /* Espacement entre les blocs de sections */
            padding-bottom: 10px;
            border-bottom: 1px dashed #eee; /* Ligne de séparation */
        }

        .info-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 100px; /* Largeur fixe pour aligner les libellés */
        }

        .text-emphasis {
            font-weight: bold;
            color: #000;
        }

        .official-stamp-text {
            text-align: center;
            margin: 25px 0 20px 0; /* Marge pour le texte officiel */
            font-style: italic;
            font-size: 13px;
            color: #444;
        }

        .mentions-block {
            margin-top: 30px; /* Marge au-dessus des mentions */
            padding-top: 15px;
            border-top: 1px solid #ddd; /* Ligne de séparation plus solide pour les mentions */
        }

        .mentions-block h2 {
            font-size: 16px; /* Taille du titre des mentions */
            text-align: center;
            margin-bottom: 15px;
            text-decoration: underline;
        }

        .mentions-block p {
            margin-bottom: 8px; /* Espacement entre les lignes de mention */
            font-size: 12px;
            line-height: 1.5; /* Plus d'espace pour écrire */
        }

        .signature-area {
            text-align: right;
            margin-top: 30px; /* Marge au-dessus de la signature */
            padding-top: 15px;
        }

        .signature-area p {
            margin-bottom: 4px;
            font-size: 13px;
        }

        .signature-area img {
            max-width: 160px; /* Taille de l'image de signature */
            height: auto;
            margin-top: 8px;
            display: block;
            margin-left: auto;
        }

        .logo-placeholder {
            float: left;
            width: 80px;
            height: 80px;
            border: 1px dashed #ccc;
            text-align: center;
            line-height: 80px;
            font-size: 10px;
            color: #888;
            margin-right: 15px;
            margin-top: -5px;
            box-sizing: border-box;
        }

        .cachet-placeholder {
            position: absolute;
            bottom: 35px; /* Position du cachet */
            left: 2cm;
            width: 100px;
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
            line-height: 1.2;
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
                padding: 1.5cm 2cm;
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
            <h1>Extrait d'Acte de Naissance</h1>
            <p>Du registre des actes de l'État Civil pour l'année <span class="text-emphasis">{{ \Carbon\Carbon::parse($acteNaissance->date_registre)->format('Y') }}</span></p>
        </header>

        <div class="row">
            <div class="col-5">
                <div class="section-block">
                    <p><span class="info-label">Centre de :</span> {{ $acteNaissance->lieuDelivrance->libelle_commune }}</p>
                    <p><span class="info-label">Sous-préfecture :</span> {{ $acteNaissance->lieuDelivrance->libelle_commune }}</p>
                    <p><span class="info-label">Circonscription :</span> {{ $acteNaissance->lieuDelivrance->libelle_commune }}</p>
                </div>
                <div class="section-block">
                    <p><span class="info-label">N° Extrait :</span> <span class="text-emphasis">{{ $acteNaissance->numero_extrait }}</span></p>
                    <p><span class="info-label">Date Registre :</span> <span class="text-emphasis">{{ \Carbon\Carbon::parse($acteNaissance->date_registre)->format('d/m/Y') }}</span></p>
                </div>
                <div class="section-block">
                    <p>Naissance de : <br> <span class="text-emphasis">{{ $acteNaissance->prenoms_enfant." ".$acteNaissance->nom_enfant }}</span></p>
                </div>
            </div>
            <div class="col-7">
                <p class="official-stamp-text">
                    <span class="text-emphasis">Le {{ $dateNaissanceEnWord }}</span>
                </p>
                <div class="section-block">
                    <p>Est né(e) <span class="text-emphasis">{{ $acteNaissance->prenoms_enfant }}</span> à <span class="text-emphasis">{{ $acteNaissance->commune->libelle_commune }}</span></p>
                    <p>{{ $acteNaissance->sexe == "F" ? "Fille de " : "Fils de " }} <span class="text-emphasis">{{ $acteNaissance->nom_pere." ".$acteNaissance->prenoms_pere }}</span></p>
                    <p>Nationalité : <span class="text-emphasis">{{ $acteNaissance->nationalite_pere }}</span></p>
                    <p>Et de <span class="text-emphasis">{{ $acteNaissance->nom_mere." ".$acteNaissance->prenoms_mere }}</span></p>
                    <p>Nationalité : <span class="text-emphasis">{{ $acteNaissance->nationalite_mere }}</span></p>
                </div>
            </div>
        </div>

        <div class="mentions-block">
            <h2>Mentions (éventuellement)</h2>
            <p>Marié(e) le .................................................................................................. à ................................................................................</p>
            <p>Avec .........................................................................................................................................................................................</p>
            <p>Mariage dissous par la décision de divorce en date de .........................................................................................</p>
            <p>Décédé(e) le ....................................................... à ................................................................................................................</p>
        </div>

        <p class="official-stamp-text">Certifie le présent extrait conforme aux indications portées aux registres.</p>

        <div class="signature-area">
            @isset($dateCopie)
                <p><em>Délivré à {{ $acteNaissance->lieuDelivrance->libelle_commune }}, le {{ \Carbon\Carbon::parse($dateCopie)->format('d/m/Y') }}</em></p>
            @else
                <p><em>Délivré à {{ $acteNaissance->lieuDelivrance->libelle_commune }}, le {{ \Carbon\Carbon::parse($acteNaissance->date_delivrance)->format('d/m/Y') }}</em></p>
            @endif 
            <p><strong>L'Officier de l'État Civil</strong></p>

            @if($acteNaissance->signature)
                @isset($signatureCopie)
                    <img src="{{ public_path($signatureCopie) }}" alt="Signature">
                @else
                    <img src="{{ public_path($acteNaissance->signature) }}" alt="Signature">
                @endif
            @else
            <p><em>[Espace pour la signature manuelle ou numérique]</em></p>
            @endif
        </div>

        <div class="cachet-placeholder">
            <img src="{{ public_path("/timbre.jpg") }}" alt="Timbre">
        </div>
    </div>
</body>
</html>