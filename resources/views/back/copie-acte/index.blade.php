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
                    <th data-field="id" data-width="50px" data-align="center" data-formatter="docFormatter"><i class="fa fa-list"></i></th>
                    <th data-formatter="referenceFormatter">Référence & état</th>
                    <th data-field="type_acte" data-formatter="typeFormatter">Type d'acte</th>
                    <th data-field="type_copie" data-formatter="typeFormatter">Type de copie</th>
                    <th data-field="numero_acte">Numero d'acte</th>
                    <th data-formatter="titulaireFormatter">Titulaire(s)</th>
                    <th data-formatter="dateEventFormatter">Date de l'événement</th>
                    <th data-formatter="lieuEventFormatter">Lieu</th>
                    <th data-formatter="demandeurFormatter">Demandeur</th>
                    <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-wrench"></i></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@push('modal')
<div class="modal fade bs-modal-ajout" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formAjout" ng-controller="formAjoutCtrl" enctype="multipart/form-data">
                @csrf
                <input type="text" class="hidden" id="idDemandeModifier" name="idDemandeModifier" ng-hide="true" />
                <input type="text" class="hidden" id="idActe" name="idActe" ng-hide="true" />
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-add-user"></i> {{$titleControlleur}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-3 text-primary">
                        <i class="fa fa-book pe-2"></i> Informations sur la demande
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="etat" class="form-label">Etat *</label>
                                <select class="form-select form-control" ng-model="demande.etat" name="etat" id="etat" required>
                                    <option value="Enregistré">Enregistré</option>
                                    <option value="En cours">En cours</option>
                                    <option value="Validé">Validé</option>
                                    <option value="Disponible">Disponible</option>
                                    <option value="Rejeté">Rejeté</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="type_acte" class="form-label">Type d'acte </label>
                                <input type="text" class="form-control" ng-model="demande.type_acte" name="type_acte" id="type_acte" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="type_copie" class="form-label">Type de copie </label>
                                <input type="text" class="form-control" ng-model="demande.type_copie" name="type_copie" id="type_copie" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="numero_acte" class="form-label">Numéro de l'acte </label>
                                <input type="text" class="form-control" ng-model="demande.numero_acte" name="numero_acte" id="numero_acte" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="numero_acte" class="form-label">Date événement </label>
                                <input ng-if="demande.type_acte == 'naissance'" type="text" class="form-control" ng-model="demande.date_naissance_enfant" id="date_naissance_enfant" readonly>
                                <input ng-if="demande.type_acte == 'mariage'" type="text" class="form-control" ng-model="demande.date_mariage" id="date_mariage" readonly>
                                <input ng-if="demande.type_acte == 'deces'" type="text" class="form-control" ng-model="demande.date_deces" id="date_deces" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="numero_acte" class="form-label">Lieu de l'événement </label>
                                <input ng-if="demande.lieu_naissance" type="text" class="form-control" ng-model="demande.lieu_naissance.libelle_commune" id="lieu_naissance" readonly>
                                <input ng-if="demande.lieu_deces" type="text" class="form-control" ng-model="demande.lieu_deces.libelle_commune" id="lieu_deces" readonly>
                                <input ng-if="demande.lieu_mariage" type="text" class="form-control" ng-model="demande.lieu_mariage.libelle_commune" id="lieu_mariage" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label class="form-label">Concerné(s)</label>
                                <input ng-if="demande.type_acte == 'naissance'"
                                    type="text"
                                    class="form-control"
                                    ng-init="nomConcerne = demande.prenoms_enfant + ' ' + demande.nom_enfant"
                                    ng-model="nomConcerne"
                                    readonly>
                                <input ng-if="demande.type_acte == 'mariage'"
                                    type="text"
                                    class="form-control"
                                    ng-init="nomConcerne = demande.nom_complet_epoux + ' et ' + demande.nom_complet_epouse"
                                    ng-model="nomConcerne"
                                    readonly>
                                <input ng-if="demande.type_acte == 'deces'"
                                    type="text"
                                    class="form-control"
                                    ng-init="nomConcerne = demande.prenoms_defunt + ' ' + demande.nom_defunt"
                                    ng-model="nomConcerne"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-3 mb-3 text-success">
                        <i class="fa fa-search pe-2"></i> Recherche
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="numero_acte_rch" class="form-label">Numéro de l'acte</label>
                                <input type="text" class="form-control" id="numero_acte_rch">
                                <input type="hidden" class="hiden" class="form-control" id="type_acte" ng-model="demande.type_acte">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="date_acte_rch" class="form-label">Date du registre</label>
                                <input type="text" class="form-control" id="date_acte_rch" placeholder="jj-mm-yyyy">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="lieu_event" class="form-label">Lieu de délivrance</label>
                                <select class="form-select" id="lieu_event">
                                    <option value="">-- Choisissez une commune --</option>
                                    @foreach($communes as $commune)
                                    <option value="{{ $commune->id }}">{{ $commune->libelle_commune }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label class="form-label d-block invisible">Rechercher</label> <!-- invisible label for alignment -->
                                <button id="recherche" class="btn btn-success w-100">
                                    <i class="pe-7s-search me-2"></i> Rechercher
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="spinnerRecherche" class="text-center my-4" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                        <p class="mt-2 text-muted">Recherche en cours...</p>
                    </div>
                    <div class="row" id="resultatsRecherche">

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
                                <a ng-if="demande.piece_identite_demandeur" class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(demande.piece_identite_demandeur) }}" alt="Pièce d'identité du demandeur">
                                    <i class="fa fa-eye pe-2"></i> Voir la pièce d'identité du demandeur
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a ng-if="demande.justificatif_lien" class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(demande.justificatif_lien) }}" alt="Justificatif de lien de parenté">
                                    <i class="fa fa-eye pe-2"></i> Voir le justificatif de lien de parenté
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a ng-if="demande.procuration" class="text-decoration-none" target="_blank" ng-href="@{{ getDocumentSrc(demande.procuration) }}" alt="Procuration">
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
            $scope.populateForm = function(demande) {
                $scope.demande = demande;
            };
            $scope.initForm = function() {
                ajout = true;
                $scope.demande = {};
            };
        });

        appSmarty.controller('formDocumentCtrl', function($scope) {
            $scope.populateForm = function(demande) {
                $scope.demande = demande;
            };

            $scope.getDocumentSrc = function(document) {
                return document ? document : "Aucun document fourni";
            };
        });


        $(function() {
            $table.on('load-success.bs.table', function(e, data) {
                rows = data.rows;
            });

            $('#date_acte_rch').datepicker({
                format: 'dd-mm-yyyy',
                local: 'fr',
                maxDate: new Date()
            });

            $("#lieu_event").select2({
                theme: "bootstrap4",
                dropdownParent: $(".bs-modal-ajout")
            });

            $("#recherche").on("click", function(e) {
                e.preventDefault();

                const numero = $("#numero_acte_rch").val().trim();
                const date_registre = $("#date_acte_rch").val().trim();
                const lieu_event = $("#lieu_event").val().trim();
                const type_acte = $("#type_acte").val().trim();
                $("#idActe").val("");
                if (numero === "" || date_registre === "" || lieu_event === "") {
                    alert("Veuillez compléter les champs avant de lancer la recherche");
                    return;
                }

                $("#spinnerRecherche").show();
                $("#resultatsRecherche").empty();

                const url = "../back/rechercher-acte/" + 
                    encodeURIComponent(numero) + "/" +
                    encodeURIComponent(date_registre) + "/" +
                    encodeURIComponent(lieu_event) + "/" +
                    encodeURIComponent(type_acte);

                $.getJSON(url, function(reponse) {
                    let html = "";

                    if (reponse.rows.length === 0) {
                        html = `<div class="alert alert-warning text-center">Aucun acte trouvé pour ces critères.</div>`;
                    } else {
                        html += `<div class="list-group">`;
                        $.each(reponse.rows, function(index, acte) {
                            const idAct = acte.id ?? null;
                            $("#idActe").val(idAct);
                            
                            html += `
                                <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap py-3">
                                    <div>
                                        <h6 class="mb-1">Acte n° <span class="text-primary">${acte.numero_extrait}</span></h6>
                                        <small class="text-muted">Date du registre : ${dateFormatter(acte.date_registre)}</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-info text-dark mb-1">Lieu de délivrance : ${acte.lieu_delivrance.libelle_commune}</span>
                                    </div>
                                </div>`;
                        });
                        html += `</div>`;
                    }

                    $("#resultatsRecherche").hide().html(html).fadeIn();
                }).fail(function() {
                    $("#resultatsRecherche").html(`<div class="alert alert-danger text-center">Une erreur est survenue lors de la recherche.</div>`);
                }).always(function() {
                    $("#spinnerRecherche").hide();
                });
            });

            $("#formAjout").submit(function(e) {
                e.preventDefault();
                var $ajaxLoader = $(".bs-modal-ajout");
               
                if ($("#resultatsRecherche").is(':empty')) {
                    alert("Veuillez effectuer la recherche avant de valider le formulaire");
                    return;
                }

                var $valid = $(this).valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
                var formData = new FormData($(this)[0]);

                var url = "{{route('back.copie-acte.update')}}";

                editerAction('POST', url, $(this), formData, $ajaxLoader, $table, ajout);
            });
        });

        function updateRow(idDemande) {
            $("#idDemandeModifier").val(idDemande)
            ajout = false;
            var $scope = angular.element($("#formAjout")).scope();
            var demande = _.findWhere(rows, {
                id: idDemande
            });

            $scope.$apply(function() {
                $scope.populateForm(demande);
            });
            $("#type_copie").val(demande.type_copie)
            if (demande.date_naissance_enfant) {
                var dateNaissanceEnfant = formatDate(demande.date_naissance_enfant);
                $("#date_naissance_enfant").val(dateNaissanceEnfant)
            }

            if (demande.date_mariage) {
                var dateMariage = formatDate(demande.date_mariage);
                $("#date_mariage").val(dateMariage)
            }

            if (demande.date_deces) {
                var dateDeces = formatDate(demande.date_deces);
                $("#date_deces").val(dateDeces)
            }

            $("#numero_acte_rch").val("");
            $("#date_acte_rch").val("");
            $("#lieu_event").val("");
            $("#lieu_event").val("").trigger('change');

            $("#resultatsRecherche").html("");
            $(".bs-modal-ajout").modal("show");
        }

        function dateFormatter(date) {
            return date ? formatDate(date) : 'Non définie';
        }

        function lieuEventFormatter(id, row) {
            if (row.type_acte == "naissance") {
                return row.lieu_naissance.libelle_commune;
            }
            if (row.type_acte == "mariage") {
                return row.lieu_mariage.libelle_commune;
            }
            if (row.type_acte == "deces") {
                return row.lieu_deces.libelle_commune;
            }
        }

        function dateEventFormatter(id, row) {
            if (row.type_acte == "naissance") {
                return dateFormatter(row.date_naissance_enfant);
            }
            if (row.type_acte == "mariage") {
                return dateFormatter(row.date_mariage);
            }
            if (row.type_acte == "deces") {
                return dateFormatter(row.date_deces);
            }
        }

        function titulaireFormatter(id, row) {
            if (row.type_acte == "naissance") {
                return row.prenoms_enfant + " " + row.nom_enfant;
            }
            if (row.type_acte == "mariage") {
                return row.nom_complet_epoux + " et " + row.nom_complet_epouse;
            }
            if (row.type_acte == "deces") {
                return row.prenoms_defunt + " " + row.nom_defunt;
            }
        }

        function demandeurFormatter(id, row) {
            if (row.demander_par != "concerne") {
                return row.prenom_demandeur + "  " + row.nom_demandeur + " - " + row.contact_demandeur;
            } else {
                return "Le concerné";
            }
        }

        function typeFormatter(type) {
            return type.charAt(0).toUpperCase() + type.slice(1).toLowerCase();
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

        function docFormatter(id, row) {
            const hasDocs = row.piece_identite_demandeur || row.justificatif_lien || row.procuration;

            return hasDocs ?
                `<button class="btn-transition btn btn-xs btn-outline-success" title="Voir les documents" onclick="showDocument(${id})"><i class="lnr-eye"></i></button>` :
                '--';
        }

        function optionFormatter(id, row) {
            return row.date_fin ? '--' : '<button class="btn-transition btn btn-xs btn-outline-primary" title="Modifier" onClick="javascript:updateRow(' + id + ');"><i class="lnr-pencil"> </i></button>';
        }
    </script>
    @endpush