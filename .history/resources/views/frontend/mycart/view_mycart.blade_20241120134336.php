@extends('frontend.master')
@section('home')
<!-- ================================
    START BREADCRUMB AREA
================================= -->
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
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->

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
           
    <!-- Ajouter un champ caché avec l'ID de la formation -->
    <input type="hidden" id="current_course_id" value="{{ $course->id }}">

    @if(Session::has('coupon'))
        <!-- Affichage du coupon -->
    @else
        <form method="post" action="#">
            <div class="input-group mb-2" id="couponField">
                <input class="form-control form--control pl-3" type="text" id="coupon_name" placeholder="Code Promo">
                <div class="input-group-append">
                    <a type="submit" onclick="applyCoupon()" class="btn theme-btn">Appliquer le code</a>      
                </div>
            </div>
        </form>
    @endif
</div>

        <div class="col-lg-4 ml-auto">
            <div class="bg-gray p-4 rounded-rounded mt-40px" id="couponCalField">
                <!-- Affichage des calculs avec coupon -->
            </div>

            <a href="{{ route('checkout') }}" class="btn theme-btn w-100">Passer la commande <i class="la la-arrow-right icon ml-1"></i></a>
        </div>
    </div><!-- end container -->
</section><!-- end cart-area -->

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
    </div><!-- end container -->
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
@endsection