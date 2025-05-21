@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - Légalisation",
]
)

@section('content-front')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Légalisation de Documents</h1>
        <p class="lead mb-4">
            Remplissez ce formulaire pour faire légaliser vos documents officiels
        </p>

        <div class="card mt-4 mb-5">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-list-ul me-2 text-success"></i>Documents requis pour la légalisation</h5>
            </div>
            <div class="card-body">
                <p>Pour compléter votre demande de légalisation, les documents suivants sont nécessaires :</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Document original à légaliser</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièce d'identité du demandeur (CNI, passeport ou permis de conduire)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Justificatif de domicile (facture d'électricité, d'eau ou de téléphone)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Procuration (si la demande est faite pour une tierce personne)</li>
                </ul>
                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Note : Les documents à légaliser doivent être en bon état, lisibles et ne présenter aucune altération. Les documents rédigés en langue étrangère doivent être accompagnés d'une traduction officielle.
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
                    <h2 class="text-center mb-4">Formulaire de Demande de Légalisation</h2>
                    <p class="text-center text-muted mb-4">Veuillez remplir tous les champs obligatoires (*)</p>
                    <div id="loader" class="loader"></div>
                    <form onsubmit="showLoader()" enctype="multipart/form-data" method="post" action="{{route('store-legalisation')}}">
                       @csrf
                        <!-- Informations sur le demandeur -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le demandeur</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_personne" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom_personne') is-invalid @enderror" id="nom_personne" name="nom_personne" value="{{ old('nom_personne') }}" placeholder="Nom de famille">
                                    <em class="error invalid-feedback">Le nom de famille est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_personne" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('prenoms_personne') is-invalid @enderror" id="prenoms_personne" name="prenoms_personne" placeholder="Prénoms" value="{{ old('prenoms_personne') }}">
                                    <em class="error invalid-feedback">Le prenom est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_personne" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control @error('date_naissance_personne') is-invalid @enderror" id="date_naissance_personne" name="date_naissance_personne" value="{{ old('date_naissance_personne') }}">
                                    <em class="error invalid-feedback">La date naissance est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_personne" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control @error('lieu_naissance_personne') is-invalid @enderror" id="lieu_naissance_personne" name="lieu_naissance_personne" placeholder="Ville de naissance" value="{{ old('lieu_naissance_personne') }}">
                                    <em class="error invalid-feedback">Le lieu de naissance est obligatoire</em>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_personne" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select @error('nationalite_personne') is-invalid @enderror" id="nationalite_personne" name="nationalite_personne">
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne" {{ old('nationalite_personne') == 'ivoirienne' ? 'selected' : '' }}>Ivoirienne</option>
                                        <option value="autre" {{ old('nationalite_personne') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    <em class="error invalid-feedback">Vous devez sélectionner la nationalité</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_personne" class="form-label">Profession </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_personne" name="profession_personne" placeholder="Profession"  value="{{ old('profession_personne') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_personne" class="form-label">Numéro de téléphone *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control @error('contact_personne') is-invalid @enderror" id="contact_personne" name="contact_personne" placeholder="+225 XXXXXXXXXX" value="{{ old('contact_personne') }}">
                                    <em class="error invalid-feedback">Le contact est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email_personne" class="form-label">Adresse e-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email_personne" name="email_personne" placeholder="exemple@email.com" value="{{ old('email_personne') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_personne" class="form-label">Adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control @error('adresse_personne') is-invalid @enderror" id="adresse_personne" name="adresse_personne" placeholder="Adresse complète" value="{{ old('adresse_personne') }}">
                              <em class="error invalid-feedback">L'adresse du domicile est obligatoire</em>
                            </div>
                        </div>

                        <!-- Informations sur le document à légaliser -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le document à légaliser</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="type_document" class="form-label">Type de document *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-file-alt"></i>
                                    </span>
                                    <select class="form-select @error('type_document') is-invalid @enderror" id="type_document" name="type_document">
                                        <option value="" selected disabled>Sélectionnez un type de document</option>
                                        <option value="diplome" {{ old('type_document') == 'diplome' ? 'selected' : '' }}>Diplôme ou certificat scolaire</option>
                                        <option value="contrat" {{ old('type_document') == 'contrat' ? 'selected' : '' }}>Contrat</option>
                                        <option value="procuration" {{ old('type_document') == 'procuration' ? 'selected' : '' }}>Procuration</option>
                                        <option value="attestation" {{ old('type_document') == 'attestation' ? 'selected' : '' }}>Attestation</option>
                                        <option value="releve_notes" {{ old('type_document') == 'releve_notes' ? 'selected' : '' }}>Relevé de notes</option>
                                        <option value="autre" {{ old('type_document') == 'autre' ? 'selected' : '' }}>Autre document</option>
                                    </select>
                                    <em class="error invalid-feedback">Sélectionner un type de document</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="autres" class="form-label">Précisez (si "Autre")</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-file"></i>
                                    </span>
                                    <input type="text" class="form-control" id="autres" name="autres" placeholder="Précisez le type de document" value="{{ old('adresse_personne') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_document" class="form-label">Date du document *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control @error('adresse_personne') is-invalid @enderror" id="date_document" name="date_document" value="{{ old('adresse_personne') }}">
                                    <em class="error invalid-feedback">La date du domicile est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="autorite" class="form-label">Autorité émettrice *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-building"></i>
                                    </span>
                                    <input type="text" class="form-control @error('autorite') is-invalid @enderror" id="autorite" placeholder="Nom de l'institution/autorité" name="autorite" value="{{ old('autorite') }}">
                                    <em class="error invalid-feedback">Ce champs est obligatoire</em>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="motif" class="form-label">Motif de la légalisation *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <textarea class="form-control @error('motif') is-invalid @enderror" id="motif" rows="3" placeholder="Précisez le motif de votre demande de légalisation" name="motif">
                                  {{ old('motif') }}
                                </textarea>
                                <em class="error invalid-feedback">Ce champs est obligatoire</em>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nb_copies" class="form-label">Nombre de copies souhaitées *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-copy"></i>
                                </span>
                                <input type="number" class="form-control @error('nb_copies') is-invalid @enderror" id="nb_copies" name="nb_copies" min="1" max="10" value="1" value="{{ old('nb_copies') }}">
                                <em class="error invalid-feedback">Ce champs est obligatoire</em>
                            </div>
                        </div>

                        <!-- Documents justificatifs -->
                        <h4 class="mb-3 mt-4 text-success">Documents justificatifs</h4>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Veuillez télécharger les documents suivants au format PDF, JPG ou PNG. Taille maximale : 5 Mo par fichier.
                        </div>

                        <div class="mb-3">
                            <label for="document_original" class="form-label">Document original à légaliser *</label>
                            <input type="file" class="form-control @error('document_original') is-invalid @enderror" id="document_original" accept=".pdf,.jpg,.jpeg,.png" name="document_original">
                            <em class="error invalid-feedback">Ce champs est obligatoire</em>
                        </div>

                        <div class="mb-3">
                            <label for="piece_demandeur" class="form-label">Pièce d'identité du demandeur *</label>
                            <input type="file" class="form-control @error('piece_demandeur') is-invalid @enderror" id="piece_demandeur" accept=".pdf,.jpg,.jpeg,.png" name="piece_demandeur">
                            <em class="error invalid-feedback">Ce champs est obligatoire</em>
                        </div>

                        <div class="mb-3">
                            <label for="justificatif_domicile" class="form-label">Justificatif de domicile *</label>
                            <input type="file" class="form-control @error('justificatif_domicile') is-invalid @enderror" id="justificatif_domicile" accept=".pdf,.jpg,.jpeg,.png" name="justificatif_domicile">
                            <em class="error invalid-feedback">Ce champs est obligatoire</em>
                        </div>

                        <div class="mb-3">
                            <label for="procuration" class="form-label">Procuration (si applicable)</label>
                            <input type="file" class="form-control" id="procuration" name="procuration" accept=".pdf,.jpg,.jpeg,.png">
                        </div>


                        <!-- Déclaration sur l'honneur -->
                        <div class="mb-4 mt-4">
                            <div class="form-check">
                                <input class="form-check-input @error('declaration_honneur') is-invalid @enderror" type="checkbox" name="declaration_honneur" id="declaration_honneur">
                                <label class="form-check-label" for="declaration_honneur">
                                    Je certifie sur l'honneur l'exactitude des informations fournies et l'authenticité des documents joints. Je suis conscient(e) que toute fausse déclaration est passible de poursuites judiciaires. *
                                </label>
                            </div>
                            <em class="error invalid-feedback">Ce champs est obligatoire</em>
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
</script>
@endauth
@endsection