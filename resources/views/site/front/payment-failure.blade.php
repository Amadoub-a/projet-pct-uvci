@extends('site.layout', ['title' => "État Civil Côte d'Ivoire - Payement échoué"])

@section('content-front')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="mb-4">Échec de paiement</h2>
                    <p class="mb-4">
                        Nous n'avons pas pu traiter votre paiement. Aucun montant n'a été débité de votre compte.
                    </p>
                    
                    <!-- Détails de la transaction -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-receipt me-2 text-danger"></i>Détails de la transaction</h5>
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
                                    <p class="fw-bold fs-5 text-danger" id="total-amount">5 000 FCFA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Raisons possibles de l'échec :
                        <ul class="mb-0 mt-2 text-start">
                            <li>Fonds insuffisants sur votre compte</li>
                            <li>Informations de paiement incorrectes</li>
                            <li>Problème temporaire avec le service de paiement</li>
                            <li>Transaction refusée par votre banque</li>
                        </ul>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route(name: 'contact') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-envelope me-2"></i>Contacter le support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
