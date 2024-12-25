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
                               <li>
                                   <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}" 
                                      class="d-flex justify-content-between align-items-center category-link 
                                             {{ request()->segment(2) == $cat->id ? 'active-category' : '' }}">
                                       {{ $cat->category_name }}
                                       
                                   </a>
                               </li>
                               @endforeach
                               
                                
                            </ul>
                        </div>
                    </div><!-- end card -->
                   <div class="card-body">
    <h3 class="card-title fs-18 pb-2">Avis</h3>
    <div class="divider"><span></span></div>
    @foreach([5,4,3,2,1] as $rating)
    <div class="custom-control custom-radio mb-1 fs-15">
        <input type="radio" class="custom-control-input rating-filter" 
               id="star{{$rating}}" name="rating" value="{{$rating}}"
               {{ request()->rating == $rating ? 'checked' : '' }}>
        <label class="custom-control-label" for="star{{$rating}}">
            <span class="rating-wrap d-flex align-items-center">
                <span class="review-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="la la-star{{ $i <= $rating ? '' : '-o' }}"></span>
                    @endfor
                </span>
                <span class="rating-total pl-1">
                    <span class="mr-1 text-black">{{$rating}}.0 & up</span>
                    ({{ App\Models\Review::where('rating', '>=', $rating)->count() }})
                </span>
            </span>
        </label>
    </div>
    @endforeach
</div>
                   
                    
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

<div class="col-lg-6 responsive-column-half position-relative">
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
    active-category {
   background-color: #f8f9fa;
   color: #007bff !important;
   font-weight: bold;

.category-link {
   color: #333;
   padding: 8px 12px;
   text-decoration: none;
   transition: all 0.3s ease;
   border-radius: 4px;

.category-link:hover {
   background-color: #f8f9fa;
   text-decoration: none;
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Active Category
    const categoryLinks = document.querySelectorAll('.course-category');
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            categoryLinks.forEach(l => l.classList.remove('active-category'));
            this.classList.add('active-category');
            filterCourses();
        });
    });

    // Ratings Filter
    const ratingInputs = document.querySelectorAll('input[name="radio-stacked"]');
    ratingInputs.forEach(input => {
        input.addEventListener('change', filterCourses);
    });

    // Level Filter
    const levelInputs = document.querySelectorAll('input[type="checkbox"]');
    levelInputs.forEach(input => {
        input.addEventListener('change', filterCourses);
    });

    // Search
    let timeout = null;
    const searchInput = document.querySelector('input[name="search"]');
    searchInput.addEventListener('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(filterCourses, 500);
    });

    function filterCourses() {
        const formData = {
            category_id: document.querySelector('.active-category')?.dataset.categoryId,
            rating: document.querySelector('input[name="radio-stacked"]:checked')?.value,
            levels: Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(cb => cb.value),
            search: searchInput.value
        };

        fetch('/filter-courses', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => updateCoursesList(data));
    }

    function updateCoursesList(courses) {
        const courseContainer = document.querySelector('.course-container');
        // Implement your course list update logic here
    }
});
</script>

// CSS
<style>
.active-category {
    background-color: #f8f9fa;
    font-weight: bold;
    color: #007bff;
}

.course-category {
    transition: all 0.3s ease;
}

.course-category:hover {
    background-color: #f8f9fa;
}
</style>
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

/* Mobile styles for course cards */
@media (max-width: 767px) {
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

/* Tablet styles for course cards */
@media (min-width: 768px) and (max-width: 1199px) {
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

/* Maintain wishlist icon styling */
.icon-element.active {
  background-color: green;
  color: white;
}


</STYle>







