@extends(
'layouts.app',
[
'title' => "E-Civil | Demande de copie d'acte",
]
)
@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des demandes de copie d'acte</h5>
        <table id="table"
            class="mb-0 table table-striped table-hover"
            data-pagination="true"
            data-search="true"
            data-toggle="table"
            data-show-columns="false"
            data-unique-id="id"
            data-show-toggle="false"
            data-url="{{url('back', ['action'=>'liste-copies-actes'])}}">
            <thead>
                <tr>
                    <th data-field="numero_declaration">Référence</th>
                    <th data-field="type_acte" data-formatter="typeFormatter">Type d'acte</th>
                    <th data-field="type_copie" data-formatter="typeFormatter">Type de copie</th>
                    <th data-field="numero_acte">Numero d'acte</th>
                    <th data-formatter="titulaireFormatter">Titulaire</th>
                    <th data-field="date_naissance" data-formatter="dateFormatter">Date naissasnce</th>
                    <th data-field="commune.libelle_commune">Lieu</th>
                    <th data-formatter="demandeurFormatter">Demandeur</th>
                    <th data-field="contact_demandeur">Contact</th>
                    <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-wrench"></i></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@push('modal')

@endpush
@push('javascript')
<script type="text/javascript">
    var ajout = true;
    var $table = jQuery("#table"),
        rows = [];

    appSmarty.controller('formAjoutCtrl', function($scope) {
        $scope.populateForm = function(mission) {
            $scope.mission = mission;
        };
        $scope.initForm = function() {
            ajout = true;
            $scope.mission = {};
        };
    });

    appSmarty.controller('formFinMissionCtrl', function($scope) {
        $scope.populateForm = function(mission) {
            $scope.mission = mission;
        };
        $scope.initForm = function() {
            ajout = true;
            $scope.mission = {};
        };
    });

    appSmarty.controller('formSupprimerCtrl', function($scope) {
        $scope.populateForm = function(mission) {
            $scope.mission = mission;
        };
        $scope.initForm = function() {
            $scope.mission = {};
        };
    });

    $(function() {
        $table.on('load-success.bs.table', function(e, data) {
            rows = data.rows;
        });
    });


    function dateFormatter(date) {
        return date ? formatDate(date) : 'Non définie';
    }

    function titulaireFormatter(id, row) {
        return row.prenoms + "  " + row.nom;
    }

    function demandeurFormatter(id, row) {
        return row.prenom_demandeur + "  " + row.nom_demandeur;
    }

    function typeFormatter(type){
        return type.charAt(0).toUpperCase() + type.slice(1).toLowerCase();
    }

    function optionFormatter(id, row) {
        return row.date_fin ? '--' : '<button class="btn-transition btn btn-xs btn-outline-primary" title="Modifier" onClick="javascript:updateRow(' + id + ');"><i class="lnr-pencil"> </i></button>';
    }
</script>
@endpush