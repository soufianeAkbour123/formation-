@extends('frontend.master')
@section('home')

<style>
    .card {
        height: 510px;
        display: flex;   flex-direction: column;
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
    .course-badge-labels {
       position: absolute;
       top: 10px;
       left: 10px;
       z-index: 1;
   }
    .course-badge {
       background-color: #ff4d4d;
       color: white;
       padding: 4px 8px;
       border-radius: 3px;
       margin-bottom: 5px;
       display: inline-block;
   }
    .course-badge.blue {
       background-color: #007bff;
   }
    .price {
       font-size: 1.1em;
   }
    .new-price {
       color: #28a745;
       font-weight: bold;
   }
    .old-price {
       text-decoration: line-through;
       color: #6c757d;
       margin-left: 8px;
   }
    .action-buttons {
       display: flex;
       gap: 10px;
   }
    .btn-cart, .btn-wishlist {
       border: none;
       background: none;
       padding: 5px;
       cursor: pointer;
       transition: all 0.3s ease;
   }
    .btn-cart:hover, .btn-wishlist:hover {
       transform: scale(1.1);
   }
    .rating-wrap {
       margin: 10px 0;
   }
    .review-stars {
       color: #ffc107;
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
               <p class="fs-14" id="courseCount">
                   Nous avons trouvé <span class="text-black">{{ count($courses) }}</span> cours disponibles pour vous
               </p>
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