@extends('site.layout', ['title' => "État Civil Côte d'Ivoire - Tableau de bord"])

@section('content-front')
<div class="container py-4">

    <!-- Section : demandes en cours -->
    <div class="mb-5">
        <h2 class="text-center text-primary mb-4">
            <i class="fas fa-hourglass-half me-2"></i>Liste des demandes <strong>en cours</strong>
        </h2>
        <div class="main-card mb-4 card shadow-sm border-0">
            <div class="card-body">
                <table id="tableEnCours" class="table table-striped table-hover"
                    data-pagination="true"
                    data-search="false"
                    data-toggle="table"
                    data-show-columns="false"
                    data-url="{{ route('liste-demandes-cours') }}"
                    data-show-toggle="false">
                    <thead class="table-light">
                        <tr>
                            <th data-field="reference">Référence</th>
                            <th data-field="date_declaration" data-formatter="dateFormatter">Date déclaration</th>
                            <th data-field="type">Type de demande</th>
                            <th data-field="etat" data-formatter="etatFormatter">Etat de la demande</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Section : demandes traitées -->
    <div>
        <h2 class="text-center text-success mb-4">
            <i class="fas fa-check-circle me-2"></i>Liste des demandes <strong>traitées</strong>
        </h2>
        <div class="main-card mb-4 card shadow-sm border-0">
            <div class="card-body">
                <table id="tableTraite" class="table table-striped table-hover"
                    data-pagination="true"
                    data-search="false"
                    data-toggle="table"
                    data-show-columns="false"
                    data-url="{{ route('liste-demandes-traitees') }}"
                    data-show-toggle="false">
                    <thead class="table-light">
                        <tr>
                            <th data-field="reference">Référence</th>
                            <th data-field="date_declaration" data-formatter="dateFormatter">Date déclaration</th>
                            <th data-field="type">Type de demande</th>
                            <th data-field="date_traitement" data-formatter="dateFormatter">Traitement</th>
                            <th data-field="date_disponible" data-formatter="dateFormatter">Disponible</th>
                            <th data-field="etat">Etat de la demande</th>
                            <th data-field="traitement_id" data-width="100px" data-align="center" data-formatter="printFormatter">
                                <i class="fa fa-print"></i>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var $tableEnCours = jQuery("#tableEnCours"),
        $tableTraite = jQuery("#tableTraite"),
        rows = [];

    $(function() {
        $tableEnCours.on('load-success.bs.table', function(e, data) {});
        $tableTraite.on('load-success.bs.table', function(e, data) {
            rows = data.rows;
        });
    });

    function printRow(idDocument) {
       window.open("../back/print-acte-naissance/" + idDocument, '_blank');
    }

    function printFormatter(id, row) {
        if (row.etat == "Disponible") {
            return '<button class="btn btn-success btn-sm" title="Imprimer votre document" onClick="javascript:printRow(' + row.traitement_id + ');">Imprimer</button>';
        }
    }

    function etatFormatter(etat) {
        if (etat === "Rejeté") {
            return `<strong style="color: red;">${etat} - Contactez nous 078 145 2561</strong>`;
        } else {
            return etat;
        }
    }

    function dateFormatter(date) {
        return date ? formatDate(date) : 'Non définie';
    }
</script>
@endsection