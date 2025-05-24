@extends(
'layouts.app',
[
'title' => 'E-Civil | Déclaration mariage',
]
)
@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des déclarations de mariage</h5>
        <table id="table" 
            class="mb-0 table table-striped table-hover" 
            data-pagination="true" 
            data-search="true" 
            data-toggle="table" 
            data-show-columns="false" 
            data-unique-id="id" 
            data-show-toggle="false" 
            data-url="{{url('back', ['action'=>'liste-declarations-mariage'])}}">
            <thead>
                <tr>
                    <th data-field="id" data-width="50px" data-align="center" data-formatter="docFormatter"><i class="fa fa-list"></i></th>
                    <th data-field="numero_declaration">Référence</th>
                    <th data-field="date_mariage" data-formatter="dateFormatter">Date mariage</th>
                    <th data-field="lieu_mariage">Lieu</th>
                    <th data-field="regime_matrimonial">Régime</th>
                    <th data-formatter="epouxFormatter">Epoux</th>
                    <th data-formatter="epouseFormatter">Epouse</th>
                    <th data-field="nom_complet_temoins_1">Temoins 1</th>
                    <th data-field="nom_complet_temoins_2">Temoins 2</th>
                    <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-wrench"></i></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@push('modal')
<div class="modal fade bs-modal-documents" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDocumentsLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">  <!-- Réduit la taille du modal avec modal-sm -->
        <div class="modal-content" id="formDocument" ng-controller="formDocumentCtrl">
            <div class="modal-header bg-success rounded-top">
                <h5 class="modal-title text-white h4" id="modalDocumentsLabel">  <!-- Utilisation de h4 pour un titre plus petit -->
                    <i class="fa fa-file-alt pe-2"></i> Documents de preuve
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">  <!-- Centrer le contenu du modal -->
                <div class="document-links">
                    <!-- Lignes pour chaque document -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(mariage.piece_identite_epoux) }}" alt="Pièce d'idéntité de l'époux">
                                <i class="fa fa-eye pe-2"></i> Voir la pièce d'idéntité de l'époux
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(mariage.piece_identite_epouse) }}" alt="Pièce d'idéntité de l'épouse">
                                <i class="fa fa-eye pe-2"></i> Voir la pièce d'idéntité de l'épouse
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(mariage.acte_naissance_epoux) }}" alt="L'acte de naissance de l'époux">
                                <i class="fa fa-eye pe-2"></i> Voir l'acte de naissance de l'époux
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(mariage.acte_naissance_epouse) }}" alt="L'acte de naissance de l'épouse">
                                <i class="fa fa-eye pe-2"></i> Voir l'acte de naissance de l'épouse
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(mariage.certificats_celibat_ou_coutume) }}" alt="Certificat de célibat">
                                <i class="fa fa-eye pe-2"></i> Voir le certificat de célibat
                            </a>
                        </div>
                    </div>

                     <div class="row mb-3">
                        <div class="col-12">
                            <a ng-if="mariage.contrat_mariage" class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(naissance.contrat_mariage) }}" alt="Contrat de mariage">
                                <i class="fa fa-eye pe-2"></i> Voir le contrat de mariage
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
        $scope.populateForm = function(mission) {
            $scope.mission = mission;
        };
        $scope.initForm = function() {
            ajout = true;
            $scope.mission = {};
        };
    });

    appSmarty.controller('formDocumentCtrl', function($scope) {
        $scope.populateForm = function(mariage) {
            $scope.mariage = mariage;
        };

        $scope.getDocumentSrc = function(document) {
            return document ? document : "Aucun document fourni";
        };
    });

    $(function() {
        $table.on('load-success.bs.table', function(e, data) {
            rows = data.rows;
        });
    });

    
    function dateFormatter(date){
        return date ? formatDate(date) : 'Non définie';
    }

    function epouxFormatter(id, row) {
        return row.prenoms_epoux + "  " + row.nom_epoux;
    }

    function epouseFormatter(id, row) {
        return row.prenoms_epouse + "  " + row.nom_epouse;
    }

    function showDocument(idMariage) {
        var $scope = angular.element($("#formDocument")).scope();
        var mariage = _.findWhere(rows, {
            id: idMariage
        });
        $scope.$apply(function() {
            $scope.populateForm(mariage);
        });
        $(".bs-modal-documents").modal("show");
    }

    function docFormatter(id) {
        return '<button class="btn-transition btn btn-xs btn-outline-success" title="Voir les documents" onClick="javascript:showDocument(' + id + ');"><i class="lnr-eye"> </i></button>';
    }

    function optionFormatter(id, row) {
        return row.date_fin ? '--' : '<button class="btn-transition btn btn-xs btn-outline-primary" title="Modifier" onClick="javascript:updateRow(' + id + ');"><i class="lnr-pencil"> </i></button>';
    }
</script>
@endpush