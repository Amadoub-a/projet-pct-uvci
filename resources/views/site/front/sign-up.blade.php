@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - S'inscrire",
]
)
@section('content-front')
<style>
    .style-app-name {
        text-align: center;
    }

    .disposition-personnelle {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .disposition-personnelle .text-center {
        width: 100%;
    }

    .disposition-personnelle button {
        width: 80%;
    }

    .text-personnel {
        font-size: larger;
    }

    .text-personnel a {
        color: black;
        text-decoration: overline !important;
    }


    .loader {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .loader::after {
        content: "";
        border: 16px solid #f3f3f3;
        border-top: 16px solid #3498db;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Inscription</h2>
                    <form onsubmit="showLoader()" action="{{route('inscription')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Votre nom">
                                    <em class="error invalid-feedback">Le nom est obligatoire</em>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenoms" class="form-label">Pr&eacute;noms <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control @error('prenoms') is-invalid @enderror" id="prenoms" name="prenoms" value="{{ old('prenoms') }}" placeholder="Vos prénoms">
                                    <em class="error invalid-feedback">Le pr&eacute;nom est obligatoire</em>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="nom@exemple.com">
                                <em class="error invalid-feedback">L'adresse e-mail est obligatoire</em>
                            </div>
                            @error('duplicate_email')
                                    <em class="text-danger">{{ $message }}</em>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="tel" class="form-control @error('email') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" placeholder="07 00 00 00 00">
                                <em class="error invalid-feedback">Le num&eacute;ro de t&eacute;l&eacute;phone est obligatoire</em>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Créez un mot de passe">
                                <em class="error invalid-feedback">Le mot de passe est obligatoire</em>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe">
                                <em class="error invalid-feedback">La confirmation du mot de passe est obligatoire</em>
                            </div>
                              @error('password_test')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms">
                            <label class="form-check-label" for="terms">J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></label>
                            <em class="error invalid-feedback">Vous devez cochez cette case</em>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                    </form>
                    <p class="text-center mt-3">Déjà inscrit ? <a href="{{ route(name: 'sign-in') }}">Connectez-vous</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const telInput = document.getElementById('telephone');
        telInput.addEventListener('input', function (e) {
            let digits = this.value.replace(/\D/g, '').slice(0, 10); // max 10 chiffres
            let formatted = digits.replace(/(\d{2})(?=\d)/g, '$1 ').trim(); // espace tous les 2 chiffres
            this.value = formatted;
        });
    });
</script>
@endsection
