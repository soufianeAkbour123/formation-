<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/formation.jfif') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Tableau de Bord</div>
            </a>
        </li>
        
        <li class="menu-label">Éléments UI</li>
        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Gérer les Catégories</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.category') }}"><i class='bx bx-radio-circle'></i>Toutes les Catégories</a>
                </li>
                <li> <a href="{{ route('all.subcategory') }}"><i class='bx bx-radio-circle'></i>Toutes les Sous-catégories</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Gérer les Formateurs</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.instructor') }}"><i class='bx bx-radio-circle'></i>Tous les Formateurs</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Reduction</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.coupon') }}"><i class='bx bx-radio-circle'></i>Tous les Codes Promo</a>
                </li>
            </ul>
        </li>

        <li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-gift'></i>
						</div>
						<div class="menu-title">Code Promo</div>
					</a>
					<ul>
						<li> <a href="{{ route('admin.all.promo') }}"><i class='bx bx-receipt'></i>Tous les codes promo</a>
						<li> <a href="{{ route('admin.all.promo.apply') }}"><i class='bx bx-receipt'></i>Les codes promo appliquer</a>

						</li>


					</ul>
			   <li>
        <li>
			<a class="has-arrow" href="javascript:;">
				<div class="parent-icon"><i class='bx bx-credit-card'></i></div>
				<div class="menu-title">Vérification des paiements</div>
			</a>
			<ul>
				<li><a href="{{ route('admin.all.virement') }}"><i class='bx bx-transfer'></i> Paiement par virement</a></li>
			</ul>
			</li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Gestion des Formations</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.course') }}"><i class='bx bx-radio-circle'></i>Toutes les Formations</a>
                </li>
            </ul>
        </li>   
       
			<li>
			<a class="has-arrow" href="javascript:;">
				<div class="parent-icon"><i class='bx bx-credit-card'></i></div>
				<div class="menu-title"> Gestion des commandes</div>
			</a>
			<ul>
				<li><a href="{{ route('admin.pending.order') }}"><i class='bx bx-radio-circle'></i> Commande en cours </a></li>
				<li><a href="{{ route('admin.confirm.order') }}"><i class='bx bx-radio-circle'></i> Commande confirmer </a></li>

			</ul>
			</li>

        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Report</div>
            </a>
            <ul>
                <li> <a href="{{ route('report.view') }}"><i class='bx bx-radio-circle'></i>Report View </a>
                </li>



            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Review</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.pending.review') }}"><i class='bx bx-radio-circle'></i>Pending Review </a>
                </li>
                <li> <a href="{{ route('admin.active.review') }}"><i class='bx bx-radio-circle'></i>Active Review </a>
                </li>
               
               
               
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage All User </div>
            </a>
            <ul>
                <li> <a href="{{ route('all.user') }}"><i class='bx bx-radio-circle'></i>All User </a>
                </li>
                <li> <a href="{{ route('all.instructorA') }}"><i class='bx bx-radio-circle'></i>All Instructor</a>
                </li>
               
               
               
            </ul>
        </li>
        <li class="menu-label">Graphiques & Cartes</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Graphiques</div>
            </a>
            <ul>
                <li> <a href="charts-apex-chart.html"><i class='bx bx-radio-circle'></i>Apex</a>
                </li>
                <li> <a href="charts-chartjs.html"><i class='bx bx-radio-circle'></i>Chartjs</a>
                </li>
                <li> <a href="charts-highcharts.html"><i class='bx bx-radio-circle'></i>Highcharts</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-map-alt"></i>
                </div>
                <div class="menu-title">Cartes</div>
            </a>
            <ul>
                <li> <a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google Maps</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Cartes Vectorielles</a>
                </li>
            </ul>
        </li>
        
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>