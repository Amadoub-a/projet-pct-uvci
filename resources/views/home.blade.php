@extends('layouts.app')

@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des nouvelles demandes</h5>
        <table id="table"
            class="mb-0 table table-striped table-hover"
            data-pagination="true"
            data-search="true"
            data-toggle="table"
            data-show-columns="false"
            data-unique-id="id"
            data-show-toggle="false"
            data-url="{{url('back', ['action'=>'liste-nouvelle-demandes'])}}">
            <thead>
                <tr>
                    <th data-field="reference" data-search="true">Référence</th>
                    <th data-field="date_declaration" data-formatter="dateFormatter">Date déclaration</th>
                    <th data-field="type">Type de demande</th>
                    <th data-field="date_traitement" data-formatter="dateFormatter">Traitement</th>
                    <th data-field="date_disponible" data-formatter="dateFormatter">Disponible</th>
                    <th data-field="etat">Etat de la demande</th>
                    <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-wrench"></i></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-start mb-3 card-btm-border card-shadow-primary border-primary card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Demandes traitées</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-success pe-2">
                                    <i class="fa fa-check-circle"></i>
                                </span>
                                {{ $demandeTraitees }}
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-gradient-alt-sm d-inline-block"><canvas width="46" height="46"></canvas></div>
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
                    <div class="widget-title opacity-5 text-uppercase">Demandes en cours ou enregistrées</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-warning pe-2">
                                    <i class="fa fa-spinner"></i>
                                </span>
                                {{ $demandeCours }}
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-danger-sm d-inline-block"><canvas width="46" height="46"></canvas></div>
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
                    <div class="widget-title opacity-5 text-uppercase">Demandes rejetées</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-danger pe-2">
                                    <i class="fa fa-times-circle"></i>
                                </span>
                                {{ $demandeRejetees }}
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-warning-sm d-inline-block"><canvas width="46" height="46"></canvas></div>
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
                    <div class="widget-title opacity-5 text-uppercase">Total des demandes</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-primary pe-2">
                                    <i class="fa fa-users"></i>
                                </span>
                                {{ $demandes }}
                            </div>
                            <div class="widget-title ms-auto font-size-lg fw-normal text-muted">
                                <div class="circle-progress circle-progress-success-sm d-inline-block"><canvas width="46" height="46"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('javascript')
<script type="text/javascript">
    var $table = jQuery("#table"),
        rows = [];

    $(function() {
        $table.on('load-success.bs.table', function(e, data) {
            rows = data.rows;
        });
    });

    function dateFormatter(date) {
        return date ? formatDate(date) : 'Non définie';
    }

    function voirDemande(idDemande) {
        var demande = _.findWhere(rows, {
            traitement_id: idDemande
        });

        switch (demande.type) {
            case "Déclaration de naissance":
                location.href = "back/vue-declarations-naissances";
                break;
            case "Déclaration de mariage":
                location.href = "back/vue-declarations-mariage";
                break;
            case "Déclaration de décès":
                location.href = "back/vue-declarations-deces";
                break;
            case "Légalisation de document":
                location.href = "back/vue-legalisations";
                break;
            case "Demande de copie d'acte":
                location.href = "back/vue-copies-actes";
                break;
            default:
                alert("Demande inconnue ou non prise en charge.");
                break;
        }
    }


    function optionFormatter(id, row) {
        return '<button class="btn-transition btn btn-xs btn-outline-primary" title="Voir la demande" onClick="javascript:voirDemande(' + row.traitement_id + ');"><i class="fa fa-eye"> </i></button>';
    }
</script>
@endpush