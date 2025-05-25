@extends(
'layouts.app',
[
'title' => 'E-Civil | Acte de naissance',
]
)
@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des actes de naissance</h5>
        <table id="table"
            class="mb-0 table table-striped table-hover"
            data-pagination="true"
            data-search="true"
            data-toggle="table"
            data-show-columns="false"
            data-unique-id="id"
            data-show-toggle="false"
            data-url="{{url('back', ['action'=>'liste-acte-naissances'])}}">
            <thead>
                <tr>
                    <th data-formatter="imprimePdf" data-width="60px" data-align="center">Extrait</th>
                    <th data-formatter="etatFormatter">Etat</th>
                    <th data-formatter="numeroActFormatter">Numero de l'acte</th>
                    <th data-field="nom_enfant">Nom</th>
                    <th data-field="prenoms_enfant">Prénom</th>
                    <th data-field="sexe_enfant">Sexe</th>
                    <th data-field="date_naissance_enfant" data-formatter="dateFormatter">Date naissance</th>
                    <th data-field="heure_naissance_enfant">heure naissance</th>
                    <th data-field="commune.libelle_commune">Lieu naissance</th>
                    <th data-field="etablissement_naissance_enfant" data-visible="false">Etablissement</th>
                    <th data-formatter="pereFormatter">Père</th>
                    <th data-formatter="mereFormatter">Mère</th>
                    <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter">Signer</th>
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
                <input type="hidden" class="hidden" id="idNaissanceModifier"/>
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
@endpush
@push('javascript')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
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
    });

    function saveSignature(signatureImage) {
        var idActe = $("#idNaissanceModifier").val(); 
        $.ajax({
            url: "{{ route('back.signer-acte-naissance') }}", 
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                signature: signatureImage,
                idNaissanceModifier: idActe
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

    function signer(idNaissance) {
        $("#idNaissanceModifier").val(idNaissance);
        $(".bs-modal-signature").modal("show");
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

    function printRow(id_acte) {
        window.open("../print-acte-naissance/" + id_acte, '_blank');
    }

    function imprimePdf(id, row) {
        return '<button type="button" class="btn-transition btn btn-xs btn-outline-warning" title="Imprimer" onClick="javascript:printRow(' + row.id + ');"><i class="lnr-file-empty"> </i></button>';
    }

    function optionFormatter(id, row) {
        return '<button class="btn-transition btn btn-xs btn-outline-primary" title="Modifier" onClick="javascript:signer(' + id + ');"><i class="lnr-pencil"> </i></button>';
    }
</script>
@endpush