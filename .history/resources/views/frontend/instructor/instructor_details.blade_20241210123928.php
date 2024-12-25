@extends('frontend.master')
@section('home')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area py-5 bg-white pattern-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <div class="media media-card align-items-center pb-4">
                <div class="media-img media--img media-img-md rounded-full">
                    <img class="rounded-full" src="{{ (!empty($instructor->photo)) ? url('upload/instructor_images/'.$instructor->photo) : url('upload/no_image.jpg')}}" alt="Student thumbnail image">
                </div>
                <div class="media-body">
                    <h2 class="section__title fs-30">{{ $instructor->name }}</h2>
                    <p class="card-text pb-3" style="white-space: pre-wrap;">{{ $instructor->username }}</p>
                    <div class="rating-wrap d-flex align-items-center">
                        <div class="review-stars">
                            <span class="rating-number">4.4</span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                        </div>
                        <span class="rating-total pl-1">(275 Avis)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================
       START TEACHER DETAILS AREA
================================= -->
<section class="teacher-details-area pt-50px">
    <div class="bg-gray py-5">
        <div class="container">
            <div class="col-lg-12">
                <div class="card shadow-sm mb-4 rounded">
                    <div class="card-body">
                        <h3 class="fs-22 font-weight-semi-bold pb-3">À propos</h3>
                        <p class="card-text" id="aboutText" style="max-height: 3.5em; overflow: hidden; transition: max-height 0.3s ease;">
                            {{ $instructor->about_prof }}
                        </p>
                        <a href="#" class="collapse-btn" id="aboutToggle">Lire plus</a>
                    </div>
                </div>

                <div class="card shadow-sm mb-4 rounded">
                    <div class="card-body">
                        <h3 class="fs-22 font-weight-semi-bold pb-3">Expérience</h3>
                        <p class="card-text" id="experienceText" style="max-height: 3.5em; overflow: hidden; transition: max-height 0.3s ease;">
                            {{ $instructor->experience }}
                        </p>
                        <a href="#" class="collapse-btn" id="experienceToggle">Lire plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================
       START COURSE AREA
================================= -->
@php  
    $coursesA = App\Models\Course::where('status', 1)->orderBy('id', 'ASC')->limit(12)->get();  
@endphp  
<section class="course-area section-padding">  
    <div class="container">  
        <div class="d-flex align-items-center justify-content-between pb-3">  
            <h3 class="fs-24 font-weight-semi-bold">Mes cours</h3>  
            <span class="ribbon ribbon-lg">{{ count($coursesA) }}</span>  
        </div>  
        <div class="divider"><span></span></div>  
        
        <div class="row">  
            @foreach ($coursesA as $course)   
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card card-item h-100">  
                    <div class="card-image">
                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">  
                            <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="{{ asset($course->course_image) }}" alt="Card image cap">  
                        </a>  
                        @php  
                        $amount = $course->selling_price - $course->discount_price;  
                        $discount = ($amount/$course->selling_price) * 100;  
                        @endphp  
                        <div class="course-badge-labels">  
                            @if ($course->bestseller == 1)  
                            <div class="course-badge">Bestseller</div>  
                            @endif  
                            @if ($course->discount_price == NULL)  
                            <div class="course-badge blue">New</div>  
                            @else  
                            <div class="course-badge blue">{{ round($discount) }}%</div>  
                            @endif  
                        </div>  
                    </div>  
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-0">{{ $course->label }}</h6>  
                            <h5 class="card-title mb-0 flex-grow-1 ml-2"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>  
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="card-text mb-0"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>  
                            <div class="rating-wrap d-flex align-items-center">  
                                <div class="review-stars">  
                                    <span class="rating-number">4.4</span>  
                                    <span class="la la-star"></span>  
                                    <span class="la la-star"></span>  
                                    <span class="la la-star"></span>  
                                    <span class="la la-star"></span>  
                                    <span class="la la-star-o"></span>  
                                </div>  
                                <span class="rating-total pl-1">(20,230)</span>  
                            </div>  
                        </div>  
                        <div class="d-flex justify-content-between align-items-center mt-auto">  
                            @if ($course->discount_price == NULL)  
                            <p class="card-price text-black font-weight-bold mb-0">{{ $course->selling_price }} DH</p>  
                            @else  
                            <p class="card-price text-black font-weight-bold mb-0">{{ $course->discount_price }} DH<span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span></p>   
                            @endif  
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i class="la la-heart-o"></i></div>  
                        </div>  
                    </div>  
                </div>
            </div>
            @endforeach  
        </div>
    </div>
</section>

@endsection

<style>
/* Styles généraux */
.card {
    border: none;
    border-radius: 1rem;
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 1rem;
    display: flex;
    flex-direction: column;
}

/* Style de l'image */
.card-image {
    position: relative;
    overflow: hidden;
}

.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* Styles des badges */
.course-badge-labels {
    position: absolute;
    top: 10px;
    left: 10px;
}

.course-badge {
    background: #ff4d4d;
    color: white;
    padding: 0.3rem 0.6rem;
    border-radius: 3px;
    margin-bottom: 5px;
    display: inline-block;
    font-size: 12px;
}

.course-badge.blue {
    background: #007bff;
}

/* Styles du contenu */
.card-title {
    font-size: 1rem;
    margin: 0;
    flex-grow: 1;
}

.card-title a {
    color: #333;
    text-decoration: none;
}

.card-text a {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
}

/* Styles des étoiles et avis */
.rating-wrap {
    font-size: 0.85rem;
}

.review-stars {
    color: #ffc107;
}

/* Styles des prix */
.card-price {
    font-size: 1.1rem;
    color: #333;
}

.before-price {
    text-decoration: line-through;
    color: #999;
    margin-left: 0.5rem;
    font-size: 0.9rem;
}

/* Style du ruban */
.ribbon {
    padding: 0.3rem 0.6rem;
    border-radius: 3px;
    font-size: 0.8rem;
    background: #f8f9fa;
    color: #333;
}

.ribbon-blue-bg {
    background: #e8f4ff;
    color: #007bff;
}

/* Styles pour le bouton "Lire plus" */
.collapse-btn {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

.collapse-btn:hover {
    text-decoration: underline;
}

/* Media queries pour la responsivité */
@media (max-width: 768px) {
    .col-md-6 {
        margin-bottom: 1.5rem;
    }
    
    .card-img-top {
        height: 180px;
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const aboutText = document.getElementById('aboutText');
        const aboutToggle = document.getElementById('aboutToggle');
        const experienceText = document.getElementById('experienceText');
        const experienceToggle = document.getElementById('experienceToggle');

        let isAboutExpanded = false;
        let isExperienceExpanded = false;

        aboutToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (!isAboutExpanded) {
                aboutText.style.maxHeight = 'none';
                aboutToggle.textContent = 'Lire moins';
                isAboutExpanded = true;
            } else {
                aboutText.style.maxHeight = '3.5em';
                aboutToggle.textContent = 'Lire plus';
                isAboutExpanded = false;
            }
        });

        experienceToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (!isExperienceExpanded) {
                experienceText.style.maxHeight = 'none';
                experienceToggle.textContent = 'Lire moins';
                isExperienceExpanded = true;
            } else {
                experienceText.style.maxHeight = '3.5em';
                experienceToggle.textContent = 'Lire plus';
                isExperienceExpanded = false;
            }
        });
    });
</script>