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
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                @include('frontend.sidebar')
            </div>
            <div class="col-lg-8">
                <div class="row">
                    @foreach ($courses as $course)
                    <div class="col-lg-6 responsive-column-half">
                        <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1{{ $course->id }}">
                            <div class="card-image">
                                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                                    <img class="card-img-top" src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
                                </a>
                                @php
                                    $amount = $course->selling_price - $course->discount_price;
                                    $discount = ($amount/$course->selling_price) * 100;
                                    $reviewcount = App\Models\Review::where('course_id', $course->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->get();
                                    $average = App\Models\Review::where('course_id', $course->id)
                                        ->where('status', 1)
                                        ->avg('rating');
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
                                    @switch($course->label)
                                        @case('Begginer')
                                            Débutant
                                            @break
                                        @case('Middle')
                                            Intermédiaire
                                            @break
                                        @case('Advance')
                                            Avancé
                                            @break
                                        @default
                                            {{ $course->label }}
                                    @endswitch
                                </h6>
                                <h5 class="card-title">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                                        {{ $course->course_name }}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <a href="{{ route('instructor.details', $course->instructor_id) }}">
                                        {{ $course->user->name }}
                                    </a>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="price-wrapper">
                                        @if ($course->discount_price == NULL)
                                            <p class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH</p>
                                        @else
                                            <p class="card-price text-black font-weight-bold">
                                                {{ $course->discount_price }} DH 
                                                <span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="action-buttons d-flex align-items-center">
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" 
                                           class="icon-element icon-element-sm shadow-sm mr-2" 
                                           title="Voir les détails du cours">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <button class="icon-element icon-element-sm shadow-sm" 
                                                onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')"
                                                title="Ajouter au panier">
                                            <i class="la la-shopping-cart"></i>
                                        </button>
                                        <button class="icon-element icon-element-sm shadow-sm ml-2" 
                                                onclick="addToWishList({{$course->id}})"
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
                <div class="text-center pt-3">
                    <nav aria-label="Page navigation" class="pagination-box">
                        <ul class="pagination justify-content-center">
                            {{ $courses->links('vendor.pagination.custom') }}
                        </ul>
                    </nav>
                    <p class="fs-14 pt-2">Showing {{ $courses->firstItem() }}-{{ $courses->lastItem() }} of {{ $courses->total() }} results</p>
                </div>
            </div>
        </div>
    </div>
</section>

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
}

.cart-icon-wrapper:hover .cart-icon {
    color: white;
}

.la-heart {
    color: #28a745;
}

.la-heart-o {
    color: inherit;
}

.course-area .col-lg-6 .card {
    height: 510px;
    display: flex;
    flex-direction: column;
}

.course-area .col-lg-6 .card-body {
    flex-grow: 1;
}

@media (max-width: 767px) {
    .course-area .col-lg-6 .card {
        height: auto;
    }
    
    .course-area .col-lg-6 .card-body {
        padding: 16px;
    }
    
    .course-area .col-lg-6 .card-title {
        font-size: 18px;
    }
}

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
</style>
@endsection







