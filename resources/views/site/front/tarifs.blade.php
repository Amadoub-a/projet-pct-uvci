@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - Tarifs",
]
)
@section('content-front')
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Grille Tarifaire</h1>
            <p class="lead mb-5">
                Calculez le coût de vos démarches administratives en fonction du type d'acte, du mode de
                paiement
            </p>
        </div>
    </section>

    <!-- Tariff Calculator Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow">
                        <div class="card-header bg-light py-3">
                            <h2 class="fs-4 mb-0 text-center"><i class="fas fa-calculator me-2 text-success"></i>Calculateur
                                de Tarifs</h2>
                        </div>
                        <div class="card-body p-4">
                            <form id="calculatorForm">
                                <div class="row g-4">
                                    <!-- Type d'acte -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <label for="typeActe" class="form-label">
                                                    <i class="fas fa-file-alt me-2 text-success"></i>Type d'acte
                                                </label>
                                                <select class="form-select" id="typeActe" name="typeActe" required>
                                                    <option value="" selected disabled>Sélectionnez un type d'acte
                                                    </option>
                                                    <option value="5000">Certificat de mariage - 5000 FCFA</option>
                                                    <option value="2500">Acte de naissance - 2500 FCFA</option>
                                                    <option value="2000">Acte de décès - 2000 FCFA</option>
                                                    <option value="1500">Légalisation - 1500 FCFA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mairie/Préfecture/Sous-préfecture -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <label for="service" class="form-label">
                                                    <i class="fas fa-building me-2 text-success"></i>Service
                                                    administratif
                                                </label>
                                                <select class="form-select" id="service" name="service" required>
                                                    <option value="" selected disabled>Sélectionnez un service</option>
                                                    <option value="1">Mairie</option>
                                                    <option value="1.1">Sous-préfecture</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mode de paiement -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <label for="modePaiement" class="form-label">
                                                    <i class="fas fa-credit-card me-2 text-success"></i>Mode de paiement
                                                </label>
                                                <select class="form-select" id="modePaiement" name="modePaiement"
                                                        required>
                                                    <option value="" selected disabled>Sélectionnez un mode de
                                                        paiement
                                                    </option>
                                                    <option value="100">Orange Money (Frais: 100 FCFA)</option>
                                                    <option value="100">MTN Mobile Money (Frais: 100 FCFA)</option>
                                                    <option value="100">Moov Money (Frais: 100 FCFA)</option>
                                                    <option value="100">Wave (Frais: 100 FCFA)</option>
                                                    <option value="250">Carte bancaire (Frais: 250 FCFA)</option>
                                                    <option value="0">TresorMoney (Frais: 0 FCFA)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Nombre de copies -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <label for="nombreCopies" class="form-label d-block">
                                                    <i class="fas fa-copy me-2 text-success"></i>Nombre de copies
                                                </label>
                                                <div class="d-flex align-items-center">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                            id="decrementCopies">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" class="form-control mx-2 text-center"
                                                           id="nombreCopies" name="nombreCopies" value="1" min="1"
                                                           max="10" required>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                            id="incrementCopies">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bouton de calcul -->
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-tariff btn-lg px-5 py-2">
                                            <i class="fas fa-calculator me-2"></i>Calculer le montant
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Résultat du calcul -->
                            <div id="resultSection" class="mt-5 d-none">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h3 class="fs-5 mb-0"><i class="fas fa-receipt me-2"></i>Détail du tarif</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span>Type d'acte:</span>
                                                        <span id="resultTypeActe" class="fw-bold"></span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span>Prix de base:</span>
                                                        <span id="resultPrixBase" class="fw-bold"></span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span>Service administratif:</span>
                                                        <span id="resultService" class="fw-bold"></span>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-group list-group-flush">

                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span>Nombre de copies:</span>
                                                        <span id="resultCopies" class="fw-bold"></span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span>Frais de paiement:</span>
                                                        <span id="resultFraisPaiement" class="fw-bold"></span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                                        <span class="fs-5">Total à payer:</span>
                                                        <span id="resultTotal" class="fs-5 fw-bold text-success"></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <a href="#" class="btn btn-tariff">
                                                <i class="fas fa-credit-card me-2"></i>Procéder au paiement
                                            </a>
                                            <button type="button" class="btn btn-outline-secondary ms-2"
                                                    id="newCalculation">
                                                <i class="fas fa-redo me-2"></i>Nouveau calcul
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations explicatives -->
                            <div class="alert alert-info mt-4">
                                <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Informations sur les tarifs</h5>
                                <ul class="mb-0">
                                    <li>Les prix de base sont fixés par décret et varient selon le type d'acte</li>
                                    <li>Des majorations peuvent s'appliquer selon le service administratif choisi
                                        (mairie, préfecture, etc.)
                                    </li>
                                    <li>Certaines villes ou communes peuvent appliquer des tarifs différents</li>
                                    <li>Le délai de traitement urgent ou express entraîne une majoration du tarif</li>
                                    <li>Le prix total est proportionnel au nombre de copies demandées</li>
                                    <li>Des frais supplémentaires s'appliquent selon le mode de paiement choisi</li>
                                    <li>Les tarifs affichés sont donnés à titre indicatif et peuvent être soumis à
                                        modification
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tariff Table Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Grille tarifaire officielle</h2>
            <p class="text-center mb-5">Consultez les tarifs de base pour les principaux actes administratifs</p>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-success">
                    <tr>
                        <th>Type d'acte</th>
                        <th>Tarif de base</th>
                        <th>Validité</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Acte de naissance (extrait)</td>
                        <td>2 500 FCFA</td>
                        <td>3 mois</td>
                    </tr>
                    <tr>
                        <td>Acte de naissance (copie intégrale)</td>
                        <td>3 500 FCFA</td>
                        <td>3 mois</td>
                    </tr>
                    <tr>
                        <td>Certificat de mariage</td>
                        <td>5 000 FCFA</td>
                        <td>3 mois</td>
                    </tr>
                    <tr>
                        <td>Acte de décès</td>
                        <td>2 000 FCFA</td>
                        <td>3 mois</td>
                    </tr>
                    <tr>
                        <td>Légalisation de document</td>
                        <td>1 500 FCFA</td>
                        <td>Permanent</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Note importante:</strong> Les tarifs peuvent varier selon les localités et sont susceptibles
                d'être modifiés par les autorités compétentes. Veuillez vous référer aux affichages officiels dans les
                administrations concernées pour les tarifs en vigueur.
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Éléments du DOM
            const calculatorForm = document.getElementById('calculatorForm');
            const resultSection = document.getElementById('resultSection');
            const decrementBtn = document.getElementById('decrementCopies');
            const incrementBtn = document.getElementById('incrementCopies');
            const nombreCopiesInput = document.getElementById('nombreCopies');
            const newCalculationBtn = document.getElementById('newCalculation');

            // Éléments de résultat
            const resultTypeActe = document.getElementById('resultTypeActe');
            const resultPrixBase = document.getElementById('resultPrixBase');
            const resultService = document.getElementById('resultService');
            const resultCopies = document.getElementById('resultCopies');
            const resultFraisPaiement = document.getElementById('resultFraisPaiement');
            const resultTotal = document.getElementById('resultTotal');

            // Gestion des boutons +/- pour le nombre de copies
            decrementBtn.addEventListener('click', function () {
                const currentValue = parseInt(nombreCopiesInput.value);
                if (currentValue > 1) {
                    nombreCopiesInput.value = currentValue - 1;
                }
            });

            incrementBtn.addEventListener('click', function () {
                const currentValue = parseInt(nombreCopiesInput.value);
                if (currentValue < 10) {
                    nombreCopiesInput.value = currentValue + 1;
                }
            });

            // Gestion du formulaire
            calculatorForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Récupération des valeurs
                const typeActeSelect = document.getElementById('typeActe');
                const serviceSelect = document.getElementById('service');
                const modePaiementSelect = document.getElementById('modePaiement');

                const prixBase = parseInt(typeActeSelect.value);
                const serviceMultiplier = parseFloat(serviceSelect.value);
                const fraisPaiement = parseInt(modePaiementSelect.value);
                const nombreCopies = parseInt(nombreCopiesInput.value);

                // Calcul du prix total
                const prixTotal = (prixBase * serviceMultiplier * nombreCopies) + fraisPaiement;

                // Affichage des résultats
                resultTypeActe.textContent = typeActeSelect.options[typeActeSelect.selectedIndex].text.split(' - ')[0];
                resultPrixBase.textContent = prixBase.toLocaleString() + ' FCFA';
                resultService.textContent = serviceSelect.options[serviceSelect.selectedIndex].text;
                resultCopies.textContent = nombreCopies;
                resultFraisPaiement.textContent = fraisPaiement.toLocaleString() + ' FCFA';
                resultTotal.textContent = Math.round(prixTotal).toLocaleString() + ' FCFA';

                // Affichage de la section de résultat
                resultSection.classList.remove('d-none');

                // Scroll vers la section de résultat
                resultSection.scrollIntoView({behavior: 'smooth'});
            });

            // Bouton pour nouveau calcul
            newCalculationBtn.addEventListener('click', function () {
                resultSection.classList.add('d-none');
                calculatorForm.reset();
                window.scrollTo({
                    top: calculatorForm.offsetTop - 100,
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection
