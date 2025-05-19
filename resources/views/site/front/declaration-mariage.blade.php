@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - Mariage",
]
)

@section('content-front')

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Déclaration d'Acte de Mariage</h1>
        <p class="lead mb-4">
            Remplissez ce formulaire pour déclarer un mariage et obtenir un acte de mariage officiel
        </p>

        <div class="card mt-4 mb-5">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-list-ul me-2 text-success"></i>Documents requis pour la déclaration</h5>
            </div>
            <div class="card-body">
                <p>Pour compléter votre déclaration de mariage, les documents suivants sont nécessaires :</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièces d'identité des deux époux (CNI, passeport ou permis de conduire)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Actes de naissance des deux époux (datant de moins de 3 mois)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Certificat de célibat ou de coutume pour chaque époux</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Certificat de publication des bans</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièces d'identité des témoins (deux minimum)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Justificatif de domicile</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Contrat de mariage (si applicable)</li>
                </ul>
                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Note : La publication des bans doit être effectuée au moins 10 jours avant la célébration du mariage.
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
                    <h2 class="text-center mb-4">Formulaire de Déclaration de Mariage</h2>
                    <p class="text-center text-muted mb-4">Veuillez remplir tous les champs obligatoires (*)</p>
                    <div id="loader" class="loader"></div>
                    <form onsubmit="showLoader()" enctype="multipart/form-data" method="post" action="{{route('store-declaration-mariage')}}">
                        @csrf
                        <!-- Informations sur le premier époux -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur l'époux</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_epoux" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom_epoux') is-invalid @enderror" id="nom_epoux" placeholder="Nom de famille" name="nom_epoux" value="{{ old('nom_epoux') }}">
                                    <em class="error invalid-feedback">Le nom de l'epoux est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_epoux" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('prenoms_epoux') is-invalid @enderror" id="prenoms_epoux" placeholder="Prénoms" name="prenoms_epoux" value="{{ old('prenoms_epoux') }}">
                                    <em class="error invalid-feedback">Le pr&eacute;nom de l'epoux est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_epoux" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control @error('date_naissance_epoux') is-invalid @enderror" id="date_naissance_epoux" name="date_naissance_epoux" value="{{ old('date_naissance_epoux') }}">
                                    <em class="error invalid-feedback">La date de naissance de l'epoux est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_epoux" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control @error('lieu_naissance_epoux') is-invalid @enderror" id="lieu_naissance_epoux" placeholder="Ville de naissance" name="lieu_naissance_epoux" value="{{ old('lieu_naissance_epoux') }}">
                                    <em class="error invalid-feedback">Le lieu de naissance de l'epoux est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_epoux" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select @error('nationalite_epoux') is-invalid @enderror" id="nationalite_epoux" name="nationalite_epoux">
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne" {{ old('nationalite_epoux') == 'ivoirienne' ? 'selected' : '' }}>Ivoirienne</option>
                                        <option value="autre" {{ old('nationalite_epoux') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    <em class="error invalid-feedback">Vous devez sélectionner la nationalité</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_epoux" class="form-label">Profession </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_epoux" name="profession_epoux" placeholder="Profession" value="{{ old('profession_epoux') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_epoux" class="form-label">Adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control @error('adresse_epoux') is-invalid @enderror" id="adresse_epoux" name="adresse_epoux" placeholder="Adresse complète" value="{{ old('adresse_epoux') }}">
                                <em class="error invalid-feedback">L'adresse de l'epoux est obligatoire</em>
                            </div>
                        </div>

                        <!-- Informations sur le deuxième époux -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur l'épouse</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_epouse" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom_epouse') is-invalid @enderror" id="nom_epouse" name="nom_epouse" placeholder="Nom de famille" value="{{ old('adresse_epoux') }}">
                                    <em class="error invalid-feedback">Le nom de l'epouse est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_epouse" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('prenoms_epouse') is-invalid @enderror" id="prenoms_epouse" name="prenoms_epouse" placeholder="Prénoms" value="{{ old('prenoms_epouse') }}">
                                    <em class="error invalid-feedback">Le pr&eacute;nom de l'epouse est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_epouse" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control @error('date_naissance_epouse') is-invalid @enderror" id="date_naissance_epouse" name="date_naissance_epouse" value="{{ old('date_naissance_epouse') }}">
                                    <em class="error invalid-feedback">La date de naissance de l'epouse est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_epouse" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control @error('lieu_naissance_epouse') is-invalid @enderror" id="lieu_naissance_epouse" name="lieu_naissance_epouse" placeholder="Ville de naissance" value="{{ old('lieu_naissance_epouse') }}">
                                    <em class="error invalid-feedback">La date de naissance de l'epouse est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_epouse" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select @error('nationalite_epouse') is-invalid @enderror" id="nationalite_epouse" name="nationalite_epouse">
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne" {{ old('nationalite_epouse') == 'ivoirienne' ? 'selected' : '' }}>Ivoirienne</option>
                                        <option value="autre" {{ old('nationalite_epouse') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    <em class="error invalid-feedback">Vous devez sélectionner la nationalité</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_epouse" class="form-label">Profession </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_epouse" name="profession_epouse" placeholder="Profession" value="{{ old('profession_epouse') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_epouse" class="form-label">Adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control @error('adresse_epouse') is-invalid @enderror" id="adresse_epouse" name="adresse_epouse" placeholder="Adresse complète" value="{{ old('adresse_epouse') }}">
                                <em class="error invalid-feedback">L'adresse de l'epouse est obligatoire</em>
                            </div>
                        </div>

                        <!-- Informations sur le mariage -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le mariage</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_mariage" class="form-label">Date du mariage *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" id="date_mariage" name="date_mariage" value="{{ old('date_mariage') }}">
                                    <em class="error invalid-feedback">La date du mariage est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_mariage" class="form-label">Lieu du mariage *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control @error('lieu_mariage') is-invalid @enderror" id="lieu_mariage" name="lieu_mariage" placeholder="Ville/Commune" value="{{ old('lieu_mariage') }}">
                                    <em class="error invalid-feedback">Le lieu du mariage est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="regime_matrimonial" class="form-label">Régime matrimonial *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-gavel"></i>
                                    </span>
                                    <select class="form-select @error('regime_matrimonial') is-invalid @enderror" id="regime_matrimonial" name="regime_matrimonial">
                                        <option value="" selected disabled>Sélectionnez un régime</option>
                                        <option value="communaute" {{ old('regime_matrimonial') == 'communaute' ? 'selected' : '' }}>Communauté de biens</option>
                                        <option value="separation" {{ old('regime_matrimonial') == 'separation' ? 'selected' : '' }}>Séparation de biens</option>
                                        <option value="participation" {{ old('regime_matrimonial') == 'participation' ? 'selected' : '' }}>Participation aux acquêts</option>
                                    </select>
                                   <em class="error invalid-feedback">Vous devez sélectionner un régime</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="officier_etat_civil" class="form-label">Officier d'état civil *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                    <input type="text" class="form-control @error('officier_etat_civil') is-invalid @enderror" id="officier_etat_civil" name="officier_etat_civil" placeholder="Nom de l'officier" value="{{ old('officier_etat_civil') }}">
                                    <em class="error invalid-feedback">Le nom de l'officier d'état civil est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <!-- Informations sur les témoins -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur les témoins</h4>

                        <!-- Témoin 1 -->
                        <h5 class="mb-3">Témoin 1</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_complet_temoins_1" class="form-label">Nom et prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom_complet_temoins_1') is-invalid @enderror" id="nom_complet_temoins_1" name="nom_complet_temoins_1" placeholder="Nom et prénoms" value="{{ old('nom_complet_temoins_1') }}">
                                    <em class="error invalid-feedback">Le nom du témoins 1 est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_temoins_1" class="form-label">Numéro de téléphone *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control @error('contact_temoins_1') is-invalid @enderror" id="contact_temoins_1" name="contact_temoins_1" placeholder="+225 XXXXXXXXXX" value="{{ old('contact_temoins_1') }}">
                                    <em class="error invalid-feedback">Le contact du témoins 1 est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <!-- Témoin 2 -->
                        <h5 class="mb-3">Témoin 2</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_complet_temoins_2" class="form-label">Nom et prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom_complet_temoins_2') is-invalid @enderror" id="nom_complet_temoins_2" name="nom_complet_temoins_2" placeholder="Nom et prénoms" value="{{ old('nom_complet_temoins_2') }}">
                                    <em class="error invalid-feedback">Le nom du témoins 2 est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_temoins_2" class="form-label">Numéro de téléphone *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control @error('contact_temoins_2') is-invalid @enderror" id="contact_temoins_2" name="contact_temoins_2" placeholder="+225 XXXXXXXXXX" value="{{ old('contact_temoins_2') }}">
                                    <em class="error invalid-feedback">Le contact du témoins 2 est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <!-- Documents justificatifs -->
                        <h4 class="mb-3 mt-4 text-success">Documents justificatifs</h4>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Veuillez télécharger les documents suivants au format PDF, JPG ou PNG. Taille maximale : 5 Mo par fichier.
                        </div>

                        <div class="mb-3">
                            <label for="piece_identite_epoux" class="form-label">Pièce d'identité de l'époux *</label>
                            <input type="file" class="form-control @error('piece_identite_epoux') is-invalid @enderror" id="piece_identite_epoux" name="piece_identite_epoux" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">La pi&egrave;ce d'identit&eacute; de l'&eacute;poux est obligatoire</em>
                        </div>

                        <div class="mb-3">
                            <label for="piece_identite_epouse" class="form-label">Pièce d'identité de l'épouse *</label>
                            <input type="file" class="form-control @error('piece_identite_epouse') is-invalid @enderror" id="piece_identite_epouse" name="piece_identite_epouse" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">La pi&egrave;ce d'identit&eacute; de l'&eacute;pouse est obligatoire</em>
                        </div>

                        <div class="mb-3">
                            <label for="acte_naissance_epoux" class="form-label">Acte de naissance l'époux *</label>
                            <input type="file" class="form-control @error('acte_naissance_epoux') is-invalid @enderror" id="acte_naissance_epoux" name="acte_naissance_epoux" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">L'acte de naissance de l'&eacute;poux est obligatoire</em>
                        </div>

                        <div class="mb-3">
                            <label for="acte_naissance_epouse" class="form-label">Acte de naissance de l'épouse *</label>
                            <input type="file" class="form-control @error('acte_naissance_epouse') is-invalid @enderror" id="acte_naissance_epouse" name="acte_naissance_epouse" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">L'acte de naissance de l'&eacute;pouse est obligatoire</em>
                        </div>

                        <div class="mb-3">
                            <label for="certificats_celibat_ou_coutume" class="form-label">Certificats de célibat ou de coutume *</label>
                            <input type="file" class="form-control @error('certificats_celibat_ou_coutume') is-invalid @enderror" id="certificats_celibat_ou_coutume" name="certificats_celibat_ou_coutume" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">Le certificat de célibat ou de coutume est obligatoire</em>
                        </div>
                        <div class="mb-3">
                            <label for="contrat_mariage" class="form-label">Contrat de mariage (si applicable)</label>
                            <input type="file" class="form-control" id="contrat_mariage" accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <!-- Déclaration sur l'honneur -->
                        <div class="mb-4 mt-4">
                            <div class="form-check">
                                <input class="form-check-input @error('declaration_honneur') is-invalid @enderror" type="checkbox" id="declaration_honneur" name="declaration_honneur">
                                <label class="form-check-label" for="declaration_honneur">
                                    Nous certifions sur l'honneur l'exactitude des informations fournies et des documents joints. Nous sommes conscients que toute fausse déclaration est passible de poursuites judiciaires. *
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
</script>
@endauth
@endsection
