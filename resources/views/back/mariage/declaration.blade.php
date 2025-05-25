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
                    <th data-formatter="referenceFormatter">Référence & état</th>
                    <th data-field="date_mariage" data-formatter="dateFormatter">Date mariage</th>
                    <th data-field="commune.libelle_commune">Lieu</th>
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
<div class="modal fade bs-modal-ajout" data-bs-backdrop="static">
    <div class="modal-dialog modal-x-lg">
        <div class="modal-content">
            <form id="formAjout" ng-controller="formAjoutCtrl" enctype="multipart/form-data">
                @csrf
                <input type="text" class="hidden" id="idMariageModifier" name="idMariageModifier" ng-hide="true"/>
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-add-user"></i> {{$titleControlleur}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-3 text-primary">
                        <i class="fa fa-book pe-2"></i> Informations sur le registre
                    </h5>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="position-relative mb-3">
                                <label for="etat" class="form-label">Etat *</label>
                                <select class="form-select form-control" ng-model="mariage.etat" name="etat" id="etat" required>
                                    <option value="Enregistré">Enregistré</option>
                                    <option value="En cours">En cours</option>
                                    <option value="Validé">Validé</option>
                                    <option value="Disponible">Disponible</option>
                                    <option value="Rejeté">Rejeté</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative mb-3">
                                <label for="numero_extrait" class="form-label">N&deg; registre </label>
                                <input type="text" class="form-control" ng-model="mariage.numero_extrait" name="numero_extrait" id="numero_extrait" placeholder="859856" autofocus>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative mb-3">
                                <label for="date_registre" class="form-label">Date registre </label>
                                <input type="text" class="form-control" name="date_registre" id="date_registre" placeholder="jj-mm-aaaa">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_delivrance" class="form-label">Date de délivrance </label>
                                <input type="text" class="form-control" name="date_delivrance" id="date_delivrance" placeholder="jj-mm-aaaa">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_delivrance" class="form-label">Lieu de délivrance </label>
                                <select class="form-select form-control" name="lieu_delivrance" id="lieu_delivrance">
                                    <option value="">-- Choisissez une commune --</option>
                                    @foreach($communes as $commune)
                                    <option value="{{$commune->id}}">{{$commune->libelle_commune}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-success">
                        <i class="fa fa-child pe-2"></i> Informations sur le mariage
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_mariage" class="form-label">Date du mariage *</label>
                                <input type="text" class="form-control" name="date_mariage" id="date_mariage" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_mariage" class="form-label">Lieu du mariage *</label>
                                <select class="form-select form-control" name="lieu_mariage" id="lieu_mariage" required>
                                    <option value="">-- Choisissez une commune --</option>
                                    @foreach($communes as $commune)
                                    <option value="{{$commune->id}}">{{$commune->libelle_commune}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="regime_matrimonial" class="form-label">Régime matrimonial *</label>
                                <select class="form-select" id="regime_matrimonial" ng-model="mariage.regime_matrimonial" name="regime_matrimonial" required>
                                        <option value="" selected disabled>Sélectionnez un régime</option>
                                        <option value="Communauté de biens">Communauté de biens</option>
                                        <option value="Séparation de biens">Séparation de biens</option>
                                        <option value="Participation aux acquêts">Participation aux acquêts</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="officier_etat_civil" class="form-label">Officier d'etat civil *</label>
                                <input type="text" class="form-control" name="officier_etat_civil" ng-model="mariage.officier_etat_civil" id="officier_etat_civil" required>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-info">
                        <i class="fa fa-user pe-2"></i> Informations sur l'epoux
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_epoux" class="form-label">Nom *</label>
                                <input type="text" class="form-control" ng-model="mariage.nom_epoux" name="nom_epoux" id="nom_epoux" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="prenoms_epoux" class="form-label">Prénom(s) *</label>
                                <input type="text" class="form-control" ng-model="mariage.prenoms_epoux" name="prenoms_epoux" id="prenoms_epoux" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_naissance_epoux" class="form-label">Date de naissance *</label>
                                <input type="text" class="form-control" name="date_naissance_epoux" id="date_naissance_epoux" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_naissance_epoux" class="form-label">Lieu de naissance *</label>
                                <input type="text" class="form-control" ng-model="mariage.lieu_naissance_epoux" name="lieu_naissance_epoux" id="lieu_naissance_epoux" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nationalite_epoux" class="form-label">Nationalité *</label>
                                <select class="form-select form-control" ng-model="mariage.nationalite_epoux" name="nationalite_epoux" id="nationalite_epoux" required>
                                    <option value="ivoirienne">Ivoirienne</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="profession_epoux" class="form-label">Profession</label>
                                <input type="text" class="form-control" ng-model="mariage.profession_epoux" name="profession_epoux" id="profession_epoux">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="adresse_epoux" class="form-label">Adresse *</label>
                                <input type="text" class="form-control" name="adresse_epoux" ng-model="mariage.adresse_epoux" id="adresse_epoux" required>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-danger">
                        <i class="fa fa-female pe-2"></i> Informations sur l'épouse
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_epouse" class="form-label">Nom *</label>
                                <input type="text" class="form-control" ng-model="mariage.nom_epouse" name="nom_epouse" id="nom_epouse" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="prenoms_epouse" class="form-label">Prénom(s) *</label>
                                <input type="text" class="form-control" ng-model="mariage.prenoms_epouse" name="prenoms_epouse" id="prenoms_epouse" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_naissance_epouse" class="form-label">Date de naissance *</label>
                                <input type="text" class="form-control" name="date_naissance_epouse" id="date_naissance_epouse" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_naissance_epouse" class="form-label">Lieu de naissance *</label>
                                <input type="text" class="form-control" ng-model="mariage.lieu_naissance_epouse" name="lieu_naissance_epouse" id="lieu_naissance_epouse" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nationalite_epouse" class="form-label">Nationalité *</label>
                                <select class="form-select form-control" ng-model="mariage.nationalite_epouse" name="nationalite_epouse" id="nationalite_epouse" required>
                                    <option value="ivoirienne">Ivoirienne</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="profession_epouse" class="form-label">Profession</label>
                                <input type="text" class="form-control" ng-model="mariage.profession_epouse" name="profession_epouse" id="profession_epouse">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="adresse_epoux" class="form-label">Adresse *</label>
                                <input type="text" class="form-control" name="adresse_epouse" ng-model="mariage.adresse_epouse" id="adresse_epouse" required>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-warning">
                        <i class="fa fa-users pe-2"></i> Informations sur les temoins
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_complet_temoins_1" class="form-label">Temoins 1</label>
                                <input type="text" class="form-control" ng-model="mariage.nom_complet_temoins_1" name="nom_complet_temoins_1" id="nom_complet_temoins_1" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="contact_temoins_1" class="form-label">Contact *</label>
                                <input type="text" class="form-control" ng-model="mariage.contact_temoins_1" name="contact_temoins_1" id="contact_temoins_1" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_complet_temoins_2" class="form-label">Temoins 2</label>
                                <input type="text" class="form-control" ng-model="mariage.nom_complet_temoins_2" name="nom_complet_temoins_2" id="nom_complet_temoins_2" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="contact_temoins_2" class="form-label">Contact *</label>
                                <input type="text" class="form-control" ng-model="mariage.contact_temoins_2" name="contact_temoins_2" id="contact_temoins_2" required>
                            </div>
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
</div>

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
        $scope.populateForm = function(mariage) {
            $scope.mariage = mariage;
        };
        $scope.initForm = function() {
            ajout = true;
            $scope.mariage = {};
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

        $('#date_registre,#date_delivrance,#date_mariage,#date_naissance_epoux,#date_naissance_epouse').datepicker({
            format: 'dd-mm-yyyy',
            local: 'fr',
            maxDate: new Date()
        });

        $("#lieu_delivrance,#lieu_mariage").select2({
            theme: "bootstrap4",
            dropdownParent: $(".bs-modal-ajout")
        });

        $("#formAjout").submit(function(e) {
            e.preventDefault();
            var $ajaxLoader = $(".bs-modal-ajout");

            var $valid = $(this).valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }
            var formData = new FormData($(this)[0]);

            var url = "{{route('back.mariage.update')}}";

            editerAction('POST', url, $(this), formData, $ajaxLoader, $table, ajout);
        });
    });

    function updateRow(idMariage) {
        $("#idMariageModifier").val(idMariage)
        ajout = false;
        var $scope = angular.element($("#formAjout")).scope();
        var mariage = _.findWhere(rows, {
            id: idMariage
        });

        $scope.$apply(function() {
            $scope.populateForm(mariage);
        });

        $("#lieu_delivrance").val(mariage.lieu_delivrance).trigger('change');
        $("#lieu_mariage").val(mariage.lieu_mariage).trigger('change');

        //formattage des dates 
        if (mariage.date_registre) {
            var dateRegistre = formatDate(mariage.date_registre);
            $("#date_registre").val(dateRegistre)
        }

        if (mariage.date_delivrance) {
            var dateDelivrance = formatDate(mariage.date_delivrance);
            $("#date_delivrance").val(dateDelivrance)
        }

        if (mariage.date_mariage) {
            var dateMariage = formatDate(mariage.date_mariage);
            $("#date_mariage").val(dateMariage)
        }

        if (mariage.date_naissance_epoux) {
            var dateNaissanceEpoux = formatDate(mariage.date_naissance_epoux);
            $("#date_naissance_epoux").val(dateNaissanceEpoux)
        }

        if (mariage.date_naissance_epouse) {
            var dateNaissanceEpouse = formatDate(mariage.date_naissance_epouse);
            $("#date_naissance_epouse").val(dateNaissanceEpouse)
        }

        $(".bs-modal-ajout").modal("show");
    }

    
    function dateFormatter(date){
        return date ? formatDate(date) : 'Non définie';
    }

    function epouxFormatter(id, row) {
        return row.prenoms_epoux + "  " + row.nom_epoux;
    }

    function epouseFormatter(id, row) {
        return row.prenoms_epouse + "  " + row.nom_epouse;
    }

    function referenceFormatter(id, row) {
        let etatColor = "";

        switch (row.etat) {
            case "Terminé":
                etatColor = "text-success"; // Vert pour "Terminé"
                break;
            case "En attente":
                etatColor = "text-warning"; // Jaune pour "En attente"
                break;
            case "Rejeté":
                etatColor = "text-danger"; // Rouge pour "Rejeté"
                break;
            case "En cours":
                etatColor = "text-info"; // Bleu pour "En cours"
                break;
            default:
                etatColor = "text-muted"; // Gris pour les autres états
                break;
        }

        return row.numero_declaration + " - <span class='" + etatColor + "'><strong>" + row.etat + "</strong></span>";
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