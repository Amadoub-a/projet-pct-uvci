@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - Se connecter",
]
)
@section('content-front')
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Connexion</h2>
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                <input type="email" class="form-control" id="email" placeholder="nom@exemple.com"
                                       required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                <input type="password" class="form-control" id="password"
                                       placeholder="Entrez votre mot de passe" required>
                            </div>
                        </div>
                        <div class="mb-4 text-end">
                            <a href="#" id="forgot-password" class="text-decoration-none small">Mot de passe oublié ?</a>
                        </div>
                        <button type="submit" class="btn btn-sign-in w-100">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script pour le formulaire de connexion
        const form = document.querySelector('form');
        const forgotPasswordLink = document.getElementById('forgot-password');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validation du formulaire
            if (form.checkValidity()) {
                // Redirection vers la page de paiement avec les paramètres
                const serviceName = "Connexion";
                const amount = "500"; // Montant en FCFA

                window.location.href = `payment.html?service=${encodeURIComponent(serviceName)}&amount=${encodeURIComponent(amount)}`;
            } else {
                // Afficher les messages de validation du formulaire
                form.reportValidity();
            }
        });

        // Gestion du lien "Mot de passe oublié"
        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;

            if (!email) {
                alert('Veuillez entrer votre adresse e-mail avant de réinitialiser votre mot de passe.');
                document.getElementById('email').focus();
                return;
            }

            // Simuler une réinitialisation de mot de passe (80% de succès)
            const isSuccess = Math.random() < 0.8;

            if (isSuccess) {
                alert('Un e-mail de réinitialisation a été envoyé à ' + email);
                // Redirection vers la page de succès
                window.location.href = 'password-reset-success.html';
            } else {
                // Redirection vers la page d'échec
                window.location.href = 'password-reset-failure.html';
            }
        });
    });
</script>
@endsection
