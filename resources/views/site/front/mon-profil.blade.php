@extends('site.layout', ['title' => "État Civil Côte d'Ivoire - Mon profil"])

@section('content-front')
<div class="toast-container position-fixed top-50 start-50 translate-middle" style="z-index: 2000;">
    <div id="toastMessage" class="toast align-items-center text-white bg-danger border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body text-center" id="toastBody">
                <!-- Le message sera injecté ici -->
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h3 class="mb-0">Mon Profil</h3>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('template/images/avatars/1.png') }}" alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px;">
                            <h5 class="text-primary">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-md-8">
                            <h5 class="mb-3">Informations personnelles</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nom complet :</strong> {{ Auth::user()->name }}</li>
                                <li class="list-group-item"><strong>Email :</strong> {{ Auth::user()->email }}</li>
                                <li class="list-group-item"><strong>Téléphone :</strong> {{ Auth::user()->contact}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 d-flex justify-content-start">
                            <button id="btnModalUpdatePassword" class="btn btn-outline-danger">Modifier le mot de passe</button>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button id="btnModalUpdateProfil" class="btn btn-outline-primary">Modifier mon profil</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-modal-update-profil" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formUpdateProfil">
                @csrf
                <input type="hidden" id="idUser" name="idUser" value="{{ Auth::user()->id }}" />
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="fa fa-address-card"></i> Modifier mon profil
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <label for="name" class="form-label">Nom complet *</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="contact" class="form-label">Contact *</label>
                                <input type="tel" class="form-control" name="contact" id="contact" value="{{ Auth::user()->contact }}" required>
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
<div class="modal fade bs-modal-update-password" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formUpdatePassword">
                @csrf
                <input type="hidden" id="idUserPassword" name="idUser" value="{{ Auth::user()->id }}" />
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" style="color:#fff;">
                        <i class="fa fa-key"></i> Modifier le mot de passe
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <label for="actuelle_password" class="form-label">Mot de passe actuel *</label>
                                <input type="password" class="form-control" name="actuelle_password" id="actuelle_password"  required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="new_password" class="form-label">Nouveau mot de passe *</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"  required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="confirm_new_password" class="form-label">Confirmez le nouveau mot de passe *</label>
                                <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password"  required>
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

<script type="text/javascript" src="{{asset('template/vendors/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/loading-modal-indicator/js/jquery.loadingModal.js')}}"></script>
<script type="text/javascript" src="{{asset('plugin/js/jquery.gritter.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        $("#btnModalUpdateProfil").on("click", function() {
            ajout = true;
            $(".bs-modal-update-profil").modal("show");
        });

        $("#btnModalUpdatePassword").on("click", function() {
            ajout = true;
            $(".bs-modal-update-password").modal("show");
        });

        $("#formUpdateProfil").submit(function(e) {
            e.preventDefault();
            var $ajaxLoader = $('#formUpdateProfil');

            var $valid = $(this).valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }

            var methode = 'POST';
            var url = "{{route('modifier-profile')}}";

            sendDataAction(methode, url, $(this), $(this).serialize(), $ajaxLoader, ajout);
        });

        $("#formUpdatePassword").submit(function(e) {
            e.preventDefault();
            var $ajaxLoader = $('#formUpdatePassword');

            var $valid = $(this).valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }

            var methode = 'POST';
            var url = "{{route('modifier-password')}}";

            sendDataAction(methode, url, $(this), $(this).serialize(), $ajaxLoader);
        });
    });

    function showToast(message, type = 'danger') {
        const toastEl = document.getElementById('toastMessage');
        const toastBody = document.getElementById('toastBody');

        toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning');
        toastEl.classList.add(`bg-${type}`);

        toastBody.innerHTML = message;

        const bsToast = new bootstrap.Toast(toastEl, {
            delay: 4000
        });

        bsToast.show();
    }

    function sendDataAction(methode, url, $form, formData, $loader) {
        // Activer le loader si nécessaire
        $loader.loadingModal({
            position: 'static',
            text: "En cours...",
            color: '#fff',
            opacity: '0.7',
            backgroundColor: 'rgb(0,0,0)',
            animation: 'fadingCircle'
        });

        // Désactiver le bouton/submit
        $form.find(':input').prop('disabled', true);

        fetch(url, {
                method: methode,
                body: new URLSearchParams(formData),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
            .then(async response => {
                const data = await response.json();

                if (data.code !== 1) {
                    showToast(data.msg || "Une erreur est survenue", 'danger');
                    return;
                }

                showToast(data.msg, 'success');
                setTimeout(() => location.reload(), 1000);
            })
            .catch(() => {
                showToast("Une erreur est survenue. Veuillez réessayer.", 'danger');
            })
            .finally(() => {
                $form.find(':input').prop('disabled', false);
                $loader.loadingModal('destroy');
            });

    }
</script>
@endsection