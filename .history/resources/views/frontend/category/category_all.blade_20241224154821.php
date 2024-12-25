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



<style>
.cart-icon-wrapper {
background-color: #f0f0f0;
border-radius: 50%;
width: 40px;
height: 40px;
display: flex;
align-items: center;
justify-content: center;
transition: all 0.3s ease;
}
.cart-icon {
color: #333;
font-size: 20px;
cursor: pointer;
}
.cart-icon-wrapper:hover {
background-color: #007bff;
color: white;
}
.cart-icon-wrapper:hover .cart-icon {
color: white;
}
</style>



              
              
              <style>
.la-heart {
color: #28a745; /* couleur verte */
}

.la-heart-o {
color: initial; /* couleur par défaut */
}
</style>
          </div>
      </div><!-- end card-body -->
  </div><!-- end card -->
</div><!-- end col-lg-4 -->
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
<STYle>
/* Target only course cards */
.course-area .col-lg-6 .card {
  height: 510px;
  display: flex;
  flex-direction: column;
}

.course-area .col-lg-6 .card-body {
  flex-grow: 1;
}

/* Base card styles */
.card-preview {
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease;
  margin-bottom: 25px;
}

.card-preview:hover {
  transform: translateY(-5px);
}

.card-image {
  position: relative;
  padding-top: 56.25%;
  overflow: hidden;
}

.card-image img {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card-body {
  flex: 1;
  display: flex;
  flex-direction: column;
}

/* Responsive grid */
@media (max-width: 767px) {
  .responsive-column-half {
    width: 100%;
    margin-bottom: 1.5rem;
  }
  
  .card-preview {
    max-width: 100%;
  }

  .course-area .col-lg-6 .card {
    flex-direction: column;
    height: auto;
  }
  
  .course-area .col-lg-6 .card-body {
    padding: 16px;
  }
  
  .course-area .col-lg-6 .card-title {
    font-size: 18px;
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .responsive-column-half {
    width: 50%;
  }
  
  .card-preview {
    margin: 0.75rem;
  }

  .course-area .col-lg-6 .card {
    height: 500px;
  }
  
  .course-area .col-lg-6 .card-body {
    padding: 20px;
  }
  
  .course-area .col-lg-6 .card-title {
    font-size: 20px;
  }
}

/* Course badge and price layout */
.course-badge-labels {
  position: absolute;
  top: 0.75rem;
  left: 0.75rem;
  z-index: 1;
}

.course-badge {
  margin-bottom: 0.5rem;
  padding: 0.25rem 0.75rem;
  border-radius: 3px;
}

/* Action buttons container */
.d-flex.align-items-center {
  gap: 0.5rem;
}

.icon-element {
  width: 2rem;
  height: 2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  transition: all 0.2s ease;
}

.icon-element:hover {
  background-color: #007bff;
  color: white;
}

/* Wishlist icon */
.icon-element.active {
  background-color: green;
  color: white;
}

/* Cart icon styling */
.cart-icon-wrapper {
  background-color: #f0f0f0;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.cart-icon {
  color: #333;
  font-size: 20px;
  cursor: pointer;
}

.cart-icon-wrapper:hover {
  background-color: #007bff;
  color: white;
}

.cart-icon-wrapper:hover .cart-icon {
  color: white;
}

/* Heart icon colors */
.la-heart {
  color: #28a745;
}

.la-heart-o {
  color: initial;
}
</STYle>







