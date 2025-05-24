@extends(
'layouts.app',
[
'title' => 'E-Civil | Déclaration décès',
]
)
@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des déclarations des décès</h5>
        <table id="table"
            class="mb-0 table table-striped table-hover"
            data-pagination="true"
            data-search="true"
            data-toggle="table"
            data-show-columns="false"
            data-unique-id="id"
            data-show-toggle="false"
            data-url="{{url('back', ['action'=>'liste-declarations-deces'])}}">
            <thead>
                <tr>
                    <th data-field="id" data-width="50px" data-align="center" data-formatter="docFormatter"><i class="fa fa-list"></i></th>
                    <th data-field="numero_declaration">Référence</th>
                    <th data-field="date_deces" data-formatter="dateFormatter">Date décès</th>
                    <th data-field="heure_deces">Heure décès</th>
                    <th data-field="lieu_deces">Lieu</th>
                    <th data-field="cause_deces">Cause</th>
                    <th data-formatter="defuntFormatter">Défunt</th>
                    <th data-formatter="ageFormatter">Age</th>
                    <th data-field="sexe_defunt">Sexe</th>
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
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(deces.certificat_deces) }}" alt="Certificat de décès">
                                <i class="fa fa-eye pe-2"></i> Voir le certificat de décès
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(deces.piece_identite_defunt) }}" alt="Pièce d'idéntité du défunt">
                                <i class="fa fa-eye pe-2"></i> Voir la pièce d'idéntité du défunt
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(deces.acte_naissance_defunt) }}" alt="L'acte de naissance du défunt">
                                <i class="fa fa-eye pe-2"></i> Voir l'acte de naissance du défunt
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(deces.piece_identite_declarant) }}" alt="Pièce d'idéntité du déclarant">
                                <i class="fa fa-eye pe-2"></i> Voir la pièce d'idéntité du déclarant
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
        $scope.populateForm = function(deces) {
            $scope.deces = deces;
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

    function defuntFormatter(id, row) {
        return row.prenoms_defunt + "  " + row.nom_defunt;
    }

    function declarantFormatter(id, row) {
        return row.prenoms_declarant + "  " + row.nom_declarant;
    }

    function ageFormatter(id, row) {
        // Récupérer la date de naissance et la date de décès depuis les données de la ligne
        let dateNaissance = row.date_naissance_defunt;
        let dateDeces = row.date_deces;

        // Vérifier que les deux dates existent
        if (!dateNaissance || !dateDeces) {
            return "Date manquante"; // Retourner un message si l'une des dates est manquante
        }

        // Convertir les dates en objets Date
        const birthDate = new Date(dateNaissance);
        const deathDate = new Date(dateDeces);

        // Calculer l'âge
        let age = deathDate.getFullYear() - birthDate.getFullYear(); // Calcul de base en années
        const monthDifference = deathDate.getMonth() - birthDate.getMonth(); // Vérifier les mois

        // Si la date de décès est avant l'anniversaire de l'année en cours, ajuster l'âge
        if (monthDifference < 0 || (monthDifference === 0 && deathDate.getDate() < birthDate.getDate())) {
            age--; // Soustraire une année si l'anniversaire n'est pas encore passé
        }

        return age > 0 ? age : 0;
    }

    function showDocument(idDeces) {
        var $scope = angular.element($("#formDocument")).scope();
        var deces = _.findWhere(rows, {
            id: idDeces
        });
        $scope.$apply(function() {
            $scope.populateForm(deces);
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