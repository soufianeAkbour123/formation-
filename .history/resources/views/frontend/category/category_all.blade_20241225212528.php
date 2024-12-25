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
                            @foreach ($categories->sortBy('category_name') as $cat)
<li>
    <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}" class="d-flex justify-content-between align-items-center category-link {{ request()->segment(2) == $cat->id ? 'active-category' : '' }}">
        {{ $cat->category_name }}
    </a>
</li>
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
                   
                   
                html

Copier
<div class="row course-grid">
    @foreach ($courses as $course)
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="course-card">
            <div class="course-image">
                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                    <img class="img-fluid" src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
                </a>

                @php
                    $amount = $course->selling_price - $course->discount_price;
                    $discount = ($amount/$course->selling_price) * 100;
                @endphp

                <div class="course-badges">
                    @if ($course->bestseller == 1)
                        <span class="badge badge-bestseller">Meilleure Vente</span>
                    @endif

                    @if ($course->highestrated == 1)
                        <span class="badge badge-rated">Le Mieux Noté</span>
                    @endif

                    @if ($course->discount_price == NULL)
                        <span class="badge badge-new">Nouveau</span>
                    @else
                        <span class="badge badge-discount">{{ round($discount) }}%</span>
                    @endif
                </div>
            </div>

            <div class="course-content">
                <div class="course-level">
                    <span class="level-badge">
                        @if ($course->label == 'Begginer')
                            Débutant
                        @elseif ($course->label == 'Middle')
                            Intermédiaire
                        @elseif ($course->label == 'Advance')
                            Avancé
                        @else
                            {{ $course->label }}
                        @endif
                    </span>
                </div>

                <h5 class="course-title">
                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                        {{ $course->course_name }}
                    </a>
                </h5>

                <div class="course-instructor">
                    <a href="{{ route('instructor.details',$course->instructor_id) }}">
                        {{ $course['user']['name'] }}
                    </a>
                </div>

                <div class="course-rating">
                    <span class="rating-number">{{ round($avarage,1) }}</span>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $avarage)
                                <i class="la la-star"></i>
                            @else
                                <i class="la la-star-o"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="rating-count">({{ count($reviewcount) }})</span>
                </div>

                <div class="course-footer">
                    <div class="course-price">
                        @if ($course->discount_price == NULL)
                            <span class="price">{{ $course->selling_price }} DH</span>
                        @else
                            <span class="price">{{ $course->discount_price }} DH</span>
                            <span class="original-price">{{ $course->selling_price }} DH</span>
                        @endif
                    </div>

                    <div class="course-actions">
                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" 
                           class="action-btn" title="Voir les détails">
                            <i class="la la-eye"></i>
                        </a>
                        <button class="action-btn" 
                                onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')"
                                title="Ajouter au panier">
                            <i class="la la-shopping-cart"></i>
                        </button>
                        <button class="action-btn" 
                                id="{{ $course->id }}" 
                                onclick="addToWishList(this.id)"
                                title="Ajouter aux favoris">
                            <i class="la la-heart-o"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
.course-grid {
    margin: 0 -15px;
}

.course-card {
    height: 100%;
    border: 1px solid #e5e5e5;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

.course-image {
    position: relative;
    padding-top: 56.25%;
}

.course-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.course-badges {
    position: absolute;
    top: 10px;
    left: 10px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.badge {
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.badge-bestseller { background: #ff9800; color: white; }
.badge-rated { background: #4CAF50; color: white; }
.badge-new { background: #2196F3; color: white; }
.badge-discount { background: #f44336; color: white; }

.course-content {
    padding: 15px;
}

.course-level {
    margin-bottom: 10px;
}

.level-badge {
    background: #e3f2fd;
    color: #1976d2;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.course-title {
    font-size: 16px;
    margin: 10px 0;
    line-height: 1.4;
}

.course-title a {
    color: #333;
    text-decoration: none;
}

.course-instructor {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.course-rating {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 15px;
}

.rating-stars {
    color: #ffc107;
}

.course-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid #e5e5e5;
}

.course-price .price {
    font-size: 18px;
    font-weight: 600;
    color: #2196F3;
}

.course-price .original-price {
    text-decoration: line-through;
    color: #999;
    font-size: 14px;
    margin-left: 5px;
}

.course-actions {
    display: flex;
    gap: 8px;
}

.action-btn {
    width: 32px;
    height: 32px;
    border: none;
    background: #f5f5f5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.action-btn:hover {
    background: #2196F3;
    color: white;
}

@media (max-width: 991px) {
    .col-lg-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 767px) {
    .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .course-title {
        font-size: 14px;
    }

    .course-price .price {
        font-size: 16px;
    }
}
</style>
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







