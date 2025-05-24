@extends(
'layouts.app',
[
'title' => 'E-Civil | Déclaration naissance',
]
)
@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des déclarations de naissance</h5>
        <table id="table"
            class="mb-0 table table-striped table-hover"
            data-pagination="true"
            data-search="true"
            data-toggle="table"
            data-show-columns="false"
            data-unique-id="id"
            data-show-toggle="false"
            data-url="{{url('back', ['action'=>'liste-declarations-naissances'])}}">
            <thead>
                <tr>
                    <th data-field="id" data-width="50px" data-align="center" data-formatter="docFormatter"><i class="fa fa-list"></i></th>
                    <th data-field="numero_declaration">Référence</th>
                    <th data-field="nom_enfant">Nom enfant</th>
                    <th data-field="prenoms_enfant">Prénom enfant</th>
                    <th data-field="sexe_enfant">Sexe enfant</th>
                    <th data-field="date_naissance_enfant" data-formatter="dateFormatter">Date naissance</th>
                    <th data-field="heure_naissance_enfant">heure naissance</th>
                    <th data-field="lieu_naissance_enfant">Lieu naissance</th>
                    <th data-field="etablissement_naissance_enfant" data-visible="false">Etablissement</th>
                    <th data-formatter="pereFormatter">Père</th>
                    <th data-formatter="mereFormatter">Mère</th>
                    <th data-formatter="declarantFormatter">Déclarant</th>
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
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(naissance.certificat_naissance) }}" alt="Certificat de naissance">
                                <i class="fa fa-eye pe-2"></i> Voir le Certificat de naissance
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(naissance.piece_identite_pere) }}" alt="Piece d'identité du père">
                                <i class="fa fa-eye pe-2"></i> Voir la pièce d'identité du père
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(naissance.piece_identite_mere) }}" alt="Piece d'identité de la mère">
                                <i class="fa fa-eye pe-2"></i> Voir la pièce d'identité de la mère
                            </a>
                        </div>
                    </div>

                     <div class="row mb-3">
                        <div class="col-12">
                            <a ng-if="naissance.piece_identite_declarant" class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(naissance.piece_identite_declarant) }}" alt="Piece d'identité du déclarant">
                                <i class="fa fa-eye pe-2"></i> Voir la pièce d'identité du déclarant
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
        $scope.populateForm = function(naissance) {
            $scope.naissance = naissance;
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


    function dateFormatter(date) {
        return date ? formatDate(date) : 'Non définie';
    }

    function pereFormatter(id, row) {
        if (row.prenoms_pere) {
            return row.prenoms_pere + "  " + row.nom_pere;
        } else {
            return " - ";
        }
    }

    function mereFormatter(id, row) {
        if (row.prenoms_mere) {
            return row.prenoms_mere + "  " + row.nom_mere;
        } else {
            return " - ";
        }
    }

    function declarantFormatter(id, row) {
        if (row.declarant == "Autre") {
            return row.nom_declarant + "  " + row.prenoms_declarant;
        }
        if (row.declarant == "Mère") {
            return "Mère";
        }
        if (row.declarant == "Père") {
            return "Père";
        }
    }

    function showDocument(idNaissance) {
        var $scope = angular.element($("#formDocument")).scope();
        var naissance = _.findWhere(rows, {
            id: idNaissance
        });
        $scope.$apply(function() {
            $scope.populateForm(naissance);
        });
        $(".bs-modal-documents").modal("show");
    }

    function docFormatter(id) {
        return '<button class="btn-transition btn btn-xs btn-outline-success" title="Voir les documents" onClick="javascript:showDocument(' + id + ');"><i class="lnr-eye"> </i></button>';
    }

    function optionFormatter(id, row) {
        return '<button class="btn-transition btn btn-xs btn-outline-primary" title="Modifier" onClick="javascript:updateRow(' + id + ');"><i class="lnr-pencil"> </i></button>';
    }
</script>
@endpush