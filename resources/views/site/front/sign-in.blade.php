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
                    <div id="loader" class="loader"></div>
                     <form onsubmit="showLoader()" method="POST" action="{{ route('connexion') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="nom@exemple.com">
                            </div>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Entrez votre mot de passe">
                            </div>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 text-end">
                            <a href="{{ route('client-password-request') }}" class="text-decoration-none small">Mot de passe oublié ?</a>
                        </div>

                        <button type="submit" class="btn btn-sign-in w-100">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showLoader() {
        document.getElementById('loader').style.display = 'flex';
    }
</script>
@endsection
