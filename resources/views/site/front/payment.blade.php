@extends('site.layout', ['title' => "État Civil Côte d'Ivoire - Payement"])

@section('content-front')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Paiement de votre {{ $service }}</h1>
        <p class="lead mb-4">
            Finalisez votre demande en effectuant le paiement des frais associés
        </p>
    </div>
</section>

<!-- Payment Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4">Détails de la transaction</h2>

                    <!-- Order Summary -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-receipt me-2 text-success"></i>Récapitulatif de la commande</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-0 text-muted">Service :</p>
                                    <p class="fw-bold" id="service-name">{{ ucfirst($service) }}</p>
                                    <input type="hidden" name="service" value="{{ $prestation['id'] }}">
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-0 text-muted">Référence :</p>
                                    <p class="fw-bold" id="reference-number">{{ $prestation['numero'] }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-0 text-muted">Date :</p>
                                    <p class="fw-bold" id="order-date">{{ date("d/m/Y")}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-0 text-muted">Montant total :</p>
                                    <p class="fw-bold fs-5 text-success" id="total-amount">{{ $prestation['montant'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <h4 class="mb-3">Choisissez votre méthode de paiement</h4>

                    <div class="mb-4">
                        <div class="form-check mb-3 p-3 border rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="mobile_money" value="mobile_money" checked>
                            <label class="form-check-label d-flex align-items-center" for="mobile_money">
                                <i class="fas fa-mobile-alt fs-3 me-3 text-success"></i>
                                <div>
                                    <span class="d-block fw-bold">Mobile Money</span>
                                    <span class="text-muted small">Orange Money, MTN Mobile Money, Moov Money, Wave</span>
                                </div>
                            </label>
                        </div>

                        <div class="form-check mb-3 p-3 border rounded">
                            <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card">
                            <label class="form-check-label d-flex align-items-center" for="credit_card">
                                <i class="fas fa-credit-card fs-3 me-3 text-primary"></i>
                                <div>
                                    <span class="d-block fw-bold">Carte bancaire</span>
                                    <span class="text-muted small">Visa, Mastercard</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Mobile Money Form (default) -->
                    <div id="mobile_money_form">
                        <div class="mb-3">
                            <label for="mobile_number" class="form-label">Numéro de téléphone *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="tel" class="form-control" id="mobile_number" placeholder="+225 XXXXXXXXXX" required>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="mb-4 mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms_conditions" required>
                            <label class="form-check-label" for="terms_conditions">
                                J'accepte les <a href="#" class="text-decoration-none">conditions générales</a> et la <a href="#" class="text-decoration-none">politique de confidentialité</a> *
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="button" id="pay-button" class="btn btn-cta btn-lg">Procéder au paiement</button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-muted small">
                            <i class="fas fa-lock me-1"></i> Toutes les transactions sont sécurisées et cryptées.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("pay-button").addEventListener("click", function() {
        var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        var mobileNumber = document.getElementById('mobile_number').value;
        var termsChecked = document.getElementById('terms_conditions').checked; // Vérification de la case des conditions

        // Vérification si le numéro de téléphone est rempli
        if (!mobileNumber) {
            alert("Le numéro de téléphone est obligatoire !");
            return;
        }

        // Vérification si la case des conditions générales est cochée
        if (!termsChecked) {
            alert("Vous devez accepter les conditions générales et la politique de confidentialité !");
            return;
        }

        // Logique pour simuler un paiement réussi ou échoué
        var paymentSuccess = true; // Simuler une réussite, mettre false pour échouer

        if (paymentSuccess) {
            // Créer un formulaire POST caché pour envoyer les données
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('payment.success') }}"; // Redirection vers la page de succès

            var serviceInput = document.createElement('input');
            serviceInput.type = 'hidden';
            serviceInput.name = 'service';
            serviceInput.value = "{{ ucfirst($service) }}";
            form.appendChild(serviceInput);

            var prestationIdInput = document.createElement('input');
            prestationIdInput.type = 'hidden';
            prestationIdInput.name = 'prestation_id';
            prestationIdInput.value = "{{ $prestation['id'] }}";
            form.appendChild(prestationIdInput);

            // Ajoutez le CSRF token à l'envoi du formulaire
            var csrfToken = "{{ csrf_token() }}"; // Récupère le CSRF token Laravel
            var csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);

            // Soumettre le formulaire
            document.body.appendChild(form);
            form.submit();
        } else {
            window.location.href = "{{ route('payment.failed') }}"; // Redirection vers la page d'échec
        }
    });
</script>

@endsection