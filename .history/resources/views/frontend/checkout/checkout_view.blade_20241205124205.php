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
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li>Caisse</li>
            </ul>
        </div>
    </div>
</section>
<!-- ================================ END BREADCRUMB AREA ================================ -->

<!-- ================================ START CHECKOUT AREA ================================ -->
<section class="cart-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <!-- Détails de facturation -->
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Détails de facturation</h3>
                        <div class="divider"><span></span></div>
                        <form method="post" class="row" action="{{ route('payment') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Champs de facturation -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Prénom</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name" value="{{ Auth::user()->name }}">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div>
                            <!-- ... autres champs de facturation ... -->
                    </div>
                </div>

                <!-- Mode de paiement -->
                <div class="card card-item mt-3">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Mode de paiement</h3>
                        <div class="divider"><span></span></div>
                        <div class="payment-option-wrap">
                            <!-- Options de paiement -->
                            <div class="payment-tab is-active">
                                <!-- ... options de paiement ... -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <!-- Détails de la commande -->
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Détails de la commande</h3>
                        <div class="divider"><span></span></div>
                        <!-- Liste des articles -->
                        <div class="order-details-lists">
                            @foreach ($carts as $item)
                                <!-- ... détails des articles ... -->
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Code Promo -->
                <div class="card card-item mt-3">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Code Promo</h3>
                        <div class="divider"><span></span></div>
                        <div id="promoField">
                            <div class="input-box">
                                <div class="form-group">
                                    <input type="text" class="form-control form--control" id="promo_name" 
                                           placeholder="Entrez votre code promo">
                                    <button type="button" class="btn theme-btn mt-2" onclick="applyPromo()">
                                        Appliquer le code
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Résumé de la commande -->
                <div class="card card-item mt-3">
                    <div class="card-body">
                        <h3 class="card-title fs-22 pb-3">Résumé de la commande</h3>
                        <div class="divider"><span></span></div>
                        <div id="promoCalField">
                            @if (Session::has('promo'))
                                <!-- Affichage avec code promo -->
                                <ul class="generic-list-item generic-list-item-flash fs-15">
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Sous-Total:</span>
                                        <span>{{ $cartTotal }} DHS</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Code Promo:</span>
                                        <div>
                                            <span>{{ session()->get('promo')['code'] }} ({{ session()->get('promo')['discount'] }}%)</span>
                                            <button type="button" class="btn-sm btn-danger ml-2" onclick="removePromo()">
                                                <i class="la la-times"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Réduction:</span>
                                        <span>-{{ session()->get('promo')['discount_amount'] }} DHS</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                        <span class="text-black">Total:</span>
                                        <span>{{ session()->get('promo')['total_amount'] }} DHS</span>
                                    </li>
                                </ul>
                                <input type="hidden" name="total" value="{{ session()->get('promo')['total_amount'] }}">
                            @else
                                <!-- Affichage sans code promo -->
                                <ul class="generic-list-item generic-list-item-flash fs-15">
                                    <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                        <span class="text-black">Total:</span>
                                        <span>{{ $cartTotal }} DHS</span>
                                    </li>
                                </ul>
                                <input type="hidden" name="total" value="{{ $cartTotal }}">
                            @endif
                        </div>

                        <!-- Boutons et champs de reçu -->
                        <div class="btn-box border-top border-top-gray pt-3">
                            <button type="button" class="btn theme-btn w-100" onclick="showReceiptField()">
                                Procéder <i class="la la-arrow-right icon ml-1"></i>
                            </button>
                        </div>

                        <div id="receiptField" style="display: none; margin-top: 15px;">
                            <label for="receipt" class="label-text"><strong>Téléchargez votre reçu :</strong></label>
                            <input type="file" id="receipt" name="receipt" class="form-control form--control" 
                                   accept=".jpg,.jpeg,.png,.pdf" onchange="showSubmitButton()">
                        </div>

                        <div id="submitButton" class="btn-box border-top border-top-gray pt-3" style="display: none;">
                            <button type="submit" class="btn theme-btn w-100">
                                Terminer <i class="la la-check icon ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script type="text/javascript">
    // Fonction pour appliquer le code promo
    function applyPromo() {
        var promo_name = $('#promo_name').val();
        
        if (!promo_name) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Veuillez entrer un code promo',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                promo_name: promo_name,
                _token: '{{ csrf_token() }}'
            },
            url: "{{ url('/promo-apply') }}",
            success: function(data) {
                if (data.validity === true) {
                    location.reload();
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: data.error,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        });
    }

    // Fonction pour supprimer le code promo
    function removePromo() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/promo-remove') }}",
            dataType: 'json',
            success: function(data) {
                location.reload();
            }
        });
    }

    // Autres fonctions JavaScript
    function toggleRibField() {
        document.getElementById('ribField').style.display = 'block';
    }

    function hideRibField() {
        document.getElementById('ribField').style.display = 'none';
    }

    function showReceiptField() {
        var receiptField = document.getElementById("receiptField");
        var paymentMethod = document.querySelector('input[name="cash_delivery"]:checked');

        if (paymentMethod && paymentMethod.value === "handcash") {
            receiptField.style.display = "block";
        } else {
            receiptField.style.display = "none";
        }
    }

    function showSubmitButton() {
        const submitButton = document.getElementById('submitButton');
        const receiptInput = document.getElementById('receipt');

        if (receiptInput.files.length > 0) {
            submitButton.style.display = 'block';
        } else {
            submitButton.style.display = 'none';
        }
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', (event) => {
        showReceiptField();
    });
</script>
@endpush

@endsection