@extends(
'site.layout',
[
'title' => "État Civil Côte d'Ivoire - Copie d'acte",
]
)
@section('content-front')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Demande de Copie d'Acte</h1>
        <p class="lead mb-4">
            Remplissez ce formulaire pour obtenir une copie certifiée de votre acte d'état civil
        </p>

        <div class="card mt-4 mb-5">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-list-ul me-2 text-success"></i>Documents requis pour la demande</h5>
            </div>
            <div class="card-body">
                <p>Pour compléter votre demande de copie d'acte, les documents suivants peuvent être nécessaires :</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièce d'identité du demandeur (CNI, passeport ou permis de conduire)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Justificatif de filiation ou d'intérêt légitime (si vous n'êtes pas la personne concernée par l'acte)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Informations sur l'acte demandé (date, lieu, numéro d'acte si connu)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Procuration (si vous faites la demande pour une tierce personne)</li>
                </ul>
                <div class="alert alert-info mt-3 mb-0">
                    <i class="fas fa-info-circle me-2"></i>Note : Les copies d'actes sont délivrées immédiatement après vérification de votre demande. Vous pouvez choisir de recevoir votre document par voie électronique ou par courrier postal.
                </div>
            </div>
        </div>
    </div>
</section>
@auth
<!-- Form Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4">Formulaire de Demande de Copie d'Acte</h2>
                    <p class="text-center text-muted mb-4">Veuillez remplir tous les champs obligatoires (*)</p>
                    <div id="loader" class="loader"></div>
                    <form onsubmit="showLoader()" enctype="multipart/form-data" method="post" action="{{route('store-copie-acte')}}">
                        <!-- Type d'acte demandé -->
                        @csrf
                        <h4 class="mb-3 mt-4 text-success">Type d'acte demandé</h4>
                        <div class="mb-4">
                            <label class="form-label">Sélectionnez le type d'acte dont vous souhaitez obtenir une copie *</label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input @error('type_acte') is-invalid @enderror"
                                        type="radio" name="type_acte" id="acte_naissance" value="naissance"
                                        {{ old('type_acte') == 'naissance' ? 'checked' : '' }} checked>
                                    <label class="form-check-label" for="acte_naissance">
                                        Acte de naissance
                                    </label>
                                </div>
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input @error('type_acte') is-invalid @enderror"
                                        type="radio" name="type_acte" id="acte_mariage" value="mariage"
                                        {{ old('type_acte') == 'mariage' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="acte_mariage">
                                        Acte de mariage
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input @error('type_acte') is-invalid @enderror"
                                        type="radio" name="type_acte" id="acte_deces" value="deces"
                                        {{ old('type_acte') == 'deces' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="acte_deces">
                                        Acte de décès
                                    </label>
                                </div>
                            </div>
                            <em class="error invalid-feedback">Veillez sélectionner un type d'acte</em>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Type de copie souhaitée *</label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input @error('type_copie') is-invalid @enderror" type="radio" name="type_copie" id="copie_integrale" value="integrale" {{ old('type_acte') == 'integrale' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="copie_integrale">
                                        Copie intégrale
                                    </label>
                                </div>
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input @error('type_copie') is-invalid @enderror" checked type="radio" name="type_copie" id="extrait" value="extrait" {{ old('type_acte') == 'extrait' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="extrait">
                                        Extrait simple
                                    </label>
                                </div>
                            </div>
                            <em class="error invalid-feedback">Veillez sélectionner un type de copie</em>
                        </div>

                        <!-- Informations sur l'acte -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur l'acte</h4>
                        <div class="row">
                            <div class="mb-3">
                                <label for="numero_acte" class="form-label">Numéro d'acte (Numéro, date du registre et comune/sous prefecture) *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-hashtag"></i>
                                    </span>
                                    <input type="text" class="form-control @error('numero_acte') is-invalid @enderror" id="numero_acte" name="numero_acte" placeholder="85655 du 12/05/2025 à Daloa" value="{{ old('numero_acte') }}">
                                    <em class="error invalid-feedback">Le numéro d'acte est obligatoire</em>
                                </div>
                            </div>
                        </div>
                        <!-- Section pour acte de naissance -->
                        <div id="section_naissance">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom_enfant" class="form-label">Nom de famille *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nom_enfant') is-invalid @enderror" id="nom_enfant" name="nom_enfant" value="{{ old('nom_enfant') }}" placeholder="Nom de famille de l'enfant">
                                        <em class="error invalid-feedback">Le nom de famille est obligatoire</em>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenoms_enfant" class="form-label">Prénoms *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('prenoms_enfant') is-invalid @enderror" id="prenoms_enfant" name="prenoms_enfant" value="{{ old('prenoms_enfant') }}" placeholder="Prénoms de l'enfant">
                                        <em class="error invalid-feedback">Le prénom est obligatoire</em>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_naissance_enfant" class="form-label">Date de naissance *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                        <input type="date" class="form-control @error('date_naissance_enfant') is-invalid @enderror" id="date_naissance_enfant" value="{{ old('date_naissance_enfant') }}" name="date_naissance_enfant">
                                        <em class="error invalid-feedback">La date de naissance est obligatoire</em>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="lieu_naissance" class="form-label">
                                        Lieu de naissance*
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <select class="form-select  @error('lieu_naissance') is-invalid @enderror" id="lieu_naissance" name="lieu_naissance">
                                            <option value="" disabled {{ old('lieu_naissance') ? '' : 'selected' }}>Sélectionnez une ville ou commune</option>
                                            @foreach ($communes as $commune)
                                            <option value="{{ $commune->id }}" {{ old('lieu_naissance') == $commune->id ? 'selected' : '' }}>
                                                {{ $commune->libelle_commune }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <em class="error invalid-feedback">Veillez sélectionner une commune</em>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section pour acte de mariage -->
                        <div id="section_mariage" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom_complet_epoux" class="form-label">Nom et prénoms de l'époux *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nom_complet_epoux') is-invalid @enderror" id="nom_complet_epoux" name="nom_complet_epoux" value="{{ old('nom_complet_epoux') }}" placeholder="Nom et prénoms de l'époux">
                                        <em class="error invalid-feedback">Le nom complet de l'époux est obligatoire</em>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nom_complet_epouse" class="form-label">Nom et prénoms de l'épouse *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nom_complet_epouse') is-invalid @enderror" id="nom_complet_epouse" name="nom_complet_epouse" value="{{ old('nom_complet_epouse') }}" placeholder="Nom et prénoms de l'épouse">
                                        <em class="error invalid-feedback">Le nom complet de l'épouse est obligatoire</em>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_mariage" class="form-label">Date du mariage *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                        <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" name="date_mariage" id="date_mariage" value="{{ old('date_mariage') }}">
                                        <em class="error invalid-feedback">La date du mariage est obligatoire</em>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lieu_mariage" class="form-label">Lieu du mariage *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <select class="form-select  @error('lieu_mariage') is-invalid @enderror" id="lieu_mariage" name="lieu_mariage">
                                            <option value="" disabled {{ old('lieu_mariage') ? '' : 'selected' }}>Sélectionnez une ville ou commune</option>
                                            @foreach ($communes as $commune)
                                            <option value="{{ $commune->id }}" {{ old('lieu_mariage') == $commune->id ? 'selected' : '' }}>
                                                {{ $commune->libelle_commune }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <em class="error invalid-feedback">Veillez sélectionner une commune</em>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section pour acte de décès -->
                        <div id="section_deces" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom_defunt" class="form-label">Nom de famille du défunt *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nom_defunt') is-invalid @enderror" id="nom_defunt" name="nom_defunt" value="{{ old('nom_defunt') }}" placeholder="Nom de famille">
                                        <em class="error invalid-feedback">Le nom du défunt est obligatoire</em>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenoms_defunt" class="form-label">Prénoms du défunt *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('prenoms_defunt') is-invalid @enderror" id="prenoms_defunt" name="prenoms_defunt" value="{{ old('nom_defunt') }}" placeholder="Prénoms">
                                        <em class="error invalid-feedback">Le prénoms du défunt est obligatoire</em>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_deces" class="form-label">Date du décès *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                        <input type="date" class="form-control @error('date_deces') is-invalid @enderror" id="date_deces" name="date_deces" value="{{ old('date_deces') }}">
                                        <em class="error invalid-feedback">La date du décès est obligatoire</em>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lieu_deces" class="form-label">Lieu du décès *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <select class="form-select  @error('lieu_deces') is-invalid @enderror" id="lieu_deces" name="lieu_deces">
                                            <option value="" disabled {{ old('lieu_deces') ? '' : 'selected' }}>Sélectionnez une ville ou commune</option>
                                            @foreach ($communes as $commune)
                                            <option value="{{ $commune->id }}" {{ old('lieu_deces') == $commune->id ? 'selected' : '' }}>
                                                {{ $commune->libelle_commune }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <em class="error invalid-feedback">Veillez sélectionner une commune</em>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informations sur le demandeur -->
                    
                        <h4 class="mb-3 mt-4 text-success">Informations sur le demandeur</h4>
                        <div class="mb-3">
                            <label class="form-label">Vous êtes : *</label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input " type="radio" name="demander_par" id="demandeur_concerne" value="concerne" {{ old('demander_par') == 'concerne' ? 'checked' : '' }} checked>
                                    <label class="form-check-label  @error('demander_par') is-invalid @enderror" for="demandeur_concerne">
                                        La personne concernée par l'acte
                                    </label>
                                </div>
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input @error('demander_par') is-invalid @enderror" type="radio" name="demander_par" id="demandeur_parent" value="parent" {{ old('demander_par') == 'parent' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="demandeur_parent">
                                        Parent direct (père, mère, enfant)
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input @error('demander_par') is-invalid @enderror" type="radio" name="demander_par" id="demandeur_autre" value="autre" {{ old('demander_par') == 'autre' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="demandeur_autre">
                                        Autre personne autorisée
                                    </label>
                                </div>
                            </div>
                            <em class="error invalid-feedback">Veillez faire un choix</em>
                        </div>
                        <div class="row infos-demandeur">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom_demandeur" class="form-label">Nom de famille *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nom_demandeur') is-invalid @enderror" id="nom_demandeur" name="nom_demandeur" placeholder="Nom de famille" value="{{ old('nom_demandeur') }}">
                                        <em class="error invalid-feedback">Le nom du demandeur est obligatoire</em>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenom_demandeur" class="form-label">Prénoms *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('prenom_demandeur') is-invalid @enderror" id="prenom_demandeur" name="prenom_demandeur" placeholder="Prénoms" value="{{ old('prenom_demandeur') }}">
                                        <em class="error invalid-feedback">Le prenom du demandeur est obligatoire</em>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email_demandeur" class="form-label">Adresse e-mail </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" id="email_demandeur" name="email_demandeur" placeholder="exemple@email.com" value="{{ old('email_demandeur') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_demandeur" class="form-label">Numéro de téléphone *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="tel" class="form-control @error('contact_demandeur') is-invalid @enderror" id="contact_demandeur" name="contact_demandeur" placeholder="+225 XXXXXXXXXX" value="{{ old('contact_demandeur') }}">
                                        <em class="error invalid-feedback">Le contact du demandeur est obligatoire</em>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="adresse_demandeur" class="form-label">Adresse *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-home"></i>
                                    </span>
                                    <input type="text" class="form-control @error('adresse_demandeur') is-invalid @enderror" id="adresse_demandeur" name="adresse_demandeur" placeholder="Adresse complète" value="{{ old('adresse_demandeur') }}">
                                    <em class="error invalid-feedback">L'adresse du demandeur est obligatoire</em>
                                </div>
                            </div>
                        </div>
                        <!-- Documents justificatifs -->
                        <h4 class="mb-3 mt-4 text-success">Documents justificatifs</h4>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Veuillez télécharger les documents suivants au format PDF, JPG ou PNG. Taille maximale : 5 Mo par fichier.
                        </div>

                        <div class="mb-3">
                            <label for="piece_identite_demandeur" class="form-label">Pièce d'identité du demandeur *</label>
                            <input type="file" class="form-control @error('piece_identite_demandeur') is-invalid @enderror" id="piece_identite_demandeur" name="piece_identite_demandeur" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">La pièce d'identité du demandeur est obligatoire</em>
                        </div>

                        <div id="section_justificatif_lien" style="display: none;">
                            <div class="mb-3">
                                <label for="justificatif_lien" class="form-label">Justificatif de lien de parenté ou d'intérêt légitime *</label>
                                <input type="file" class="form-control @error('justificatif_lien') is-invalid @enderror" id="justificatif_lien" name="justificatif_lien" accept=".pdf,.jpg,.jpeg,.png">
                                <em class="error invalid-feedback">Ce document est obligatoire</em>
                            </div>
                        </div>

                        <div id="section_procuration" style="display: none;">
                            <div class="mb-3">
                                <label for="procuration" class="form-label">Procuration *</label>
                                <input type="file" class="form-control @error('procuration') is-invalid @enderror" id="procuration" name="procuration" accept=".pdf,.jpg,.jpeg,.png">
                                <em class="error invalid-feedback">Ce document est obligatoire</em>
                            </div>
                        </div>

                        <!-- Déclaration sur l'honneur -->
                        <div class="mb-4 mt-4">
                            <div class="form-check">
                                <input class="form-check-input @error('declaration_honneur') is-invalid @enderror" type="checkbox" id="declaration_honneur" name="declaration_honneur">
                                <label class="form-check-label" for="declaration_honneur">
                                    Je certifie sur l'honneur l'exactitude des informations fournies et des documents joints. Je suis conscient(e) que toute fausse déclaration est passible de poursuites judiciaires. *
                                </label>
                            </div>
                            <em class="error invalid-feedback">Vous devez accepeter la d&eacute;claration d'honneure</em>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-cta btn-lg">Soumettre la demande</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showLoader() {
        document.getElementById('loader').style.display = 'flex';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('input[name="type_acte"]');
        const sections = {
            naissance: document.getElementById('section_naissance'),
            mariage: document.getElementById('section_mariage'),
            deces: document.getElementById('section_deces')
        };

        function showSection(type) {
            for (const key in sections) {
                sections[key].style.display = 'none';
            }
            if (sections[type]) {
                sections[type].style.display = 'block';
            }
        }

        // Affiche la section sélectionnée lors du chargement si old() est défini
        const selected = document.querySelector('input[name="type_acte"]:checked');
        if (selected) {
            showSection(selected.value);
        }

        // Met à jour l'affichage quand on change de type d'acte
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                showSection(this.value);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const radiosDemandeur = document.querySelectorAll('input[name="demander_par"]');

        const sectionLien = document.getElementById('section_justificatif_lien');
        const sectionProcuration = document.getElementById('section_procuration');
        const sectionInfosDemandeur = document.querySelectorAll('.infos-demandeur');

        function toggleSections(value) {
            // Réinitialisation
            sectionLien.style.display = 'none';
            sectionProcuration.style.display = 'none';
            sectionInfosDemandeur.forEach(el => el.style.display = 'block');

            if (value === 'parent') {
                sectionLien.style.display = 'block';
            } else if (value === 'autre') {
                sectionProcuration.style.display = 'block';
            } else if (value === 'concerne') {
                sectionInfosDemandeur.forEach(el => el.style.display = 'none');
            }
        }

        // Détecte la sélection initiale (old value)
        const selected = document.querySelector('input[name="demander_par"]:checked');
        if (selected) toggleSections(selected.value);

        // Écoute les changements
        radiosDemandeur.forEach(radio => {
            radio.addEventListener('change', function() {
                toggleSections(this.value);
            });
        });
    });
</script>
@endauth
@endsection