@extends(
'layouts.app',
[
'title' => 'E-Civil | Acte de mariage',
]
)
@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des actes de mariage</h5>
        <table id="table"
            class="mb-0 table table-striped table-hover"
            data-pagination="true"
            data-search="true"
            data-toggle="table"
            data-show-columns="false"
            data-unique-id="id"
            data-show-toggle="false"
            data-url="{{url('back', ['action'=>'liste-acte-mariages'])}}">
            <thead>
                <tr>
                    <th data-formatter="imprimePdf" data-width="60px" data-align="center">Extrait</th>
                    <th data-formatter="etatFormatter">Etat</th>
                    <th data-formatter="numeroActFormatter">Numero de l'acte</th>
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
<div class="modal fade bs-modal-signature" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 550px;">
        <div class="modal-content">
            <form id="formSignature">
                @csrf
                <input type="hidden" class="hidden" id="idMariageModifier"/>
                <div class="modal-header bg-primary">
                    <h3 class="modal-title" style="color:#fff;">
                        Signez ci-dessous
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <canvas id="signatureCanvas" width="500" height="300" style="border: 1px solid #000;"></canvas>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button id="clearBtn" class="mb-2 me-2 btn-icon btn btn-secondary">Effacer</button>
                    <button id="saveBtn"  class="mb-2 me-2 btn-icon btn btn-success">Sauvegarder la signature</button>
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
                <input type="text" class="hidden" id="idMariageSupprimer" ng-hide="true" ng-model="mariage.id" />
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-trash"></i> Revenir à l'etat précédent
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-question-circle fa-2x"></i> 
                        Etes vous certains de vouloir revenir à l'etat précédent pour <br/><b>@{{mariage.numero_extrait}}</b>
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
        $scope.populateForm = function(mariage) {
            $scope.mariage = mariage;
        };
        $scope.initForm = function() {
            $scope.mariage = {};
        };
    });

    $(function() {
        $table.on('load-success.bs.table', function(e, data) {
            rows = data.rows;
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

        $('#date_registre,#date_delivrance,#date_naissance_enfant,#date_naissance_pere,#date_naissance_mere').datepicker({
            format: 'dd-mm-yyyy',
            local: 'fr',
            maxDate: new Date()
        });

        $("#lieu_delivrance,#lieu_naissance_enfant").select2({
            theme: "bootstrap4",
            dropdownParent: $(".bs-modal-ajout")
        });

         $("#formSupprimer").submit(function(e) {
            e.preventDefault();
            var id = $("#idMariageSupprimer").val();
            var formData = $(this).serialize();
            var $ajaxLoader = $(".bs-modal-suppression");
            supprimerAction('/back/update-state-mariage/' + id, $(this).serialize(), $ajaxLoader, $table);
        });
    });

    function saveSignature(signatureImage) {
        var idActe = $("#idMariageModifier").val(); 
        $.ajax({
            url: "{{ route('back.signer-acte-mariage') }}", 
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                signature: signatureImage,
                idMariageModifier: idActe
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

    function signer(idMariage) {
        $("#idMariageModifier").val(idMariage);
        $(".bs-modal-signature").modal("show");
    }

    function deleteRow(idMariage) {
        var $scope = angular.element($("#formSupprimer")).scope();
        var mariage = _.findWhere(rows, {
            id: idMariage
        });
        $scope.$apply(function() {
            $scope.populateForm(mariage);
        });
        $(".bs-modal-suppression").modal("show");
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

    function numeroActFormatter(id, row) {
        return "<strong>" + row.numero_extrait + " du " + formatDate(row.date_registre) + "</strong>";
    }

    function epouxFormatter(id, row) {
        return row.prenoms_epoux + "  " + row.nom_epoux;
    }

    function epouseFormatter(id, row) {
        return row.prenoms_epouse + "  " + row.nom_epouse;
    }

    function printRow(id_acte) {
        window.open("../print-acte-mariage/" + id_acte, '_blank');
    }

    function imprimePdf(id, row) {
        return '<button type="button" class="btn-transition btn btn-xs btn-outline-warning" title="Imprimer" onClick="javascript:printRow(' + row.id + ');"><i class="lnr-file-empty"> </i></button>';
    }

    function optionFormatter(id, row) {
        if(row.signature){
            return '--'; 
        }else{
            return '<button class="btn-transition btn btn-xs btn-outline-primary" title="Signer le document" onClick="javascript:signer(' + id + ');"><i class="lnr-pencil"> </i></button>\n\
                <button class="btn-transition btn btn-xs btn-outline-danger" title="Revenir" onClick="javascript:deleteRow(' + id + ');"><i class="lnr-trash"> </i></button>';
        }
    }
</script>
@endpush