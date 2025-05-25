<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acte de Naissance - {{ $acteNaissance->numero_extrait }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="p-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p>République de Côte d'Ivoire</p>
                <p class="text-center"><strong>Etat Civil</strong></p>
                <p class="text-center">Sous préfecture de : <br>{{ $acteNaissance->lieuDelivrance->libelle_commune }}</p>
                <p class="text-center">Circonscription de : <br> {{ $acteNaissance->lieuDelivrance->libelle_commune }}</p>
                <hr>
                <p class="text-center"> Centre de : {{ $acteNaissance->lieuDelivrance->libelle_commune }}</p>
                <p>N° {{ $acteNaissance->numero_extrait }} DU {{ \Carbon\Carbon::parse($acteNaissance->date_registre)->format('d/m/Y') }} du registre</p>
                <hr>
                <p>Naissance de : <br> {{ $acteNaissance->prenoms_enfant." ".$acteNaissance->nom_enfant }}</p>
            </div>
            <div class="col-md-8">
                <h1>EXTRAIT DE NAISSANCE</h1>
                <p>du Registre des actes de l'Etat Civil pour l'année {{ \Carbon\Carbon::parse($acteNaissance->date_registre)->format('Y') }}</p>
                <p> <strong>Le {{ $dateNaissanceEnWord }}</strong></p>
                <p>est né {{ $acteNaissance->prenoms_enfant }} à {{ $acteNaissance->commune->libelle_commune }}</p>
                <p>{{ $acteNaissance->sexe == "F" ? "fille de " : "fils de ".$acteNaissance->nom_pere." ".$acteNaissance->prenoms_pere }}</p>
                <p>Nationalité : {{ $acteNaissance->nationalite_pere }}</p>
                <p>et de {{ $acteNaissance->nom_mere." ".$acteNaissance->prenoms_mere }}</p>
                <p>Nationalité : {{ $acteNaissance->nationalite_mere }}</p>
            </div>
        </div>

        <div class="row">
            <p class="text-center h2">Mentions (éventuellement)</p>
            <hr>
            <p>Marié le .................................................................................................. à ................................................................................</p>
            <p>Avec .........................................................................................................................................................................................</p>
            <p>Mariage dissous par la décision de divorce en date de .........................................................................................</p>
            <p>Décédé le ....................................................... à ................................................................................................................</p>
        </div>
    </div>
    <p class="text-center m-5">Certifie le présent extrait conforme aux indications portées aux registres</p>
    
    <div class="text-end">
        <i>Délivré à {{ $acteNaissance->lieuDelivrance->libelle_commune }}, le {{ \Carbon\Carbon::parse($acteNaissance->date_delivrance)->format('d/m/Y') }}</i>
        <p>L'Officier de l'Etat Civil</p>
        <p>(Signature) <br>
            @if($acteNaissance->signature)
                <div>
                    <img src="{{ public_path($acteNaissance->signature) }}" alt="Signature" width="200" height="100">
                </div>
            @else
                <p>Signature non fournie.</p>
            @endif
        </p>
    </div>
</body>
</html>
