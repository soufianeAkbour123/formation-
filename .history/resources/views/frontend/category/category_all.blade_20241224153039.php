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
<div class="col-lg-4 responsive-column-half">
    <div class="card card-item card-preview">
        <div class="card-image">
            <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                <img class="card-img-top" src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
            </a>
            
            @php
                $amount = $course->selling_price - $course->discount_price;
                $discount = ($amount/$course->selling_price) * 100;
                $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->count();
                $avarage = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');
            @endphp

            <div class="course-badge-labels">
                @if ($course->bestseller == 1)
                    <div class="course-badge">Meilleure Vente</div>
                @endif
                @if ($course->highestrated == 1)
                    <div class="course-badge sky-blue">Le Mieux Noté</div>
                @endif
                @if ($course->discount_price == NULL)
                    <div class="course-badge blue">Nouveau</div>
                @else
                    <div class="course-badge blue">{{ round($discount) }}%</div>
                @endif
            </div>
        </div>

        <div class="card-body">
            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                @if ($course->label == 'Begginer')
                    Débutant
                @elseif ($course->label == 'Middle')
                    Intermédiaire
                @elseif ($course->label == 'Advance')
                    Avancé
                @else
                    {{ $course->label }}
                @endif
            </h6>

            <h5 class="card-title">
                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a>
            </h5>

            <p class="card-text">
                <a href="{{ route('instructor.details', $course->instructor_id) }}" class="instructor-link">
                    <i class="la la-user mr-1"></i>{{ $course['user']['name'] }}
                </a>
            </p>

            <div class="rating-wrap d-flex align-items-center py-2">
                <div class="review-stars">
                    <span class="rating-number">{{ number_format($avarage, 1) }}</span>
                    @for($i = 1; $i <= 5; $i++)
                        @if ($i <= $avarage)
                            <span class="la la-star"></span>
                        @else
                            <span class="la la-star-o"></span>
                        @endif
                    @endfor
                </div>
                <span class="rating-total pl-1">({{ $reviewcount }})</span>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                @if ($course->discount_price == NULL)
                    <p class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH</p>
                @else
                    <p class="card-price text-black font-weight-bold">
                        {{ $course->discount_price }} DH 
                        <span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span>
                    </p>
                @endif

                <div class="d-flex align-items-center">
                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" 
                       class="icon-element icon-element-sm mr-2" 
                       title="Voir les détails">
                        <i class="la la-eye"></i>
                    </a>

                    <div class="icon-element icon-element-sm mr-2"
                         onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')"
                         title="Ajouter au panier">
                        <i class="la la-shopping-cart"></i>
                    </div>

                    <div class="icon-element icon-element-sm wishlist-icon {{ $course->wishlist ? 'active' : '' }}"
                         id="wishlist_{{ $course->id }}"
                         onclick="addToWishList(this.id)"
                         title="Ajouter aux favoris">
                        <i class="la {{ $course->wishlist ? 'la-heart' : 'la-heart-o' }}"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.card {
    height: 510px;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.instructor-link {
    color: #555;
    transition: color 0.3s;
}

.instructor-link:hover {
    color: #007bff;
}

.icon-element {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #f5f5f5;
    cursor: pointer;
    transition: all 0.3s;
}

.icon-element:hover {
    background: #007bff;
    color: white;
}

.icon-element.active {
    background: #28a745;
    color: white;
}

.rating-wrap .la-star {
    color: #ffa808;
}

.rating-wrap .la-star-o {
    color: #ddd;
}

@media (max-width: 767px) {
    .card {
        height: auto;
        min-height: 450px;
    }
}
</style>

<script>
function addToCart(courseId, courseName, instructorId, courseSlug) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        data: {
            course_id: courseId,
            course_name: courseName,
            instructor_id: instructorId,
            course_slug: courseSlug
        },
        url: "/cart/add",
        success: function(data) {
            miniCart();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: 'Cours ajouté au panier'
            });
        }
    });
}

function addToWishList(courseId) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/add-to-wishlist/" + courseId,
        success: function(data) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            if (data.success) {
                $('#wishlist_' + courseId).toggleClass('active');
                $('#wishlist_' + courseId + ' i').toggleClass('la-heart-o la-heart');
                Toast.fire({
                    icon: 'success',
                    title: data.message
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Veuillez vous connecter d\'abord'
                });
            }
        }
    });
}
</script>

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
<style>
    
    </style>








