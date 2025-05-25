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
                    <th data-field="id" data-width="50px" data-align="center" data-formatter="docFormatter">Documents</th>
                    <th data-formatter="referenceFormatter">Référence & état</th>
                    <th data-field="nom_enfant">Nom enfant</th>
                    <th data-field="prenoms_enfant">Prénom enfant</th>
                    <th data-field="sexe_enfant">Sexe enfant</th>
                    <th data-field="date_naissance_enfant" data-formatter="dateFormatter">Date naissance</th>
                    <th data-field="heure_naissance_enfant">heure naissance</th>
                    <th data-field="commune.libelle_commune">Lieu naissance</th>
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
<div class="modal fade bs-modal-ajout" data-bs-backdrop="static">
    <div class="modal-dialog modal-x-lg">
        <div class="modal-content">
            <form id="formAjout" ng-controller="formAjoutCtrl" enctype="multipart/form-data">
                @csrf
                <input type="text" class="hidden" id="idNaissanceModifier" name="idNaissanceModifier" ng-hide="true"/>
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
                                <select class="form-select form-control" ng-model="naissance.etat" name="etat" id="etat" required>
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
                                <input type="text" class="form-control" ng-model="naissance.numero_extrait" name="numero_extrait" id="numero_extrait" placeholder="859856" autofocus>
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
                        <i class="fa fa-child pe-2"></i> Informations sur l'enfant
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_enfant" class="form-label">Nom de l'enfant *</label>
                                <input type="text" class="form-control" ng-model="naissance.nom_enfant" name="nom_enfant" id="nom_enfant" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="prenoms_enfant" class="form-label">Prénom(s) de l'enfant *</label>
                                <input type="text" class="form-control" ng-model="naissance.prenoms_enfant" name="prenoms_enfant" id="prenoms_enfant" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_naissance_enfant" class="form-label">Date de naissance *</label>
                                <input type="text" class="form-control" name="date_naissance_enfant" id="date_naissance_enfant" placeholder="jj-mm-aaaa" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="heure_naissance_enfant" class="form-label">Heure de naissance *</label>
                                <input type="time" class="form-control" name="heure_naissance_enfant" ng-model="naissance.heure_naissance_enfant" id="heure_naissance_enfant" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_naissance_enfant" class="form-label">Lieu de naissance *</label>
                                <select class="form-select form-control" name="lieu_naissance_enfant" id="lieu_naissance_enfant" required>
                                    <option value="">-- Choisissez une commune --</option>
                                    @foreach($communes as $commune)
                                    <option value="{{$commune->id}}">{{$commune->libelle_commune}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="etablissement_naissance_enfant" class="form-label">Etablissement de naissance *</label>
                                <input type="text" class="form-control" ng-model="naissance.etablissement_naissance_enfant" name="etablissement_naissance_enfant" id="etablissement_naissance_enfant" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nationalite_enfant" class="form-label">Nationalité *</label>
                                <select class="form-select form-control" ng-model="naissance.nationalite_enfant" name="nationalite_enfant" id="nationalite_enfant" required>
                                    <option value="ivoirienne">Ivoirienne</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="sexe_enfant" class="form-label">Sexe *</label>
                                <select class="form-select form-control" ng-model="naissance.sexe_enfant" name="sexe_enfant" id="sexe_enfant" required>
                                    <option value="M">Maculin</option>
                                    <option value="F">Feminin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-info">
                        <i class="fa fa-users pe-2"></i> Informations sur le père
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_pere" class="form-label">Nom du père</label>
                                <input type="text" class="form-control" ng-model="naissance.nom_pere" name="nom_pere" id="nom_pere">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="prenoms_pere" class="form-label">Prénom(s) du père</label>
                                <input type="text" class="form-control" ng-model="naissance.prenoms_pere" name="prenoms_pere" id="prenoms_pere">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_naissance_pere" class="form-label">Date de naissance du père</label>
                                <input type="text" class="form-control" name="date_naissance_pere" id="date_naissance_pere">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_naissance_pere" class="form-label">Lieu de naissance du père</label>
                                <input type="text" class="form-control" ng-model="naissance.lieu_naissance_pere" name="lieu_naissance_pere" id="lieu_naissance_pere">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nationalite_pere" class="form-label">Nationalité du père </label>
                                <select class="form-select form-control" ng-model="naissance.nationalite_pere" name="nationalite_pere" id="nationalite_pere">
                                    <option value="ivoirienne">Ivoirienne</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="profession_pere" class="form-label">Profession du père</label>
                                <input type="text" class="form-control" ng-model="naissance.profession_pere" name="profession_pere" id="profession_pere">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="adresse_pere" class="form-label">Adresse du père</label>
                                <input type="text" class="form-control" name="adresse_pere" ng-model="naissance.adresse_pere" id="adresse_pere">
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-danger">
                        <i class="fa fa-female pe-2"></i> Informations sur la mère
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_mere" class="form-label">Nom de la mère</label>
                                <input type="text" class="form-control" ng-model="naissance.nom_mere" name="nom_mere" id="nom_mere">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="prenoms_mere" class="form-label">Prénom(s) de la mère</label>
                                <input type="text" class="form-control" ng-model="naissance.prenoms_mere" name="prenoms_mere" id="prenoms_mere">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_naissance_mere" class="form-label">Date de naissance de la mère</label>
                                <input type="text" class="form-control" name="date_naissance_mere" id="date_naissance_mere">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_naissance_mere" class="form-label">Lieu de naissance de la mère</label>
                                <input type="text" class="form-control" ng-model="naissance.lieu_naissance_mere" name="lieu_naissance_mere" id="lieu_naissance_mere">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nationalite_mere" class="form-label">Nationalité de la mère </label>
                                <select class="form-select form-control" ng-model="naissance.nationalite_mere" name="nationalite_mere" id="nationalite_mere">
                                    <option value="ivoirienne">Ivoirienne</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="profession_mere" class="form-label">Profession de la mère</label>
                                <input type="text" class="form-control" ng-model="naissance.profession_mere" name="profession_mere" id="profession_mere">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="adresse_mere" class="form-label">Adresse de la mère</label>
                                <input type="text" class="form-control" name="adresse_mere" ng-model="naissance.adresse_mere" id="adresse_mere">
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-warning" ng-if="naissance.declarant === 'Autre'">
                        <i class="fa fa-user pe-2"></i> Informations sur le déclarant
                    </h5>
                    <div class="row" ng-if="naissance.declarant === 'Autre'">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_declarant" class="form-label">Nom du déclarant</label>
                                <input type="text" class="form-control" ng-model="naissance.nom_declarant" name="nom_declarant" id="nom_declarant">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="prenoms_declarant" class="form-label">Prénom(s) du déclarant</label>
                                <input type="text" class="form-control" ng-model="naissance.prenoms_declarant" name="prenoms_declarant" id="prenoms_declarant">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lien_avec_enfant" class="form-label">Lien avec l'enfant</label>
                                <input type="text" class="form-control" ng-model="naissance.lien_avec_enfant" name="lien_avec_enfant" id="lien_avec_enfant">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="contact_declarant" class="form-label">Contact</label>
                                <input type="text" class="form-control" ng-model="naissance.contact_declarant" name="contact_declarant" id="contact_declarant">
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
    <div class="modal-dialog modal-sm"> <!-- Réduit la taille du modal avec modal-sm -->
        <div class="modal-content" id="formDocument" ng-controller="formDocumentCtrl">
            <div class="modal-header bg-success rounded-top">
                <h5 class="modal-title text-white h4" id="modalDocumentsLabel"> <!-- Utilisation de h4 pour un titre plus petit -->
                    <i class="fa fa-file-alt pe-2"></i> Documents de preuve
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center"> <!-- Centrer le contenu du modal -->
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
    var ajout = false;
    var $table = jQuery("#table"),
        rows = [];

    appSmarty.controller('formAjoutCtrl', function($scope) {
        $scope.populateForm = function(naissance) {
            $scope.naissance = naissance;
        };
        $scope.initForm = function() {
            ajout = true;
            $scope.naissance = {};
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

        $('#date_registre,#date_delivrance,#date_naissance_enfant,#date_naissance_pere,#date_naissance_mere').datepicker({
            format: 'dd-mm-yyyy',
            local: 'fr',
            maxDate: new Date()
        });

        $("#lieu_delivrance,#lieu_naissance_enfant").select2({
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

            var url = "{{route('back.naissance.update')}}";

            editerAction('POST', url, $(this), formData, $ajaxLoader, $table, ajout);
        });
    });

    function updateRow(idNaissance) {
        $("#idNaissanceModifier").val(idNaissance)
        ajout = false;
        var $scope = angular.element($("#formAjout")).scope();
        var naissance = _.findWhere(rows, {
            id: idNaissance
        });
        $scope.$apply(function() {
            $scope.populateForm(naissance);
        });

        $("#lieu_delivrance").val(naissance.lieu_delivrance).trigger('change');
        $("#lieu_naissance_enfant").val(naissance.lieu_naissance_enfant).trigger('change');

        //formattage des dates 
        if (naissance.date_registre) {
            var dateRegistre = formatDate(naissance.date_registre);
            $("#date_registre").val(dateRegistre)
        }

        if (naissance.date_delivrance) {
            var dateDelivrance = formatDate(naissance.date_delivrance);
            $("#date_delivrance").val(dateDelivrance)
        }

        if (naissance.date_naissance_enfant) {
            var dateNaissanceEnfant = formatDate(naissance.date_naissance_enfant);
            $("#date_naissance_enfant").val(dateNaissanceEnfant)
        }

        if (naissance.date_naissance_pere) {
            var dateNaissancePere = formatDate(naissance.date_naissance_pere);
            $("#date_naissance_pere").val(dateNaissancePere)
        }

        if (naissance.date_naissance_mere) {
            var dateNaissanceMere = formatDate(naissance.date_naissance_mere);
            $("#date_naissance_mere").val(dateNaissanceMere)
        }

        $(".bs-modal-ajout").modal("show");
    }

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
            return row.nom_declarant + "  " + row.prenoms_declarant + " - " + row.contact_declarant;
        }
        if (row.declarant == "Mère") {
            return "Mère";
        }
        if (row.declarant == "Père") {
            return "Père";
        }
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