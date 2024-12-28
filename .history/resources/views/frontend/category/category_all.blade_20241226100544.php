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
            <div class="col-lg-3">
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
                            <!-- [Other rating options remain the same] -->
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
                            <!-- [Other level options remain the same] -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end sidebar -->
            </div><!-- end col-lg-3 -->
            
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card card-course">
                            <div class="card-image">
                                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                                    <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" alt="Card image cap">
                                </a>
                                @php
                                    $amount = $course->selling_price - $course->discount_price;
                                    $discount = ($amount/$course->selling_price) * 100;
                                @endphp
                                <div class="course-badge-labels">
                                    @if ($course->bestseller == 1)
                                        <div class="course-badge">Bestseller</div>
                                    @elseif ($course->discount_price == NULL)
                                        <div class="course-badge blue">New</div>
                                    @else
                                        <div class="course-badge blue">{{ round($discount) }}%</div>
                                    @endif
                                </div>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                                <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                                <p class="card-text"><a href="">{{ $course['user']['name'] }}</a></p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span class="rating-number">4.4</span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                    </div>
                                    <span class="rating-total pl-1">(350)</span>
                                </div><!-- end rating-wrap -->
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($course->discount_price == NULL)
                                        <p class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH</p>
                                    @else
                                        <p class="card-price text-black font-weight-bold">{{ $course->discount_price }} DH <span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span></p>
                                    @endif
                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-4 -->
                    @endforeach
                </div><!-- end row -->

                <!-- Pagination -->
                <div class="text-center pt-3">
                    <nav aria-label="Page navigation example" class="pagination-box">
                        <ul class="pagination justify-content-center">
                            {{ $courses->links('vendor.pagination.custom') }}
                        </ul>
                    </nav>
                    <p class="fs-14 pt-2">Showing {{ $courses->firstItem() }}-{{ $courses->lastItem() }} of {{ $courses->total() }} results</p>
                </div>
            </div><!-- end col-lg-9 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->

<style>
.card-course {
    height: 510px;
    display: flex;
    flex-direction: column;
    margin-bottom: 30px;
}

.card-body {
    flex-grow: 1;
}

.card-title a {
    color: #0D6EFD;
    text-decoration: none;
}

.card-title a:hover {
    color: #0b5ed7;
}

.ribbon.ribbon-blue-bg {
    background-color: #e7f3ff;
    color: #0D6EFD;
    padding: 5px 15px;
    border-radius: 3px;
}

.card-text a {
    color: #0D6EFD;
    text-decoration: none;
}

.card-text a:hover {
    color: #0b5ed7;
}

/* Mobile */
@media (max-width: 767px) {
    .col-lg-4 {
        width: 100%;
    }
    .card-course {
        height: auto;
    }
}

/* Tablette */
@media (min-width: 768px) and (max-width: 991px) {
    .col-lg-4 {
        width: 50%;
    }
    .card-course {
        height: 500px;
    }
}

/* Desktop */
@media (min-width: 992px) {
    .col-lg-3 {
        width: 25%;
    }
    .col-lg-9 {
        width: 75%;
    }
    .col-lg-4 {
        width: 33.333333%;
    }
}

.icon-element.active {
    background-color: green;
    color: white;
}

</style>
<style>
    .active-category {
   background-color: #f8f9fa;
   color: #007bff !important;
   font-weight: bold;
    }
.category-link {
   color: #333;
   padding: 8px 12px;
   text-decoration: none;
   transition: all 0.3s ease;
   border-radius: 4px;
}
.category-link:hover {
   background-color: #f8f9fa;
   text-decoration: none;
}
.count {
   background-color: #f1f1f1;
   padding: 2px 8px;
   border-radius: 12px;
   font-size: 12px;
}
.custom-control-input:checked ~ .custom-control-label::before {
   border-color: #007bff;
   background-color: #007bff;
}
.rating-wrap .la-star {
   color: #ffd700;
}
.rating-wrap .la-star-o {
   color: #ddd;
}
</style>