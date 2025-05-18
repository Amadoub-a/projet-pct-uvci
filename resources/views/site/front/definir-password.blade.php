@extends('site.layout', ['title' => "État Civil Côte d'Ivoire - Réinitialiser mot de passe"])

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
                    <h2 class="text-center mb-4">Veuillez définir votre nouveau mot de passe</h2>

                    <form method="POST" action="{{ route('redefnir-password') }}" id="resetForm">
                        @csrf

                        <div class="mb-3">
                            <input type="hidden" name="email" class="form-control" value="{{ request('email') }}">
                        </div>

                        @error('msg')
                            <div class="alert alert-warning text-center" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('password_test')
                            <div class="alert alert-warning text-center" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <input type="password" name="password" placeholder="Mot de passe" class="form-control @error('password') is-invalid @enderror">
                                <em class="error invalid-feedback">Le mot de passe est obligatoire</em>
                            </div>
                            <div class="position-relative mb-3">
                                <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" class="form-control @error('password_confirmation') is-invalid @enderror">
                                <em class="error invalid-feedback">La confirmation du mot de passe est obligatoire</em>
                            </div>
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

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Envoi...';
        loader.style.display = 'flex';
    });
</script>
@endsection