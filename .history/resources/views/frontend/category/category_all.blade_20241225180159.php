@extends('frontend.master')
@section('home')
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">{{ $category->category_name }}</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Home</a></li>
                <li>{{ $category->category_name }}</li> 
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE AREA
======================================-->
<section class="course-area section--padding">
    <div class="container">
        <div class="filter-bar mb-4">
            <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                <p class="fs-14">Nous avons trouvé <span class="text-black">{{ count($courses) }}</span> cours disponibles pour vous</p>
                <div class="d-flex flex-wrap align-items-center">
                    <ul class="filter-nav mr-3">
                        <li><a href="course-grid.html" data-toggle="tooltip" data-placement="top" title="Grid View" class="active"><span class="la la-th-large"></span></a></li>
                        <li><a href="course-list.html" data-toggle="tooltip" data-placement="top" title="List View"><span class="la la-list"></span></a></li>
                    </ul>
                    <div class="select-container select--container">
                        <select class="select-container-select">
                            <option value="all-category">All Category</option>
                            <option value="newest">Newest courses</option>
                            <option value="oldest">Oldest courses</option>
                            <option value="high-rated">Highest rated</option>
                            <option value="popular-courses">Popular courses</option>
                            <option value="high-to-low">Price: high to low</option>
                            <option value="low-to-high">Price: low to high</option>
                        </select>
                    </div>
                </div>
            </div><!-- end filter-bar-inner -->
        </div><!-- end filter-bar -->
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar mb-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2"></h3>
                            <div class="divider"><span></span></div>
                            <form method="post">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search courses">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card -->
                    
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Catégories de cours</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                               @foreach ($categories as $cat)
                                <li><a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}</a></li> 
                               @endforeach 
                                
                            </ul>
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Avis</h3>
                            <div class="divider"><span></span></div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="fiveStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="fiveStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                         <span class="review-stars">
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                         </span>
                                       <span class="rating-total pl-1"><span class="mr-1 text-black">5.0</span>(350)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="fourStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="fourStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                         <span class="review-stars">
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                         </span>
                                       <span class="rating-total pl-1"><span class="mr-1 text-black">4.5 & up</span>(10,230)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="threeStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="threeStarRating">
                                    <span class="rating-wrap d-flex align-items-center">
                                        <span class="review-stars">
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                        </span>
                                        <span class="rating-total pl-1"><span class="mr-1 text-black">3.0 & up</span>(7,230)</span>
                                    </span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="twoStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="twoStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                       <span class="review-stars">
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                       </span>
                                       <span class="rating-total pl-1"><span class="mr-1 text-black">2.0 & up</span>(5,230)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input" id="oneStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="oneStarRating">
                                    <span class="rating-wrap d-flex align-items-center">
                                        <span class="review-stars">
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                        </span>
                                        <span class="rating-total pl-1"><span class="mr-1 text-black">1.0 & up</span>(3,230)</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div><!-- end card -->
                   
                    
                    <div class="card card-item">
    <div class="card-body">
        <h3 class="card-title fs-18 pb-2">Niveau</h3>
        <div class="divider"><span></span></div>
        <div class="custom-control custom-checkbox mb-1 fs-15">
            <input type="checkbox" class="custom-control-input" id="levelCheckbox" required>
            <label class="custom-control-label custom--control-label text-black" for="levelCheckbox">
                Tous les niveaux<span class="ml-1 text-gray">(20)</span>
            </label>
        </div><!-- end custom-control -->
        <div class="custom-control custom-checkbox mb-1 fs-15">
            <input type="checkbox" class="custom-control-input" id="levelCheckbox2" required>
            <label class="custom-control-label custom--control-label text-black" for="levelCheckbox2">
                Débutant<span class="ml-1 text-gray">(22)</span>
            </label>
        </div><!-- end custom-control -->
        <div class="custom-control custom-checkbox mb-1 fs-15">
            <input type="checkbox" class="custom-control-input" id="levelCheckbox3" required>
            <label class="custom-control-label custom--control-label text-black" for="levelCheckbox3">
                Intermédiaire<span class="ml-1 text-gray">(15)</span>
            </label>
        </div><!-- end custom-control -->
        <div class="custom-control custom-checkbox mb-1 fs-15">
            <input type="checkbox" class="custom-control-input" id="levelCheckbox4" required>
            <label class="custom-control-label custom--control-label text-black" for="levelCheckbox4">
                Expert<span class="ml-1 text-gray">(10)</span>
            </label>
        </div><!-- end custom-control -->
    </div>
</div><!-- end card -->

                   
                  
                    
                    
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-8">
                <div class="row">
                   
                   
                @foreach ($courses as $course) 

<div class="col-lg-4 responsive-column-half position-relative">
<div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1{{ $course->id }}">
      <div class="card-image">
      <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
              <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="images/img8.jpg" alt="Card image cap">
          </a>


@php
  $amount = $course->selling_price - $course->discount_price;
  $discount = ($amount/$course->selling_price) * 100;
@endphp

          <div class="course-badge-labels">

              @if ($course->bestseller == 1)
              <div class="course-badge">Meilleure Vente</div>
              @else
              @endif

              @if ($course->highestrated == 1)
              <div class="course-badge sky-blue">Le Mieux Noté</div>
              @else
              @endif

              @if ($course->discount_price == NULL)
              <div class="course-badge blue">Nouveau</div>
              @else
              <div class="course-badge blue">{{ round($discount) }}%</div>
              @endif



          </div>
      </div><!-- end card-image -->
      @php
      $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->get();
      $avarage = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');

  @endphp   

      <div class="card-body">
          <h6 class="ribbon ribbon-blue-bg fs-14 mb-3"> @if ($course->label == 'Begginer')
  Débutant
@elseif ($course->label == 'Middle')
  Intermédiaire
@elseif ($course->label == 'Advance')
  Avancé
@else
  {{ $course->label }}
@endif</h6>
          
          <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
          <p class="card-text"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
          <div class="rating-wrap d-flex align-items-center py-2">
              <div class="review-stars">
                        <span class="rating-number">{{ round($avarage,1) }}</span>
                  @if ($avarage == 0)
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      @elseif ($avarage == 1 || $avarage < 2)
                      <span class="la la-star"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      @elseif ($avarage == 2 || $avarage < 3)
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      @elseif ($avarage == 3 || $avarage < 4)
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star-o"></span>
                      <span class="la la-star-o"></span>
                      @elseif ($avarage == 4 || $avarage < 5)
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star-o"></span>
                      @elseif ($avarage == 5 || $avarage < 5)
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      <span class="la la-star"></span>
                      @endif 
              </div>
              <span class="rating-total pl-1">({{ count($reviewcount) }})</span>
          </div><!-- end rating-wrap -->
          <div class="d-flex justify-content-between align-items-center">
@if ($course->discount_price == NULL)
<p class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH</p>
@else
<p class="card-price text-black font-weight-bold">{{ $course->discount_price }} DH <span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span></p> 
@endif

<div class="d-flex align-items-center">
  <!-- Icon to view course details -->
  <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" 
     class="icon-element icon-element-sm shadow-sm mr-2 cursor-pointer" 
     title="Voir les détails du cours">
      <i class="la la-eye"></i>
  </a>

  <!-- Icon to add to cart -->
  <div class="icon-element icon-element-sm shadow-sm cursor-pointer" 
       title="Ajouter au panier"
       onclick="addToCart({{$course->id}} , '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')">
      <i class="la la-shopping-cart"></i>
  </div>

  <!-- Existing wishlist icon -->
  <div class="icon-element icon-element-sm shadow-sm ml-2 cursor-pointer" 
       title="Ajouter aux favoris" 
       id="{{ $course->id }}" 
       onclick="addToWishList(this.id)">
      <i class="la la-heart-o"></i>
  </div>
</div>
        </div>
    </div>
</div>
@endforeach
                    
                </div><!-- end row -->
               <!-- Boucle pour afficher les cours -->  
@foreach($courses as $course)  
    <!-- Affichez chaque cours comme vous le souhaitez ici -->  
    <div class="course-item">  
        <h3>{{ $course->title }}</h3>  
        <!-- Autres détails sur le cours -->  
    </div>  
@endforeach  

<!-- Pagination -->  
<div class="text-center pt-3">  
    <nav aria-label="Page navigation example" class="pagination-box">  
        <ul class="pagination justify-content-center">  
            
            {{ $courses->links('vendor.pagination.custom') }} <!-- Cela générera les liens de pagination automatiquement -->  
        </ul>  
    </nav>  
    <p class="fs-14 pt-2">Showing {{ $courses->firstItem() }}-{{ $courses->lastItem() }} of {{ $courses->total() }} results</p>  
</div>
            </div><!-- end col-lg-8 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================--> 


<!-- Style -->
<style>
/* Card Styling */
.card-item {
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 12px;
    transition: all 0.3s ease;
    height: 100%;
    background: #fff;
    margin-bottom: 20px;
}

.card-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

/* Image Container */
.card-image {
    position: relative;
    border-radius: 12px 12px 0 0;
    overflow: hidden;
    padding-top: 66.67%; /* 3:2 Aspect Ratio */
}

.card-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.card-image:hover img {
    transform: scale(1.05);
}

/* Badge Styling */
.course-badge-labels {
    position: absolute;
    top: 12px;
    left: 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 1;
}

.course-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    background: rgba(255,255,255,0.95);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.course-badge.sky-blue {
    background: rgba(100,181,246,0.95);
    color: #fff;
}

.course-badge.blue {
    background: rgba(33,150,243,0.95);
    color: #fff;
}

/* Card Body */
.card-body {
    padding: 20px;
}

.card-title {
    font-size: 16px;
    line-height: 1.4;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-title a {
    color: #2c3e50;
    text-decoration: none;
}

/* Rating System */
.rating-wrap {
    margin: 12px 0;
}

.review-stars {
    color: #ffc107;
    font-size: 14px;
}

.rating-number {
    font-weight: 600;
    margin-right: 5px;
}

/* Price Section */
.card-price {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
}

.before-price {
    text-decoration: line-through;
    color: #999;
    font-size: 14px;
    margin-left: 8px;
}

/* Action Buttons */
.icon-element {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #f8f9fa;
    cursor: pointer;
    transition: all 0.2s ease;
}

.icon-element:hover {
    background: #2196f3;
    color: #fff;
}

/* Responsive Grid */
@media (min-width: 1200px) {
    .responsive-column-half {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

@media (min-width: 768px) and (max-width: 1199px) {
    .responsive-column-half {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 767px) {
    .responsive-column-half {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .card-body {
        padding: 15px;
    }
    
    .course-badge {
        padding: 4px 8px;
        font-size: 11px;
    }
    
    .card-title {
        font-size: 15px;
    }
}

/* Sidebar Improvements */
.sidebar .card {
    margin-bottom: 20px;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.08);
}

.sidebar .card-body {
    padding: 20px;
}

.form--control {
    height: 45px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    padding-left: 40px;
}

.search-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

/* Filter Bar */
.filter-bar {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 30px;
}

.filter-bar-inner {
    gap: 15px;
}

.select-container-select {
    height: 40px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    padding: 0 15px;
    background: #fff;
}

/* Custom Checkbox and Radio */
.custom-control {
    padding-left: 30px;
    margin-bottom: 10px;
}

.custom-control-label {
    cursor: pointer;
}

.custom-control-label::before {
    border-radius: 4px;
    border: 1px solid #dee2e6;
}

/* Pagination */
.pagination {
    gap: 5px;
}

.pagination .page-link {
    border-radius: 8px;
    border: none;
    padding: 8px 16px;
    color: #2c3e50;
    background: #f8f9fa;
}

.pagination .page-item.active .page-link {
    background: #2196f3;
    color: #fff;
}
</style>







