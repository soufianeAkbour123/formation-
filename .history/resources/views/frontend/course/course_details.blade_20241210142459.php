@extends('frontend.master')
@section('home')
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area pt-50px pb-50px bg-white pattern-bg">
    <div class="container">
        <div class="col-lg-8 mr-auto">
            <div class="breadcrumb-content">
                <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="#">{{ $course['category']['category_name'] }}</a></li>
                </ul>
                <div class="section-heading">
                    <h2 class="section__title">{{ $course->course_name }}</h2>
                    <p class="section__desc pt-2 lh-30">{{ $course->course_title }}</p>
                </div><!-- end section-heading -->
                <div class="d-flex flex-wrap align-items-center pt-3">
                    @if ($course->bestseller == 1)
                        <h6 class="ribbon ribbon-lg mr-2 bg-3 text-white">Meilleure Vente</h6>
                    @endif 
                    @php
                        // Récupérer tous les cours de l'instructeur
                        $instructorCourseIds = App\Models\Course::where('instructor_id', $course->instructor_id)
                                                ->pluck('id');
                        
                        // Récupérer tous les avis pour tous les cours de l'instructeur
                        $allInstructorReviews = App\Models\Review::whereIn('course_id', $instructorCourseIds)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                        
                        // Calculer la moyenne globale des notes
                        $instructorAverage = App\Models\Review::whereIn('course_id', $instructorCourseIds)
                                                ->where('status', 1)
                                                ->avg('rating');
                    @endphp                 

                    <div class="rating-wrap d-flex flex-wrap align-items-center">
                        <div class="review-stars">
                            <span class="rating-number">{{ round($instructorAverage,1) }}</span>
                        
                            @if ($instructorAverage == 0)
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($instructorAverage == 1 || $instructorAverage < 2)
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($instructorAverage == 2 || $instructorAverage < 3)
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($instructorAverage == 3 || $instructorAverage < 4)
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($instructorAverage == 4 || $instructorAverage < 5)
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($instructorAverage == 5)
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            @endif 
                            
                        </div>
                        <span class="rating-total pl-1">({{ count($allInstructorReviews) }} avis)</span>
                        @php
                            // Compter tous les étudiants inscrits aux cours de l'instructeur
                            $totalEnrollments = App\Models\Order::whereIn('course_id', $instructorCourseIds)->count();
                        @endphp
                        <span class="student-total pl-2">{{ number_format($totalEnrollments) }} étudiants</span>
                    </div>
                </div><!-- end d-flex -->
                <p class="pt-2 pb-1">Par <a href="teacher-detail.html" class="text-color hover-underline">{{ $course['user']['name'] }}</a></p>
                <div class="d-flex flex-wrap align-items-center">
                    <p class="pr-3 d-flex align-items-center">
                        <svg class="svg-icon-color-gray mr-1" width="16px" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95a15.65 15.65 0 00-1.38-3.56A8.03 8.03 0 0118.92 8zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56A7.987 7.987 0 015.08 16zm2.95-8H5.08a7.987 7.987 0 014.33-3.56A15.65 15.65 0 008.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 01-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"></path></svg>
                        Français
                    </p>
                    <p class="pr-3 d-flex align-items-center">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <b>Date Début :</b> {{ \Carbon\Carbon::parse($course->date_debut)->format('d/m/Y') }} 
                        <span class="ml-3 mr-2"></span> <!-- Séparateur entre Date Début et Date Fin -->
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <b>Date Fin :</b> {{ \Carbon\Carbon::parse($course->date_fin)->format('d/m/Y') }} 
                    </p>
                </div><!-- end d-flex -->
                <div class="bread-btn-box pt-3">
                    <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 mr-2 mb-2">
                        <i class="la la-heart-o mr-1"></i>
                        <span class="swapping-btn" data-text-swap="Wishlisted" data-text-original="Wishlist">Wishlist</span>
                    </button>
                    <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 mr-2 mb-2" data-toggle="modal" data-target="#shareModal">
                        <i class="la la-share mr-1"></i>Share
                    </button>
                    <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 mb-2" data-toggle="modal" data-target="#reportModal">
                        <i class="la la-flag mr-1"></i>Report abuse
                    </button>
                </div>
            </div><!-- end breadcrumb-content -->
        </div><!-- end col-lg-8 -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->
<!--======================================
        START COURSE DETAILS AREA
======================================-->
<section class="course-details-area pb-20px">
    <div class="container">
        <div class="row">
           <div class="col-lg-8 pb-5">
               <div class="course-details-content-wrap pt-90px">
                   <div class="course-overview-card bg-gray p-4 rounded">
                       <h3 class="fs-24 font-weight-semi-bold pb-3">Ce que vous apprendrez ?</h3>
                       <ul class="generic-list-item overview-list-item">
                       @foreach ($goals as $goal) 
                     <li><i class="la la-check mr-1 text-black"></i>  {{ $goal->goal_name }} </li>
                        @endforeach 
                   </div><!-- end course-overview-card -->
                   <style>
        
        .accordion-item {
            background-color: white;
            margin-bottom: 10px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .accordion-header {
            background-color: white;
            padding: 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            color: #333;
        }
        .accordion-content {
            padding: 0 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, padding 0.3s ease;
        }
        .accordion-content.active {
            max-height: 1000px;
            padding: 15px;
        }
        .chevron::after {
            content: '+';
            font-size: 1.2em;
            color: #666;
        }
        .accordion-header.active .chevron::after {
            content: '-';
        }
        .sub-section {
            font-family: 'Georgia', serif;
            color: #555;
            margin-bottom: 10px;
        }
        .sub-section strong {
            color: #333;
        }
    </style>
</head>


    <Br><br>
                   <div class="course-overview-card">
                       <h3 class="fs-24 font-weight-semi-bold pb-3">Prérequis</h3>
                       <ul class="generic-list-item generic-list-item-bullet fs-15">
                       <li> {{ $course->prerequisites }} </li>
                       </ul>
                   </div><!-- end course-overview-card -->
                    
   
                   <h3 class="fs-24 font-weight-semi-bold pb-3">À TÉLÉCHARGER</h3>
<div class="generic-action-wrap">
    <div class="dropdown">
    <a href="{{ route('course.view.pdf', $course->id) }}" target="_blank" class="btn theme-btn theme-btn-sm theme-btn-transparent mt-1 fs-14 font-weight-medium" aria-label="Voir le PDF des détails du cours">  
            <i class="la la-folder-open mr-1"></i> Détails du cours en PDF  
        </a>  
        <br>  
        
        <br>
    </div>
</div><!-- end generic-action-wrap -->
<br>


@php
    // Compte les lectures des sections initiales et reprogrammées
    $activeLectures = App\Models\CourseLecture::whereIn('section_id', 
        App\Models\CourseSection::where('course_id', $course->id)
            ->where(function($query) {
                $query->where(function($q) {
                    $q->where('is_cancelled', 0)
                      ->where('is_rescheduled', 0);
                })->orWhere(function($q) {
                    $q->where('is_cancelled', 1)
                      ->where('is_rescheduled', 1);
                });
            })
            ->pluck('id')
    )->count();
@endphp
<div class="course-overview-card">
    <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
        <h3 class="fs-24 font-weight-semi-bold">Contenu de la Formation</h3>
        <div class="curriculum-duration fs-15">
        <span class="curriculum-total__text mr-2">
            <strong class="text-black font-weight-semi-bold">Total:</strong> 
            {{ $activeLectures }} Chapitres
        </span>
        <span class="curriculum-total__hours">
            <strong class="text-black font-weight-semi-bold">Total hours:</strong> 
            {{ $course->duration }}
        </span>
        </div>
    </div>

    @php
    // Récupère les sections initiales et reprogrammées
    $sections = App\Models\CourseSection::where('course_id', $course->id)
        ->where(function($query) {
            $query->where(function($q) {
                $q->where('is_cancelled', 0)
                  ->where('is_rescheduled', 0);
            })->orWhere(function($q) {
                $q->where('is_cancelled', 1)
                  ->where('is_rescheduled', 1);
            });
        })
        ->orderBy('date', 'asc')
        ->get();
@endphp

    <div class="curriculum-content">
        <div class="accordion generic-accordion" id="courseAccordion">
            @foreach ($sections as $sec)
                @php
                    $lecture = App\Models\CourseLecture::where('section_id', $sec->id)->get();
                @endphp
                <div class="card">
                    <div class="card-header" id="heading{{ $sec->id }}">
                        <button class="btn btn-link d-flex align-items-center justify-content-between collapsed" 
                                type="button"
                                data-toggle="collapse" 
                                data-target="#collapse{{ $sec->id }}" 
                                aria-expanded="false" 
                                aria-controls="collapse{{ $sec->id }}">
                            <div class="d-flex align-items-center">
                                <div class="toggle-icon">
                                    <i class="la la-plus"></i>
                                    <i class="la la-minus d-none"></i>
                                </div>
                                <div class="ml-2">
                                    <div class="section-title">{{ $sec->section_title }}</div>
                                    <span class="fs-15 text-gray font-weight-medium">
                                        {{ count($lecture) }} Chapitres
                                    </span>
                                </div>
                            </div>
                            @if($sec->start_time && $sec->end_time)
                                <div class="modern-schedule-info">
                                    <div class="date-container">
                                        <div class="date-info">
                                            <i class="la la-calendar-alt"></i>
                                            {{ \Carbon\Carbon::parse($sec->date)->format('d/m/Y') }}
                                        </div>
                                        <div class="time-info">
                                            <i class="la la-clock"></i>
                                            {{ \Carbon\Carbon::parse($sec->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($sec->end_time)->format('H:i') }}
                                        </div>
                                       
                                    </div>
                                </div>
                            @endif
                        </button>
                    </div>
                    <div id="collapse{{ $sec->id }}" 
                         class="collapse" 
                         aria-labelledby="heading{{ $sec->id }}" 
                         data-parent="#courseAccordion">
                        <div class="card-body">
                            <ul class="generic-list-item">
                                @foreach ($lecture as $lect)
                                    <li>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>
                                                <i class="la la-play-circle mr-1"></i>
                                                {{ $lect->lecture_title }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestionnaire pour la fermeture des autres sections
    const accordion = document.getElementById('courseAccordion');
    
    accordion.addEventListener('show.bs.collapse', function(e) {
        const activeCollapse = accordion.querySelector('.collapse.show');
        if (activeCollapse && activeCollapse !== e.target) {
            $(activeCollapse).collapse('hide');
        }
        
        // Mettre à jour les icônes
        const button = e.target.previousElementSibling.querySelector('button');
        button.querySelector('.la-plus').classList.add('d-none');
        button.querySelector('.la-minus').classList.remove('d-none');
    });

    accordion.addEventListener('hide.bs.collapse', function(e) {
        // Mettre à jour les icônes
        const button = e.target.previousElementSibling.querySelector('button');
        button.querySelector('.la-plus').classList.remove('d-none');
        button.querySelector('.la-minus').classList.add('d-none');
    });
});
</script>

<style>
/* Les styles restent les mêmes */
.section-title {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 4px;
}

.modern-schedule-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.date-container {
    background: linear-gradient(145deg, #f8f9fa, #ffffff);
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 8px 16px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
}

.date-container:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.08);
}

.date-info, .time-info {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #4a5568;
}

.date-info {
    margin-bottom: 4px;
    font-weight: 500;
}

.time-info {
    color: #718096;
}

.date-info i, .time-info i {
    font-size: 16px;
    color: #3182ce;
}

.toggle-icon {
    width: 20px;
    text-align: center;
}

.card-header button {
    width: 100%;
    text-align: left;
    padding: 15px;
    background-color: #fff;
    border: none;
    transition: all 0.3s ease;
}

.card-header button:hover {
    background-color: #f8f9fa;
    text-decoration: none;
}

.card-header button:hover .date-container {
    border-color: #3182ce;
}

/* Toggle icon behavior */
.card-header button[aria-expanded="true"] .la-plus {
    display: none;
}

.card-header button[aria-expanded="true"] .la-minus {
    display: inline-block !important;
}

.card-header button[aria-expanded="false"] .la-plus {
    display: inline-block;
}

.card-header button[aria-expanded="false"] .la-minus {
    display: none !important;
}

@media (max-width: 768px) {
    .modern-schedule-info {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .date-container {
        padding: 6px 12px;
    }
    
    .date-info, .time-info {
        font-size: 13px;
    }
}
</style>
<div class="course-overview-card border border-gray p-4 rounded">
                        <h3 class="fs-20 font-weight-semi-bold">Les grandes entreprises font confiance à Formation++</h3>
                        <BR>
                         <div class="pb-3">
                             <img width="85" class="mr-3" src="{{ url('upload/dislogfondation.png')}}" alt="company logo">
                             <img width="80" class="mr-3" src="{{ url('upload/OCP logo.jpg')}}" alt="company logo">
                             <img width="80" class="mr-3" src="{{ url('upload/oncf.png')}}" alt="company logo">
                             <img width="80" class="mr-3" src="{{ url('upload/- Copie.png')}}" alt="company logo">
                         </div>
                         <a href="for-business.html" class="btn theme-btn theme-btn-sm">Essayez Formation++ pour les entreprises.</a>
                    </div><!-- end course-overview-card -->
                   
                   
                    <div class="course-overview-card pt-4">
        <h3 class="fs-24 font-weight-semi-bold pb-4">À propos de l'instructeur</h3>
        <div class="instructor-wrap">
            <div class="media media-card">
                <div class="instructor-img">
                    <a href="teacher-detail.html" class="media-img d-block">
                        <img class="lazy" src="{{ (!empty($course->user->photo)) ? url('upload/instructor_images/'.$course->user->photo) : url('upload/no_image.jpg')}}" data-src="images/small-avatar-1.jpg" alt="Avatar image">
                    </a>
                    <ul class="generic-list-item pt-3">
                        <li><i class="la la-star mr-2 text-color-3"></i> 4.6 Instructor Avis</li>
                    
                        <li><i class="la la-comment-o mr-2 text-color-3"></i> 150 Avis</li>
                        <li><i class="la la-play-circle-o mr-2 text-color-3"></i> {{ count($instructorCourses) }} Cours</li>
                        <li><a href="teacher-detail.html">Voir tous les cours.</a></li>
                    </ul>
                </div><!-- end instructor-img -->
                <div class="media-body">
                    <h5><a href="teacher-detail.html">{{ $course['user']['name'] }}</a></h5>
                    <br>
                    <p class="text-black lh-18 pb-3">{{ $course['user']['email'] }}</p>
                    <p class="pb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    <div class="collapse" id="collapseMoreTwo">
                        <p class="pb-3">After learning the hard way, Tim was determined to become the best teacher he could, and to make his training as painless as possible, so that you, or anyone else with the desire to become a software developer, could become one.</p>
                        <p class="pb-3">If you want to become a financial analyst, a finance manager, an FP&A analyst, an investment banker, a business executive, an entrepreneur, a business intelligence analyst, a data analyst, or a data scientist, <strong class="text-black font-weight-semi-bold">Tim Buchalka's courses are the perfect course to start</strong>.</p>
                    </div>
                    <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMoreTwo" role="button" aria-expanded="false" aria-controls="collapseMoreTwo">
                        <span class="collapse-btn-hide">Show more<i class="la la-angle-down ml-1 fs-14"></i></span>
                        <span class="collapse-btn-show">Show less<i class="la la-angle-up ml-1 fs-14"></i></span>
                    </a>
                </div>
            </div>
        </div><!-- end instructor-wrap -->
    </div><!-- end course-overview-card -->
                   <div class="course-overview-card pt-4">
                       <h3 class="fs-24 font-weight-semi-bold pb-40px">Retour des étudiants</h3>
                       <div class="feedback-wrap">
                           <div class="media media-card align-items-center">
                               <div class="review-rating-summary">
                                    <span class="stats-average__count">4.6</span>
                                   <div class="rating-wrap pt-1">
                                       <div class="review-stars">
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star-half-alt"></span>
                                       </div>
                                       <span class="rating-total d-block">(2,533)</span>
                                       <span>Course Rating</span>
                                   </div><!-- end rating-wrap -->
                               </div><!-- end review-rating-summary -->
                               <div class="media-body">
                                   <div class="review-bars d-flex align-items-center mb-2">
                                       <div class="review-bars__text">5 stars</div>
                                       <div class="review-bars__fill">
                                           <div class="skillbar-box">
                                               <div class="skillbar" data-percent="77%">
                                                   <div class="skillbar-bar bg-3"></div>
                                               </div> <!-- End Skill Bar -->
                                           </div>
                                       </div><!-- end review-bars__fill -->
                                       <div class="review-bars__percent">77%</div>
                                   </div><!-- end review-bars -->
                                   <div class="review-bars d-flex align-items-center mb-2">
                                       <div class="review-bars__text">4 stars</div>
                                       <div class="review-bars__fill">
                                           <div class="skillbar-box">
                                               <div class="skillbar" data-percent="54%">
                                                   <div class="skillbar-bar bg-3"></div>
                                               </div> <!-- End Skill Bar -->
                                           </div>
                                       </div><!-- end review-bars__fill -->
                                       <div class="review-bars__percent">54%</div>
                                   </div><!-- end review-bars -->
                                   <div class="review-bars d-flex align-items-center mb-2">
                                       <div class="review-bars__text">3 stars</div>
                                       <div class="review-bars__fill">
                                           <div class="skillbar-box">
                                               <div class="skillbar" data-percent="14%">
                                                   <div class="skillbar-bar bg-3"></div>
                                               </div> <!-- End Skill Bar -->
                                           </div>
                                       </div><!-- end review-bars__fill -->
                                       <div class="review-bars__percent">14%</div>
                                   </div><!-- end review-bars -->
                                   <div class="review-bars d-flex align-items-center mb-2">
                                       <div class="review-bars__text">2 stars</div>
                                       <div class="review-bars__fill">
                                           <div class="skillbar-box">
                                               <div class="skillbar" data-percent="5%">
                                                   <div class="skillbar-bar bg-3"></div>
                                               </div> <!-- End Skill Bar -->
                                           </div>
                                       </div><!-- end review-bars__fill -->
                                       <div class="review-bars__percent">5%</div>
                                   </div><!-- end review-bars -->
                                   <div class="review-bars d-flex align-items-center mb-2">
                                       <div class="review-bars__text">1 stars</div>
                                       <div class="review-bars__fill">
                                           <div class="skillbar-box">
                                               <div class="skillbar" data-percent="2%">
                                                   <div class="skillbar-bar bg-3"></div>
                                               </div> <!-- End Skill Bar -->
                                           </div>
                                       </div><!-- end review-bars__fill -->
                                       <div class="review-bars__percent">2%</div>
                                   </div><!-- end review-bars -->
                               </div><!-- end media-body -->
                           </div>
                       </div><!-- end feedback-wrap -->
                   </div><!-- end course-overview-card -->
                   <div class="course-overview-card pt-4">
                       <h3 class="fs-24 font-weight-semi-bold pb-4">Reviews</h3>
                       <div class="review-wrap">
              
                        
   @php
       $reviews = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->limit(5)->get();
   @endphp
    @foreach ($reviews as $item)
    <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
        <div class="media-img mr-4 rounded-full">
            <img class="rounded-full lazy" src="{{ (!empty($item->user->photo)) ? url('upload/user_images/'.$item->user->photo) : url('upload/no_image.jpg')}}" data-src="images/small-avatar-1.jpg" alt="User image">
        </div>
        <div class="media-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                <h5>{{ $item->user->name }}</h5>
                <div class="review-stars">
                    @if($item->rating == NULL)
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    @elseif ($item->rating == 1)
                    <span class="la la-star"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    @elseif ($item->rating == 2)
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    @elseif ($item->rating == 3)
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star-o"></span>
                    <span class="la la-star-o"></span>
                    @elseif ($item->rating == 4)
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star-o"></span>
                    @elseif ($item->rating == 5)
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    @endif
                </div>
            </div>
            <span class="d-block lh-18 pb-2">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
            <p class="pb-2">{{ $item->comment }}</p>
            <div class="helpful-action">
                <span class="d-block fs-13">Was this review helpful?</span>
                <button class="btn">Yes</button>
                <button class="btn">No</button>
                <span class="btn-text fs-14 cursor-pointer pl-1" data-toggle="modal" data-target="#reportModal">Report</span>
            </div>
        </div>
    </div><!-- end media --> 
        
    @endforeach
                     
                       </div><!-- end review-wrap -->
                       <div class="see-more-review-btn text-center">
                           <button type="button" class="btn theme-btn theme-btn-transparent">Load more reviews</button>
                       </div>
                   </div><!-- end course-overview-card -->
                  
                  
                   @guest
<p><b> For Add Course Review. You need to login first <a href="{{ route('login') }}"> Login Here</a> </b> </p>
               @else 
                  
                   <div class="course-overview-card pt-4">
                       <h3 class="fs-24 font-weight-semi-bold pb-4">Add a Review</h3>
                       
        <form method="post" action="{{ route('store.review') }}" class="row">
        @csrf
        <div class="leave-rating-wrap pb-4">
            <div class="leave-rating leave--rating">
                <input type="radio" name='rate' id="star5" value="5" />
                <label for="star5"></label>
                <input type="radio" name='rate' id="star4" value="4"/>
                <label for="star4"></label>
                <input type="radio" name='rate' id="star3" value="3"/>
                <label for="star3"></label>
                <input type="radio" name='rate' id="star2" value="2"/>
                <label for="star2"></label>
                <input type="radio" name='rate' id="star1" value="1"/>
                <label for="star1"></label>
            </div><!-- end leave-rating -->
        </div>
        
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="instructor_id" value="{{ $course->instructor_id }}">
            
            <div class="input-box col-lg-12">
                <label class="label-text">Message</label>
                <div class="form-group">
                    <textarea class="form-control form--control pl-3" name="comment" placeholder="Write Message" rows="5"></textarea>
                </div>
            </div><!-- end input-box -->
            <div class="btn-box col-lg-12">
                
                <button class="btn theme-btn" type="submit">Submit Review</button>
            </div><!-- end btn-box -->
        </form>
                   </div><!-- end course-overview-card -->
                   @endguest   


               </div><!-- end course-details-content-wrap -->
           </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar sidebar-negative">
                    <div class="card card-item">
                        <div class="card-body">
                            <div class="preview-course-video">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal">
                                <img src="{{ asset($course->course_image) }}" data-src="{{ asset($course->course_image) }}" alt="course-img" class="w-100 rounded lazy">
                                    <div class="preview-course-video-content">
                                        <div class="overlay"></div>
                                        <div class="play-button">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-307.4 338.8 91.8 91.8" style=" enable-background:new -307.4 338.8 91.8 91.8;" xml:space="preserve">
                                              <style type="text/css">
                                                  .st0{fill:#ffffff; border-radius: 100px;}
                                                  .st1{fill:#000000;}
                                              </style>
                                                <g>
                                                 <circle class="st0" cx="-261.5" cy="384.7" r="45.9"></circle><path class="st1" d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"></path>
                                             </g>
                                         </svg>
                                        </div>
                                        <p class="fs-15 font-weight-bold text-white pt-3">Aperçu de ce cours</p>
                                    </div>
                                </a>
                            </div><!-- end preview-course-video -->
                                                    @php
                            $amount = $course->selling_price - $course->discount_price;
                            $discount = ($amount/$course->selling_price) * 100;
                        @endphp     
                            <div class="preview-course-feature-content pt-40px">
                            <p class="d-flex align-items-center pb-2">
            @if ($course->discount_price == NULL)
            <span class="fs-35 font-weight-semi-bold text-black">{{ $course->selling_price }}DH</span>
            @else
            <span class="fs-35 font-weight-semi-bold text-black">{{ $course->discount_price }}DH</span>
            <span class="before-price mx-1">{{ $course->selling_price }}DH</span>
            @endif
            
            
            <span class="price-discount">{{ round($discount) }}% off</span>
        </p>
                                <p class="preview-price-discount-text pb-35px">
                                    <span class="text-color-3">4 days</span> Restant à ce prix !
                                </p>
                                <div class="buy-course-btn-box">
                                <button type="submit" class="btn theme-btn w-100 mb-2" onclick="addToCart({{$course->id}},'{{$course->course_name}}','{{$course->instructor_id}}','{{$course->course_name_slug}}')" ><i class="la la-shopping-cart fs-18 mr-1"></i> Ajouter au panier </button>
                    <button type="button" class="btn theme-btn w-100 theme-btn-white mb-2"><i class="la la-shopping-bag mr-1"></i> Acheter ce cours</button>
                </div>
                                <p class="fs-14 text-center pb-4">Garantie de remboursement de 30 jours</p>
                                
                            </div><!-- end preview-course-content -->
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Caractéristiques du cours</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-flash">
        <li class="d-flex align-items-center justify-content-between"><span><i class="la la-clock mr-2 text-color"></i>Durée</span> {{ $course->duration }} hour</li>
        
        
     
        <li class="d-flex align-items-center justify-content-between"><span><i class="la la-language mr-2 text-color"></i>Language</span> Français</li>

        <li class="d-flex align-items-center justify-content-between">
    <span><i class="la la-lightbulb mr-2 text-color"></i>Niveau de compétence.</span>
    @if ($course->label == 'Begginer')
        Débutant
    @elseif ($course->label == 'Middle')
        Intermédiaire
    @elseif ($course->label == 'Advance')
        Avancé
    @else
        {{ $course->label }}
    @endif
</li>


        <li class="d-flex align-items-center justify-content-between"><span><i class="la la-certificate mr-2 text-color"></i>Certificate</span>{{ $course->certificate ? 'Oui' : 'Non' }}</li>
        <li class="d-flex align-items-center justify-content-between"><span><i class="la la-users mr-2 text-color"></i>Nombre maximum d'inscrits</span> {{ $course->nombre_maxDInscrit }}</li>
        <li class="d-flex align-items-center justify-content-between"><span><i class="la la-certificate mr-2 text-color"></i>Type de formation</span> {{ $course->type_formation }}</li>
    </ul>
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
                            <h3 class="card-title fs-18 pb-2">Cours connexes</h3>
                            <div class="divider"><span></span></div>

                             @foreach ($relatedCourses as $related)
        <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
            <a href="course-details.html" class="media-img">
                <img class="mr-3 lazy" src="{{ asset($related->course_image) }}" data-src="{{ asset($related->course_image) }}" alt="Related course image">
            </a>
            <div class="media-body">
                <h5 class="fs-15"><a href="course-details.html"> {{ $related->course_name}}</a></h5>
                <span class="d-block lh-18 py-1 fs-14">{{ $related['user']['name'] }}</span>
                @if ($related->discount_price == NULL)
                <p class="text-black font-weight-semi-bold lh-18 fs-15">{{ $related->selling_price }} DH </p>
                @else
                <p class="text-black font-weight-semi-bold lh-18 fs-15">{{ $related->discount_price }}DH <span class="before-price fs-14">{{ $related->selling_price }}DH</span></p>
                @endif
               
            </div>
        </div><!-- end media -->
        
            
        @endforeach
                         

                          
                            <div class="view-all-course-btn-box">
                                <a href="course-grid.html" class="btn theme-btn w-100">Voir tous les cours <i class="la la-arrow-right icon ml-1"></i></a>
                            </div>
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                      
                    </div><!-- end card -->
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end course-details-area -->
<!--======================================
        END COURSE DETAILS AREA
======================================-->

<section class="related-course-area bg-gray pt-60px pb-60px">
    <div class="container">
        <div class="related-course-wrap">
            <h3 class="fs-28 font-weight-semi-bold pb-35px">Plus de cours par.<a href="teacher-detail.html" class="text-color hover-underline">{{ $course['user']['name'] }}</a></h3>
            <div class="view-more-carousel-2 owl-action-styled">
                
                @foreach ($instructorCourses  as $inscourse)
                @php
                $amount = $inscourse->selling_price - $inscourse->discount_price;
                $discount = ($amount/$inscourse->selling_price) * 100;
            @endphp
                <div class="card card-item">
                    <div class="card-image">
                        <a href="{{ url('course/details/'.$inscourse->id.'/'.$inscourse->course_name_slug) }}" class="d-block">
                            <img class="card-img-top" src="{{ asset($inscourse->course_image) }}" alt="Card image cap">
                        </a>
                        <div class="course-badge-labels">
                            @if ($inscourse->bestseller == 1)
                            <div class="course-badge">Bestseller</div>
                            @else
                            @endif
                            @if ($inscourse->discount_price == NULL)
                            <div class="course-badge blue">New</div>
                            @else
                            <div class="course-badge blue">{{ round($discount) }}%</div>
                            @endif
                        </div>
                    </div><!-- end card-image -->
                    <div class="card-body">
                        <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $inscourse->label }}</h6>
                        <h5 class="card-title"><a href="{{ url('course/details/'.$inscourse->id.'/'.$inscourse->course_name_slug) }}">{{ $inscourse->course_name }}</a></h5>
                        <p class="card-text"><a href="teacher-detail.html">{{ $inscourse['user']['name'] }}</a></p>
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
                    @if ($inscourse->discount_price == NULL)
                    <p class="card-price text-black font-weight-bold">{{ $inscourse->selling_price }}  DH</p>
                    @else
                    <p class="card-price text-black font-weight-bold">{{ $inscourse->discount_price }} DH<span class="before-price font-weight-medium"> {{ $inscourse->selling_price }} DH</span></p> 
                    @endif
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card --> 
                @endforeach
            
            </div><!-- end view-more-carousel -->
        </div><!-- end related-course-wrap -->
    </div><!-- end container -->
</section><!-- end related-course-area -->
<!--======================================
        END RELATED COURSE AREA
======================================-->

<!--======================================
        START CTA AREA
======================================-->
<section class="cta-area pt-60px pb-60px position-relative overflow-hidden">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="cta-content-wrap py-4 d-flex flex-wrap align-items-center">
                    <svg class="flex-shrink-0 mr-4" width="70" viewBox="0 -48 496 496" xmlns="http://www.w3.org/2000/svg"><path d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0"></path><path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"></path><path d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0"></path><path d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0"></path><path d="m152 288h16v80h-16zm0 0"></path><path d="m120 288h16v80h-16zm0 0"></path><path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"></path></svg>
                    <div class="section-heading">
                        <h2 class="section__title mb-1 fs-22">Devenir enseignant, Partagez vos connaissances</h2>
                        <p class="section__desc">Créez un cours vidéo en ligne, atteignez des étudiants dans le monde entier, et gagnez de l'argent</p>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="cta-btn-box text-right">
                    <a href="become-a-teacher.html" class="btn theme-btn">Technologie sur Formation++<i class="la la-arrow-right icon ml-1"></i> </a>
                </div>
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end cta-area -->
<!--======================================
        END CTA AREA
======================================-->
<!-- Modal -->
<div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">Share this course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <div class="copy-to-clipboard">
                    <span class="success-message">Copied!</span>
                    <div class="input-group">
                        <input type="text" class="form-control form--control copy-input pl-3" value="http://127.0.0.1:8000/{{ Request::path() }} ">
                        <div class="input-group-append">
                            <button class="btn theme-btn theme-btn-sm copy-btn shadow-none"><i class="la la-copy mr-1"></i> Copy</button>
                        </div>
                    </div>
                </div><!-- end copy-to-clipboard -->
            </div><!-- end modal-body -->
            <div class="modal-footer justify-content-center border-top-gray">
                <ul class="social-icons social-icons-styled">
                    <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                    <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                    <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                </ul>
            </div><!-- end modal-footer -->
        </div><!-- end modal-content-->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->
<!-- Modal -->
<div class="modal fade modal-container" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <p class="pb-2 font-weight-semi-bold">Course Preview</p>
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="previewModalTitle">{{ $course->course_name }}</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
            <video controls crossorigin playsinline poster="{{ asset($course->course_image) }}" id="player">
                    <!-- Video files -->
                    <source src="{{ asset($course->video) }}" type="video/mp4"/>
                </video>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->
<!-- Modal -->
<div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Report Abuse</h5>
                    <p class="pt-1 fs-14 lh-24">Flagged content is reviewed by Aduca staff to determine whether it violates Terms of Service or Community Guidelines. If you have a question or technical issue, please contact our
                        <a href="contact.html" class="text-color hover-underline">Support team here</a>.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form method="post">
                    <div class="input-box">
                        <label class="label-text">Select Report Type</label>
                        <div class="form-group">
                            <div class="select-container w-auto">
                                <select class="select-container-select">
                                    <option value>-- Select One --</option>
                                    <option value="1">Inappropriate Course Content</option>
                                    <option value="2">Inappropriate Behavior</option>
                                    <option value="3">Aduca Policy Violation</option>
                                    <option value="4">Spammy Content</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Write Message</label>
                        <div class="form-group">
                            <textarea class="form-control form--control pl-3" name="message" placeholder="Provide additional details here..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Submit <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->
@endsection