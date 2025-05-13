<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="Smart Parc Auto simplifie la gestion de votre flotte de véhicules avec des outils de suivi en temps réel et des rapports personnalisés pour une efficacité optimale.">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{ @$title ?? config('app.name') }}</title>

    <!-- Template elements -->
    <link rel="stylesheet" href="{{asset('template/vendors/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendors/ionicons-npm/css/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendors/linearicons-master/dist/web-font/style.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{asset('template/styles/css/base.css')}}">

    <!-- plugin dependencies -->
    <link rel="stylesheet" href="{{asset('plugin/loading-modal-indicator/css/jquery.loadingModal.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/css/jquery.gritter.css') }}">
    <link rel="stylesheet" href="{{asset('plugin/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugin/css/bootstrap-table.min.css') }}">

    <script type="text/javascript" src="{{asset('plugin/angular/angular.js')}}"></script>
    <style>
        .style-app-name {
            font-size: large;
            font-weight: bold;
            color: #fff;
        }

        .modal-x-lg {
            max-width: 70%;
        }

    </style>
</head>

<body id="smartyApp" ng-app="smartyApp">
    <script type="text/javascript">
            var appSmarty = angular.module('smartyApp', []);
    </script>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow bg-night-sky header-text-light">
            <div class="app-header__logo">
                <div class="style-app-name">
                    E-Civil
                </div>
                <div class="header__pane ms-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-dots">
                        <div class="dropdown">
                            @if(auth()->user()->role == "admin" or auth()->user()->role == "super-admin")
                                <!--button type="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown" class="p-0 me-2 btn btn-link">
                                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                        <span class="icon-wrapper-bg bg-danger"></span>
                                        <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                                        <span class="badge badge-dot badge-dot-sm">Notifications</span>
                                    </span>
                                </button-->
                            @endif
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                
                                    <!--div class="dropdown-menu-header mb-0">
                                        <div class="dropdown-menu-header-inner bg-deep-blue">
                                            <div class="menu-header-content text-dark">
                                                <h5 class="menu-header-title">Notifications</h5>
                                                <h6 class="menu-header-subtitle">
                                                    Vous avez
                                                    <b id="notificationCount">0</b>
                                                    message(s) non lus
                                                </h6>
                                            </div>
                                        </div>
                                    </div-->
                                
                                <!--div class="tab-content">
                                    <audio id="notificationSound" src="" preload="auto"></audio>

                                    <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container ps">
                                                <div class="p-3">
                                                    <div class="notifications-box">
                                                        <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                            

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                </div>
                                                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav flex-column all-notification-btn">
                                            <li class="nav-item-divider nav-item"></li>
                                            <li class="nav-item-btn text-center nav-item ">
                                                <a href="" class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">Voir toutes les notifications non lues</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div-->
                            </div>
                        </div>
                    </div>
                    <div class="header-btn-lg pe-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  ms-3 header-user-info">
                                    <div class="widget-heading"> {{auth()->user()->name}}</div>
                                    <div class="widget-subheading"> {{ucfirst(str_replace('-',' ',auth()->user()->role))}}</div>
                                </div>
                                <input type="hidden" id="userId" value="{{auth()->user()->id}}">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="{{asset('template/images/avatars/1.png')}}" alt="">
                                            <i class="fa fa-angle-down ms-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2" style="background-image: url('images/dropdown-header/city3.jpg');"></div>
                                                    <div class="menu-header-content text-start">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left me-3">
                                                                    <img width="42" class="rounded-circle" src="{{asset('template/images/avatars/1.png')}}" alt="Photo de profil">
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">{{auth()->user()->name}}</div>
                                                                    <div class="widget-subheading opacity-8">{{ucfirst(str_replace('-',' ',auth()->user()->role))}}</div>
                                                                </div>
                                                                <div class="widget-content-right me-2">
                                                                <a class="btn-pill btn-shadow btn-shine btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                    D&eacute;connexion
                                                                </a>
                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                    {{ csrf_field() }}
                                                                </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-btn text-center nav-item">
                                                    <a href="{{ route('auth.profil') }}" class="btn-wide btn btn-primary btn-sm"> Mon profil</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow bg-night-sky sidebar-text-light">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ms-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>
                    <div class="scrollbar-sidebar ps ps--active-y">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu metismenu">
                            <li class="app-sidebar__heading">Menu</li>
                            <li>
                                <a href="{{route('home')}}" class=" {{Route::currentRouteName() === 'home' ? 'mm-active' : ''}}" aria-expanded="false">
                                    <i class="metismenu-icon pe-7s-display1"></i>
                                    Tableau de bord
                                </a>
                            </li>
                            <li class="app-sidebar__heading"></li>
                            @include("layouts.menus.admin.parametre")
                            <li class="app-sidebar__heading"></li>
                            <li class="app-sidebar__heading"></li>
                            <li>
                                <a href="{{ route('auth.users.index') }}" class=" {{Route::currentRouteName() === 'auth.users.index' ? 'mm-active' : ''}}">
                                    <i class="metismenu-icon pe-7s-users"></i>Utilisateurs
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="metismenu-icon pe-7s-power"></i>D&eacute;connexion
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 636px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 399px;"></div></div></div>
                </div>
               
                <div class="app-main__outer">
                
                    <div class="app-main__inner">
                   
                        <div class="app-page-title">
                                <div class="page-title-wrapper">
                                    <div class="page-title-heading">
                                        <div>
                                            {{$menuPrincipal}}
                                            <div class="page-title-subheading">{{$titleControlleur}}</div>
                                        </div>
                                    </div>
                                    <div class="page-title-actions">
                                        <div class="d-inline-block dropdown">
                                            @if ($btnModalAjout == 'TRUE')
                                                <button type="button" id="btnModalAjout" class="btn-shadow btn btn-info">
                                                <i class="pe-7s-plus"></i>
                                                    Ajouter
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                       
                       <div class="tabs-animation">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-xl-12">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                            <!--div class="app-footer-left">
                                <p>
                                    Copyright © <a href="https://groupsmarty.com/" target="_blank">Group Smarty</a> 2024
                                </p>
                                </div>
                                <div class="app-footer-right">
                                    <ul class="header-megamenu nav">
                                        <li class="nav-item">
                                            <p>
                                            Copyright © <a href="https://groupsmarty.com/" target="_blank">Group Smarty</a> 2024
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div-->
                        </div>
                    </div>
                </div>
            </div>
    </div>

      <!-- plugin dependencies -->
    <script type="text/javascript" src="{{asset('template/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/metismenu/dist/metisMenu.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/loading-modal-indicator/js/jquery.loadingModal.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/@atomaras/bootstrap-multiselect/dist/js/bootstrap-multiselect.js')}}"></script>

    <!-- custome.js -->
    <script type="text/javascript" src="{{asset('template/js/demo.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/js/scrollbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/js/jquery.gritter.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/js/underscore-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/function-crud.js')}}"></script>

    <!-- online plugin -->
    <!--script src="//code.jquery.com/jquery-3.1.1.slim.min.js"></script-->
    <script type="text/javascript" src="{{asset('plugin/js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/js/bootstrap-table.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/bootstrap-table/locale/bootstrap-table-fr-FR.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/js/jquery.number.min.js')}}"></script>

    @stack('modal')   
    @stack('javascript')   

    <script type="text/javascript">
        $(function () {
            
            //Reactivation de fenetre modal (le cas ou 2 fenetres sont superposées)
            $(document).on('hidden.bs.modal', function (e) {
                if ($('.modal:visible').length) {
                    $("body").addClass('modal-open');
                }
            });

            //Au click du bouton ajouter
            $("#btnModalAjout").on("click", function () {
                ajout = true;
                document.forms["formAjout"].reset();
                $(".sectionUniteDepot").hide();
                $(".bs-modal-ajout").modal("show");
            });
        });
  </script>
</body>
</html>