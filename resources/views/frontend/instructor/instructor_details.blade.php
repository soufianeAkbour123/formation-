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
            </div><!-- end media -->
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->

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
        </div><!-- end container -->
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
            <h3 class="fs-24 font-weight-semi-bold text-center">Mes cours</h3>  
            <span class="ribbon ribbon-lg">{{ count($coursesA) }}</span>  
        </div>  
        <div class="divider"><span></span></div>  
        
        <div class="view-more-carousel-2 owl-action-styled">  
            @foreach ($coursesA as $course)   
            @php  
                $amount = $course->selling_price - $course->discount_price;  
                $discount = ($amount/$course->selling_price) * 100;  
                $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->get();
                $avarage = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');
            @endphp  
            <div class="card card-item">  
                <div class="card-image text-center">
                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">  
                        <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="{{ asset($course->course_image) }}" alt="Card image cap">  
                    </a>  
                    <div class="course-badge-labels">
    @if ($course->bestseller == 1)
        <span class="course-badge bestseller-badge">
            <i class="la la-gem"></i>
            <span class="badge-tooltip">Meilleure vente</span>
        </span>
    @endif

    @if ($course->discount_price == NULL)
        <span class="course-badge new-badge">
            <i class="la la-star"></i>
            <span class="badge-tooltip">Nouveau</span>
        </span>
    @endif
</div>  
                </div>  
                <div class="card-body text-center">
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
                    <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>  
                    <p class="card-text"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>  
                    <div class="rating-wrap d-flex justify-content-center align-items-center py-2">  
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
                    </div>  
                    <div class="d-flex justify-content-between align-items-center">  
                        @if ($course->discount_price == NULL)  
                            <p class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH</p>  
                        @else  
                            <p class="card-price text-black font-weight-bold">{{ $course->discount_price }} DH<span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span></p>   
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
                                 onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')">
                                <i class="la la-shopping-cart"></i>
                            </div>

                            <!-- Wishlist icon -->
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
        </div><!-- end view-more-carousel -->  
    </div>
</section><!-- end course-area -->

@endsection

<!-- ================================
       START STYLES AREA
================================= -->
<style>
/* Styles pour les boutons "Lire plus" et "Lire moins" */
.btn {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 10px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    background-color: #EC5252;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #d94c4c;
}

/* Suppression du centrage des infos du formateur */
.media-body {
    text-align: left;
}

/* Centrage général (autre que les infos formateur) */
.text-center {
    text-align: center;
}

/* Amélioration du carousel */
.card-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-item:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Étoiles d'évaluation */
.review-stars span {
    transition: color 0.3s ease;
}

.review-stars span:hover {
    color: #EC5252;
}
.card {
    border: none;
    border-radius: 1rem;
}

.card-body {
    padding: 2rem;
}

.collapse-btn {
    display: inline-block;
    margin-top: 1rem;
    font-weight: bold;
    color: #EC5252;
    transition: color 0.3s ease;
}

.collapse-btn:hover {
    color: #b22222; /* Changement de couleur au survol */
}
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const aboutText = document.getElementById('aboutText');
        const aboutToggle = document.getElementById('aboutToggle');

        const experienceText = document.getElementById('experienceText');
        const experienceToggle = document.getElementById('experienceToggle');

        // Stocker l'état de l'affichage
        let isAboutExpanded = false;
        let isExperienceExpanded = false;

        aboutToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (!isAboutExpanded) {
                aboutText.style.maxHeight = 'none'; // Afficher tout le texte
                aboutToggle.textContent = 'Lire moins';
                isAboutExpanded = true;
            } else {
                aboutText.style.maxHeight = '3.5em'; // Limiter à 4 lignes
                aboutToggle.textContent = 'Lire plus';
                isAboutExpanded = false;
            }
        });

        experienceToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (!isExperienceExpanded) {
                experienceText.style.maxHeight = 'none'; // Afficher tout le texte
                experienceToggle.textContent = 'Lire moins';
                isExperienceExpanded = true;
            } else {
                experienceText.style.maxHeight = '3.5em'; // Limiter à 4 lignes
                experienceToggle.textContent = 'Lire plus';
                isExperienceExpanded = false;
            }
        });
    });
</script>