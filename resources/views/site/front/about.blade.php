@extends(
'site.layout',
[
    'title' => "État Civil Côte d'Ivoire - A propos",
]
)
@section('content-front')
<!-- Hero Section -->
<section class="about-hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">
            À propos de nous
        </h1>
        <p class="lead mb-0">
            Découvrez notre mission et notre engagement pour moderniser l'état civil en Côte d'Ivoire
        </p>
    </div>
</section>


<section class="py-5" id="about-us">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="text-center">Qui sommes-nous ?</h2>
                <p>
                    Nous sommes une entreprise numérique qui propose des solutions aux citoyens et à l'État pour le
                    bien-être des citoyens. Nous sommes des jeunes dynamiques et travailleurs pour le développement de
                    tous. Nous avons constaté qu'aujourd'hui, pour avoir un document d'état civil, cela prend du temps,
                    voire des jours. C'est dans cette optique que nous avons eu l'idée de mettre en place une
                    application web pour faciliter la tâche à tous. À travers cette application, nous n'aurons plus à
                    nous déplacer à la Mairie pour faire quelconque demande d'un document. Depuis votre position, vous
                    avez la possibilité de le faire et de le télécharger. Il vous suffit juste de suivre quelques étapes
                    pour avoir votre document. En plus de ça, vous pouvez payer en ligne, signer électroniquement et le
                    télécharger sans problème. Fin aux longues heures d'attente, fin aux longs rangs, fin à la perte de
                    temps, (Le nom de l'Application) est la solution à votre problème.
                </p>
                <p>
                    Nous nous engageons à :
                </p>
                <ul>
                    <li>Réduire les délais d'obtention des documents officiels</li>
                    <li>Lutter contre la fraude documentaire grâce à des systèmes de vérification avancés</li>
                    <li>Préserver la confidentialité des données personnelles</li>
                    <li>Rendre les services d'état civil accessibles à tous, y compris dans les zones rurales</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Notre vision</h4>
                        <p>
                            Nous aspirons à créer un système d'état civil moderne, inclusif et efficace qui:
                        </p>
                        <div class="d-flex mb-3">
                            <div class="me-3 text-success">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5>Accessibilité</h5>
                                <p>Rendre les services d'état civil accessibles à tous les citoyens, où qu'ils
                                    soient.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3 text-success">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5>Efficacité</h5>
                                <p>Réduire les délais de traitement et simplifier les procédures administratives.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3 text-success">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5>Sécurité</h5>
                                <p>Garantir l'authenticité des documents et protéger les données personnelles.</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-3 text-success">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5>Innovation</h5>
                                <p>Utiliser les technologies modernes pour améliorer continuellement nos services.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light" id="faq">
    <div class="container">
        <h2 class="text-center mb-5">Foire aux questions</h2>

        <div class="accordion" id="faqAccordion">
            <!-- Question 1 -->
            <div class="accordion-item mb-3 border">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Le site est-il fiable et sécurisé ?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Oui, notre site est à la fois fiable et sécurisé. La rapidité de notre service vous assure une expérience efficace, et nous accordons une importance primordiale à votre sécurité et à la protection de vos informations.</p>
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="accordion-item mb-3 border">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Combien de temps faut-il pour obtenir un document d'état civil ?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Le délai d'obtention des documents dépend du type de document demandé. Pour les actes de naissance, la délivrance est séance tenante (immédiate). Pour les autres types de documents, le délai standard est de 24 à 48 heures après la validation de votre demande, selon la complexité spécifique de votre requête.</p>
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="accordion-item mb-3 border">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Quelles sont les méthodes de paiement acceptées ?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Nous acceptons les paiements par carte bancaire (Visa et MasterCard), Mobile Money(Orange, MTN, Moov) pour les demandes groupées. Les documents délivrés en ligne ont la même valeur légale que les originaux.</p>
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="accordion-item mb-3 border">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Comment être sûr(e) de recevoir mon document après le paiement ?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Après la validation de votre paiement, votre document est automatiquement disponible dans votre espace personnel sécurisé. Notre système garantit une livraison immédiate et fiable. En cas de problème technique exceptionnel, notre service client est disponible pour vous aider rapidement.</p>
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="accordion-item mb-3 border">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Les documents obtenus ont-ils la même valeur légale que ceux obtenus en mairie ?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Oui, tous les documents délivrés via notre plateforme sont officiels et ont la même valeur légale que ceux obtenus directement auprès des services d'état civil. Ils comportent une signature électronique sécurisée et un QR code permettant de vérifier leur authenticité.</p>
                    </div>
                </div>
            </div>



            <!-- Question 6 -->
            <div class="accordion-item mb-3 border">
                <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        Que faire si je ne connais pas mon numéro d'acte de naissance ?
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Si vous ne connaissez pas votre numéro d'acte de naissance, vous pouvez tout de même faire votre demande en fournissant toutes les autres informations demandées. Notre système effectuera une recherche dans la base de données centralisée pour retrouver votre acte.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
