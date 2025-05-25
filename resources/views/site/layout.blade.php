<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ @$title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('plugin/css/bootstrap-table.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/style-front.css')}}" />

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
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{asset('images/e-civil-ci.svg')}}" alt="Logo État Civil CI" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ 
                        Route::currentRouteName() === 'services' || 
                        Route::currentRouteName() === 'declaration-naissance' ||
                        Route::currentRouteName() === 'declaration-mariage' ||
                        Route::currentRouteName() === 'declaration-deces' ||
                        Route::currentRouteName() === 'declaration-vie' ||
                        Route::currentRouteName() === 'legalisation-document' ||
                        Route::currentRouteName() === 'copie-acte' ? 'active' : '' }} dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item {{ Route::currentRouteName() === 'services' ? 'active' : '' }}" href="{{ route(name: 'services') }}">Tous les services</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item {{ Route::currentRouteName() === 'declaration-naissance' ? 'active' : '' }}" href="{{ route(name: 'declaration-naissance') }}">Déclaration de naissance</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ Route::currentRouteName() === 'declaration-mariage' ? 'active' : '' }}" href="{{ route(name: 'declaration-mariage') }}">Déclaration de mariage</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ Route::currentRouteName() === 'declaration-deces' ? 'active' : '' }}" href="{{ route(name: 'declaration-deces') }}">Déclaration de décès</a>
                            </li>
                            <!--li>
                                <a class="dropdown-item {{ Route::currentRouteName() === 'declaration-vie' ? 'active' : '' }}" href="{{ route(name: 'declaration-vie') }}">Certification de vie</a>
                            </li-->
                            <li>
                                <a class="dropdown-item {{ Route::currentRouteName() === 'legalisation-document' ? 'active' : '' }}" href="{{ route(name: 'legalisation-document') }}">Légalisation de documents</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ Route::currentRouteName() === 'copie-acte' ? 'active' : '' }}" href="{{ route(name: 'copie-acte') }}">Copies d'actes</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() === 'tarifs' ? 'active' : '' }}" href="{{ route(name: 'tarifs') }}">Tarifs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() === 'about' ? 'active' : '' }}" href="{{ route(name: 'about') }}">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() === 'contact' ? 'active' : '' }}" href="{{ route(name: 'contact') }}">Contact</a>
                    </li>
                    @auth
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('template/images/avatars/1.png') }}" alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarProfile">
                            <li>
                                <a class="dropdown-item" href="{{ route(name: 'client-home') }}">Tableau de bord</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route(name: 'mon-profil') }}">Profil</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('client-logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">Se déconnecter</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-success {{ Route::currentRouteName() === 'sign-in' ? 'active' : '' }}" href="{{ route('sign-in') }}">Se connecter</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-primary {{ Route::currentRouteName() === 'sign-up' ? 'active' : '' }}" href="{{ route('sign-up') }}">S'inscrire</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    @yield('content-front')
    <!-- Footer -->
    <footer class="footer py-5 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <p>
                        <img src="{{asset('images/e-civil-ci.svg')}}" alt="Logo État Civil CI" class="mb-4 d-block" />
                        Système de Gestion Intégré de l'État Civil de Côte d'Ivoire. Une
                        solution innovante pour rapprocher l'état civil des citoyens.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/" class="text-white text-decoration-none">Accueil</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route(name: 'services') }}" class="text-white text-decoration-none">Services</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route(name: 'about') }}" class="text-white text-decoration-none">À propos</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route(name: 'contact') }}" class="text-white text-decoration-none">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5>Services</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route(name: 'declaration-naissance') }}" class="text-white text-decoration-none">Déclaration de naissance</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route(name: 'declaration-mariage') }}" class="text-white text-decoration-none">Déclaration de mariage</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route(name: 'declaration-deces') }}" class="text-white text-decoration-none">Déclaration de décès</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route(name: 'legalisation-document') }}" class="text-white text-decoration-none">Légalisation de documents</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i> Abidjan, Cocody
                            Deux-Plateaux
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i> +225 0781452561
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            contact@e-civil.ci
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light" />
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">
                        &copy; 2025 État Civil Côte d'Ivoire. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Mentions légales</a>
                    <a href="#" class="text-white text-decoration-none me-3">Politique de confidentialité</a>
                    <a href="#" class="text-white text-decoration-none">CGU</a>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="{{asset('template/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{asset('js/function-crud.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/js/bootstrap-table.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/bootstrap-table/locale/bootstrap-table-fr-FR.js')}}"></script>
</body>
</html>