@extends(
'site.layout',
[
'title' => "État Civil Côte d'Ivoire - Naissance",
]
)
@section('content-front')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Déclaration d'Acte de Naissance</h1>
        <p class="lead mb-4">
            Remplissez ce formulaire pour déclarer une naissance et obtenir un acte de naissance officiel
        </p>

        <div class="card mt-4 mb-5">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-list-ul me-2 text-success"></i>Documents requis pour la déclaration</h5>
            </div>
            <div class="card-body">
                <p>Pour compléter votre déclaration de naissance, les documents suivants sont nécessaires :</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Certificat de naissance délivré par l'établissement de santé</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièce d'identité du père (CNI, passeport ou permis de conduire)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièce d'identité de la mère (CNI, passeport ou permis de conduire)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Livret de famille (si disponible)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Certificat de mariage des parents (si mariés)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièce d'identité du déclarant (si différent des parents)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Procuration (si le déclarant n'est pas l'un des parents)</li>
                </ul>
                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Note : La déclaration doit être faite dans les 30 jours suivant la naissance. Au-delà de ce délai, une procédure judiciaire sera nécessaire.
                </div>
                @guest
                <h4 class="mt-4">Prêt à faire votre demande ?</h4>
                <p class="lead mb-4">
                    Créez votre compte en quelques clics et accédez à tous nos services en
                    ligne
                </p>
                <a href="{{ route(name: 'sign-up') }}" class="btn btn-cta btn-lg px-5">S'inscrire maintenant</a>
                <p class="mt-3">Déjà inscrit ? <a href="{{ route(name: 'sign-in') }}">Connectez-vous</a></p>
                @endguest
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
                    <h2 class="text-center mb-4">Formulaire de Déclaration de Naissance</h2>
                    <p class="text-center text-muted mb-4">Veuillez remplir tous les champs obligatoires (*)</p>
                    <div id="loader" class="loader"></div>
                    <form onsubmit="showLoader()" enctype="multipart/form-data" method="post" action="{{route('send-declaration-naissance')}}">
                        @csrf
                        <!-- Informations sur l'enfant -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur l'enfant</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_enfant" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom_enfant') is-invalid @enderror" id="nom_enfant" name="nom_enfant" value="{{ old('nom_enfant') }}" placeholder="Nom de famille">
                                    <em class="error invalid-feedback">Le nom de famille de l'enfant est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_enfant" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('prenoms_enfant') is-invalid @enderror" id="prenoms_enfant" name="prenoms_enfant" value="{{ old('prenoms_enfant') }}" placeholder="Prénoms">
                                    <em class="error invalid-feedback">Les ou le pr&eacute;nom(s) de l'enfant sont/est obligatoire(s)</em>
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
                                    <input type="date" class="form-control @error('date_naissance_enfant') is-invalid @enderror" id="date_naissance_enfant" name="date_naissance_enfant" value="{{ old('date_naissance_enfant') }}">
                                    <em class="error invalid-feedback">La date de naissance de l'enfant est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="heure_naissance_enfant" class="form-label">Heure de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    <input type="time" class="form-control @error('heure_naissance_enfant') is-invalid @enderror" id="heure_naissance_enfant" name="heure_naissance_enfant" value="{{ old('heure_naissance_enfant') }}">
                                    <em class="error invalid-feedback">L'heure de naissance de l'enfant est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_enfant" class="form-label">Lieu de naissance (ville) *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control @error('lieu_naissance_enfant') is-invalid @enderror" id="lieu_naissance_enfant" name="lieu_naissance_enfant" value="{{ old('lieu_naissance_enfant') }}" placeholder="Commune ou sous préfecture">
                                    <em class="error invalid-feedback">Le lieu de naissance de l'enfant est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etablissement_naissance_enfant" class="form-label">Établissement de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-hospital"></i>
                                    </span>
                                    <input type="text" class="form-control @error('etablissement_naissance_enfant') is-invalid @enderror" id="etablissement_naissance_enfant" name="etablissement_naissance_enfant" value="{{ old('etablissement_naissance_enfant') }}" placeholder="Hôpital, clinique, domicile, etc.">
                                    <em class="error invalid-feedback">L'&eacute;tablissement de naissance de l'enfant est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sexe *</label>
                                <div class="d-flex">
                                    <div class="form-check me-4">
                                        <input class="form-check-input @error('sexe_enfant') is-invalid @enderror" type="radio" name="sexe_enfant" id="sexe_masculin" value="M" {{ old('sexe_enfant', 'M') == 'M' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sexe_masculin">
                                            Masculin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('sexe_enfant') is-invalid @enderror" type="radio" name="sexe_enfant" id="sexe_feminin" value="F" {{ old('sexe_enfant', 'M') == 'F' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sexe_feminin">
                                            Féminin
                                        </label>
                                    </div>
                                </div>
                                <em class="error invalid-feedback">Vous devez choisir un sexe</em>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_enfant" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select @error('nationalite_enfant') is-invalid @enderror" id="nationalite_enfant" name="nationalite_enfant">
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne" {{ old('nationalite_enfant') == 'ivoirienne' ? 'selected' : '' }}>Ivoirienne</option>
                                        <option value="autre" {{ old('nationalite_enfant') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    <em class="error invalid-feedback">Vous devez sélectionner un sexe</em>
                                </div>
                            </div>
                        </div>

                        <!-- Informations sur le père -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le père</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_pere" class="form-label">Nom de famille </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_pere" name="nom_pere" value="{{ old('nom_pere') }}" placeholder="Nom de famille">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_pere" class="form-label">Prénoms </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_pere" name="prenoms_pere" value="{{ old('prenoms_pere') }}" placeholder="Prénoms">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_pere" class="form-label">Date de naissance </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="date_naissance_pere" name="date_naissance_pere" value="{{ old('date_naissance_pere') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_pere" class="form-label">Lieu de naissance </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance_pere" name="lieu_naissance_pere" value="{{ old('lieu_naissance_pere') }}" placeholder="Ville de naissance">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_pere" class="form-label">Nationalité </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite_pere" name="nationalite_pere" value="{{ old('nationalite_pere') }}">
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_pere" class="form-label">Profession </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_pere" name="profession_pere" value="{{ old('profession_pere') }}" placeholder="Profession">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_pere" class="form-label">Adresse de résidence </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_pere" name="adresse_pere" value="{{ old('adresse_pere') }}" placeholder="Adresse complète">
                            </div>
                        </div>

                        <!-- Informations sur la mère -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur la mère</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_mere" class="form-label">Nom de famille </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_mere" name="nom_mere" value="{{ old('nom_mere') }}" placeholder="Nom de famille">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_mere" class="form-label">Prénoms </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_mere" name="prenoms_mere" value="{{ old('prenoms_mere') }}" placeholder="Prénoms">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_mere" class="form-label">Date de naissance </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="date_naissance_mere" value="{{ old('date_naissance_mere') }}" name="date_naissance_mere">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_mere" class="form-label">Lieu de naissance </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance_mere" name="lieu_naissance_mere" value="{{ old('lieu_naissance_mere') }}" placeholder="Ville de naissance">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_mere" class="form-label">Nationalité </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite_mere" name="nationalite_mere" value="{{ old('nationalite_mere') }}">
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_mere" class="form-label">Profession </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_mere" name="profession_mere" value="{{ old('profession_mere') }}" placeholder="Profession">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_mere" class="form-label">Adresse de résidence </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_mere" name="adresse_mere" value="{{ old('adresse_mere') }}" placeholder="Adresse complète">
                            </div>
                        </div>

                        <!-- Informations sur le déclarant -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le déclarant</h4>
                        <div class="mb-3">
                            <label class="form-label">Le déclarant est : *</label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input @error('declarant') is-invalid @enderror" type="radio" name="declarant" id="pere" value="Père" {{ old('declarant') == 'Père' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pere">
                                        Le père
                                    </label>
                                </div>
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input @error('declarant') is-invalid @enderror" type="radio" name="declarant" id="mere" value="Mère" {{ old('declarant') == 'Mère' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="mere">
                                        La mère
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input @error('declarant') is-invalid @enderror" type="radio" name="declarant" id="autre" value="Autre" {{ old('declarant') == 'Autre' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="autre">
                                        Autre personne
                                    </label>
                                </div>
                            </div>
                            <em class="error invalid-feedback">Vous devez choisir un d&eacute;clarant</em>
                        </div>

                        <div id="autre_declarant_section" class="d-none">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom_declarant" class="form-label">Nom du déclarant *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('nom_declarant') is-invalid @enderror" id="nom_declarant" name="nom_declarant" value="{{ old('nom_declarant') }}" placeholder="Nom de famille">
                                        <em class="error invalid-feedback">Le nom du d&eacute;clarant est obligatoire.</em>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenoms_declarant" class="form-label">Prénoms du déclarant *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('prenoms_declarant') is-invalid @enderror" id="prenoms_declarant" name="prenoms_declarant" value="{{ old('prenoms_declarant') }}" placeholder="Prénoms">
                                        <em class="error invalid-feedback">Le pr&eacute;nom du d&eacute;clarant est obligatoire.</em>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="lien_avec_enfant" class="form-label">Qualité/Lien avec l'enfant *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                        <input type="text" class="form-control @error('lien_avec_enfant') is-invalid @enderror" id="lien_avec_enfant" name="lien_avec_enfant" value="{{ old('lien_avec_enfant') }}" placeholder="Ex: Grand-parent, Oncle, Tante, etc.">
                                        <em class="error invalid-feedback">Vous devez renseigner le lien ou la qualit&eacute; du d&eacute;clarant</em>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_declarant" class="form-label">Numéro de téléphone *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="tel" class="form-control @error('contact_declarant') is-invalid @enderror" id="contact_declarant" name="contact_declarant" value="{{ old('contact_declarant') }}" placeholder="+225 XXXXXXXXXX">
                                        <em class="error invalid-feedback">Le contact du d&eacute;clarant est obligatoire.</em>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents justificatifs -->
                        <h4 class="mb-3 mt-4 text-success">Documents justificatifs</h4>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Veuillez télécharger les documents suivants au format PDF, JPG ou PNG. Taille maximale : 5 Mo par fichier.
                        </div>

                        <div class="mb-3">
                            <label for="certificat_naissance" class="form-label">Certificat de naissance délivré par l'établissement de santé *</label>
                            <input type="file" class="form-control @error('certificat_naissance') is-invalid @enderror" id="certificat_naissance" name="certificat_naissance" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">Le certificat de naissance est obligatoire.</em>
                        </div>

                        <div class="mb-3">
                            <label for="piece_identite_pere" class="form-label">Pièce d'identité du père *</label>
                            <input type="file" class="form-control @error('piece_identite_pere') is-invalid @enderror" id="piece_identite_pere" name="piece_identite_pere" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">La pi&egrave;ce d'identit&eacute; du p&egrave;re est obligatoire.</em>
                        </div>

                        <div class="mb-3">
                            <label for="piece_identite_mere" class="form-label">Pièce d'identité de la mère *</label>
                            <input type="file" class="form-control @error('piece_identite_mere') is-invalid @enderror" id="piece_identite_mere" name="piece_identite_mere" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">La pi&egrave;ce d'identit&eacute; de la m&egrave;re est obligatoire.</em>
                        </div>

                        <div class="mb-3">
                            <label for="piece_identite_declarant" class="form-label">Pièce d'identité du déclarant </label>
                            <input type="file" class="form-control @error('piece_identite_declarant') is-invalid @enderror" id="piece_identite_declarant" name="piece_identite_declarant" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">La pi&egrave;ce d'identit&eacute; du d&eacute;clarant est obligatoire.</em>
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
                            <button type="submit" class="btn btn-cta btn-lg">Soumettre la déclaration</button>
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
        const radios = document.querySelectorAll('input[name="declarant"]');
        const autreSection = document.getElementById('autre_declarant_section');

        function toggleAutreSection() {
            const selected = document.querySelector('input[name="declarant"]:checked');
            if (selected && selected.value === 'Autre') {
                autreSection.classList.remove('d-none');
            } else {
                autreSection.classList.add('d-none');
            }
        }

        radios.forEach(radio => {
            radio.addEventListener('change', toggleAutreSection);
        });

        // Vérifie au chargement si "Autre" est déjà coché
        toggleAutreSection();
    });
</script>
@endauth
@endsection