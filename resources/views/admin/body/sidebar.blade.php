<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-container">
            <img src="{{URL::asset('backend/assets/images/OSRlogo.png')}}" class="logo-icon" alt="logo">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                <div class="menu-title">Tableau de Bord</div>
            </a>
        </li>

        <li class="menu-label">Éléments UI</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i></div>
                <div class="menu-title">Gérer les Catégories</div>
            </a>
            <ul>
                <li><a href="{{ route('all.category') }}"><i class='bx bx-radio-circle'></i>Toutes les Catégories</a></li>
                <li><a href="{{ route('all.subcategory') }}"><i class='bx bx-radio-circle'></i>Toutes les Sous-catégories</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i></div>
                <div class="menu-title">Gestion des Formations</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.all.course') }}"><i class='bx bx-radio-circle'></i>Toutes les Formations</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-gift'></i></div>
                <div class="menu-title">Code Promo</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.all.promo') }}"><i class='bx bx-receipt'></i>Tous les codes promo</a></li>
                <li><a href="{{ route('admin.all.promo.apply') }}"><i class='bx bx-receipt'></i>Les codes promo appliqués</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-credit-card'></i></div>
                <div class="menu-title">Vérification des paiements</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.all.virement') }}"><i class='bx bx-transfer'></i>Paiement par virement</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-credit-card'></i></div>
                <div class="menu-title">Gestion des commandes</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.pending.order') }}"><i class='bx bx-radio-circle'></i>Commande en cours</a></li>
                <li><a href="{{ route('admin.confirm.order') }}"><i class='bx bx-radio-circle'></i>Commande confirmée</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i></div>
                <div class="menu-title">Gérer les avis</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.pending.review') }}"><i class='bx bx-radio-circle'></i>Avis en attente</a></li>
                <li><a href="{{ route('admin.active.review') }}"><i class='bx bx-radio-circle'></i>Avis actifs</a></li>
            </ul>
        </li>

        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i></div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>

<style>
/* Styles pour le logo */
.logo-icon {
    width: 100%;
    max-width: 100px;
    max-width: 80px;
    height: auto;
    display: block;
    margin: 0 auto;
}

/* Conteneur pour le logo */
.logo-container {
    text-align: center;
    margin: 9px 10px;
}

/* Styles pour la barre latérale */
.sidebar-header {
    padding: 15px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Sidebar fermée */
.sidebar-wrapper.sidebar-closed .logo-icon {
    max-width: 50px;
    transition: max-width 0.3s ease-in-out;
}

.sidebar-wrapper.sidebar-closed .logo-text {
    display: none;
}

/* Responsive pour petits écrans */
@media (max-width: 768px) {
    .logo-icon {
        max-width: 100px 80px;
    }

    .sidebar-header {
        padding: 10px;
    }
}
</style>
