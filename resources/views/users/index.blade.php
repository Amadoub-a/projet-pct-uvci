@extends(
'layouts.app',
[
'title' => 'Smart Parc Auto | Utilisateurs',
]
)

@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Liste des utilisateurs</h5>
        <table id="table" class="mb-0 table table-striped table-hover" data-pagination="true" data-search="false" data-toggle="table" data-show-columns="false" data-url="{{url('auth', ['action'=>'liste-users'])}}" data-show-toggle="false">
            <thead>
                <tr>
                    <th data-field="name" data-sortable="true">Nom</th>
                    <th data-field="contact">Contact</th>
                    <th data-field="depot.libelle_depot">D&eacute;p&ocirc;t</th>
                    <th data-field="role" data-formatter="optionRoleFormatter">Role</th>
                    <th data-field="compte_is_actif" data-formatter="etatCompteFormatter">Compte</th>
                    <th data-field="user_connected" data-formatter="etatConnexionFormatter">Connect&eacute;</th>
                    <th data-field="last_login">Derni&egrave;re connexion</th>
                    <th data-field="id" data-width="80px" data-align="center" data-formatter="optionFormatter"><i class="fa fa-wrench"></i></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade bs-modal-ajout" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formAjout" ng-controller="formAjoutCtrl">
                @csrf
                <input type="text" class="hidden" id="idUserModifier" ng-hide="true" ng-model="user.id" />
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-users"></i> {{$titleControlleur}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="name" class="form-label">Nom de l'utilisateur *</label>
                                <input type="text" class="form-control" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" ng-model="user.name" name="name" id="name" placeholder="Nom et prénom(s) de l'utilisateur" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="email" class="form-label">E-mail *</label>
                                <input type="email" class="form-control" ng-model="user.email" name="email" id="email" placeholder="Adresse email de l'utilisateur" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="contact" class="form-label">Contact *</label>
                                <input type="text" class="form-control" ng-model="user.contact" name="contact" id="contact" placeholder="Contact de l'utilisateur" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="role" class="form-label">R&ocirc;le *</label>
                                <select class="form-select form-control" name="role" id="role" ng-model="user.role" required>
                                    <option value="">-- Choisissez un r&ocirc;le --</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role}}">{{ucfirst(str_replace('-',' ',$role))}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row sectionUniteDepot">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="unite_id" class="form-label">Unit&eacute;</label>
                                <select class="form-select form-control" name="unite_id" id="unite_id" ng-model="user.unite_id">
                                    <option value="">-- Choisissez une unit&eacute; --</option>
                                    @foreach($unites as $unite)
                                        <option value="{{$unite->id}}">{{$unite->libelle_unite}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="depot_id" class="form-label">D&eacute;p&ocirc;t</label>
                                <select class="form-select form-control" name="depot_id" id="depot_id" ng-model="user.depot_id">
                                    <option value="">-- Choisissez un d&eacute;p&ocirc;t--</option>
                                    @foreach($depots as $depot)
                                        <option value="{{$depot->id}}">{{$depot->libelle_depot}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row sectionUniteSuperviseur">
                    <div class="col-md-12">
                        <div class="position-relative mb-3">
                            <label for="unites" class="form-label">L'unit&eacute; ou les unit&eacute;s &agrave; superviser</label>
                            <select class="form-select form-control" multiple="multiple" name="unites[]" id="unites">
                                <option value="">-- Choisissez une ou les unit&eacute;s --</option>
                                @foreach($unites as $unite)
                                <option value="{{$unite->id}}">{{$unite->libelle_unite}}</option>
                                @endforeach
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

<div class="modal fade bs-modal-suppression" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formSupprimer" ng-controller="formSupprimerCtrl">
                @csrf
                <input type="text" class="hidden" id="idUserSupprimer" ng-hide="true" ng-model="user.id" />
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-trash"></i> D&eacute;sactiver ou activer le compte
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-question-circle fa-2x"></i> 
                        Etes vous certains de vouloir <b>@{{user.compte_is_actif == 1 ? "désactiver" : "activer"}}</b>  le compte utilisateur de <br/><b>@{{user.name}}</b>
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
<script type="text/javascript">
    var ajout = true;
    var $table = jQuery("#table"),
        rows = [];

    appSmarty.controller('formAjoutCtrl', function($scope) {
        $scope.populateForm = function(user) {
            $scope.user = user;
        };
        $scope.initForm = function() {
            ajout = true;
            $scope.user = {};
        };
    });

    appSmarty.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (user) {
            $scope.user = user;
        };
        $scope.initForm = function () {
            $scope.user = {};
        };
    });

    $(function() {
        $(".sectionUniteSuperviseur").hide();
        $table.on('load-success.bs.table', function(e, data) {
            rows = data.rows;
        });

        $("#unite_id, #unites").select2({
            theme: "bootstrap4",
            dropdownParent: $(".bs-modal-ajout")
        });

        $("#role").change(function(e) {
            var role = $("#role").val();
            if(role == "admin"){
                $(".sectionUniteDepot, .sectionUniteSuperviseur").hide();
            }
            if(role != "admin" && role != "superviseur"){
                $(".sectionUniteDepot").show();
                $(".sectionUniteSuperviseur").hide();
            }
            if(role == "superviseur"){
                $(".sectionUniteDepot").hide();
                $(".sectionUniteSuperviseur").show();
            }
        });


        $("#formAjout").submit(function(e) {
            e.preventDefault();
            var $ajaxLoader = $(".bs-modal-ajout");

            var $valid = $(this).valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }

            if (ajout == true) {
                var methode = 'POST';
                var url = "{{route('auth.users.store')}}";
            } else {
                var id = $("#idUserModifier").val();
                var methode = 'PUT';
                var url = 'users/' + id;
            }
            editerAction(methode, url, $(this), $(this).serialize(), $ajaxLoader, $table, ajout);
        });

        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var id = $("#idUserSupprimer").val();
            var formData = $(this).serialize();
            var $ajaxLoader = $(".bs-modal-suppression");
            supprimerAction('users/' + id, $(this).serialize(),$ajaxLoader, $table);
        });
    });

    function updateRow(idUser) {
        ajout = false;
        var $scope = angular.element($("#formAjout")).scope();
        var user = _.findWhere(rows, {
            id: idUser
        });
        $scope.$apply(function() {
            $scope.populateForm(user);
        });
          
        var role = $("#role").val();
        if(role == "admin"){
            $(".sectionUniteDepot, .sectionUniteSuperviseur").hide();
            $("#depot_id").val("");
            $("#unite_id").val("");
        }
        if(role != "admin" && role != "superviseur"){
            $(".sectionUniteDepot").show();
            $(".sectionUniteSuperviseur").hide();
            if(user.depot_id == null){
                $("#depot_id").val("");
            }
            if(user.unite_id == null){
                $("#unite_id").val("").trigger('change');
            }else{
                $("#unite_id").val(user.unite_id).trigger('change');
            }
        }

        if(role == "superviseur"){
            $(".sectionUniteDepot").hide();
            $(".sectionUniteSuperviseur").show();
            $("#depot_id").val("");
            $("#unite_id").val("");

            var ids = user.unites.map(function(unite){
                return unite.id;
            });
            $("#unites").val(ids).trigger('change');
        }

        $(".bs-modal-ajout").modal("show");
    }

    function deleteRow(idUser) {
          var $scope = angular.element($("#formSupprimer")).scope();
          var user =_.findWhere(rows, {id: idUser});
           $scope.$apply(function () {
              $scope.populateForm(user);
          });
       $(".bs-modal-suppression").modal("show");
    }

    function optionFormatter(id, row) {
        return '<button class="btn-transition btn btn-xs btn-outline-primary" title="Modifier" onClick="javascript:updateRow(' + id + ');"><i class="lnr-pencil"> </i></button>\n\
                <button class="btn-transition btn btn-xs btn-outline-danger" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"><i class="lnr-trash"> </i></button>';
    }

    function optionRoleFormatter(roles) {
        var role = roles.charAt(0).toUpperCase() + roles.slice(1);
        return role.replace(/-/g, ' ');
    }

    function etatCompteFormatter(etat) {
        return etat == 1 ? "<span class='mb-2 me-2 badge bg-success'>Actif</span>" : "<span class='mb-2 me-2 badge bg-danger'>Fermé</span>";
    }

    function etatConnexionFormatter(etat){
        return etat == 1 ? "<span class='mb-2 me-2 badge bg-success'>Oui </span>" : "<span class='mb-2 me-2 badge bg-danger'>Non</span>";
    }
</script>
@endpush