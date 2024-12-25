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
    <div class="card card-item card-preview hover-shadow" data-tooltip-content="#tooltip_content_1{{ $course->id }}">
        <div class="card-image position-relative">
            <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                <img class="card-img-top" src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
            </a>

            @php
                $amount = $course->selling_price - $course->discount_price;
                $discount = ($amount/$course->selling_price) * 100;
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

        <div class="card-body p-4">
            <div class="level-badge mb-3">
                <span class="badge bg-primary-soft">
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

            <h5 class="card-title mb-2">
                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="text-decoration-none">
                    {{ Str::limit($course->course_name, 50) }}
                </a>
            </h5>

            <p class="instructor-name mb-3">
                <a href="{{ route('instructor.details',$course->instructor_id) }}" class="text-muted">
                    <i class="la la-user-circle mr-1"></i>{{ $course['user']['name'] }}
                </a>
            </p>

            <div class="rating-wrap d-flex align-items-center mb-3">
                <div class="review-stars">
                    <span class="rating-number mr-2">{{ number_format($avarage, 1) }}</span>
                    @for($i = 1; $i <= 5; $i++)
                        <i class="la {{ $i <= $avarage ? 'la-star' : 'la-star-o' }}"></i>
                    @endfor
                </div>
                <span class="rating-total ml-2">({{ count($reviewcount) }})</span>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center mt-auto border-0 p-0">
                <div class="course-price">
                    @if ($course->discount_price == NULL)
                        <span class="current-price">{{ $course->selling_price }} DH</span>
                    @else
                        <span class="current-price">{{ $course->discount_price }} DH</span>
                        <span class="old-price">{{ $course->selling_price }} DH</span>
                    @endif
                </div>

                <div class="action-buttons d-flex gap-2">
                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" 
                       class="btn-action" title="Voir les détails">
                        <i class="la la-eye"></i>
                    </a>
                    <button class="btn-action" title="Ajouter au panier"
                            onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')">
                        <i class="la la-shopping-cart"></i>
                    </button>
                    <button class="btn-action" title="Ajouter aux favoris"
                            id="{{ $course->id }}" 
                            onclick="addToWishList(this.id)">
                        <i class="la la-heart-o"></i>
                    </button>
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
.card-item {
    border: none;
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.2s ease;
    height: 100%;
}

.card-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.card-image {
    border-radius: 12px 12px 0 0;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.course-badge-labels {
    position: absolute;
    top: 10px;
    left: 10px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.course-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    background: rgba(255,255,255,0.9);
}

.badge.bg-primary-soft {
    background-color: rgba(74, 144, 226, 0.1);
    color: #4A90E2;
    font-weight: 500;
}

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-action:hover {
    background: #4A90E2;
    color: white;
}

.current-price {
    font-weight: 600;
    color: #2C3E50;
    font-size: 1.1rem;
}

.old-price {
    text-decoration: line-through;
    color: #999;
    margin-left: 8px;
    font-size: 0.9rem;
}

@media (max-width: 992px) {
    .col-lg-4 {
        width: 50%;
    }
}

@media (max-width: 576px) {
    .col-lg-4 {
        width: 100%;
    }
}
</style>







