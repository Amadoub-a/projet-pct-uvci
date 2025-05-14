@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - Déclaration vie",
]
)

@section('content-front')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Certification de vie et d'entretien</h1>
        <p class="lead mb-4">
            Remplissez ce formulaire pour certifier que vous être vivant
        </p>

        <div class="card mt-4 mb-5">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-list-ul me-2 text-success"></i>Documents requis pour la certification</h5>
            </div>
            <div class="card-body">
                <p>Pour compléter votre demande de certification, les documents suivants sont nécessaires :</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Formulaire sur l'honneur (Selon le cas)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Pièce d'identité du demandeur (CNI, passeport ou permis de conduire)</li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>Justificatif de domicile (facture d'électricité, d'eau ou de téléphone)</li>
                </ul>
                <div class="alert alert-warning mt-3 mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Note : Les documents à certifier doivent être en bon état, lisibles et ne présenter aucune altération.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4">Formulaire de Demande de Certification</h2>
                    <p class="text-center text-muted mb-4">Veuillez remplir tous les champs obligatoires (*)</p>

                    <form>
                        <!-- Informations sur la personne qui déclare entrete -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur la personne qui déclare entretenir</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_demandeur" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_demandeur" placeholder="Nom de famille" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_demandeur" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_demandeur" placeholder="Prénoms" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_demandeur" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="date_naissance_demandeur" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_demandeur" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance_demandeur" placeholder="Ville de naissance" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_demandeur" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite_demandeur" required>
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_demandeur" class="form-label">Profession *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_demandeur" placeholder="Profession" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telephone_demandeur" class="form-label">Numéro de téléphone *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control" id="telephone_demandeur" placeholder="+225 XXXXXXXXXX" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email_demandeur" class="form-label">Adresse e-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email_demandeur" placeholder="exemple@email.com">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_demandeur" class="form-label">Adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_demandeur" placeholder="Adresse complète" required>
                            </div>
                        </div>

                        <!-- Informations sur le document à certifier -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur la personne concerné</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="type_document" class="form-label">Type de document *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-file-alt"></i>
                                    </span>
                                    <select class="form-select" id="type_document" required>
                                        <option value="" selected disabled>Sélectionnez un type de document</option>
                                        <option value="diplome">Diplôme ou certificat scolaire</option>
                                        <option value="releve_notes">Relevé de notes</option>
                                        <option value="piece_identite">Pièce d'identité</option>
                                        <option value="acte_civil">Acte d'état civil</option>
                                        <option value="document_administratif">Document administratif</option>
                                        <option value="autre">Autre document</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="autre_type_document" class="form-label">Précisez (si "Autre")</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-file"></i>
                                    </span>
                                    <input type="text" class="form-control" id="autre_type_document" placeholder="Précisez le type de document">
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
                                    <input type="date" class="form-control" id="date_document" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="autorite_emettrice" class="form-label">Autorité émettrice *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-building"></i>
                                    </span>
                                    <input type="text" class="form-control" id="autorite_emettrice" placeholder="Nom de l'institution/autorité" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="motif_certification" class="form-label">Motif de la certification *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <textarea class="form-control" id="motif_certification" rows="3" placeholder="Précisez le motif de votre demande de certification (dossier administratif, candidature, inscription scolaire, etc.)" required></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nombre_copies" class="form-label">Nombre de copies souhaitées *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-copy"></i>
                                </span>
                                <input type="number" class="form-control" id="nombre_copies" min="1" max="10" value="1" required>
                            </div>
                        </div>

                        <!-- Documents justificatifs -->
                        <h4 class="mb-3 mt-4 text-success">Documents justificatifs</h4>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Veuillez télécharger les documents suivants au format PDF, JPG ou PNG. Taille maximale : 5 Mo par fichier.
                        </div>

                        <div class="mb-3">
                            <label for="document_original" class="form-label">Document original à certifier *</label>
                            <input type="file" class="form-control" id="document_original" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="cni_demandeur" class="form-label">Pièce d'identité du demandeur *</label>
                            <input type="file" class="form-control" id="cni_demandeur" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="justificatif_domicile" class="form-label">Justificatif de domicile *</label>
                            <input type="file" class="form-control" id="justificatif_domicile" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <!-- Déclaration sur l'honneur -->
                        <div class="mb-4 mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="declaration_honneur" required>
                                <label class="form-check-label" for="declaration_honneur">
                                    Je certifie sur l'honneur l'exactitude des informations fournies et l'authenticité des documents joints. Je suis conscient(e) que toute fausse déclaration est passible de poursuites judiciaires. *
                                </label>
                            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validation du formulaire (à implémenter selon les besoins)
            if (form.checkValidity()) {
                // Redirection vers la page de paiement avec les paramètres
                const serviceName = "Certification de document";
                const amount = "3000"; // Montant en FCFA
                
                window.location.href = `payment.html?service=${encodeURIComponent(serviceName)}&amount=${encodeURIComponent(amount)}`;
            } else {
                // Afficher les messages de validation du formulaire
                form.reportValidity();
            }
        });
    });
</script>

@endsection