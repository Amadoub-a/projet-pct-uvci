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

<!-- Form Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4">Formulaire de Déclaration de Mariage</h2>
                    <p class="text-center text-muted mb-4">Veuillez remplir tous les champs obligatoires (*)</p>

                    <form>
                        <!-- Informations sur le premier époux -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur l'époux</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_epoux1" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_epoux1" placeholder="Nom de famille" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_epoux1" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_epoux1" placeholder="Prénoms" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_epoux1" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="date_naissance_epoux1" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_epoux1" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance_epoux1" placeholder="Ville de naissance" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_epoux1" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite_epoux1" required>
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_epoux1" class="form-label">Profession *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_epoux1" placeholder="Profession" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_epoux1" class="form-label">Adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_epoux1" placeholder="Adresse complète" required>
                            </div>
                        </div>

                        <!-- Informations sur le deuxième époux -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur l'épouse</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_epoux2" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_epoux2" placeholder="Nom de famille" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_epoux2" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_epoux2" placeholder="Prénoms" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_epoux2" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="date_naissance_epoux2" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_epoux2" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance_epoux2" placeholder="Ville de naissance" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_epoux2" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite_epoux2" required>
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_epoux2" class="form-label">Profession *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_epoux2" placeholder="Profession" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_epoux2" class="form-label">Adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_epoux2" placeholder="Adresse complète" required>
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
                                    <input type="date" class="form-control" id="date_mariage" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_mariage" class="form-label">Lieu du mariage *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_mariage" placeholder="Ville/Commune" required>
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
                                    <select class="form-select" id="regime_matrimonial" required>
                                        <option value="" selected disabled>Sélectionnez un régime</option>
                                        <option value="communaute">Communauté de biens</option>
                                        <option value="separation">Séparation de biens</option>
                                        <option value="participation">Participation aux acquêts</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="officier_etat_civil" class="form-label">Officier d'état civil *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                    <input type="text" class="form-control" id="officier_etat_civil" placeholder="Nom de l'officier" required>
                                </div>
                            </div>
                        </div>

                        <!-- Informations sur les témoins -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur les témoins</h4>

                        <!-- Témoin 1 -->
                        <h5 class="mb-3">Témoin 1</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_temoin1" class="form-label">Nom et prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_temoin1" placeholder="Nom et prénoms" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_temoin1" class="form-label">Numéro de téléphone *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control" id="contact_temoin1" placeholder="+225 XXXXXXXXXX" required>
                                </div>
                            </div>
                        </div>

                        <!-- Témoin 2 -->
                        <h5 class="mb-3">Témoin 2</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_temoin2" class="form-label">Nom et prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_temoin2" placeholder="Nom et prénoms" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_temoin2" class="form-label">Numéro de téléphone *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control" id="contact_temoin2" placeholder="+225 XXXXXXXXXX" required>
                                </div>
                            </div>
                        </div>

                        <!-- Documents justificatifs -->
                        <h4 class="mb-3 mt-4 text-success">Documents justificatifs</h4>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Veuillez télécharger les documents suivants au format PDF, JPG ou PNG. Taille maximale : 5 Mo par fichier.
                        </div>

                        <div class="mb-3">
                            <label for="cni_epoux1" class="form-label">Pièce d'identité de l'époux *</label>
                            <input type="file" class="form-control" id="cni_epoux1" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="cni_epoux2" class="form-label">Pièce d'identité de l'épouse *</label>
                            <input type="file" class="form-control" id="cni_epoux2" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="acte_naissance_epoux1" class="form-label">Acte de naissance l'époux *</label>
                            <input type="file" class="form-control" id="acte_naissance_epoux1" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="acte_naissance_epoux2" class="form-label">Acte de naissance de l'épouse *</label>
                            <input type="file" class="form-control" id="acte_naissance_epoux2" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="certificat_celibat" class="form-label">Certificats de célibat ou de coutume *</label>
                            <input type="file" class="form-control" id="certificat_celibat" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                       

                        <div class="mb-3">
                            <label for="contrat_mariage" class="form-label">Contrat de mariage (si applicable)</label>
                            <input type="file" class="form-control" id="contrat_mariage" accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <!-- Déclaration sur l'honneur -->
                        <div class="mb-4 mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="declaration_honneur" required>
                                <label class="form-check-label" for="declaration_honneur">
                                    Nous certifions sur l'honneur l'exactitude des informations fournies et des documents joints. Nous sommes conscients que toute fausse déclaration est passible de poursuites judiciaires. *
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validation du formulaire (à implémenter selon les besoins)
            if (form.checkValidity()) {
                // Redirection vers la page de paiement avec les paramètres
                const serviceName = "Déclaration d'Acte de Mariage";
                const amount = "4500"; // Montant en FCFA

                window.location.href = `payment.html?service=${encodeURIComponent(serviceName)}&amount=${encodeURIComponent(amount)}`;
            } else {
                // Afficher les messages de validation du formulaire
                form.reportValidity();
            }
        });
    });
</script>

@endsection
