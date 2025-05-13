<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>E-Civil - Mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="Smart Parc Auto simplifie la gestion de votre flotte de véhicules avec des outils de suivi en temps réel et des rapports personnalisés pour une efficacité optimale.">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="{{asset('template/vendors/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendors/ionicons-npm/css/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendors/linearicons-master/dist/web-font/style.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css')}}">
    <link href="{{asset('template/styles/css/base.css')}}" rel="stylesheet">
    <style>
        .style-app-name {
            text-align: center;
            font-size: xx-large;
            font-weight: 700;
            color: #fff;
            font-style: italic;
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
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="style-app-name">
                            <img src="{{asset('logo-page-connexion.png')}}" alt="logo page de connexion">
                        </div>
                        <div class="modal-dialog w-100 mx-auto">
                            <div id="loader" class="loader"></div>
                            <form onsubmit="showLoader()" method="POST" action="{{ route('resete-password') }}">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="h5 modal-title text-center">
                                            <h4 class="mt-2">
                                                <span>Veuillez entrez votre E-mail.</span>
                                            </h4>
                                        </div>
                                        @csrf
                                        <div class="">
                                            <div class="col-md-12">
                                                <div class="position-relative mb-3">
                                                    <input id="email" type="email" placeholder="E-mail" class="form-control mb-2" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('error')
                                                        <em class="text-danger">
                                                            {{ $message }}
                                                        </em>
                                                    @enderror
                                                    @error('success')
                                                        <em class="text-success">
                                                            {{ $message }}
                                                        </em>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer disposition-personnelle">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Envoyer le lien de réinitialisation du mot de passe</button>
                                        </div>
                                        <div class="text-center">
                                            <a href="{{ route('login') }}" class="btn-lg btn btn-link">Aller &agrave; la page d'authentification</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
</body>

</html>