@extends('frontend.master')
@section('home') 

<!-- ================================ START BREADCRUMB AREA ================================ -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Caisse</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Accueil</a></li>
                <li>Page</li>
                <li>Caisse</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================ END BREADCRUMB AREA ================================ -->

<!-- ================================ START CONTACT AREA ================================ -->
<section class="cart-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Détails de facturation</h3>
                        <div class="divider"><span></span></div>
                        <form method="post" class="row" action="{{ route('payment') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-box col-lg-6">
                                <label class="label-text">Prénom</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name" value="{{ Auth::user()->name }}">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Email</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email" value="{{ Auth::user()->email }}">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-12">
                                <label class="label-text">Adresse</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="address" value="{{ Auth::user()->address }}">
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-12">
                                <label class="label-text">Numéro de téléphone</label>
                                <div class="form-group">
                                    <input id="phone" class="form-control form--control" type="tel" name="phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div><!-- end input-box -->
                    </div><!-- end card-body -->
                </div><!-- end card -->

                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Sélectionnez le mode de paiement</h3>
                        <div class="divider"><span></span></div>
                        <div class="payment-option-wrap">
                            <div class="payment-tab is-active">
                                <div class="payment-tab-toggle">
                                    <input id="cashDelivery" name="cash_delivery" type="radio" value="handcash" onchange="toggleRibField()">
                                    <label for="cashDelivery">Paiement direct</label>
                                    <div id="ribField" style="display: none; margin-top: 5px;">
                                        <label for="rib" class="label-text"><strong>RIB :</strong></label>
                                        <input type="text" id="rib" value="23456789015" class="form-control form--control" readonly>
                                    </div>
                                </div>

                                <div class="payment-tab-toggle">
                                    <input id="stripePayment" name="cash_delivery" type="radio" value="stripe" onchange="hideRibField()">
                                    <label for="stripePayment">Paiement Stripe</label>
                                </div>

                                <div class="payment-tab-toggle">
                                    <input id="cashOption" name="cash_delivery" type="radio" value="especes" onchange="hideRibField()">
                                    <label for="cashOption">Espèce</label>
                                </div>

                                <div class="payment-tab-toggle">
                                    <input id="cashPlus" name="cash_delivery" type="radio" value="cashplus" onchange="hideRibField()">
                                    <label for="cashPlus">Cash plus</label>
                                </div>
                            </div><!-- end payment-tab -->
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-7 -->

            <div class="col-lg-5">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Détails de la commande</h3>
                        <div class="divider"><span></span></div>
                        <div class="order-details-lists">
                            @foreach ($carts as $item) 
                                <input type="hidden" name="sulg[]" value="{{ $item->options->slug }}">
                                <input type="hidden" name="course_id[]" value="{{ $item->id }}">
                                <input type="hidden" name="course_title[]" value="{{ $item->name }}">
                                <input type="hidden" name="price[]" value="{{ $item->price }}">
                                <input type="hidden" name="instructor_id[]" value="{{ $item->options->instructor }}">

                                <div class="media media-card border-bottom border-bottom-gray pb-3 mb-3">
                                    <a href="{{ url('course/details/'.$item->id.'/'.$item->options->slug) }}" class="media-img">
                                        <img src="{{ asset($item->options->image) }}" alt="Cart image">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="fs-15 pb-2"><a href="{{ url('course/details/'.$item->id.'/'.$item->options->slug) }}">{{ $item->name }}</a></h5>
                                        <p class="text-black font-weight-semi-bold lh-18">{{ $item->price }} DHS</p>
                                    </div>
                                </div><!-- end media -->
                            @endforeach  
                        </div><!-- end order-details-lists -->
                        <a href="{{ route('mycart') }}" class="btn-text"><i class="la la-edit mr-1"></i>Modifier</a>
                    </div><!-- end card-body -->
                </div><!-- end card -->

                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Résumé de la commande</h3>
                        <div class="divider"><span></span></div>
                        @if (Session::has('coupon'))
                            <ul class="generic-list-item generic-list-item-flash fs-15">
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">Sous-Total:</span>
                                    <span>{{ $cartTotal }} DHS</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">Code Promo:</span>
                                    <span>{{ session()->get('coupon')['coupon_name'] }} ({{ session()->get('coupon')['coupon_discount'] }} %)</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">Réduction :</span>
                                    <span>{{ session()->get('coupon')['discount_amount'] }} DHS</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                    <span class="text-black">Total:</span>
                                    <span>{{ session()->get('coupon')['total_amount'] }} DHS</span>
                                </li>
                            </ul>
                            <input type="hidden" name="total" value="{{ $cartTotal }}">
                        @else
                            <ul class="generic-list-item generic-list-item-flash fs-15">
                                <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                    <span class="text-black">Total:</span>
                                    <span>{{ $cartTotal }} DHS</span>
                                </li>
                                <input type="hidden" name="total" value="{{ $cartTotal }}">
                            </ul>
                        @endif  
                        <div class="btn-box border-top border-top-gray pt-3">
                            <p class="fs-14 lh-22 mb-2">Formation ++ est tenu par la loi de percevoir les taxes de transaction applicables pour les achats effectués dans certaines juridictions fiscales.</p>
                            <p class="fs-14 lh-22 mb-3">En complétant votre achat, vous acceptez ces <a href="#" class="text-color hover-underline">Conditions de service.</a></p>
                            <button type="button" class="btn theme-btn w-100" onclick="showReceiptField()">Procéder <i class="la la-arrow-right icon ml-1"></i></button>
</div>
<!-- Champ de téléchargement de reçu (caché par défaut) -->
<div id="receiptField" style="display: none; margin-top: 15px;">
    <label for="receipt" class="label-text"><strong>Téléchargez votre reçu :</strong></label>
    <input type="file" id="receipt" name="receipt" class="form-control form--control" accept=".jpg,.jpeg,.png,.pdf" onchange="showSubmitButton()">
</div>

<!-- Bouton Terminer (caché par défaut) -->
<div id="submitButton" class="btn-box border-top border-top-gray pt-3" style="display: none;">
    <button type="submit" class="btn theme-btn w-100">Terminer <i class="la la-check icon ml-1"></i></button>
</div>

<script>
    function showSubmitButton() {
        const receiptField = document.getElementById('receiptField');
        const submitButton = document.getElementById('submitButton');
        const receiptInput = document.getElementById('receipt');

        // Vérifier si un fichier a été sélectionné
        if (receiptInput.files.length > 0) {
            submitButton.style.display = 'block'; // Afficher le bouton Terminer
        } else {
            submitButton.style.display = 'none'; // Masquer le bouton Terminer si aucun fichier
        }
    }
</script>

                        </div><!-- end btn-box -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end cart-area -->
<!-- ================================ END CONTACT AREA ================================ -->

<script>
    function toggleRibField() {
        document.getElementById('ribField').style.display = 'block';
    }

    function hideRibField() {
        document.getElementById('ribField').style.display = 'none';
    }

    function submitForm() {
        document.querySelector('form').submit();
    }
</script>


<!-- -->
<script>
    function showReceiptField() {
        var receiptField = document.getElementById("receiptField");
        var paymentMethod = document.querySelector('input[name="cash_delivery"]:checked').value;

        // Affiche le champ de téléchargement uniquement si "Paiement direct" est sélectionné
        if (paymentMethod === "handcash") {
            receiptField.style.display = "block";
        } else {
            receiptField.style.display = "none"; // Cache le champ si une autre méthode est sélectionnée
        }
    }

    // Appel de la fonction pour cacher le champ de réception par défaut
    document.addEventListener('DOMContentLoaded', (event) => {
        showReceiptField(); // Cache le champ au chargement de la page
    });
</script>



@endsection