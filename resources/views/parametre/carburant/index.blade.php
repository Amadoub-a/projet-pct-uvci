@extends(
'layouts.app',
[
'title' => 'Smart Parc Auto | Carburant',
]
)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="main-card mb-3 card">
            <form id="formAjout" ng-controller="formAjoutCtrl">
                @csrf
                <input type="text" class="hidden" id="idCarburantModifier" ng-hide="true" ng-model="carburant.id" />
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" style="color:#fff;">
                        {{$titleControlleur}}
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="position-relative mb-3">
                            <label for="libelle_carburant" class="form-label">Libell&eacute; *</label>
                            <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control" ng-model="carburant.libelle_carburant" name="libelle_carburant" id="libelle_carburant" placeholder="Niveau du carburant" autofocus required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="mb-2 me-2 btn-icon btn btn-primary">
                        <i class="pe-7s-check btn-icon-wrapper"></i> Valider
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Liste des niveaux</h5>
                <table id="table" class="mb-0 table table-striped table-hover" data-pagination="true" data-search="false" data-toggle="table" data-show-columns="false" data-url="{{url('parametre', ['action'=>'liste-carburants'])}}" data-show-toggle="false">
                    <thead>
                        <tr>
                            <th data-field="libelle_carburant" data-sortable="true">Niveau du carburant</th>
                            <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-wrench"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('modal')
<div class="modal fade bs-modal-suppression" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formSupprimer" ng-controller="formSupprimerCtrl">
                @csrf
                <input type="text" class="hidden" id="idCarburantSupprimer" ng-hide="true" ng-model="carburant.id" />
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-trash"></i> Suppression de donn&eacute;es
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-question-circle fa-2x"></i>
                        Etes vous certains de vouloir supprimer<br /><b>@{{carburant.libelle_carburant}}</b>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush
@push('javascript')
<script type="text/javascript">
    var ajout = true;
    var $table = jQuery("#table"),
        rows = [];

    appSmarty.controller('formAjoutCtrl', function($scope) {
        $scope.populateForm = function(carburant) {
            $scope.carburant = carburant;
        };
        $scope.initForm = function() {
            ajout = true;
            $scope.carburant = {};
        };
    });

    appSmarty.controller('formSupprimerCtrl', function($scope) {
        $scope.populateForm = function(carburant) {
            $scope.carburant = carburant;
        };
        $scope.initForm = function() {
            $scope.carburant = {};
        };
    });

    $(function() {
        $table.on('load-success.bs.table', function(e, data) {
            rows = data.rows;
        });
        
        $("#formAjout").submit(function(e) {
            e.preventDefault();
            var $ajaxLoader = $('#formAjout');

            var $valid = $(this).valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }

            if (ajout == true) {
                var methode = 'POST';
                var url = "{{route('parametre.carburants.store')}}";
            } else {
                var id = $("#idCarburantModifier").val();
                var methode = 'PUT';
                var url = 'carburants/' + id;
            }
            editerAction(methode, url, $(this), $(this).serialize(), $ajaxLoader, $table, ajout);
        });

        $("#formSupprimer").submit(function(e) {
            e.preventDefault();
            var id = $("#idCarburantSupprimer").val();
            var formData = $(this).serialize();
            var $ajaxLoader = $(".bs-modal-suppression");
            supprimerAction('carburants/' + id, $(this).serialize(), $ajaxLoader, $table);
        });
    });

    function updateRow(idCarburant) {
        ajout = false;
        var $scope = angular.element($("#formAjout")).scope();
        var carburant = _.findWhere(rows, {
            id: idCarburant
        });
        $scope.$apply(function() {
            $scope.populateForm(carburant);
        });
    }

    function deleteRow(idCarburant) {
        var $scope = angular.element($("#formSupprimer")).scope();
        var carburant = _.findWhere(rows, {
            id: idCarburant
        });
        $scope.$apply(function() {
            $scope.populateForm(carburant);
        });
        $(".bs-modal-suppression").modal("show");
    }

    function optionFormatter(id, row) {
        return '<button class="btn-transition btn btn-xs btn-outline-primary" title="Modifier" onClick="javascript:updateRow(' + id + ');"><i class="lnr-pencil"> </i></button>\n\
                <button class="btn-transition btn btn-xs btn-outline-danger" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"><i class="lnr-trash"> </i></button>';
    }
</script>
@endpush