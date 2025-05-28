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
                    <th data-formatter="referenceFormatter">Référence & état</th>
                    <th data-field="date_deces" data-formatter="dateFormatter">Date décès</th>
                    <th data-field="heure_deces">Heure décès</th>
                    <th data-field="commune.libelle_commune">Lieu</th>
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
<div class="modal fade bs-modal-ajout" data-bs-backdrop="static">
    <div class="modal-dialog modal-x-lg">
        <div class="modal-content">
            <form id="formAjout" ng-controller="formAjoutCtrl" enctype="multipart/form-data">
                @csrf
                <input type="text" class="hidden" id="idDecesModifier" name="idDecesModifier" ng-hide="true" />
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
                                <select class="form-select form-control" ng-model="deces.etat" name="etat" id="etat" required>
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
                                <input type="text" class="form-control" ng-model="deces.numero_extrait" name="numero_extrait" id="numero_extrait" placeholder="859856" autofocus>
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
                        <i class="fa fa-child pe-2"></i> Informations sur le décès
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_deces" class="form-label">Date du décès *</label>
                                <input type="text" class="form-control" name="date_deces" id="date_deces" placeholder="jj-mm-aaaa" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="heure_deces" class="form-label">Heure du décès *</label>
                                <input type="time" class="form-control" name="heure_deces" ng-model="deces.heure_deces" id="heure_deces" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_deces" class="form-label">Lieu du décès *</label>
                                <select class="form-select form-control" name="lieu_deces" id="lieu_deces" required>
                                    <option value="">-- Choisissez une commune --</option>
                                    @foreach($communes as $commune)
                                    <option value="{{$commune->id}}">{{$commune->libelle_commune}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="cause_deces" class="form-label">Cause du décès *</label>
                                <input type="text" class="form-control" ng-model="deces.cause_deces" name="cause_deces" id="cause_deces" required>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-success">
                        <i class="fa fa-user pe-2"></i> Informations sur le défunt
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_defunt" class="form-label">Nom *</label>
                                <input type="text" class="form-control" ng-model="deces.nom_defunt" name="nom_defunt" id="nom_defunt" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="prenoms_defunt" class="form-label">Prénom(s) *</label>
                                <input type="text" class="form-control" ng-model="deces.prenoms_defunt" name="prenoms_defunt" id="prenoms_defunt" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_naissance_defunt" class="form-label">Date de naissance *</label>
                                <input type="text" class="form-control" name="date_naissance_defunt" id="date_naissance_defunt" placeholder="jj-mm-aaaa" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_naissance_defunt" class="form-label">Lieu de naissance *</label>
                                <input type="text" class="form-control" name="lieu_naissance_defunt" ng-model="deces.lieu_naissance_defunt" id="lieu_naissance_defunt" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nationalite_defunt" class="form-label">Nationalité *</label>
                                <select class="form-select form-control" ng-model="deces.nationalite_defunt" name="nationalite_defunt" id="nationalite_defunt" required>
                                    <option value="ivoirienne">Ivoirienne</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="sexe_defunt" class="form-label">Sexe *</label>
                                <select class="form-select form-control" ng-model="deces.sexe_defunt" name="sexe_defunt" id="sexe_defunt" required>
                                    <option value="F">Feminin</option>
                                    <option value="M">Masculin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="profession_defunt" class="form-label">Profession </label>
                                <input type="text" class="form-control" ng-model="deces.profession_defunt" name="profession_defunt" id="profession_defunt">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="adresse_defunt" class="form-label">Adresse *</label>
                                <input type="text" class="form-control" ng-model="deces.adresse_defunt" name="adresse_defunt" id="adresse_defunt" required>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-warning">
                        <i class="fa fa-user pe-2"></i> Informations sur le déclarant
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="nom_declarant" class="form-label">Nom du déclarant *</label>
                                <input type="text" class="form-control" ng-model="deces.nom_declarant" name="nom_declarant" id="nom_declarant" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="prenoms_declarant" class="form-label">Prénom(s) du déclarant *</label>
                                <input type="text" class="form-control" ng-model="deces.prenoms_declarant" name="prenoms_declarant" id="prenoms_declarant" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="contact_declarant" class="form-label">Contact *</label>
                                <input type="text" class="form-control" ng-model="deces.contact_declarant" name="contact_declarant" id="contact_declarant" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lien_parente" class="form-label">Lien de parenté avec le défunt *</label>
                                <select class="form-select" id="lien_parente" ng-model="deces.lien_parente" name="lien_parente" required>
                                    <option value="" selected disabled>Sélectionnez une option</option>
                                    <option value="Conjoint(e)">Conjoint(e)</option>
                                    <option value="Enfant">Enfant</option>
                                    <option value="Parent">Parent</option>
                                    <option value="Frère/Sœur">Frère/Sœur</option>
                                    <option value="Autre parent">Autre parent</option>
                                    <option value="Non apparenté">Non apparenté</option>
                                </select>
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
        $scope.populateForm = function(deces) {
            $scope.deces = deces;
        };
        $scope.initForm = function() {
            ajout = true;
            $scope.deces = {};
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

        $('#date_registre,#date_delivrance,#date_deces,#date_naissance_defunt').datepicker({
            format: 'dd-mm-yyyy',
            local: 'fr',
            maxDate: new Date()
        });

        $("#lieu_delivrance,#lieu_deces").select2({
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

            var url = "{{route('back.deces.update')}}";

            editerAction('POST', url, $(this), formData, $ajaxLoader, $table, ajout);
        });

    });

    function updateRow(idDeces) {
        $("#idDecesModifier").val(idDeces)
        ajout = false;
        var $scope = angular.element($("#formAjout")).scope();
        var deces = _.findWhere(rows, {
            id: idDeces
        });
        $scope.$apply(function() {
            $scope.populateForm(deces);
        });

        $("#lieu_delivrance").val(deces.lieu_delivrance).trigger('change');
        $("#lieu_deces").val(deces.lieu_deces).trigger('change');

        //formattage des dates 
        if (deces.date_registre) {
            var dateRegistre = formatDate(deces.date_registre);
            $("#date_registre").val(dateRegistre)
        }

        if (deces.date_delivrance) {
            var dateDelivrance = formatDate(deces.date_delivrance);
            $("#date_delivrance").val(dateDelivrance)
        }

        if (deces.date_deces) {
            var dateDeces = formatDate(deces.date_deces);
            $("#date_deces").val(dateDeces)
        }

        if (deces.date_naissance_defunt) {
            var dateNaissanceDefunt = formatDate(deces.date_naissance_defunt);
            $("#date_naissance_defunt").val(dateNaissanceDefunt)
        }

        $(".bs-modal-ajout").modal("show");
    }

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