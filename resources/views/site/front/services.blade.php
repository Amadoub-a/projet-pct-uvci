@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - Services",
]
)

@section('content-front')
<!-- Services Hero Section -->

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Nos Services</h1>
        <p class="lead mb-5">
            Découvrez tous les services de l'État civil disponibles en ligne pour
            simplifier vos démarches administratives
        </p>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 mb-5" id="acte-naissance">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{asset('images/actes/acte-naissance.png')}}" alt="Acte de naissance" class="img-fluid rounded"/>
            </div>
            <div class="col-lg-6">
                <h2 class="service-title">Acte de naissance</h2>
                <p>
                    L'acte de naissance est un document officiel qui atteste de la
                    naissance d'une personne. Il est essentiel pour de nombreuses
                    démarches administratives comme l'obtention d'une carte
                    d'identité, d'un passeport, ou l'inscription à l'école.
                </p>

                <h5 class="mt-4">Documents requis :</h5>
                <ul>
                    <li>Numéro d'acte de naissance (si connu)</li>
                    <li>Informations sur le lieu et la date de naissance</li>
                    <li>Noms et prénoms des parents</li>
                </ul>

                <h5 class="mt-4">Délai d'obtention :</h5>
                <p>Immédiatement</p>

                <a href="{{ route(name: 'declaration-naissance') }}" class="btn btn-cta mt-3">Faire une demande</a>
            </div>
        </div>
    </div>
</section>

<div class="bg-light">
    <section class="py-5 mb-5" id="acte-mariage">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <img src="{{asset('images/actes/acte-mariage.png')}}" alt="Acte de mariage" class="img-fluid rounded"/>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <h2 class="service-title">Acte de mariage</h2>
                    <p>
                        L'acte de mariage est un document officiel qui atteste de
                        l'union civile de deux personnes. Il est nécessaire pour
                        diverses démarches administratives et juridiques, notamment pour
                        les questions d'héritage ou de changement de nom.
                    </p>

                    <h5 class="mt-4">Documents requis :</h5>
                    <ul>
                        <li>Numéro d'acte de mariage (si connu)</li>
                        <li>Date et lieu du mariage</li>
                        <li>Noms et prénoms des époux</li>
                    </ul>

                    <h5 class="mt-4">Délai d'obtention :</h5>
                    <p>Immédiatement</p>

                    <a href="{{ route(name: 'declaration-mariage') }}" class="btn btn-cta mt-3">Faire une demande</a>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="py-5 mb-5" id="acte-deces">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{asset('images/actes/acte-deces.png')}}" alt="Certificat de décès" class="img-fluid rounded"/>
            </div>
            <div class="col-lg-6">
                <h2 class="service-title">Certificat de décès</h2>
                <p>
                    Le certificat de décès est un document officiel qui atteste du
                    décès d'une personne. Il est nécessaire pour les démarches
                    successorales, les demandes de pension de réversion, et autres
                    formalités administratives liées au décès.
                </p>

                <h5 class="mt-4">Documents requis :</h5>
                <ul>
                    <li>Numéro d'acte de décès (si connu)</li>
                    <li>Date et lieu du décès</li>
                    <li>Informations sur la personne décédée</li>
                    <li>Preuve de filiation ou d'intérêt légitime</li>
                </ul>

                <h5 class="mt-4">Délai d'obtention :</h5>
                <p>Immédiatement</p>

                <a href="{{ route(name: 'declaration-deces') }}" class="btn btn-cta mt-3">Faire une demande</a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 mb-5" id="acte-vie">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{asset('images/actes/acte-vie.png')}}" alt="Certificat de décès" class="img-fluid rounded"/>
            </div>
            <div class="col-lg-6">
                <h2 class="service-title">Certificat de vie</h2>
                <p>
                    Le certificat de vie est un document officiel qui atteste qu'une personne est vivante à une date donnée. Il est nécessaire pour diverses démarches administratives telles que la justification de l'existence auprès d'organismes de pension, d'assurances, ou d'autres institutions qui requièrent une preuve de vie.
                </p>

                <h5 class="mt-4">Documents requis :</h5>
                <ul>
                    <li>Présence physique de la personne concernée</li>
                    <li>Pièce d'identité originale et une photocopie (CNI, passeport, etc.)</li>
                </ul>

                <h5 class="mt-4">Délai d'obtention :</h5>
                <p>Immédiatement</p>

                <a href="{{ route(name: 'declaration-vie') }}" class="btn btn-cta mt-3">Faire une demande</a>
            </div>
        </div>
    </div>
</section>

<div class="bg-light">
    <section class="py-5 mb-5" id="certification-document">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <img src="{{asset('images/actes/certification.png')}}" alt="Certification de documents" class="img-fluid rounded"/>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <h2 class="service-title">Certification de documents</h2>
                    <p>
                        La certification de documents est une procédure qui permet
                        d'attester qu'une copie de document est conforme à l'original.
                        Ce service est souvent requis pour des dossiers administratifs,
                        des candidatures à des emplois ou des inscriptions scolaires.
                    </p>

                    <h5 class="mt-4">Documents acceptés pour certification :</h5>
                    <ul>
                        <li>Diplômes et relevés de notes</li>
                        <li>Pièces d'identité</li>
                        <li>Actes d'état civil</li>
                        <li>Documents administratifs divers</li>
                    </ul>

                    <h5 class="mt-4">Procédure :</h5>
                    <ol>
                        <li>
                            Téléchargez une copie numérique claire du document original
                        </li>
                        <li>Remplissez le formulaire de demande en ligne</li>
                        <li>Payez les frais de certification</li>
                        <li>
                            Recevez votre document certifié par voie électronique ou
                            postale
                        </li>
                    </ol>

                    <a href="{{ route(name: 'legalisation-document') }}" class="btn btn-cta mt-3">Faire une demande</a>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="py-5 mb-5" id="legalisation-document">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{asset('images/actes/legalisation.png')}}" alt="Légalisation de documents" class="img-fluid rounded"/>
            </div>
            <div class="col-lg-6">
                <h2 class="service-title">Légalisation de documents</h2>
                <p>
                    La légalisation de documents est une procédure qui permet de
                    vérifier l'authenticité de la signature apposée sur un acte
                    officiel et la qualité du signataire. Ce service est
                    particulièrement important pour les documents destinés à être
                    utilisés à l'étranger.
                </p>

                <h5 class="mt-4">Documents acceptés pour légalisation :</h5>
                <ul>
                    <li>Actes notariés</li>
                    <li>Jugements et décisions de justice</li>
                    <li>Diplômes et certificats</li>
                    <li>Procurations</li>
                    <li>Déclarations sous serment</li>
                </ul>

                <h5 class="mt-4">Procédure :</h5>
                <ol>
                    <li>Téléchargez une copie numérique du document à légaliser</li>
                    <li>Remplissez le formulaire de demande en ligne</li>
                    <li>Payez les frais de légalisation</li>
                    <li>
                        Recevez votre document légalisé par voie électronique ou postale
                    </li>
                </ol>

                <div class="alert alert-info mt-4">
                    <i class="fas fa-info-circle me-2"></i> La légalisation de
                    documents peut nécessiter des étapes supplémentaires selon le pays
                    de destination. Contactez-nous pour plus d'informations.
                </div>

                <a href="{{ route(name: 'legalisation-document') }}" class="btn btn-cta mt-3">Faire une demande</a>
            </div>
        </div>
    </div>
</section>

<div class="bg-light">
    <section class="py-5 mb-5" id="copies-actes">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <img src="{{asset('images/actes/acte-naissance.png')}}" alt="Copies d'actes" class="img-fluid rounded"/>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <h2 class="service-title">Copies d'actes</h2>
                    <p>
                        Obtenez des copies certifiées de vos actes d'état civil (naissance, mariage, décès) sans avoir à vous déplacer. 
                        Ce service vous permet de recevoir rapidement des copies officielles de vos documents importants.
                    </p>

                    <h5 class="mt-4">Types de copies disponibles :</h5>
                    <ul>
                        <li>Copie intégrale d'acte de naissance</li>
                        <li>Extrait d'acte de naissance</li>
                        <li>Copie d'acte de mariage</li>
                        <li>Copie d'acte de décès</li>
                    </ul>

                    <h5 class="mt-4">Procédure :</h5>
                    <ol>
                        <li>Sélectionnez le type d'acte dont vous avez besoin</li>
                        <li>Fournissez les informations nécessaires</li>
                        <li>Payez les frais correspondants</li>
                        <li>Recevez votre copie par voie électronique ou postale</li>
                    </ol>

                    <a href="{{ route(name: 'copie-acte') }}" class="btn btn-cta mt-3">Faire une demande</a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- CTA Section -->
<section class="py-5 text-center">
    <div class="container">
        <h2 class="mb-4">Prêt à faire votre demande ?</h2>
        <p class="lead mb-4">
            Créez votre compte en quelques clics et accédez à tous nos services en
            ligne
        </p>
        <a href="{{ route(name: 'sign-up') }}" class="btn btn-cta btn-lg px-5">S'inscrire maintenant</a>
        <p class="mt-3">Déjà inscrit ? <a href="{{ route(name: 'sign-in') }}">Connectez-vous</a></p>
    </div>
</section>
@endsection
