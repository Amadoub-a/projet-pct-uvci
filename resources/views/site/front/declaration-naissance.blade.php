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
                    <h2 class="text-center mb-4">Formulaire de Déclaration de Naissance</h2>
                    <p class="text-center text-muted mb-4">Veuillez remplir tous les champs obligatoires (*)</p>

                    <form>
                        <!-- Informations sur l'enfant -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur l'enfant</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_enfant" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_enfant" placeholder="Nom de famille" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_enfant" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_enfant" placeholder="Prénoms" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="date_naissance" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="heure_naissance" class="form-label">Heure de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    <input type="time" class="form-control" id="heure_naissance" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance" class="form-label">Lieu de naissance (ville) *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance" placeholder="Ville de naissance" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etablissement" class="form-label">Établissement de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-hospital"></i>
                                    </span>
                                    <input type="text" class="form-control" id="etablissement" placeholder="Hôpital, clinique, domicile, etc." required>
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
                                <label for="nationalite" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite" required>
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Informations sur le père -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le père</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_pere" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_pere" placeholder="Nom de famille" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_pere" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_pere" placeholder="Prénoms" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_pere" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="date_naissance_pere" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_pere" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance_pere" placeholder="Ville de naissance" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_pere" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite_pere" required>
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_pere" class="form-label">Profession *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_pere" placeholder="Profession" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_pere" class="form-label">Adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_pere" placeholder="Adresse complète" required>
                            </div>
                        </div>

                        <!-- Informations sur la mère -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur la mère</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom_mere" class="form-label">Nom de famille *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_mere" placeholder="Nom de famille" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms_mere" class="form-label">Prénoms *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="prenoms_mere" placeholder="Prénoms" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance_mere" class="form-label">Date de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="date_naissance_mere" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance_mere" class="form-label">Lieu de naissance *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="lieu_naissance_mere" placeholder="Ville de naissance" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationalite_mere" class="form-label">Nationalité *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <select class="form-select" id="nationalite_mere" required>
                                        <option value="" selected disabled>Sélectionnez une nationalité</option>
                                        <option value="ivoirienne">Ivoirienne</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="profession_mere" class="form-label">Profession *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control" id="profession_mere" placeholder="Profession" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adresse_mere" class="form-label">Adresse de résidence *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-home"></i>
                                </span>
                                <input type="text" class="form-control" id="adresse_mere" placeholder="Adresse complète" required>
                            </div>
                        </div>

                        <!-- Informations sur le déclarant -->
                        <h4 class="mb-3 mt-4 text-success">Informations sur le déclarant</h4>
                        <div class="mb-3">
                            <label class="form-label">Le déclarant est : *</label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input" type="radio" name="declarant_type" id="declarant_pere" value="pere" required>
                                    <label class="form-check-label" for="declarant_pere">
                                        Le père
                                    </label>
                                </div>
                                <div class="form-check me-4 mb-2">
                                    <input class="form-check-input" type="radio" name="declarant_type" id="declarant_mere" value="mere">
                                    <label class="form-check-label" for="declarant_mere">
                                        La mère
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="declarant_type" id="declarant_autre" value="autre">
                                    <label class="form-check-label" for="declarant_autre">
                                        Autre personne
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="autre_declarant_section" class="d-none">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom_declarant" class="form-label">Nom du déclarant *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" id="nom_declarant" placeholder="Nom de famille">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenoms_declarant" class="form-label">Prénoms du déclarant *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" id="prenoms_declarant" placeholder="Prénoms">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="qualite_declarant" class="form-label">Qualité/Lien avec l'enfant *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                        <input type="text" class="form-control" id="qualite_declarant" placeholder="Ex: Grand-parent, Oncle, Tante, etc.">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_declarant" class="form-label">Numéro de téléphone *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="tel" class="form-control" id="contact_declarant" placeholder="+225 XXXXXXXXXX">
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
                            <input type="file" class="form-control" id="certificat_naissance" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="cni_pere" class="form-label">Pièce d'identité du père *</label>
                            <input type="file" class="form-control" id="cni_pere" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3">
                            <label for="cni_mere" class="form-label">Pièce d'identité de la mère *</label>
                            <input type="file" class="form-control" id="cni_mere" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>

                        <div class="mb-3" id="cni_declarant_section" style="display: none;">
                            <label for="cni_declarant" class="form-label">Pièce d'identité du déclarant *</label>
                            <input type="file" class="form-control" id="cni_declarant" accept=".pdf,.jpg,.jpeg,.png">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script pour le formulaire de déclaration
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validation du formulaire (à implémenter selon les besoins)
            if (form.checkValidity()) {
                // Redirection vers la page de paiement avec les paramètres
                const serviceName = "Déclaration d'Acte de Naissance";
                const amount = "3500"; // Montant en FCFA

                window.location.href = `payment.html?service=${encodeURIComponent(serviceName)}&amount=${encodeURIComponent(amount)}`;
            } else {
                // Afficher les messages de validation du formulaire
                form.reportValidity();
            }
        });
    });
</script>

<script>
    // Script pour afficher/masquer les champs du déclarant autre que les parents
    document.addEventListener('DOMContentLoaded', function() {
        const declarantTypeRadios = document.querySelectorAll('input[name="declarant_type"]');
        const autreDeclarantSection = document.getElementById('autre_declarant_section');
        const cniDeclarantSection = document.getElementById('cni_declarant_section');

        // Fonction pour gérer l'affichage des sections du déclarant
        function handleDeclarantTypeChange() {
            const selectedValue = document.querySelector('input[name="declarant_type"]:checked')?.value;

            if (selectedValue === 'autre') {
                autreDeclarantSection.classList.remove('d-none');
                cniDeclarantSection.style.display = 'block';

                // Rendre les champs obligatoires
                document.getElementById('nom_declarant').required = true;
                document.getElementById('prenoms_declarant').required = true;
                document.getElementById('qualite_declarant').required = true;
                document.getElementById('contact_declarant').required = true;
                document.getElementById('cni_declarant').required = true;
            } else {
                autreDeclarantSection.classList.add('d-none');
                cniDeclarantSection.style.display = 'none';

                // Rendre les champs non obligatoires
                document.getElementById('nom_declarant').required = false;
                document.getElementById('prenoms_declarant').required = false;
                document.getElementById('qualite_declarant').required = false;
                document.getElementById('contact_declarant').required = false;
                document.getElementById('cni_declarant').required = false;
            }
        }

        // Ajouter les écouteurs d'événements aux boutons radio
        declarantTypeRadios.forEach(radio => {
            radio.addEventListener('change', handleDeclarantTypeChange);
        });

        // Initialiser l'état des sections au chargement de la page
        handleDeclarantTypeChange();
    });
</script>
@endsection