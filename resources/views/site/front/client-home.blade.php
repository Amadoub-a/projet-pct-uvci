@extends('site.layout', ['title' => "État Civil Côte d'Ivoire - Tableau de bord"])

@section('content-front')
<div class="container py-4">

    <!-- Section : demandes en cours -->
    <div class="mb-5">
        <h2 class="text-center text-primary mb-4">
            <i class="fas fa-hourglass-half me-2"></i>Liste des demandes <strong>en cours</strong>
        </h2>

        @foreach (['Copie d\'acte', 'Acte de naissance', 'Acte de mariage', 'Acte de décès', 'Légalisation'] as $titre)
            <div class="main-card mb-4 card shadow-sm border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-success"><i class="fas fa-file-alt me-2"></i>{{ $titre }}</h5>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-hover"
                        data-pagination="true"
                        data-search="false"
                        data-toggle="table"
                        data-show-columns="false"
                        data-url="{{ url('personnel', ['action'=>'liste-conducteurs']) }}"
                        data-show-toggle="false">
                        <thead class="table-light">
                            <tr>
                                <th data-field="matricule">Matricule</th>
                                <th data-field="nom_conducteur">Nom</th>
                                <th data-field="grade.libelle_grade">Grade</th>
                                <th data-field="unite.libelle_unite">Unité</th>
                                <th data-field="contact_conducteur">Contact</th>
                                <th data-field="email_conducteur">E-mail</th>
                                <th data-field="adresse">Adresse</th>
                                <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter">
                                    <i class="fa fa-print"></i>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Section : demandes traitées -->
    <div>
        <h2 class="text-center text-success mb-4">
            <i class="fas fa-check-circle me-2"></i>Liste des demandes <strong>traitées</strong>
        </h2>

        @foreach (['Copie d\'acte', 'Acte de naissance', 'Acte de mariage', 'Acte de décès', 'Légalisation'] as $titre)
            <div class="main-card mb-4 card shadow-sm border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-primary"><i class="fas fa-file-alt me-2"></i>{{ $titre }}</h5>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-hover"
                        data-pagination="true"
                        data-search="false"
                        data-toggle="table"
                        data-show-columns="false"
                        data-url="{{ url('personnel', ['action'=>'liste-conducteurs']) }}"
                        data-show-toggle="false">
                        <thead class="table-light">
                            <tr>
                                <th data-field="matricule">Matricule</th>
                                <th data-field="nom_conducteur">Nom</th>
                                <th data-field="grade.libelle_grade">Grade</th>
                                <th data-field="unite.libelle_unite">Unité</th>
                                <th data-field="contact_conducteur">Contact</th>
                                <th data-field="email_conducteur">E-mail</th>
                                <th data-field="adresse">Adresse</th>
                                <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter">
                                    <i class="fa fa-print"></i>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
