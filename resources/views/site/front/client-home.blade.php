@extends(
'site.layout',
[
'title' => "État Civil Côte d'Ivoire - Tableau de bord",
]
)
@section('content-front')
<div class="container mt-5">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Liste des demandes en cours</h5>
            <table id="table" class="mb-0 table table-striped table-hover" data-pagination="true" data-search="false" data-toggle="table" data-show-columns="false" data-url="{{url('personnel', ['action'=>'liste-conducteurs'])}}" data-show-toggle="false">
                <thead>
                    <tr>
                        <th data-field="matricule">Matricule</th>
                        <th data-field="nom_conducteur">Nom</th>
                        <th data-field="grade.libelle_grade">Grade</th>
                        <th data-field="unite.libelle_unite">Unit&eacute;</th>
                        <th data-field="contact_conducteur">Contact</th>
                        <th data-field="email_conducteur">E-mail</th>
                        <th data-field="adresse">Adresse</th>
                        <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-print"></i></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">Liste des demandes traités</h5>
            <table id="table" class="mb-0 table table-striped table-hover" data-pagination="true" data-search="false" data-toggle="table" data-show-columns="false" data-url="{{url('personnel', ['action'=>'liste-conducteurs'])}}" data-show-toggle="false">
                <thead>
                    <tr>
                        <th data-field="matricule">Matricule</th>
                        <th data-field="nom_conducteur">Nom</th>
                        <th data-field="grade.libelle_grade">Grade</th>
                        <th data-field="unite.libelle_unite">Unit&eacute;</th>
                        <th data-field="contact_conducteur">Contact</th>
                        <th data-field="email_conducteur">E-mail</th>
                        <th data-field="adresse">Adresse</th>
                        <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-print"></i></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection