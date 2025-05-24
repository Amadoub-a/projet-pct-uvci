@extends(
'layouts.app',
[
'title' => 'E-Civil | Légalisation',
]
)
@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des légalisations</h5>
        <table id="table" 
            class="mb-0 table table-striped table-hover" 
            data-pagination="true" 
            data-search="true" 
            data-toggle="table" 
            data-show-columns="false" 
            data-unique-id="id" 
            data-show-toggle="false" 
            data-url="{{url('back', ['action'=>'liste-legalisations'])}}">
            <thead>
                <tr>
                    <th data-field="id" data-width="50px" data-align="center" data-formatter="docFormatter"><i class="fa fa-list"></i></th>
                    <th data-field="numero_declaration">Référence</th>
                    <th data-formatter="titulaireFormatter">Titulaire</th>
                    <th data-field="contact_personne">Contact</th>
                    <th data-field="profession_personne">Profession</th>
                    <th data-field="document_original" data-formatter="documentFormatter">Document à légaliser</th>
                    <th data-field="type_document" data-formatter="typeFormatter">Type document</th>
                    <th data-field="nb_copies">Copie(s)</th>
                    <th data-field="date_document"  data-formatter="dateFormatter">Date document</th>
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
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(legalisation.piece_demandeur) }}" alt="Pièce d'idéntité du demandeur">
                                <i class="fa fa-eye pe-2"></i> Voir la pièce d'idéntité du demandeur
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(legalisation.justificatif_domicile) }}" alt="Justificatif domicile">
                                <i class="fa fa-eye pe-2"></i> Voir le justificatif domicile
                            </a>
                        </div>
                    </div>

                     <div class="row mb-3">
                        <div class="col-12">
                            <a ng-if="legalisation.procuration" class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(legalisation.procuration) }}" alt="Procuration">
                                <i class="fa fa-eye pe-2"></i> Voir la procuration
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
        $scope.populateForm = function(legalisation) {
            $scope.legalisation = legalisation;
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

    function titulaireFormatter(id, row) {
        return row.prenoms_personne + "  " + row.nom_personne;
    }

    function typeFormatter(type){
        return type.charAt(0).toUpperCase() + type.slice(1).toLowerCase();
    }

    function documentFormatter(document){
        return  `<a href="${document}" target="_blank">Voir le document</a>`;
    }

    function showDocument(idLegalisation) {
        var $scope = angular.element($("#formDocument")).scope();
        var legalisation = _.findWhere(rows, {
            id: idLegalisation
        });
        $scope.$apply(function() {
            $scope.populateForm(legalisation);
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