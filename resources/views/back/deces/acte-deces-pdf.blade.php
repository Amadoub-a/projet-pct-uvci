<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acte de Décès - {{ $acteDeces->numero_extrait }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Police principale pour le corps du texte */
            font-size: 13px; /* Légèrement réduit pour une meilleure densité sur PDF */
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* Couleur de fond légère pour le contraste */
        }
        .document-container {
            width: 21cm; /* Taille A4 standard pour le PDF */
            min-height: 29.7cm; /* Hauteur A4 */
            margin: 20px auto; /* Centrer le document */
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 2.5cm; /* Marges intérieures généreuses pour l'impression */
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Ombre subtile */
            position: relative;
        }
        header, footer {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            font-family: 'Merriweather', serif; /* Police plus formelle pour le titre */
            font-size: 24px;
            text-transform: uppercase;
            color: #000;
            margin-bottom: 5px;
            text-decoration: underline;
        }
        header p {
            font-size: 15px;
            margin-bottom: 0;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .info-block p {
            margin-bottom: 5px;
        }
        .info-block strong {
            color: #000;
        }
        .main-content {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .main-content p {
            font-size: 15px;
            margin-bottom: 10px;
        }
        .signature-block {
            text-align: right;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px dashed #ddd; /* Ligne pointillée avant la signature */
        }
        .signature-block p {
            margin-bottom: 5px;
        }
        .signature-block img {
            max-width: 180px; /* Taille maximale pour la signature */
            height: auto;
            margin-top: 10px;
            display: block; /* Pour centrer si nécessaire ou aligner */
            margin-left: auto; /* Aligner à droite */
        }
        .text-center-line {
            text-align: center;
            margin: 20px 0;
            font-style: italic;
        }
        .logo-placeholder {
            float: left; /* Pour placer le logo à gauche de l'en-tête */
            width: 100px; /* Exemple de taille pour le logo */
            height: 100px;
            border: 1px dashed #ccc;
            text-align: center;
            line-height: 100px;
            font-size: 12px;
            color: #888;
            margin-right: 20px;
            margin-top: -10px; /* Ajuster la position */
            box-sizing: border-box; /* Inclure padding et border dans la largeur/hauteur */
        }
        .cachet-placeholder {
            position: absolute; /* Positionnement absolu pour le cachet */
            bottom: 60px; /* Ajuster la position verticale */
            left: 2.5cm; /* Aligner avec la marge gauche */
            width: 120px;
            height: 120px;
            border: 2px dashed #bbb;
            border-radius: 50%; /* Forme circulaire pour un cachet */
            text-align: center;
            line-height: 110px;
            font-size: 12px;
            color: #888;
            box-sizing: border-box;
            opacity: 0.7; /* Légèrement transparent pour un cachet */
        }

        /* Styles spécifiques pour l'impression PDF */
        @media print {
            body {
                background-color: #fff;
                -webkit-print-color-adjust: exact; /* Pour conserver les couleurs de fond */
            }
            .document-container {
                margin: 0;
                border: none;
                box-shadow: none;
                width: 100%;
                min-height: auto;
                padding: 2.5cm;
            }
            .logo-placeholder, .cachet-placeholder {
                border-color: #888; /* Rendre les bordures des placeholders plus visibles à l'impression */
            }
        }
    </style>
</head>
<body class="p-4">
    <div class="document-container">
        <div class="logo-placeholder">
            Logo ici
        </div>

        <header>
            <p><strong>République de Côte d'Ivoire</strong></p>
            <p><strong>Union - Discipline - Travail</strong></p>
            <p><strong>---</strong></p>
            <h1>Extrait d'acte de décès</h1>
            <p>Du registre des actes de l'État civil pour l'année <strong>{{ \Carbon\Carbon::parse($acteDeces->date_registre)->format('Y') }}</strong>.</p>
        </header>

        <div class="row main-content">
            <div class="col-6">
                <div class="info-block">
                    <p><strong>Centre de :</strong> {{ $acteDeces->lieuDelivrance->libelle_commune }}</p>
                    <p><strong>Sous-préfecture de :</strong> {{ $acteDeces->lieuDelivrance->libelle_commune }}</p>
                    <p><strong>Circonscription de :</strong> {{ $acteDeces->lieuDelivrance->libelle_commune }}</p>
                    <p><strong>N° Extrait :</strong> {{ $acteDeces->numero_extrait }}</p>
                    <p><strong>Date Registre :</strong> {{ \Carbon\Carbon::parse($acteDeces->date_registre)->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="info-block">
                    <p><strong>Décédé(e) :</strong> {{ $acteDeces->prenoms_defunt }} {{ $acteDeces->nom_defunt }}</p>
                    <p><strong>Le :</strong> {{ $dateDecesEnWord }}</p>
                    <p><strong>À :</strong> {{ $acteDeces->commune->libelle_commune }}</p>
                </div>
            </div>
        </div>

        <p class="text-center-line">Certifié conforme aux indications portées sur les registres.</p>

        <div class="signature-block">
            <p><em>Délivré à {{ $acteDeces->lieuDelivrance->libelle_commune }}, le {{ \Carbon\Carbon::parse($acteDeces->date_delivrance)->format('d/m/Y') }}</em></p>
            <p><strong>L'Officier de l'État Civil</strong></p>

            @if($acteDeces->signature)
                <img src="{{ public_path($acteDeces->signature) }}" alt="Signature">
            @else
                <p><em>[Espace pour la signature manuelle ou numérique]</em></p>
            @endif
        </div>

        <div class="cachet-placeholder">
            Cachet Officiel
        </div>
    </div>
</body>
</html>