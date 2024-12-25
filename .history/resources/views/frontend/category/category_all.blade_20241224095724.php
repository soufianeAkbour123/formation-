@extends('frontend.master')
section('home')
<style>
   .card {
       height: 510px;
       display: flex;
       flex-direction: column;
   }
    .card-body {
       flex-grow: 1;
   }
    /* Mobile */
   @media (max-width: 767px) {
       .card {
           flex-direction: column;
           height: auto;
       }
       .card-body {
           padding: 16px;
       }
       .card-title {
           font-size: 18px;
       }
   }
    /* Tablette */
   @media (min-width: 768px) and (max-width: 1199px) {
       .card {
           height: 500px;
       }
       .card-body {
           padding: 20px;
       }
       .card-title {
           font-size: 20px;
       }
   }
    .icon-element.active {
       background-color: green;
       color: white;
   }
    .category-item.active {
       background-color: #f8f9fa;
       font-weight: bold;
   }
    .custom-control.active label {
       font-weight: bold;
   }
    .la-heart {
       color: #28a745;
   }
    .la-heart-o {
       color: initial;
   }
    #searchResults {
       max-height: 400px;
       overflow-y: auto;
   }
    .loading {
       opacity: 0.5;
       pointer-events: none;
   }
/style>
<!-- Breadcrumb Area -->
section class="breadcrumb-area section-padding img-bg-2">
   <div class="overlay"></div>
   <div class="container">
       <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
           <div class="section-heading">
               <h2 class="section__title text-white">{{ $category->category_name }}</h2>
           </div>
           <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
               <li><a href="{{ url('/') }}">Home</a></li>
               <li>{{ $category->category_name }}</li>
           </ul>
       </div>
   </div>
/section>
<!-- Course Area -->
section class="course-area section--padding">
   <div class="container">
       <div class="filter-bar mb-4">
           <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
               <p class="fs-14" id="courseCount">Nous avons trouvé <span class="text-black">{{ count($courses) }}</span> cours disponibles pour vous</p>
               <div class="d-flex flex-wrap align-items-center">
                   <div class="select-container select--container">
                       <select class="select-container-select" id="sortSelect">
                           <option value="all">Trier par</option>
                           <option value="newest">Plus récents</option>
                           <option value="oldest">Plus anciens</option>
                           <option value="price-high">Prix: décroissant</option>
                           <option value="price-low">Prix: croissant</option>
                       </select>
                   </div>
               </div>
           </div>
       </div>
        <div class="row">
           <!-- Sidebar -->
           <div class="col-lg-4">
               <div class="sidebar mb-5">
                   <!-- Search Box -->
                   <div class="card card-item">
                       <div class="card-body">
                           <h3 class="card-title fs-18 pb-2">Rechercher</h3>
                           <div class="divider"><span></span></div>
                           <div class="form-group mb-0">
                               <input class="form-control form--control" type="text" id="searchInput" placeholder="Rechercher des cours">
                               <span class="la la-search search-icon"></span>
                           </div>
                       </div>
                   </div>
                    <!-- Categories -->
                   <div class="card card-item">
                       <div class="card-body">
                           <h3 class="card-title fs-18 pb-2">Catégories</h3>
                           <div class="divider"><span></span></div>
                           <ul class="generic-list-item" id="categoryList">
                               <li class="category-item active" data-category="all">
                                   <a href="#">Toutes les catégories</a>
                               </li>
                               @foreach($categories as $cat)
                               <li class="category-item" data-category="{{ $cat->id }}">
                                   <a href="#">{{ $cat->category_name }}</a>
                               </li>
                               @endforeach
                           </ul>
                       </div>
                   </div>
                    <!-- Ratings -->
                   <div class="card card-item">
                       <div class="card-body">
                           <h3 class="card-title fs-18 pb-2">Avis</h3>
                           <div class="divider"><span></span></div>
                           @foreach([5,4,3,2,1] as $rating)
                           <div class="custom-control custom-radio mb-1 fs-15">
                               <input type="radio" class="custom-control-input" 
                                      id="rating{{ $rating }}" 
                                      name="rating" 
                                      value="{{ $rating }}">
                               <label class="custom-control-label" for="rating{{ $rating }}">
                                   <span class="rating-stars">
                                       @for($i = 1; $i <= 5; $i++)
                                           <i class="la la-star {{ $i <= $rating ? 'text-warning' : 'text-muted' }}"></i>
                                       @endfor
                                   </span>
                                   <span class="ml-1">{{ $rating }}.0 & plus</span>
                               </label>
                           </div>
                           @endforeach
                       </div>
                   </div>
                    <!-- Levels -->
                   <div class="card card-item">
                       <div class="card-body">
                           <h3 class="card-title fs-18 pb-2">Niveau</h3>
                           <div class="divider"><span></span></div>
                           @foreach(['all' => 'Tous les niveaux', 'beginner' => 'Débutant', 'intermediate' => 'Intermédiaire', 'advanced' => 'Expert'] as $key => $level)
                           <div class="custom-control custom-checkbox mb-1 fs-15">
                               <input type="radio" class="custom-control-input" 
                                      id="level{{ $key }}" 
                                      name="level" 
                                      value="{{ $key }}"
                                      {{ $key === 'all' ? 'checked' : '' }}>
                               <label class="custom-control-label" for="level{{ $key }}">
                                   {{ $level }}
                               </label>
                           </div>
                           @endforeach
                       </div>
                   </div>
               </div>
           </div>
            <!-- Course List -->
           <div class="col-lg-8">
               <div class="row" id="courseContainer">
                   @foreach($courses as $course)
                   <div class="col-lg-6 responsive-column-half">
                       <div class="card card-item">
                           <div class="card-image">
                               <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                                   <img src="{{ asset($course->course_image) }}" class="card-img-top" alt="{{ $course->course_name }}">
                               </a>
                               @php
                                   $discount = $course->discount_price 
                                       ? round(($course->selling_price - $course->discount_price) / $course->selling_price * 100) 
                                       : 0;
                               @endphp
                               <div class="course-badge-labels">
                                   @if($course->bestseller)
                                       <div class="course-badge">Bestseller</div>
                                   @endif
                                   @if($discount > 0)
                                       <div class="course-badge blue">-{{ $discount }}%</div>
                                   @endif
                               </div>
                           </div>
                           <div class="card-body">
                               <h5 class="card-title">
                                   <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                                       {{ $course->course_name }}
                                   </a>
                               </h5>
                               <p class="card-text">{{ $course->user->name }}</p>
                               <div class="rating-wrap d-flex align-items-center py-2">
                                   @php
                                       $rating = $course->reviews->avg('rating') ?? 0;
                                       $reviewCount = $course->reviews->count();
                                   @endphp
                                   <div class="review-stars">
                                       @for($i = 1; $i <= 5; $i++)
                                           <i class="la la-star {{ $i <= $rating ? 'text-warning' : 'text-muted' }}"></i>
                                       @endfor
                                   </div>
                                   <span class="rating-total ml-1">({{ $reviewCount }})</span>
                               </div>
                               <div class="d-flex justify-content-between align-items-center">
                                   <div class="price">
                                       @if($course->discount_price)
                                           <span class="new-price">{{ $course->discount_price }} DH</span>
                                           <span class="old-price">{{ $course->selling_price }} DH</span>
                                       @else
                                           <span class="new-price">{{ $course->selling_price }} DH</span>
                                       @endif
                                   </div>
                                   <div class="action-buttons">
                                       <button class="btn-cart" 
                                               onclick="addToCart({{ $course->id }}, '{{ $course->course_name }}', {{ $course->instructor_id }}, '{{ $course->course_name_slug }}')">
                                           <i class="la la-shopping-cart"></i>
                                       </button>
                                       <button class="btn-wishlist" 
                                               onclick="addToWishList({{ $course->id }})">
                                           <i class="la la-heart-o"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   @endforeach
               </div>
                <!-- Pagination -->
               <div class="text-center pt-3">
                   {{ $courses->links('vendor.pagination.custom') }}
               </div>
           </div>
       </div>
   </div>
/section>
@endsection
@section('scripts')
script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
script>
(document).ready(function() {
   let currentFilters = {
       search: '',
       category: 'all',
       rating: 'all',
       level: 'all',
       sort: 'all'
   };
    // Fonction pour mettre à jour les cours
   function updateCourses() {
       $.ajax({
           url: '{{ route("filter.courses") }}',
           method: 'POST',
           data: {
               _token: '{{ csrf_token() }}',
               ...currentFilters
           },
           beforeSend: function() {
               $('#courseContainer').addClass('loading');
           },
           success: function(response) {
               $('#courseContainer').html(response.html);
               $('#courseCount').html(`Nous avons trouvé <span class="text-black">${response.count}</span> cours disponibles pour vous`);
           },
           complete: function() {
               $('#courseContainer').removeClass('loading');
           }
       });
   }
    // Gestionnaire de recherche
   let searchTimeout;
   $('#searchInput').on('input', function() {
       clearTimeout(searchTimeout);
       searchTimeout = setTimeout(() => {
           currentFilters.search = $(this).val();
           updateCourses();
       }, 500);
   });
    // Gestionnaire de catégories
   $('.category-item').click(function(e) {
       e.preventDefault();
       $('.category-item').removeClass('active');
       $(this).addClass('active');
       currentFilters.category = $(this).data('category');
       updateCourses();
   });
    // Gestionnaire de notes
   $('input[name="rating"]').change(function() {
       currentFilters.rating = $(this).val();
       updateCourses();
   });
    // Gestionnaire de niveaux
   $('input[name="level"]').change(function() {
       currentFilters.level = $(this).val();
       updateCourses();
   });
    // Gestionnaire de tri
   $('#sortSelect').change(function() {
       currentFilters.sort = $(this).val();
       updateCourses();
   });
    // Fonctions pour le panier et la liste de souhaits
   window.addToCart = function(courseId, courseName, instructorId, courseSlug) {
       $.ajax({
           url: '{{ route("add.to.cart") }}',
           method: 'POST',
           data: {
               _token: '{{ csrf_token() }}',
               course_id: courseId,
               course_name: courseName,
               instructor_id: instructorId,
               course_name_slug: courseSlug
           },
           success: function(response) {
               toastr.success(response.message);
               updateCartCount();
           }
       });
   };
    window.addToWishList = function(courseId) {
       $.ajax({
           url: '{{ route("add.to.wishlist") }}',
           method: 'POST',
           data: {
               _token: '{{ csrf_token() }}',
               course_id: courseId
           },
           success: function(response) {
               if (response.success) {
                   toastr.success(response.message);
                   updateWishlistCount();
               } else {
                   toastr.error(response.message);
               }
           }
       });
   };
    // Fonctions utilitaires
   function updateCartCount() {
       $.get('{{ route("cart.count") }}', function(response) {
           $('.cart-count').text(response);
       });
   }
    function updateWishlistCount() {
       $.get('{{ route("wishlist.count") }}', function(response) {
           $('.wishlist-count').text(response);
       });
   }
);
/script>
@endsection