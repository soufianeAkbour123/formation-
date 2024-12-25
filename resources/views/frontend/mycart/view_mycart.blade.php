@extends('frontend.master')
@section('home')

<!-- ================================
    START BREADCRUMB AREA
================================= -->

<style>
    #couponField {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    #couponField .input-group {
        display: flex; /* Pour afficher l'input et le bouton sur la même ligne */
        align-items: center;
    }

    #promoCodeInput {
        flex: 1; /* L'input prend tout l'espace disponible */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px 0 0 4px; /* Bordure arrondie gauche uniquement */
        font-size: 14px;
        outline: none;
    }

    #applyPromoButton {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 0 4px 4px 0; /* Bordure arrondie droite uniquement */
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    #applyPromoButton:hover {
        background-color: #0056b3;
    }

    #promoMessage {
        margin-top: 10px;
        font-size: 14px;
        color: #28a745;
        text-align: center;
    }

    #promoMessage.error {
        color: #dc3545;
    }
</style>

<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Panier d'achat</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>Panier d'achat</li>
            </ul>
        </div>
    </div>
</section>

<!-- ================================
       START CART AREA
================================= -->
<section class="cart-area section-padding">
    <div class="container">
        <div class="table-responsive">
            <table class="table generic-table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Le Cours</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="cartPage">
                    <!-- Contenu du panier ici -->
                </tbody>
            </table>

            <div class="d-flex flex-wrap align-items-center justify-content-between pt-4"> 
                @if(Session::has('coupon'))
                    <!-- Affichage du coupon -->
                @else
                    <form method="post" action="#">
                        <div class="input-group mb-2" id="couponField">
                            <div class="input-group">
                                <input type="text" id="promoCodeInput" placeholder="Enter Promo Code">
                                <button type="button" id="applyPromoButton" onclick="applyPromo()">Apply Promo</button>
                            </div>
                            <div id="promoMessage"></div> <!-- Section où le message s'affichera -->
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <div class="col-lg-4 ml-auto">
            <div class="bg-gray p-4 rounded-rounded mt-40px" id="promoCalField">
                
                <!-- Affichage des calculs avec coupon -->
         
            </div>

            <a href="{{ route('checkout') }}" class="btn theme-btn w-100">Passer la commande <i class="la la-arrow-right icon ml-1"></i></a>
        </div>
    </div>
</section>

<!-- Section pour le paiement direct -->
<section class="payment-section" id="paymentSection" style="display:none;">
    <div class="container">
        <form action="{{ route('payment') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Champ Nom -->
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <!-- Champ Email -->
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Champ Téléphone -->
            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <!-- Champ Adresse -->
            <div class="form-group">
                <label for="address">Adresse :</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <!-- Options de paiement -->
            <div class="form-group">
                <label for="direct_payment">
                    <input type="radio" id="direct_payment" name="payment_method" value="direct" onchange="toggleRibField()"> Paiement direct
                </label>
            </div>

            <!-- Champ RIB caché par défaut -->
            <div class="form-group" id="rib_field" style="display:none;">
                <label for="rib">RIB :</label>
                <input type="text" id="rib" name="rib" class="form-control">
            </div>

            <!-- Téléchargement du reçu après sélection de paiement direct -->
            <div class="form-group" id="receipt_field" style="display:none;">
                <label for="receipt">Télécharger le reçu de virement :</label>
                <input type="file" id="receipt" name="receipt" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Procéder</button>
        </form>
    </div>
</section>

<script>
    // Fonction pour afficher/cacher la section de paiement direct
    function togglePaymentOptions() {
        var paymentSection = document.getElementById('paymentSection');
        paymentSection.style.display = 'block';
    }

    // Fonction pour afficher/cacher les champs RIB et reçu
    function toggleRibField() {
        var ribField = document.getElementById('rib_field');
        var receiptField = document.getElementById('receipt_field');
        if (document.getElementById('direct_payment').checked) {
            ribField.style.display = 'block';
            receiptField.style.display = 'block';
        } else {
            ribField.style.display = 'none';
            receiptField.style.display = 'none';
        }
    }

   
</script>



<!-- Assurez-vous d'inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //// pour appliquer le code promo 
    $(document).ready(function () {
    $('#applyPromoButton').on('click', function () {
        var promoCode = $('#promoCodeInput').val(); // Récupérer le code promo saisi
        var rows = "";
        
        // Récupérer l'ID du cours
        $.ajax({
            type: 'GET',
            url: '/get-cart-course',
            dataType: 'json',
            success: function(response) {
                $.each(response.carts, function(key, value) {
                    rows += value.id;
                });
                var courseId = rows;
                
                $.ajax({
                    url: '/promo-apply',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        promo_name: promoCode,
                        course_id: courseId // Inclure l'ID du cours
                    },
                    success: function (response) {
                        if (response.validity) {
                            $('#promoMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                            promoCalculation(); // Rafraîchir les totaux après application du code promo
                        } else {
                            $('#promoMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        $('#promoMessage').html('<div class="alert alert-danger">Une erreur est survenue. Veuillez réessayer.</div>');
                    }
                });
            },
        });
    });
});

</script>


@endsection