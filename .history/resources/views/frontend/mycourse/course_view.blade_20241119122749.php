@include('frontend.mycourse.body.header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> 
<body>

<!-- start cssload-loader -->

    
          
            
    
  
<div class="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->
<!--======================================
        START HEADER AREA
    ======================================-->
<section class="header-menu-area">
    <div class="header-menu-content bg-dark">
        <div class="container-fluid">
            <div class="main-menu-content d-flex align-items-center">
                <div class="logo-box logo--box">
                    <div class="theme-picker d-flex align-items-center">
                        <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                            <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                            </svg>
                        </button>
<button class="theme-picker-btn light-mode-btn" title="Light mode">
<svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="12" cy="12" r="5"></circle>
    <line x1="12" y1="1" x2="12" y2="3"></line>
    <line x1="12" y1="21" x2="12" y2="23"></line>
    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
    <line x1="1" y1="12" x2="3" y2="12"></line>
    <line x1="21" y1="12" x2="23" y2="12"></line>
    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
</svg>
</button>
</div>
</div><!-- end logo-box -->
<div class="course-dashboard-header-title pl-4">
<a href="course-details.html" class="text-white fs-15">{{ $course->course->course_name }}</a>
</div><!-- end course-dashboard-header-title -->
<div class="menu-wrapper ml-auto">
<div class="theme-picker d-flex align-items-center mr-3">
<button class="theme-picker-btn dark-mode-btn" title="Dark mode">
<svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
</svg>
</button>
<button class="theme-picker-btn light-mode-btn" title="Light mode">
<svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="12" cy="12" r="5"></circle>
    <line x1="12" y1="1" x2="12" y2="3"></line>
    <line x1="12" y1="21" x2="12" y2="23"></line>
    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
    <line x1="1" y1="12" x2="3" y2="12"></line>
    <line x1="21" y1="12" x2="23" y2="12"></line>
    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
</svg>
</button>
</div>
<div class="nav-right-button d-flex align-items-center">
<a href="#" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2" data-toggle="modal" data-target="#ratingModal"><i class="la la-star mr-1"></i> Laisser une évaluation</a>
<a href="#" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2" data-toggle="modal" data-target="#shareModal"><i class="la la-share mr-1"></i> Partager</a>
<div class="generic-action-wrap generic--action-wrap">
<div class="dropdown">
    <a class="action-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="la la-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="#"> Ajouter ce cours aux favoris</a>
        <a class="dropdown-item" href="#">Archiver ce cours</a>
        <a class="dropdown-item" href="#">Offrir ce cours</a>
    </div>
</div>
</div>
</div><!-- end nav-right-button -->
</div><!-- end menu-wrapper -->
</div><!-- end row -->
</div><!-- end container-fluid -->
</div><!-- end header-menu-content -->
</section><!-- end header-menu-area -->
<!--======================================
END HEADER AREA
======================================-->










<!--======================================
START COURSE-DASHBOARD
======================================-->
<section class="course-dashboard">
<div class="course-dashboard-wrap">
<div class="course-dashboard-container d-flex">
<div class="course-dashboard-column">



    <div class="lecture-viewer-container">
        <div class="lecture-video-item">
<iframe width="100%" height="500" id="videoContainer" src="" 
    title="The Best Way to Learn With Videos and Online Classes I Video Notebook" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
    allowfullscreen></iframe>
<div id="textLesson" class="fs-24 font-weight-semi-bold pb-2 text-center mt-4">
<h3></h3>
</div> 

        </div> 
    </div><!-- end lecture-viewer-container -->

















<div class="lecture-video-detail">
<div class="lecture-tab-body bg-gray p-4">
<ul class="nav nav-tabs generic-tab" id="myTab" role="tablist">

    
          
            
    

          
         
  
<li class="nav-item">
    <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false">
        <i class="la la-search"></i>
    </a>
</li>
<li class="nav-item mobile-menu-nav-item">
    <a class="nav-link" id="course-content-tab" data-toggle="tab" href="#course-content" role="tab" aria-controls="course-content" aria-selected="false">
    Contenu du cours
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
    Aperçu
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" id="question-and-ans-tab" data-toggle="tab" href="#question-and-ans" role="tab" aria-controls="question-and-ans" aria-selected="false">
    Questions et réponses
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" id="announcements-tab" data-toggle="tab" href="#announcements" role="tab" aria-controls="announcements" aria-selected="false">
    Annonces
    </a>
</li>
</ul>
</div>
<div class="lecture-video-detail-body">
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
    <div class="search-course-wrap pt-40px">
        <form action="#" class="pb-5">
            <div class="input-group">
                <input class="form-control form--control form--control-gray pl-3" type="text" name="search" placeholder="Search course content">
                <div class="input-group-append">
                    <button class="btn theme-btn"><span class="la la-search"></span></button>
                </div>
            </div>
        </form>
        <div class="search-results-message text-center">
            <h3 class="fs-24 font-weight-semi-bold pb-1">Démarrer une nouvelle recherche</h3>
            <p>Pour trouver des sous-titres, des conférences ou des ressources</p>
        </div>
    </div><!-- end search-course-wrap -->
</div><!-- end tab-pane -->
<div class="tab-pane fade" id="course-content" role="tabpanel" aria-labelledby="course-content-tab">
    <div class="mobile-course-menu pt-4">
        <div class="accordion generic-accordion generic--accordion" id="mobileCourseAccordionCourseExample">
           
            
           
            <div class="card">
                <div class="card-header" id="mobileCourseHeadingOne">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mobileCourseCollapseOne" aria-expanded="true" aria-controls="mobileCourseCollapseOne">
                        <i class="la la-angle-down"></i>
                        <i class="la la-angle-up"></i>
                        <span class="fs-15"> Section 1 : Plongez et découvrez After Effects</span>
                        <span class="course-duration">
                            <span>1/5</span>
                            <span>21min</span>
                        </span>
                    </button>
                </div><!-- end card-header -->
                <div id="mobileCourseCollapseOne" class="collapse show" aria-labelledby="mobileCourseHeadingOne" data-parent="#mobileCourseAccordionCourseExample">
                    <div class="card-body p-0">
                        <ul class="curriculum-sidebar-list">
                            <li class="course-item-link active">
                                <div class="course-item-content-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="mobileCourseCheckbox" required>
                                        <label class="custom-control-label custom--control-label" for="mobileCourseCheckbox"></label>
                                    </div><!-- end custom-control -->
                                    <div class="course-item-content">
                                        <h4 class="fs-15"> Amusons-nous - Sérieusement !</h4>
                                        <div class="courser-item-meta-wrap">
                                            <p class="course-item-meta"><i class="la la-play-circle"></i>2min</p>
                                        </div>
                                    </div><!-- end course-item-content -->
                                </div><!-- end course-item-content-wrap -->
                            </li>
                            <li class="course-item-link">
                                <div class="course-item-content-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="mobileCourseCheckbox2" required>
                                        <label class="custom-control-label custom--control-label" for="mobileCourseCheckbox2"></label>
                                    </div><!-- end custom-control -->
                                    <div class="course-item-content">
                                        <h4 class="fs-15">2. Un concept simple pour avancer</h4>
                                        <div class="courser-item-meta-wrap">
                                            <p class="course-item-meta"><i class="la la-play-circle"></i>2min</p>
                                        </div>
                                    </div><!-- end course-item-content -->
                                </div><!-- end course-item-content-wrap -->
                            </li>
                            <li class="course-item-link active-resource">
                                <div class="course-item-content-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="mobileCourseCheckbox3" required>
                                        <label class="custom-control-label custom--control-label" for="mobileCourseCheckbox3"></label>
                                    </div><!-- end custom-control -->
                                    <div class="course-item-content">
                                        <h4 class="fs-15">3. Téléchargez vos séquences pour votre démarrage rapide</h4>
                                        <div class="courser-item-meta-wrap">
                                            <p class="course-item-meta"><i class="la la-file"></i>2min</p>
                                            <div class="generic-action-wrap">
                                                <div class="dropdown">
                                                    <a class="btn theme-btn theme-btn-sm theme-btn-transparent mt-1 fs-14 font-weight-medium" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la la-folder-open mr-1"></i> Ressources<i class="la la-angle-down ml-1"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            Section-Footage.zip
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!-- end generic-action-wrap -->
                                        </div>
                                    </div><!-- end course-item-content -->
                                </div><!-- end course-item-content-wrap -->
                            </li>
                            <li class="course-item-link">
                                <div class="course-item-content-wrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="mobileCourseCheckbox4" required>
                                        <label class="custom-control-label custom--control-label" for="mobileCourseCheckbox4"></label>
                                    </div><!-- end custom-control -->
                                    <div class="course-item-content">
                                        <h4 class="fs-15">4. Lancez-vous et animez votre personnage</h4>
                                        <div class="courser-item-meta-wrap">
                                            <p class="course-item-meta"><i class="la la-play-circle"></i>2min</p>
                                        </div>
                                    </div><!-- end course-item-content -->
                                </div><!-- end course-item-content-wrap -->
                            </li>
                        </ul>
                    </div><!-- end card-body -->
                </div><!-- end collapse -->
            </div><!-- end card -->
           
        </div><!-- end accordion-->
    </div><!-- end mobile-course-menu -->
</div><!-- end tab-pane -->
<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
    <div class="lecture-overview-wrap">
        <div class="lecture-overview-item">
            <h3 class="fs-24 font-weight-semi-bold pb-2">À propos de ce cours</h3>
            <p>{{ $course->course->course_title }}</p>
        </div><!-- end lecture-overview-item -->
        <div class="section-block"></div>
        <div class="lecture-overview-item">
            <div class="lecture-overview-stats-wrap d-flex">
                <div class="lecture-overview-stats-item">
                    <h3 class="fs-16 font-weight-semi-bold pb-2">Par les chiffres</h3>
                </div><!-- end lecture-overview-stats-item -->
                <div class="lecture-overview-stats-item">
                    <ul class="generic-list-item">
                    <li><span>Niveau de compétence :</span>{{ $course->course->label }}</li>
                    <li><span>Langues :</span>Français</li>
                        
                    </ul>
                </div><!-- end lecture-overview-stats-item -->
                <div class="lecture-overview-stats-item">
                    <ul class="generic-list-item">
                    <li><span>Ressources :</span>{{ $course->course->resources }}</li>
                    <li><span>Durée de la vidéo :</span>{{ $course->course->duration }} heures au total</li>
                    <li><span>Certificat :</span>{{ $course->course->certificate }}</li>

                    </ul>
                </div><!-- end lecture-overview-stats-item -->
            </div><!-- end lecture-overview-stats-wrap -->
        </div><!-- end lecture-overview-item -->
        <div class="section-block"></div>
        <div class="lecture-overview-item">
            <div class="lecture-overview-stats-wrap d-flex">
                <div class="lecture-overview-stats-item">
                    <h3 class="fs-16 font-weight-semi-bold pb-2">Certificats</h3>
                </div><!-- end lecture-overview-stats-item -->
                <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                    <p class="pb-3">Obtenez un certificat Aduca en complétant l'intégralité du cours</p>
                    <a href="#" class="btn theme-btn theme-btn-transparent">Certificat Aduca</a>
                </div><!-- end lecture-overview-stats-item -->
            </div><!-- end lecture-overview-stats-wrap -->
        </div><!-- end lecture-overview-item -->
        <div class="section-block"></div>
        <div class="lecture-overview-item">
            <div class="lecture-overview-stats-wrap d-flex">
                <div class="lecture-overview-stats-item">
                    <h3 class="fs-16 font-weight-semi-bold pb-2">Caractéristiques</h3>
                    </div><!-- end lecture-overview-stats-item -->
            <div class="lecture-overview-stats-item">
                <p>Disponible sur <a href="#" class="text-color hover-underline">IOS</a> et <a href="#" class="text-color hover-underline">Android</a></p>
            </div><!-- end lecture-overview-stats-item -->
            </div><!-- end lecture-overview-stats-wrap -->
            </div><!-- end lecture-overview-item -->
            <div class="section-block"></div>
            <div class="lecture-overview-item">
                <div class="lecture-overview-stats-wrap d-flex">
                    <div class="lecture-overview-stats-item">
                        <h3 class="fs-16 font-weight-semi-bold pb-2">Description</h3>
                    </div><!-- end lecture-overview-stats-item -->
                    <div class="lecture-overview-stats-item lecture-overview-stats-wide-item lecture-description">
                        <h3 class="fs-16 font-weight-semi-bold pb-2">De l'auteur du cours complet After Effects CC 2020</h3>
                        <p> {!! $course->course->description !!} </p>
                    </div><!-- end lecture-overview-stats-item -->
                </div><!-- end lecture-overview-stats-wrap -->
            </div><!-- end lecture-overview-item -->
            <div class="section-block"></div>

       
    </div><!-- end lecture-overview-wrap -->
</div><!-- end tab-pane -->

Si vous avez besoin d'autres traductions ou d'assistance, n'hésitez pas à demander !
<div class="tab-pane fade" id="announcements" role="tabpanel" aria-labelledby="announcements-tab">
    <div class="lecture-overview-wrap lecture-announcement-wrap">
        <div class="lecture-overview-item">
            <div class="media media-card align-items-center">
                <a href="teacher-detail.html" class="media-img d-block rounded-full avatar-md">
                    <img src="images/small-avatar-1.jpg" alt="Instructor avatar" class="rounded-full">
                </a>
                <div class="media-body">
                    <h5 class="pb-1"><a href="teacher-detail.html">Alex Smith</a></h5>
                    <div class="announcement-meta fs-15">
                        <span>Posted an announcement</span>
                        <span> · 3 years ago ·</span>
                        <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Report abuse"><i class="la la-flag"></i></a>
                    </div>
                </div>
            </div>
            <div class="lecture-owner-decription pt-4">
                <h3 class="fs-19 font-weight-semi-bold pb-3">Important Q&A support</h3>
                <p>Happy 2019 to everyone, thank you for being a student and all of your support.</p>
                <p><strong>Great job on enrolling and your current course progress.  I encourage you keep in pursuit of your dreams :)</strong></p>
                <p>The whole lot. In my course After Effects Complete Course packed with all Techniques and Methods (No Tricks and gimmicks).</p>
                <p class="font-italic"><strong>Unfortunately this will result in delayed responses by me in the Q&A section and to direct messages.  This is only for the next week  and once back I will be back to 100% .</strong></p>
                <p>I will continue to do my best to respond to as many questions as possible but only one person, regularly I spend 4-5 hours daily on this and with over 440000 students as you can image that its a lot of work.</p>
                <p class="font-italic">Thank you once again for your understanding and for all of the wonderful students who I have had an opportunity to communicate with regularly and all of your encouragement.</p>
                <p>Have an awesome day</p>
                <p>Alex</p>
            </div>
            <div class="lecture-announcement-comment-wrap pt-4">
                <div class="media media-card align-items-center">
                    <div class="media-img rounded-full avatar-sm flex-shrink-0">
                        <img src="images/small-avatar-1.jpg" alt="Instructor avatar" class="rounded-full">
                    </div><!-- end media-img -->
                    <div class="media-body">
                        <form action="#">
                            <div class="input-group">
                                <input class="form-control form--control form--control-gray pl-3" type="text" name="search" placeholder="Enter your comment">
                                <div class="input-group-append">
                                    <button class="btn theme-btn" type="button"><i class="la la-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div><!-- end media-body -->
                </div><!-- end media -->
                <div class="comments pt-40px">
                    <div class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                        <div class="media-img rounded-full avatar-sm flex-shrink-0">
                            <img src="images/small-avatar-2.jpg" alt="Instructor avatar" class="rounded-full">
                        </div><!-- end media-img -->
                        <div class="media-body">
                            <div class="announcement-meta fs-15 lh-20">
                                <a href="#" class="text-color">Tony Olsson</a>
                                <span> · 3 years ago ·</span>
                                <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Report abuse"><i class="la la-flag"></i></a>
                            </div>
                            <p class="pt-1">Occaecati cupiditate non provident, similique sunt in culpa fuga.</p>
                        </div><!-- end media-body -->
                    </div><!-- end media -->
                    <div class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                        <div class="media-img rounded-full avatar-sm flex-shrink-0">
                            <img src="images/small-avatar-3.jpg" alt="Instructor avatar" class="rounded-full">
                        </div><!-- end media-img -->
                        <div class="media-body">
                            <div class="announcement-meta fs-15 lh-20">
                                <a href="#" class="text-color">Eduard-Dan</a>
                                <span> · 2 years ago ·</span>
                                <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Report abuse"><i class="la la-flag"></i></a>
                            </div>
                            <p class="pt-1">Occaecati cupiditate non provident, similique sunt in culpa fuga.</p>
                        </div><!-- end media-body -->
                    </div><!-- end media -->
                </div><!-- end comments -->
            </div><!-- end lecture-announcement-comment-wrap -->
        </div><!-- end lecture-overview-item -->
    </div>
</div><!-- end tab-pane -->
</div><!-- end tab-content -->
</div><!-- end lecture-video-detail-body -->
</div><!-- end lecture-video-detail -->
<div class="cta-area py-4 bg-gray">
<div class="container-fluid">
<div class="row align-items-center">
<div class="col-lg-6">
    <div class="cta-content-wrap">
        <h3 class="fs-18 font-weight-semi-bold">Top companies choose <a href="for-business.html" class="text-color hover-underline">Aduca for Business</a> to build in-demand career skills.</h3>
    </div>
</div><!-- end col-lg-6 -->
<div class="col-lg-6">
    <div class="client-logo-wrap text-right">
        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="{{ asset('frontend/images/sponsor-img.png') }}" alt="brand image"></a>
        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="{{ asset('frontend/images/sponsor-img2.png') }}" alt="brand image"></a>
        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="{{ asset('frontend/images/sponsor-img3.png') }}" alt="brand image"></a>
    </div><!-- end client-logo-wrap -->
</div><!-- end col-lg-6 -->
</div><!-- end row -->
</div><!-- end container-fluid -->
</div><!-- end cta-area -->
@include('frontend.mycourse.body.footer')

</div><!-- end course-dashboard-column -->
<div class="course-dashboard-sidebar-column">
<button class="sidebar-open" type="button"><i class="la la-angle-left"></i> Course content</button>
<div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
<div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
<h3 class="fs-18 font-weight-semi-bold">Course content</h3>
<button class="sidebar-close" type="button"><i class="la la-times"></i></button>
</div><!-- end course-dashboard-side-heading -->
<div class="course-dashboard-side-content">
<div class="accordion generic-accordion generic--accordion" id="accordionCourseExample">





@foreach ($section as $sec)
    <div class="card">
        <div class="card-header" id="headingOne{{ $sec->id }}">
            <button class="btn btn-link" type="button" data-toggle="collapse"
                    data-target="#collapseOne{{ $sec->id }}"
                    aria-expanded="true"
                    aria-controls="collapseOne">
                <i class="la la-angle-down"></i>
                <i class="la la-angle-up"></i>
            </button>
        </div><!-- end card-header -->
        <div id="collapseOne{{ $sec->id }}" class="collapse show"
             aria-labelledby="headingOne{{ $sec->id }}"
             data-parent="#accordionCourseExample">
            <div class="card-body p-0">
                <ul class="curriculum-sidebar-list">
                    <li class="course-item-link active">
                        <div class="course-item-content-wrap">
                            <div class="course-item-content">
                                <h4 class="fs-15 lecture-title"
                                    data-video-url="{{ $sec->video_url }}">
                                    {{ $sec->section_title }}
                                </h4>
                            </div><!-- end course-item-content -->
                        </div><!-- end course-item-content-wrap -->
                    </li>
                </ul>
            </div><!-- end card-body -->
        </div><!-- end collapse -->
    </div><!-- end card -->
@endforeach
 





                        </div><!-- end accordion-->
                    </div><!-- end course-dashboard-side-content -->
                </div><!-- end course-dashboard-sidebar-wrap -->

    
          
            
    

          
       
  
            </div><!-- end course-dashboard-sidebar-column -->
        </div><!-- end course-dashboard-container -->
    </div><!-- end course-dashboard-wrap -->
</section><!-- end course-dashboard -->
<!--======================================
        END COURSE-DASHBOARD
======================================-->
<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->
<!-- Modal -->
<div class="modal fade modal-container" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="ratingModalTitle">
                        How would you rate this course?
                    </h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body text-center py-5">
                <div class="leave-rating mt-5">
                    <input type="radio" name='rate' id="star5"/>
                    <label for="star5" class="fs-45"></label>
                    <input type="radio" name='rate' id="star4"/>
                    <label for="star4" class="fs-45"></label>
                    <input type="radio" name='rate' id="star3"/>
                    <label for="star3" class="fs-45"></label>
                    <input type="radio" name='rate' id="star2"/>
                    <label for="star2" class="fs-45"></label>
                    <input type="radio" name='rate' id="star1"/>
                    <label for="star1" class="fs-45"></label>
                    <div class="rating-result-text fs-20 pb-4"></div>
                </div><!-- end leave-rating -->
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->
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
                        <input type="text" class="form-control form--control copy-input pl-3" value="https://www.aduca.com/share/101WxMB0oac1hVQQ==/">
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
<!-- Modal -->
<div class="modal fade modal-container" id="insertLinkModal" tabindex="-1" role="dialog" aria-labelledby="insertLinkModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="insertLinkModalTitle">Insert Link</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form action="#">
                    <div class="input-box">
                        <label class="label-text">URL</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text" placeholder="Url">
                            <i class="la la-link input-icon"></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Text</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text" placeholder="Text">
                            <i class="la la-pencil input-icon"></i>
                        </div>
                    </div>
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Insert <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->
<!-- Modal -->
<div class="modal fade modal-container" id="uploadPhotoModal" tabindex="-1" role="dialog" aria-labelledby="uploadPhotoModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="uploadPhotoModalTitle">Upload an Image</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <div class="file-upload-wrap">
                    <input type="file" name="files[]" class="multi file-upload-input" multiple>
                    <span class="file-upload-text"><i class="la la-upload mr-2"></i>Drop files here or click to upload</span>
                </div><!-- file-upload-wrap -->
                <div class="btn-box text-right pt-2">
                    <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Submit <i class="la la-arrow-right icon ml-1"></i></button>
                </div>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->


<script type="text/javascript">
    // Function to open the first lecture when the page loads
    function openFirstLecture() {
        const firstLecture = document.querySelector('.lecture-title'); // Get the first lecture element
        if (firstLecture) {
            firstLecture.click(); // Trigger the click event on the first lecture
        }
    }
    // Function to handle lecture clicks and load content
    function viewLesson(videoUrl, vimeoUrl, textContent) {
        const video = document.getElementById("videoContainer");
        const text = document.getElementById("textLesson");
        const textContainer = document.createElement("div");
        if (videoUrl && videoUrl.trim() !== "") {
            video.classList.remove("d-none");
            text.classList.add("d-none");
            text.innerHTML = "";
            video.setAttribute("src", videoUrl);
        } else if (vimeoUrl && vimeoUrl.trim() !== "") {
            video.classList.remove("d-none");
            text.classList.add("d-none");
            text.innerHTML = "";
            video.setAttribute("src", vimeoUrl);
        } else if (textContent && textContent.trim() !== "") {
            video.classList.add("d-none");
            text.classList.remove("d-none");
            text.innerHTML = "";
            textContainer.innerText = textContent;
            textContainer.style.fontSize = "14px";
            textContainer.style.textAlign = "left";
            textContainer.style.paddingLeft = "40px";
            textContainer.style.paddingRight = "40px";
            text.appendChild(textContainer);
        }
    }
    // Add a click event listener to all lecture elements
    document.querySelectorAll('.lecture-title').forEach((lectureTitle) => {
        lectureTitle.addEventListener('click', () => {
            const videoUrl = lectureTitle.getAttribute('data-video-url');
            const vimeoUrl = lectureTitle.getAttribute('data-vimeo-url');
            const textContent = lectureTitle.getAttribute('data-content');
            viewLesson(videoUrl, vimeoUrl, textContent);
        });
    });
    // Open the first lecture when the page loads
    window.addEventListener('load', () => {
        openFirstLecture();
    });
</script>






@include('frontend.mycourse.body.footer')
</body>
</html>