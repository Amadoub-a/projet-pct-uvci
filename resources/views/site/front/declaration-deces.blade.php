@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - Décès",
]
)

@section('content-front')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Déclaration de Décès</h1>
        <p class="lead mb-4">
            Remplissez ce formulaire pour déclarer un décès et obtenir un certificat de décès officiel
        </p>

        <div class="card mt-4 mb-5">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-list-ul me-2 text-success"></i>Documents requis pour la déclaration</h5>
            </div>
            <div class="card-body">
                <p>Pour compléter votre déclaration de décès, les documents suivants sont nécessaires :</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Certificat médical de décès</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièce d'identité du défunt (CNI, passeport ou permis de conduire)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Acte de naissance du défunt</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Livret de famille (si disponible)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièce d'identité du déclarant</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Justificatif de lien de parenté avec le défunt (si applicable)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Procuration (si le déclarant n'est pas un membre de la famille)</li>
                </ul>
                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Note : La déclaration doit être faite dans les 15 jours suivant le décès. Au-delà de ce délai, une procédure judiciaire sera nécessaire.
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
                    <h2 class="text-center mb-4">Formulaire de Déclaration de Décès</h2>
                    <p class="text-center text-muted mb-4">Veuillez remplir tous les champs obligatoires (*)</p>
                    <div id="loader" class="loader"></div>
                    <form onsubmit="showLoader()" enctype="multipart/form-data" method="post" action="{{route('store-declaration-deces')}}">
                        @csrf 
                        <!-- Informations sur le défunt -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le défunt</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_defunt" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom_defunt') is-invalid @enderror" id="nom_defunt" name="nom_defunt" placeholder="Nom de famille" value="{{ old('nom_defunt') }}">
                                    <em class="error invalid-feedback">Le nom du défunt est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_defunt" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('prenoms_defunt') is-invalid @enderror" id="prenoms_defunt" name="prenoms_defunt" placeholder="Prénoms" value="{{ old('prenoms_defunt') }}">
                                    <em class="error invalid-feedback">Le pr&eacute;nom du défunt est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_defunt" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control @error('date_naissance_defunt') is-invalid @enderror" id="date_naissance_defunt" name="date_naissance_defunt" value="{{ old('date_naissance_defunt') }}">
                                    <em class="error invalid-feedback">La date de naissance du défunt est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_defunt" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control @error('lieu_naissance_defunt') is-invalid @enderror" id="lieu_naissance_defunt" name="lieu_naissance_defunt" placeholder="Ville de naissance" value="{{ old('lieu_naissance_defunt') }}">
                                    <em class="error invalid-feedback">La lieu de naissance du défunt est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Sexe *</label>
                                <div class="d-flex">
                                    <div class="form-check me-4">
                                        <input class="form-check-input @error('sexe_defunt') is-invalid @enderror" type="radio" name="sexe_defunt" id="sexe_masculin" value="M" {{ old('sexe_defunt', 'M') == 'M' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sexe_masculin">
                                            Masculin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('sexe_defunt') is-invalid @enderror" type="radio" name="sexe_defunt" id="sexe_feminin" value="F" {{ old('sexe_defunt', 'M') == 'F' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sexe_feminin">
                                            Féminin
                                        </label>
                                    </div>
                                </div>
                                <em class="error invalid-feedback">Vous devez choisir un sexe</em>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_defunt" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select @error('nationalite_defunt') is-invalid @enderror" id="nationalite_defunt" name="nationalite_defunt">
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne" {{ old('nationalite_defunt') == 'ivoirienne' ? 'selected' : '' }}>Ivoirienne</option>
                                        <option value="autre" {{ old('nationalite_defunt') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    <em class="error invalid-feedback">Vous devez sélectionner la nationalité</em>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="profession_defunt" class="form-label">Profession</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_defunt" name="profession_defunt" placeholder="Profession" value="{{ old('profession_defunt') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="situation_familiale_defunt" class="form-label">Situation familiale *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-friends"></i>
                                    </span>
                                    <select class="form-select @error('situation_familiale_defunt') is-invalid @enderror" id="situation_familiale_defunt" name="situation_familiale_defunt">
                                        <option value="" selected disabled>Sélectionnez une option</option>
                                        <option value="celibataire" {{ old('situation_familiale_defunt') == 'celibataire' ? 'selected' : '' }}>Célibataire</option>
                                        <option value="marie" {{ old('situation_familiale_defunt') == 'marie' ? 'selected' : '' }}>Marié(e)</option>
                                        <option value="divorce" {{ old('situation_familiale_defunt') == 'divorce' ? 'selected' : '' }}>Divorcé(e)</option>
                                        <option value="veuf" {{ old('situation_familiale_defunt') == 'veuf' ? 'selected' : '' }}>Veuf/Veuve</option>
                                    </select>
                                    <em class="error invalid-feedback">Vous devez sélectionner la situation familiale</em>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_defunt" class="form-label">Dernière adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control @error('adresse_defunt') is-invalid @enderror" id="adresse_defunt" name="adresse_defunt" placeholder="Adresse complète" value="{{ old('adresse_defunt') }}">
                                <em class="error invalid-feedback">L'adresse du défunt est obligatoire.</em>
                            </div>
                        </div>

                        <!-- Informations sur le décès -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le décès</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_deces" class="form-label">Date du décès *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control @error('date_deces') is-invalid @enderror" id="date_deces" name="date_deces" value="{{ old('date_deces') }}">
                                    <em class="error invalid-feedback">La date du décès est obligatoire.</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="heure_deces" class="form-label">Heure du décès (approximative) *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    <input type="time" class="form-control @error('heure_deces') is-invalid @enderror" id="heure_deces" name="heure_deces" value="{{ old('heure_deces') }}">
                                    <em class="error invalid-feedback">L'heure du décès est obligatoire.</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lieu_deces" class="form-label">Lieu du décès *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control @error('lieu_deces') is-invalid @enderror" id="lieu_deces" name="lieu_deces" placeholder="Ville/Commune" value="{{ old('lieu_deces') }}">
                                    <em class="error invalid-feedback">Le lieu du décès est obligatoire.</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etablissement_deces" class="form-label">Établissement (si applicable)</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-hospital"></i>
                                    </span>
                                    <input type="text" class="form-control" id="etablissement_deces" name="etablissement_deces" placeholder="Hôpital, clinique, domicile, etc." value="{{ old('etablissement_deces') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cause_deces" class="form-label">Cause du décès (selon certificat médical) *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-file-medical"></i>
                                </span>
                                <input type="text" class="form-control @error('cause_deces') is-invalid @enderror" id="cause_deces" name="cause_deces" placeholder="Cause du décès" value="{{ old('cause_deces') }}">
                                <em class="error invalid-feedback">La cause du décès est obligatoire.</em>
                            </div>
                        </div>

                        <!-- Informations sur le déclarant -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le déclarant</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_declarant" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom_declarant') is-invalid @enderror" id="nom_declarant" name="nom_declarant" placeholder="Nom de famille" value="{{ old('nom_declarant') }}">
                                    <em class="error invalid-feedback">Le nom du déclarant est obligatoire.</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_declarant" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('prenoms_declarant') is-invalid @enderror" id="prenoms_declarant" name="prenoms_declarant" placeholder="Prénoms" value="{{ old('prenoms_declarant') }}">
                                    <em class="error invalid-feedback">Le prénom du déclarant est obligatoire.</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lien_parente" class="form-label">Lien de parenté avec le défunt *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-tag"></i>
                                    </span>
                                    <select class="form-select @error('lien_parente') is-invalid @enderror" id="lien_parente" name="lien_parente">
                                        <option value="" selected disabled>Sélectionnez une option</option>
                                        <option value="conjoint" {{ old('lien_parente') == 'conjoint' ? 'selected' : '' }}>Conjoint(e)</option>
                                        <option value="enfant" {{ old('lien_parente') == 'enfant' ? 'selected' : '' }}>Enfant</option>
                                        <option value="parent" {{ old('lien_parente') == 'parent' ? 'selected' : '' }}>Parent</option>
                                        <option value="frere_soeur" {{ old('lien_parente') == 'frere_soeur' ? 'selected' : '' }}>Frère/Sœur</option>
                                        <option value="autre_parent" {{ old('lien_parente') == 'autre_parent' ? 'selected' : '' }}>Autre parent</option>
                                        <option value="non_parente" {{ old('lien_parente') == 'non_parente' ? 'selected' : '' }}>Non apparenté</option>
                                    </select>
                                    <em class="error invalid-feedback">Vous devez faire un choix.</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_declarant" class="form-label">Numéro de téléphone *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control @error('contact_declarant') is-invalid @enderror" id="contact_declarant" name="contact_declarant" placeholder="+225 XXXXXXXXXX" value="{{ old('contact_declarant') }}">
                                    <em class="error invalid-feedback">Le contact du déclarant est obligatoire.</em>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_declarant" class="form-label">Adresse du déclarant *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control @error('adresse_declarant') is-invalid @enderror" id="adresse_declarant" name="adresse_declarant" placeholder="Adresse complète"  value="{{ old('adresse_declarant') }}">
                                <em class="error invalid-feedback">L'adresse du déclarant est obligatoire.</em>
                            </div>
                        </div>

                        <!-- Documents justificatifs -->
                        <h4 class="mb-3 mt-4 text-success">Documents justificatifs</h4>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Veuillez télécharger les documents suivants au format PDF, JPG ou PNG. Taille maximale : 5 Mo par fichier.
                        </div>

                        <div class="mb-3">
                            <label for="certificat_deces" class="form-label">Certificat médical de décès *</label>
                            <input type="file" class="form-control @error('certificat_deces') is-invalid @enderror" id="certificat_deces" name="certificat_deces" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">Le certificat du décès est obligatoire.</em>                        
                        </div>

                        <div class="mb-3">
                            <label for="piece_identite_defunt" class="form-label">Pièce d'identité du défunt *</label>
                            <input type="file" class="form-control @error('piece_identite_defunt') is-invalid @enderror" id="piece_identite_defunt" name="piece_identite_defunt" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">La pièce d'identité du défunt est obligatoire.</em> 
                        </div>

                        <div class="mb-3">
                            <label for="acte_naissance_defunt" class="form-label">Acte de naissance du défunt</label>
                            <input type="file" class="form-control @error('acte_naissance_defunt') is-invalid @enderror" id="acte_naissance_defunt" name="acte_naissance_defunt" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">L'acte de naissance du défunt est obligatoire.</em>                        
                        </div>
                        <div class="mb-3">
                            <label for="piece_identite_declarant" class="form-label">Pièce d'identité du déclarant *</label>
                            <input type="file" class="form-control @error('piece_identite_declarant') is-invalid @enderror" id="piece_identite_declarant" name="piece_identite_declarant" accept=".pdf,.jpg,.jpeg,.png">
                            <em class="error invalid-feedback">La pièce d'identité du déclarant est obligatoire.</em>
                        </div>

                        <!-- Déclaration sur l'honneur -->
                        <div class="mb-4 mt-4">
                            <div class="form-check">
                                <input class="form-check-input @error('piece_identite_declarant') is-invalid @enderror" type="checkbox" id="declaration_honneur" name="declaration_honneur">
                                <label class="form-check-label" for="declaration_honneur">
                                    Je certifie sur l'honneur l'exactitude des informations fournies et des documents joints. Je suis conscient(e) que toute fausse déclaration est passible de poursuites judiciaires. *
                                </label>
                            </div>
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
@endauth
<script>
   function showLoader() {
        document.getElementById('loader').style.display = 'flex';
    }
</script>
@endsection
