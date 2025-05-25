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
            data-url="{{url('back', ['action'=>'liste-acte-deces'])}}">
            <thead>
                <tr>
                    <th data-formatter="imprimePdf" data-width="60px" data-align="center">Extrait</th>
                    <th data-formatter="etatFormatter">Etat</th>
                    <th data-formatter="numeroActFormatter">Numero de l'acte</th>
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
<div class="modal fade bs-modal-signature" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" style="width: 550px;">
        <div class="modal-content">
            <form id="formSignature">
                @csrf
                <input type="hidden" class="hidden" id="idDecesModifier"/>
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
                <input type="text" class="hidden" id="idDecesSupprimer" ng-hide="true" ng-model="deces.id" />
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-trash"></i> Revenir à l'etat précédent
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-question-circle fa-2x"></i> 
                        Etes vous certains de vouloir revenir à l'etat précédent pour <br/><b>@{{deces.numero_extrait}}</b>
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
        $scope.populateForm = function(deces) {
            $scope.deces = deces;
        };
        $scope.initForm = function() {
            $scope.deces = {};
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

        $("#formSupprimer").submit(function(e) {
            e.preventDefault();
            var id = $("#idDecesSupprimer").val();
            var formData = $(this).serialize();
            var $ajaxLoader = $(".bs-modal-suppression");
            supprimerAction('/back/update-state-deces/' + id, $(this).serialize(), $ajaxLoader, $table);
        });
    });

    function saveSignature(signatureImage) {
        var idActe = $("#idDecesModifier").val(); 
        $.ajax({
            url: "{{ route('back.signer-acte-deces') }}", 
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                signature: signatureImage,
                idDecesModifier: idActe
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

    function signer(idDeces) {
        $("#idDecesModifier").val(idDeces);
        $(".bs-modal-signature").modal("show");
    }

    function deleteRow(idDeces) {
        var $scope = angular.element($("#formSupprimer")).scope();
        var deces = _.findWhere(rows, {
            id: idDeces
        });
        $scope.$apply(function() {
            $scope.populateForm(deces);
        });
        $(".bs-modal-suppression").modal("show");
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
        window.open("../print-acte-deces/" + id_acte, '_blank');
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