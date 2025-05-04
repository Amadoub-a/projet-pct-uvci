@extends(
'layouts.app',
[
'title' => 'Smart Parc Auto | Profil',
]
)

@section('content')
<div class="card-shadow-primary profile-responsive card-border mb-3 card">
    <div class="dropdown-menu-header">
        <div class="dropdown-menu-header-inner bg-info">
            <div class="menu-header-image opacity-2"></div>
            <div class="menu-header-content btn-pane-right">
                <div class="avatar-icon-wrapper me-2 avatar-icon-xl">
                    <div class="avatar-icon rounded">
                        <img src="{{asset('template/images/avatars/1.png')}}" alt="Photo de profil">
                    </div>
                </div>
                <div>
                    <h5 class="menu-header-title">{{$user->name}}</h5>
                </div>
                <div class="menu-header-btn-pane">
                    <div>
                        <div role="group" class="btn-group text-center">
                            <div class="nav">
                                <a href="{{route('auth.edit-profil')}}" class="btn btn-focus me-4">Modifier profil</a>
                                <a id="btnModalAjout" class="btn btn-danger">Changer mot de passe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active show">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="widget-content">
                        <div class="text-center">
                            <h5 class="widget-heading">{{ucfirst(str_replace('-',' ',$user->role))}}</h5>
                            <h5>
                                <span>
                                    Inscrit le <b class="text-success">{{date('d-m-Y à H:i', strtotime($user->created_at))}}</b>
                                </span>
                            </h5>
                        </div>
                    </div>
                </li>
                <li class="p-0 list-group-item">
                    <div class="grid-menu grid-menu-2col">
                        <div class="g-0 row">
                            <div class="col-sm-6">
                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-phone-handset btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    <h5>{{$user->contact}}</h5>
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                    <i class="lnr-envelope btn-icon-wrapper btn-icon-lg mb-3"></i>
                                    <h5>{{$user->email}}</h5>
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade bs-modal-ajout" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAjout">
                @csrf
                <input type="text" id="idUser" class="hidden" ng-hide="true" value="{{$user->id}}" />
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="metismenu-icon pe-7s-key"></i> Changement de mot de passe
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <label for="password" class="form-label">Mot de passe actuel *</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe actuel" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <label for="new_password" class="form-label">Nouveau mot de passe *</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Nouveau mot de passe" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe *</label>
                                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirmer le nouveau mot de passe" required>
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
@endpush
@push('javascript')
<script type="text/javascript">
    
    $(function() {
        $("#formAjout").submit(function(e) {
            e.preventDefault();
            var $ajaxLoader = $(".bs-modal-ajout");

            var $valid = $(this).valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }
            
            var id = $("#idUser").val();
            var methode = 'PUT';
            var url = 'update-password/' + id;
            
            updatePasswordAction(methode, url, $(this), $(this).serialize(), $ajaxLoader);
        });
    });

    function updatePasswordAction(methode, url, $formObject, formData, $ajaxLoader) {
        // Convertir les données du formulaire en un objet URLSearchParams
        const formDataObject = new URLSearchParams(formData);
        
        //Désactiver le formulaire avant l'envoi
        $formObject.attr("disabled", true);
        
        //Activer le loader
        $ajaxLoader.loadingModal({
            position: 'absolute',
            text: "En cours...",
            color: '#fff',
            opacity: '0.7',
            backgroundColor: 'rgb(0,0,0)',
            animation: 'fadingCircle'
        });

        fetch(url, {
            method: methode,
            body: formDataObject,
            cache: "no-cache",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        })
        .then(response => response.json())
        .then(response => {
            if (response.code === 1) {
                var formElement = document.querySelector("#" + $formObject.attr("id"));
                // Réinitialiser le formulaire
                formElement.reset();
                $(".bs-modal-ajout").modal("hide");
                $formObject.trigger('eventAjouter', [response.data]);

                $.gritter.add({
                    // heading of the notification
                    title: "Smart Parc Auto",
                    // the text inside the notification
                    text: response.msg,
                    sticky: false,
                    image: "../plugin/gritter/img/confirm.png",
                });
            }else{
                $.gritter.add({
                    // heading of the notification
                    title: "Smart Parc Auto",
                    // the text inside the notification
                    text: response.msg,
                    sticky: false,
                    image: "../plugin/gritter/img/canceled.png",
                });
            }
        })
        .catch(err => {
            $.gritter.add({
                // heading of the notification
                title: "Smart Parc Auto",
                // the text inside the notification
                text: err.msg,
                sticky: false, 
                image: "../plugin/gritter/img/canceled.png",
            });
            $formObject.removeAttr("disabled");
        })
        .finally(() => {
            $formObject.removeAttr("disabled");
            //destroy the loading modal
            $ajaxLoader.loadingModal('destroy');
        });
    }
</script>
@endpush