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

                    <form>
                        <!-- Informations sur le défunt -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le défunt</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_defunt" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_defunt" placeholder="Nom de famille" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_defunt" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_defunt" placeholder="Prénoms" required>
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
                                    <input type="date" class="form-control" id="date_naissance_defunt" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_defunt" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance_defunt" placeholder="Ville de naissance" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sexe *</label>
                                <div class="d-flex">
                                    <div class="form-check me-4">
                                        <input class="form-check-input" type="radio" name="sexe" id="sexe_masculin" value="M" required>
                                        <label class="form-check-label" for="sexe_masculin">
                                            Masculin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexe" id="sexe_feminin" value="F">
                                        <label class="form-check-label" for="sexe_feminin">
                                            Féminin
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_defunt" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite_defunt" required>
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
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
                                    <input type="text" class="form-control" id="profession_defunt" placeholder="Profession">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="situation_familiale" class="form-label">Situation familiale *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-friends"></i>
                                    </span>
                                    <select class="form-select" id="situation_familiale" required>
                                        <option value="" selected disabled>Sélectionnez une option</option>
                                        <option value="celibataire">Célibataire</option>
                                        <option value="marie">Marié(e)</option>
                                        <option value="divorce">Divorcé(e)</option>
                                        <option value="veuf">Veuf/Veuve</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_defunt" class="form-label">Dernière adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_defunt" placeholder="Adresse complète" required>
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
                                    <input type="date" class="form-control" id="date_deces" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="heure_deces" class="form-label">Heure du décès (approximative) *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    <input type="time" class="form-control" id="heure_deces" required>
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
                                    <input type="text" class="form-control" id="lieu_deces" placeholder="Ville/Commune" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etablissement_deces" class="form-label">Établissement (si applicable)</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-hospital"></i>
                                    </span>
                                    <input type="text" class="form-control" id="etablissement_deces" placeholder="Hôpital, clinique, domicile, etc.">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cause_deces" class="form-label">Cause du décès (selon certificat médical) *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-file-medical"></i>
                                </span>
                                <input type="text" class="form-control" id="cause_deces" placeholder="Cause du décès" required>
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
                                    <input type="text" class="form-control" id="nom_declarant" placeholder="Nom de famille" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_declarant" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_declarant" placeholder="Prénoms" required>
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
                                    <select class="form-select" id="lien_parente" required>
                                        <option value="" selected disabled>Sélectionnez une option</option>
                                        <option value="conjoint">Conjoint(e)</option>
                                        <option value="enfant">Enfant</option>
                                        <option value="parent">Parent</option>
                                        <option value="frere_soeur">Frère/Sœur</option>
                                        <option value="autre_parent">Autre parent</option>
                                        <option value="non_parent">Non apparenté</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_declarant" class="form-label">Numéro de téléphone *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control" id="contact_declarant" placeholder="+225 XXXXXXXXXX" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_declarant" class="form-label">Adresse du déclarant *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_declarant" placeholder="Adresse complète" required>
                            </div>
                        </div>

                        <!-- Documents justificatifs -->
                        <h4 class="mb-3 mt-4 text-success">Documents justificatifs</h4>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Veuillez télécharger les documents suivants au format PDF, JPG ou PNG. Taille maximale : 5 Mo par fichier.
                        </div>

                        <div class="mb-3">
                            <label for="certificat_medical" class="form-label">Certificat médical de décès *</label>
                            <input type="file" class="form-control" id="certificat_medical" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="cni_defunt" class="form-label">Pièce d'identité du défunt *</label>
                            <input type="file" class="form-control" id="cni_defunt" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="acte_naissance_defunt" class="form-label">Acte de naissance du défunt</label>
                            <input type="file" class="form-control" id="acte_naissance_defunt" accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <div class="mb-3">
                            <label for="cni_declarant" class="form-label">Pièce d'identité du déclarant *</label>
                            <input type="file" class="form-control" id="cni_declarant" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="justificatif_lien" class="form-label">Justificatif de lien de parenté (si applicable)</label>
                            <input type="file" class="form-control" id="justificatif_lien" accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <!-- Déclaration sur l'honneur -->
                        <div class="mb-4 mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="declaration_honneur" required>
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validation du formulaire (à implémenter selon les besoins)
            if (form.checkValidity()) {
                // Redirection vers la page de paiement avec les paramètres
                const serviceName = "Déclaration de Décès";
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
