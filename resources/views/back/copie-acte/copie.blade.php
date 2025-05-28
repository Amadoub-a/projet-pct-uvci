@extends(
'layouts.app',
[
'title' => 'E-Civil | Acte de décès',
]
)
@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des actes de décès</h5>
        <table id="table"
            class="mb-0 table table-striped table-hover"
            data-pagination="true"
            data-search="true"
            data-toggle="table"
            data-show-columns="false"
            data-unique-id="id"
            data-show-toggle="false"
            data-url="{{url('back', ['action'=>'liste-copie-actes'])}}">
            <thead>
                <tr>
                    <th data-formatter="imprimePdf" data-width="60px" data-align="center">Extrait</th>
                    <th data-formatter="etatFormatter">Etat</th>
                    <th data-formatter="numeroActFormatter">Numero de l'acte</th>
                    <th data-field="type_acte" data-formatter="typeFormatter">Type d'acte</th>
                    <th data-field="type_copie" data-formatter="typeFormatter">Type de copie</th>
                    <th data-formatter="titulaireFormatter">Titulaire(s)</th>
                    <th data-formatter="dateEventFormatter">Date de l'événement</th>
                    <th data-field="date_delivrance" data-formatter="dateFormatter">Date délivrance du copie</th>
                    <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-wrench"></i></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade bs-modal-signature" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 550px;">
        <div class="modal-content">
            <form id="formSignature">
                @csrf
                <input type="hidden" class="hidden" id="idCopieModifier" />
                <div class="modal-header bg-primary">
                    <h3 class="modal-title" style="color:#fff;">
                        Signez ci-dessous
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <label for="date_delivrance" class="form-label">Date de délivrance *</label>
                                <input type="text" class="form-control" id="date_delivrance" name="date_delivrance" placeholder="jj-mm-yyyy" required>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <canvas id="signatureCanvas" width="500" height="300" style="border: 1px solid #000;"></canvas>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button id="clearBtn" class="mb-2 me-2 btn-icon btn btn-secondary">Effacer</button>
                    <button id="saveBtn" class="mb-2 me-2 btn-icon btn btn-success">Sauvegarder la signature</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bs-modal-suppression" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formSupprimer" ng-controller="formSupprimerCtrl">
                @csrf
                <input type="text" class="hidden" id="idCopieSupprimer" ng-hide="true" ng-model="copie.id" />
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-trash"></i> Revenir à l'etat précédent
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-question-circle fa-2x"></i>
                        Etes vous certains de vouloir revenir à l'etat précédent pour la copie de l'extrait de
                        <b ng-if="copie.naissance_id">@{{' naissance numéro ' + copie.naissance.numero_extrait}}</b>
                        <b ng-if="copie.deces_id">@{{' décès numéro ' + copie.deces.numero_extrait}}</b>
                        <b ng-if="copie.mariage_id">@{{' mariage numéro ' +copie.mariage.numero_extrait}}</b>
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
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script type="text/javascript">
    var ajout = false;
    var $table = jQuery("#table"),
        rows = [];

    appSmarty.controller('formSupprimerCtrl', function($scope) {
        $scope.populateForm = function(copie) {
            $scope.copie = copie;
        };
        $scope.initForm = function() {
            $scope.copie = {};
        };
    });

    $(function() {
        $table.on('load-success.bs.table', function(e, data) {
            rows = data.rows;
        });

        $('#date_delivrance').datepicker({
            format: 'dd-mm-yyyy',
            local: 'fr',
            maxDate: new Date()
        });


        var canvas = document.getElementById('signatureCanvas');
        var signaturePad = new SignaturePad(canvas);

        document.getElementById('clearBtn').addEventListener('click', function() {
            signaturePad.clear();
        });

        document.getElementById('saveBtn').addEventListener('click', function() {
            if (!signaturePad.isEmpty()) {
                var signatureImage = signaturePad.toDataURL('image/png');
                saveSignature(signatureImage);
            } else {
                alert("Veuillez dessiner une signature !");
            }
        });

        $("#formSupprimer").submit(function(e) {
            e.preventDefault();
            var id = $("#idCopieSupprimer").val();
            var formData = $(this).serialize();
            var $ajaxLoader = $(".bs-modal-suppression");
            supprimerAction('/back/update-state-copie/' + id, $(this).serialize(), $ajaxLoader, $table);
        });
    });

    function saveSignature(signatureImage) {
        var idActe = $("#idCopieModifier").val();
        var date_delivrance = $("#date_delivrance").val();

        if (date_delivrance == "") {
            alert("La date de délivrance est obligatoire");
            return
        }
        $.ajax({
            url: "{{ route('back.signer-copie-acte') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                signature: signatureImage,
                idCopieModifier: idActe,
                date_delivrance: date_delivrance
            },
            success: function(response) {
                $.gritter.add({
                    // heading of the notification
                    title: "E-Civil",
                    // the text inside the notification
                    text: response.msg,
                    sticky: false,
                    image: "/plugin/gritter/img/confirm.png",
                });

                // Fermer le modal après succès
                $(".bs-modal-signature").modal("hide");

                // Effacer le canevas de signature
                var canvas = document.getElementById('signatureCanvas');
                var signaturePad = new SignaturePad(canvas);
                signaturePad.clear();
                $table.bootstrapTable('refresh');
            },
            error: function(error) {
                $.gritter.add({
                    // heading of the notification
                    title: "E-Civil",
                    // the text inside the notification
                    text: response.msg,
                    sticky: false,
                    image: "/plugin/gritter/img/canceled.png",
                });
            }
        });
    }

    function signer(idCopie) {
        $("#idCopieModifier").val(idCopie);
        $(".bs-modal-signature").modal("show");
    }

    function deleteRow(idCopie) {
        var $scope = angular.element($("#formSupprimer")).scope();
        var copie = _.findWhere(rows, {
            id: idCopie
        });
        $scope.$apply(function() {
            $scope.populateForm(copie);
        });
        $(".bs-modal-suppression").modal("show");
    }

    function dateFormatter(date) {
        return date ? formatDate(date) : 'Non définie';
    }

    function etatFormatter(id, row) {
        let etatColor = "";

        switch (row.etat) {
            case "Disponible":
                etatColor = "text-success"; // Vert pour "Terminé"
                break;
            case "Validé":
                etatColor = "text-warning"; // Jaune pour "En attente"
                break;
            default:
                etatColor = "text-muted"; // Gris pour les autres états
                break;
        }

        return "<span class='" + etatColor + "'><strong>" + row.etat + "</strong></span>";
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

    function typeFormatter(type) {
        return type.charAt(0).toUpperCase() + type.slice(1).toLowerCase();
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

    function numeroActFormatter(id, row) {
        if (row.naissance_id) {
            return "<strong>" + row.naissance.numero_extrait + " du " + formatDate(row.naissance.date_registre) + "</strong>";
        }
        if (row.deces_id) {
            return "<strong>" + row.deces.numero_extrait + " du " + formatDate(row.deces.date_registre) + "</strong>";
        }
        if (row.mariage_id) {
            return "<strong>" + row.mariage.numero_extrait + " du " + formatDate(row.mariage.date_registre) + "</strong>";
        }
    }

    function printRow(id, row) {
        let type = null;

        if (row.naissance_id) type = 'naissance';
        else if (row.deces_id) type = 'deces';
        else if (row.mariage_id) type = 'mariage';

        if (type) {
            const url = `../print-copie-acte/${row.id}/${row.type_copie}/${type}`;
            window.open(url, '_blank');
        }
    }

    function imprimePdf(id, row) {
        return `
        <button type="button" class="btn-transition btn btn-xs btn-outline-warning" 
            title="Imprimer" 
            onClick="printRow(${id}, ${JSON.stringify(row).replace(/"/g, '&quot;')})">
            <i class="lnr-file-empty"></i>
        </button>
    `;
    }

    function optionFormatter(id, row) {
        if (row.signature) {
            return '--';
        } else {
            return '<button class="btn-transition btn btn-xs btn-outline-primary" title="Signer le document" onClick="javascript:signer(' + id + ');"><i class="lnr-pencil"> </i></button>\n\
                <button class="btn-transition btn btn-xs btn-outline-danger" title="Revenir" onClick="javascript:deleteRow(' + id + ');"><i class="lnr-trash"> </i></button>';
        }
    }
</script>
@endpush