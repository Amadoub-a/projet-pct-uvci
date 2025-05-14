@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - Contact",
]
)
@section('content-front')
<!-- Hero Section -->
<section class="contact-hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">
            Contactez-nous
        </h1>
        <p class="lead mb-0">
            Nous sommes à votre écoute pour toute question ou demande d'information
        </p>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="mb-4">Écrivez-nous</h2>
                <div class="contact-form">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <form>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" id="nom" placeholder="Votre nom" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="prenoms" class="form-label">Prénoms</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" id="prenoms" placeholder="Vos prénoms" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" id="email" placeholder="votre.email@exemple.com" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="sujet" class="form-label">Sujet de visite</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        <select class="form-select" id="sujet" required>
                                            <option value="" selected disabled>Sélectionnez un sujet</option>
                                            <option value="demande-information">Demande d'information</option>
                                            <option value="probleme-technique">Problème technique</option>
                                            <option value="suggestion">Suggestion</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="message" class="form-label">Message</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-comment"></i>
                                        </span>
                                        <textarea class="form-control" id="message" rows="5" placeholder="Votre message" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-cta w-100">Envoyer une reclamation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">Nos coordonnées</h2>
                <div class="card shadow mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <i class="fas fa-map-marker-alt fa-2x text-success"></i>
                            </div>
                            <div>
                                <h5>Adresse</h5>
                                <p class="mb-0">Abidjan, Cocody Deux-Plateaux<br>Côte d'Ivoire</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <i class="fas fa-phone fa-2x text-success"></i>
                            </div>
                            <div>
                                <h5>Téléphone</h5>
                                <p class="mb-0">+225 0781452561</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <i class="fas fa-envelope fa-2x text-success"></i>
                            </div>
                            <div>
                                <h5>Email</h5>
                                <p class="mb-0">contact@civid.gouv.ci</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-clock fa-2x text-success"></i>
                            </div>
                            <div>
                                <h5>Heures d'ouverture</h5>
                                <p class="mb-0">Lundi - Dimanche 24h/7jrs
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h5 class="mb-3">Suivez-nous</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-outline-primary rounded-circle">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-outline-info rounded-circle">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger rounded-circle">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary rounded-circle">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script pour le formulaire de contact
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validation du formulaire
            if (form.checkValidity()) {
                // Redirection vers la page de paiement avec les paramètres
                const serviceName = "Demande de Contact";
                const amount = "1000"; // Montant en FCFA

                window.location.href = `payment.html?service=${encodeURIComponent(serviceName)}&amount=${encodeURIComponent(amount)}`;
            } else {
                // Afficher les messages de validation du formulaire
                form.reportValidity();
            }
        });
    });
</script>
@endsection
