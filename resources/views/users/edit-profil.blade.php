@extends(
'layouts.app',
[
'title' => 'Smart Parc Auto | Profil',
]
)

@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Modifier mon profil</h5>
        <form method="PUT" action="{{route('auth.update-profil', $user->id)}}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">Nom complet *</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom et prénom(s) de l'utilisateur" value="{{$user->name}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="email" class="form-label">E-mail *</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Adresse email de l'utilisateur" value="{{$user->email}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="contact" class="form-label">Contact *</label>
                        <input type="text" class="form-control" name="contact" id="email" placeholder="Contact" value="{{$user->contact}}" required>
                    </div>
                </div>
            </div>
            <div class="float-end">
                <a href="{{route('auth.profil')}}" class="mb-2 me-4 btn-icon btn btn-secondary">
                    <i class="pe-7s-back btn-icon-wrapper"></i> Annuler
                </a> 
                <button type="submit" class="mb-2 me-2 btn-icon btn btn-primary">
                    <i class="pe-7s-check btn-icon-wrapper"></i> Valider
                </button>
            </div>
        </form>
    </div>
</div>
@endsection