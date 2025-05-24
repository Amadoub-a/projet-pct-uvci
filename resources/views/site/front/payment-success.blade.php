@extends('site.layout', ['title' => "État Civil Côte d'Ivoire - Payement success"])

@section('content-front')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="mb-4">Paiement réussi !</h2>
                    <p class="mb-4">
                        Votre paiement a été traité avec succès. Nous vous remercions pour votre confiance.
                    </p>
                    
                    <!-- Détails de la transaction -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-receipt me-2 text-success"></i>Détails de la transaction</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6 text-start">
                                    <p class="mb-0 text-muted">Service :</p>
                                    <p class="fw-bold" id="service-name">Service demandé</p>
                                </div>
                                <div class="col-md-6 text-start">
                                    <p class="mb-0 text-muted">Référence :</p>
                                    <p class="fw-bold" id="reference-number">REF-2025-0001</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-start">
                                    <p class="mb-0 text-muted">Date :</p>
                                    <p class="fw-bold" id="order-date">01/01/2025</p>
                                </div>
                                <div class="col-md-6 text-start">
                                    <p class="mb-0 text-muted">Montant total :</p>
                                    <p class="fw-bold fs-5 text-success" id="total-amount">5 000 FCFA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        Un reçu détaillé a été envoyé à votre adresse e-mail.
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="/" class="btn btn-primary btn-lg">
                            <i class="fas fa-home me-2"></i>Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection