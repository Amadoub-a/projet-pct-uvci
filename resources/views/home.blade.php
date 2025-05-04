@extends(
'layouts.app',
[
'title' => 'E-Civil | Tableau de bord',
]
)
@section('content')
@if(auth()->user()->country_id != null)
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-primary border-primary card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Cartes d'identité à expirer </div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-danger pe-2">
                                    <i class="fa fa-id-card"></i>
                                </span>
                                5
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-gradient-alt-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-danger border-danger card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Cartes valides</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-success pe-2">
                                    <i class="fa fa-id-badge"></i>
                                </span>
                                35
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-danger-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-warning border-warning card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">En attente de confirmation</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-warning pe-2">
                                    <i class="fa fa-newspaper"></i>
                                </span>
                                2
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-warning-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-success border-success card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Employées</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-primary pe-2">
                                    <i class="fa fa-users"></i>
                                </span>
                                55
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-success-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="app-main__inner">
        <div class="card mb-3">
            <div class="card-header pe-0 ps-0">
                <div class="row g-0 align-items-center w-100">
                    <div class="col fw-bold ps-3">Démandeur</div>
                    <div class="d-none d-md-block col-6 text-muted">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">Statut</div>
                            <div class="col-3">No de Carte</div>
                            <div class="col-6">Commentaire</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="row g-0 align-items-center">
                    <div class="col">
                        <a class="text-big fw-semibold">
                            Wilfried PONDA
                        </a>
                    </div>
                    <div class="d-none d-md-block col-6">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">Rejeté</div>
                            <div class="col-3">34 652 963</div>
                            <div class="d-flex col-6 align-items-center">
                                <div class="flex-grow-1 flex-truncate ms-2">
                                    Démande réfusée pour manque de document
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="card-body py-3">
                <div class="row g-0 align-items-center">
                    <div class="col">
                        <a class="text-big fw-semibold">
                            KOFFI Serge Edmon
                        </a>
                    </div>
                    <div class="d-none d-md-block col-6">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">En cours</div>
                            <div class="col-3">34 555 963</div>
                            <div class="d-flex col-6 align-items-center">
                                <div class="flex-grow-1 flex-truncate ms-2">
                                    Traitement en cours
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="card-body py-3">
                <div class="row g-0 align-items-center">
                    <div class="col">
                        <a class="text-big fw-semibold">
                            Amon KOUASSI
                        </a>
                    </div>
                    <div class="d-none d-md-block col-6">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">Terminé</div>
                            <div class="col-3">34 555 000</div>
                            <div class="d-flex col-6 align-items-center">
                                <div class="flex-grow-1 flex-truncate ms-2">
                                    Carte disponible
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header ps-0 pe-0">
                <div class="row w-100 g-0 align-items-center">
                    <div class="col fw-bold ps-3">FACTURE</div>
                    <div class="d-none d-md-block col-6 text-muted">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">Montant TVA</div>
                            <div class="col-3">Statut</div>
                            <div class="col-6">Commentaire</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="row g-0 align-items-center">
                    <div class="col">
                        <a class="text-big fw-semibold">FACT-5696</a>
                    </div>
                    <div class="d-none d-md-block col-6">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">63 202</div>
                            <div class="col-3">En cocurs</div>
                            <div class="d-flex col-6 align-items-center">
                                <div class="flex-grow-1 flex-truncate ms-2">
                                    <a class="d-block text-truncate">
                                        Traitement en cours
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="card-body py-3">
                <div class="row g-0 align-items-center">
                    <div class="col">
                        <a class="text-big fw-semibold">FACT-5000</a>
                    </div>
                    <div class="d-none d-md-block col-6">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">73 202</div>
                            <div class="col-3">En cocurs</div>
                            <div class="d-flex col-6 align-items-center">
                                <div class="flex-grow-1 flex-truncate ms-2">
                                    <a class="d-block text-truncate">
                                        Traitement en cours
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="card-body py-3">
                <div class="row g-0 align-items-center">
                    <div class="col">
                        <a class="text-big fw-semibold">54-5632</a>
                    </div>
                    <div class="d-none d-md-block col-6">
                        <div class="row g-0 align-items-center">
                            <div class="col-3">33 202</div>
                            <div class="col-3">En cocurs</div>
                            <div class="d-flex col-6 align-items-center">
                                <div class="flex-grow-1 flex-truncate ms-2">
                                    <a class="d-block text-truncate">
                                        Traitement en cours
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-primary border-primary card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Missions diplomatiques</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-success pe-2">
                                    <i class="fa fa-book"></i>
                                </span>
                                234
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-gradient-alt-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-danger border-danger card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Véhicules</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-danger pe-2">
                                    <i class="fa fa-car"></i>
                                </span>
                                350
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-danger-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-warning border-warning card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Diplomates</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-warning pe-2">
                                    <i class="fa fa-users"></i>
                                </span>
                                2500
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-warning-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-success border-success card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Employées locaux</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-primary pe-2">
                                    <i class="fa fa-users"></i>
                                </span>
                                221
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-success-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-primary border-primary card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Documents validés</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-success pe-2">
                                    <i class="fa fa-thumbs-up"></i>
                                </span>
                                23
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-gradient-alt-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-primary border-primary card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Documents rejetés</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-danger pe-2">
                                    <i class="fa fa-thumbs-down"></i>
                                </span>
                                12
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-gradient-alt-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-primary border-primary card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Documents en cours</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-warning pe-2">
                                    <i class="fa fa-spinner"></i>
                                </span>
                                45
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-gradient-alt-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-primary border-primary card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Documents traités</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-primary pe-2">
                                    <i class="fa fa-file"></i>
                                </span>
                                35
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-gradient-alt-sm d-inline-block"><canvas width="46" height="46"></canvas>
                                    <!--small><span>230<span></span></span></small-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
        <div class="card">
            <div class="g-0 row">
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="pt-0 pb-0 card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Documents validés</div>
                                                <div class="widget-subheading">Sur un total de 35 documents</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-warning">45,5%</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%;">
                                                </div>
                                            </div>
                                            <div class="progress-sub-label">
                                                <div class="sub-label-left">Année 2025</div>
                                                <div class="sub-label-right">100%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="pt-0 pb-0 card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Documents réjetés</div>
                                                <div class="widget-subheading">Sur un total de 35 documents</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-danger">15%</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%;">
                                                </div>
                                            </div>
                                            <div class="progress-sub-label">
                                                <div class="sub-label-left">Année 2025</div>
                                                <div class="sub-label-right">100%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="pt-0 pb-0 card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Documents en cours</div>
                                                <div class="widget-subheading">Sur un total de 80 documents</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-success">55%</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%;">
                                                </div>
                                            </div>
                                            <div class="progress-sub-label">
                                                <div class="sub-label-left">Année 2025</div>
                                                <div class="sub-label-right">100%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="pt-0 pb-0 card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Documents en traités</div>
                                                <div class="widget-subheading">Sur un total de 80 documents</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-info">45%</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%;">
                                                </div>
                                            </div>
                                            <div class="progress-sub-label">
                                                <div class="sub-label-left">Année 2025</div>
                                                <div class="sub-label-right">100%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Statut des démandes de document</h5>
            <table class="mb-0 table table-bordered">
                <thead>
                    <tr>
                        <th>Mission diplomatique</th>
                        <th>No de la démande</th>
                        <th>Date de la démande</th>
                        <th>Type de document</th>
                        <th>Démandeur</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Commentaire</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Togo</td>
                        <td>569-6695</td>
                        <td>12-05-2025</td>
                        <td>Carte de séjour</td>
                        <td>Edwige Ponda</td>
                        <td>Sécretaire</td>
                        <td>En cours</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>France</td>
                        <td>874-5523</td>
                        <td>10-02-2025</td>
                        <td>Visa</td>
                        <td>Jean Dupont</td>
                        <td>Consul</td>
                        <td>Approuvé</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Canada</td>
                        <td>365-8741</td>
                        <td>15-01-2025</td>
                        <td>Carte TVA</td>
                        <td>Sophie Tremblay</td>
                        <td>Attachée</td>
                        <td>Refusé</td>
                        <td>Manque de certaisn documents</td>
                    </tr>
                    <tr>
                        <td>Allemagne</td>
                        <td>998-4521</td>
                        <td>20-03-2025</td>
                        <td>Carte diplomatique</td>
                        <td>Klaus Müller</td>
                        <td>Ambassadeur</td>
                        <td>En cours</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Sénégal</td>
                        <td>741-3698</td>
                        <td>05-12-2024</td>
                        <td>Carte d'entrée aéroportuaire</td>
                        <td>Aïssatou Diop</td>
                        <td>Consul</td>
                        <td>Approuvé</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Brésil</td>
                        <td>652-1478</td>
                        <td>08-04-2025</td>
                        <td>Carte TVA</td>
                        <td>Carlos Ferreira</td>
                        <td>Secrétaire</td>
                        <td>En attente</td>
                        <td>Documents manquants re&ccedil;us</td>
                    </tr>
                    <tr>
                        <td>Japon</td>
                        <td>785-9632</td>
                        <td>30-11-2024</td>
                        <td>Certificat de résidence</td>
                        <td>Hiroshi Tanaka</td>
                        <td>Attaché culturel</td>
                        <td>Approuvé</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection