
@extends(
'site.layout',
[
'title' => "État Civil Côte d'Ivoire - Accueil",
]
)

@section('content-front')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">
            Système de Gestion Intégré de l'État Civil
        </h1>
        <p class="lead mb-5">
            Obtenez vos documents d'état civil rapidement et en toute sécurité, où
            que vous soyez en Côte d'Ivoire
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#how-it-work-section" class="btn btn-light btn-lg px-4">Comment ça marche ?</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Nos services</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card service-card h-100 text-center shadow rounded-4">
                    <img src="{{asset('images/actes/acte-naissance.png')}}" class="card-img-top p-4" alt="Acte de naissance" style="max-height: 160px; object-fit: contain"/>
                    <div class="card-body px-4 pb-4">
                        <h5 class="card-title">Acte de naissance</h5>
                        <p class="card-text">
                            Demandez votre extrait d'acte de naissance en ligne et
                            recevez-le rapidement.
                        </p>
                        <a href="declaration-naissance.html" class="btn btn-cta mt-3">Faire une demande</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card service-card h-100 text-center shadow rounded-4">
                    <img src="{{asset('images/actes/acte-mariage.png')}}" class="card-img-top p-4" alt="Acte de mariage" style="max-height: 160px; object-fit: contain"/>
                    <div class="card-body px-4 pb-4">
                        <h5 class="card-title">Acte de mariage</h5>
                        <p class="card-text">
                            Obtenez votre acte de mariage facilement sans vous déplacer
                            dans votre commune d'origine.
                        </p>
                        <a href="declaration-mariage.html" class="btn btn-cta mt-3">Faire une demande</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card service-card h-100 text-center shadow rounded-4">
                    <img
                            src="{{asset('images/actes/acte-deces.png')}}"
                            class="card-img-top p-4"
                            alt="Certificat de décès"
                            style="max-height: 160px; object-fit: contain"
                    />
                    <div class="card-body px-4 pb-4">
                        <h5 class="card-title">Certificat de décès</h5>
                        <p class="card-text">
                            Demandez un certificat de décès en toute simplicité grâce à
                            notre système centralisé.
                        </p>
                        <a href="declaration-deces.html" class="btn btn-cta mt-3">Faire une demande</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How it works -->
<section class="py-5 bg-light" id="how-it-work-section">
    <div class="container">
        <h2 class="text-center mb-5">Comment ça marche ?</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-plus fa-3x text-success"></i>
                    </div>
                    <h5>1. Créez votre compte</h5>
                    <p class="text-muted">
                        Inscrivez-vous en quelques étapes simples pour accéder à nos
                        services.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="fas fa-file-alt fa-3x text-primary"></i>
                    </div>
                    <h5>2. Faites votre demande</h5>
                    <p class="text-muted">
                        Sélectionnez le type d'acte et remplissez le formulaire de
                        demande.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="fas fa-credit-card fa-3x text-warning"></i>
                    </div>
                    <h5>3. Payez les frais</h5>
                    <p class="text-muted">
                        Réglez les frais de timbre en ligne via Mobile Money ou carte
                        bancaire.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="fas fa-download fa-3x text-danger"></i>
                    </div>
                    <h5>4. Recevez votre acte</h5>
                    <p class="text-muted">
                        Téléchargez votre document signé électroniquement ou recevez-le
                        par courrier.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Pourquoi nous choisir</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="stat-card">
                    <span class="stat-number">24/7</span>
                    <p class="mb-0">Service disponible</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <span class="stat-number">100%</span>
                    <p class="mb-0">Sécurisé</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <span class="stat-number">0h</span>
                    <p class="mb-0">Délai de traitement</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <span class="stat-number">201</span>
                    <p class="mb-0">Communes connectées</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Ce que disent nos utilisateurs</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text">
                            "J'ai pu obtenir mon acte de naissance en 24h sans me déplacer
                            dans ma commune natale à 300km. Un vrai gain de temps !"
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <div class="d-flex align-items-center">
                            <img src="{{asset('images/temoignages/kouame-konan.jpg')}}" class="rounded-circle me-3" alt="Photo utilisateur"/>
                            <div>
                                <h6 class="mb-0">Kouamé Konan</h6>
                                <small class="text-muted">Abidjan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text">
                            "Interface simple et intuitive. Le paiement par Mobile Money
                            est très pratique. Je recommande ce service à tous mes
                            proches."
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <div class="d-flex align-items-center">
                            <img src="{{asset('images/temoignages/aminata-diallo.jpg')}}" class="rounded-circle me-3" alt="Photo utilisateur"/>
                            <div>
                                <h6 class="mb-0">Aminata Diallo</h6>
                                <small class="text-muted">Bouaké</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="card-text">
                            "En tant qu'agent administratif, ce système facilite
                            grandement notre travail. Moins de papier, plus d'efficacité
                            et de transparence."
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <div class="d-flex align-items-center">
                            <img src="{{asset('images/temoignages/serge-coulibaly.jpg')}}" class="rounded-circle me-3" alt="Photo utilisateur"/>
                            <div>
                                <h6 class="mb-0">Serge Coulibaly</h6>
                                <small class="text-muted">San-Pédro</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection