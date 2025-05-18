@extends(
    'site.layout',
    [
        'title' => "État Civil Côte d'Ivoire - Réinitialiser mot de passe",
    ]
)

@section('content-front')
<style>
    .form-loader {
        display: none;
        justify-content: center;
        margin-top: 1rem;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Réinitialiser votre mot de passe</h2>
                    <p class="text-center mb-4">
                        Entrez votre adresse e-mail et nous vous enverrons un nouveau mot de passe.
                    </p>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reset-password') }}" id="resetForm">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                   name="email" value="{{ old('email') }}" autofocus placeholder="nom@exemple.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i>Valider
                            </button>
                        </div>

                        <div class="form-loader" id="formLoader">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Chargement...</span>
                            </div>
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <a href="{{ route('sign-in') }}" class="text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i>Retour à la connexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const form = document.getElementById('resetForm');
    const submitBtn = document.getElementById('submitBtn');
    const loader = document.getElementById('formLoader');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Envoi...';
        loader.style.display = 'flex';
    });
</script>
@endsection
