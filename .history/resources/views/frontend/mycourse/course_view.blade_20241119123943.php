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
        
        <div class="section-block"></div>
        <div class="lecture-overview-item">
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
<div class="tab-pane fade" id="question-and-ans" role="tabpanel" aria-labelledby="question-and-ans-tab">
    <div class="lecture-overview-wrap lecture-quest-wrap">
        <div class="new-question-wrap">
            <button class="btn theme-btn theme-btn-transparent back-to-question-btn"><i class="la la-reply mr-1"></i>Retour à toutes les questions</button>
            <div class="new-question-body pt-40px">
                <h3 class="fs-20 font-weight-semi-bold">Ma question concerne</h3>
                <form action="#" class="pt-4">
                    <div class="custom-control-wrap">
                        <div class="custom-control custom-radio mb-3 pl-0">
                            <input type="radio" class="custom-control-input" id="courseContentRadio" name="radio-stacked" required>
                            <label class="custom-control-label custom--control-label custom--control-label-boxed" for="courseContentRadio">
                                <span class="font-weight-semi-bold text-black d-block">Contenu du cours</span>
                                <span class="d-block fs-14 lh-20">Cela peut inclure des commentaires, des questions, des conseils ou des projets à partager</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio mb-3 pl-0">
                            <input type="radio" class="custom-control-input" id="somethingElseRadio" name="radio-stacked" required>
                            <label class="custom-control-label custom--control-label custom--control-label-boxed" for="somethingElseRadio">
                                <span class="font-weight-semi-bold text-black d-block">Autre chose</span>
                                <span class="d-block fs-14 lh-20">Cela peut inclure des questions sur les certificats, des problèmes audio et vidéo, ou des problèmes de téléchargement</span>
                            </label>
                        </div>
                    </div>
                    <div class="btn-box text-center">
                        <button class="btn theme-btn w-100">Continuer <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div>
        </div><!-- fin new-question-wrap -->
        <div class="replay-question-wrap">
            <button class="btn theme-btn theme-btn-transparent back-to-question-btn"><i class="la la-reply mr-1"></i>Retour à toutes les questions</button>
            <div class="replay-question-body pt-30px">
                <div class="question-list-item">
                    <div class="media media-card border-bottom border-bottom-gray py-4">
                        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                            <img class="rounded-full" src="images/small-avatar-1.jpg" alt="Image de l'utilisateur">
                        </div>
                        <div class="media-body">
                            <div class="d-flex justify-content-between">
                                <div class="question-meta-content">
                                    <h5 class="fs-16 pb-1">Je n'ai toujours pas obtenu H264 après avoir installé Quicktime. Que dois-je faire ?</h5>
                                    <p class="meta-tags fs-13">
                                        <a href="#">Alex Smith</a>
                                        <a href="#">Cours 20</a>
                                        <span>Il y a 3 heures</span>
                                    </p>
                                    <p class="fs-15 text-gray">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        Ut enim ad minim veniam, quis nostrud exercitation.
                                    </p>
                                </div><!-- fin question-meta-content -->
                                <div class="question-upvote-action">
                                    <div class="number-upvotes pb-2 d-flex align-items-center generic-action-wrap">
                                        <span>1</span>
                                        <button type="button"><i class="la la-arrow-up"></i></button>
                                        <div class="dropdown">
                                            <button class="ml-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="la la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#reportModal"><i class="la la-flag mr-1"></i> Signaler un abus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- fin question-upvote-action -->
                            </div>
                        </div><!-- fin media-body -->
                    </div><!-- fin media -->
                    <div class="question-replay-separator-wrap d-flex align-items-center justify-content-between py-3">
                        <h4 class="fs-16 font-weight-semi-bold">1 Réponse</h4>
                        <button class="btn swapping-btn text-gray font-weight-medium" data-text-swap="Réponses suivantes" data-text-original="Suivre les réponses">Suivre les réponses</button>
                    </div><!-- fin question-replay-separator-wrap -->
                    <div class="section-block"></div>
                    <div class="question-answer-wrap">
                        <div class="media media-card mb-3 border-bottom border-bottom-gray py-4">
                            <div class="media-img rounded-full avatar-sm flex-shrink-0">
                                <img src="images/small-avatar-2.jpg" alt="Avatar de l'instructeur" class="rounded-full">
                            </div><!-- fin media-img -->
                            <div class="media-body">
                                <h5 class="fs-16"><a href="#">David Luise</a></h5>
                                <span class="fs-14">Il y a 3 ans</span>
                                <p class="pt-1 fs-15">Occaecati cupiditate non provident, similique sunt in culpa fuga.</p>
                            </div><!-- fin media-body -->
                        </div><!-- fin media -->
                        <div class="question-replay-input-wrap pt-20px">
                            <div class="question-replay-body">
                                <h3 class="fs-16 font-weight-semi-bold">Ajouter une réponse</h3>
                                <form method="post" class="pt-4">
                                    <div class="replay-action-bar">
                                        <div class="btn-group">
                                            <button class="btn" type="button" data-toggle="modal" data-target="#insertLinkModal" title="Insérer un lien"><i class="la la-link"></i></button>
                                            <button class="btn" type="button" data-toggle="modal" data-target="#uploadPhotoModal" title="Télécharger une image"><i class="la la-photo"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control form--control pl-3" name="message" rows="4" placeholder="Écrivez votre réponse..."></textarea>
                                    </div>
                                    <div class="btn-box">
                                        <button class="btn theme-btn" type="submit">Ajouter une réponse <i class="la la-arrow-right icon ml-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- fin question-replay-input-wrap -->
                    </div><!-- fin question-answer-wrap -->
                </div><!-- fin question-list-item -->
            </div><!-- fin replay-question-body -->
        </div><!-- fin replay-question-wrap -->
        <div class="question-overview-result-wrap">
            <div class="lecture-overview-item">
                <form method="post">
                    <div class="input-group mb-3">
                        <input class="form-control form--control form--control-gray pl-3" type="text" name="search" placeholder="Rechercher toutes les questions du cours">
                        <div class="input-group-append">
                            <button class="btn theme-btn"><i class="la la-search search-icon"></i></button>
                        </div>
                    </div>
                </form>
                <div class="question-overview-filter-wrap d-flex align-items-center">
                    <div class="question-overview-filter-item">
                        <div class="select-container w-100">
                            <select class="select-container-select">
                                <option value="0">Tous les cours</option>
                                <option value="1">Cours actuel</option>
                            </select>
                        </div>
                    </div><!-- fin question-overview-filter-item -->
                    <div class="question-overview-filter-item">
                        <div class="select-container w-100">
                            <select class="select-container-select">
                                <option value="0">Trier par le plus récent</option>
                                <option value="1">Trier par le plus voté</option>
                                <option value="2">Trier par recommandé</option>
                            </select>
                        </div>
                    </div><!-- fin question-overview-filter-item -->
                    <div class="question-overview-filter-item">
                        <div class="generic-action-wrap">
                            <div class="dropdown">
                                <a class="btn theme-btn theme-btn-transparent w-100" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filtrer les questions
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox fs-15">
                                            <input type="checkbox" class="custom-control-input" id="questionsCheckbox" required>
                                            <label class="custom-control-label custom--control-label" for="questionsCheckbox">
                                                Questions que je suis
                                            </label>
                                        </div><!-- fin custom-control -->
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox fs-15">
                                            <input type="checkbox" class="custom-control-input" id="questionsCheckbox2" required>
                                            <label class="custom-control-label custom--control-label" for="questionsCheckbox2">
                                                Questions que j'ai posées
                                            </label>
                                        </div><!-- fin custom-control -->
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox fs-15">
                                            <input type="checkbox" class="custom-control-input" id="questionsCheckbox3" required>
                                            <label class="custom-control-label custom--control-label" for="questionsCheckbox3">
                                                Questions sans réponses
                                            </label>
                                        </div><!-- fin custom-control -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- fin generic-action-wrap -->
                    </div><!-- fin question-overview-filter-item -->
                </div>
            </div><!-- fin lecture-overview-item -->
            <div class="lecture-overview-item">
                <div class="question-overview-result-header d-flex align-items-center justify-content-between">
                    <h3 class="fs-17 font-weight-semi-bold">30 questions dans ce cours</h3>
                    <button class="btn theme-btn theme-btn-sm theme-btn-transparent ask-new-question-btn">Poser une nouvelle question</button>
                </div>
            </div><!-- fin lecture-overview-item -->
            <div class="section-block"></div>
            <div class="lecture-overview-item mt-0">
                <div class="question-list-item">
                    <div class="media media-card border-bottom border-bottom-gray py-4 px-3">
                        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                            <img class="rounded-full" src="images/small-avatar-1.jpg" alt="Image de l'utilisateur">
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="question-meta-content">
                                    <a href="javascript:void(0)" class="d-block">
                                        <h5 class="fs-16 pb-1">Je n'ai toujours pas obtenu H264 après avoir installé Quicktime. Que dois-je faire ?</h5>
                                        <p class="text-truncate fs-15 text-gray">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation.
                                        </p>
                                    </a>
                                </div><!-- fin question-meta-content -->
                                <div class="question-upvote-action">
                                    <div class="number-upvotes pb-2 d-flex align-items-center">
                                        <span>1</span>
                                        <button type="button"><i class="la la-arrow-up"></i></button>
                                    </div>
                                    <div class="number-upvotes question-response d-flex align-items-center">
                                        <span>1</span>
                                        <button type="button" class="question-replay-btn"><i class="la la-comments"></i></button>
                                    </div>
                                </div><!-- fin question-upvote-action -->
                            </div>
                            <p class="meta-tags pt-1 fs-13">
                                <a href="#">Alex Smith</a>
                                <a href="#">Cours 20</a>
                                <span>Il y a 3 heures</span>
                            </p>
                        </div><!-- fin media-body -->
                    </div><!-- fin media -->
                    <div class="media media-card border-bottom border-bottom-gray py-4 px-3">
                        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                            <img class="rounded-full" src="images/small-avatar-2.jpg" alt="Image de l'utilisateur">
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="question-meta-content">
                                    <a href="javascript:void(0)" class="d-block">
                                        <h5 class="fs-16 pb-1">Quand j'ai sélectionné le rectangle et que je l'ai placé, cela crée un masque ? Je ne peux pas résoudre cela.</h5>
                                        <p class="text-truncate fs-15 text-gray">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation.
                                        </p>
                                    </a>
                                </div><!-- fin question-meta-content -->
                                <div class="question-upvote-action">
                                    <div class="number-upvotes pb-2 d-flex align-items-center">
                                        <span>0</span>
                                        <button type="button"><i class="la la-arrow-up"></i></button>
                                    </div>
                                    <div class="number-upvotes question-response d-flex align-items-center">
                                        <span>0</span>
                                        <button type="button" class="question-replay-btn"><i class="la la-comments"></i></button>
                                    </div>
                                </div><!-- fin question-upvote-action -->
                            </div>
                            <p class="meta-tags pt-1 fs-13">
                                <a href="#">Alex Smith</a>
                                <a href="#">Cours 20</a>
                                <span>Il y a 3 heures</span>
                            </p>
                        </div><!-- fin media-body -->
                    </div><!-- fin media -->
                    <div class="media media-card border-bottom border-bottom-gray py-4 px-3">
                        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                            <img class="rounded-full" src="images/small-avatar-3.jpg" alt="Image de l'utilisateur">
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="question-meta-content">
                                    <a href="javascript:void(0)" class="d-block">
                                        <h5 class="fs-16 pb-1">Activité de pratique</h5>
                                        <p class="text-truncate fs-15 text-gray">
                                            https://youtu.be/fzyAWYKh2pgg
                                        </p>
                                    </a>
                                </div><!-- fin question-meta-content -->
                                <div class="question-upvote-action">
                                    <div class="number-upvotes pb-2 d-flex align-items-center">
                                        <span>0</span>
                                        <button type="button"><i class="la la-arrow-up"></i></button>
                                    </div>
                                    <div class="number-upvotes question-response d-flex align-items-center">
                                        <span>0</span>
                                        <button type="button" class="question-replay-btn"><i class="la la-comments"></i></button>
                                    </div>
                                </div><!-- fin question-upvote-action -->
                            </div>
                            <p class="meta-tags pt-1 fs-13">
                                <a href="#">Alex Smith</a>
                                <a href="#">Cours 20</a>
                                <span>Il y a 3 heures</span>
                            </p>
                        </div><!-- fin media-body -->
                    </div><!-- fin media -->
                    <div class="media media-card border-bottom border-bottom-gray py-4 px-3">
                        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                            <img class="rounded-full" src="images/small-avatar-4.jpg" alt="Image de l'utilisateur">
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="question-meta-content">
                                    <a href="javascript:void(0)" class="d-block">
                                        <h5 class="fs-16 pb-1">La composition de l'homme qui marche.</h5>
                                        <p class="text-truncate fs-15 text-gray">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation.
                                        </p>
                                    </a>
                                </div><!-- fin question-meta-content -->
                                <div class="question-upvote-action">
                                    <div class="number-upvotes pb-2 d-flex align-items-center">
                                        <span>0</span>
                                        <button type="button"><i class="la la-arrow-up"></i></button>
                                    </div>
                                    <div class="number-upvotes question-response d-flex align-items-center">
                                        <span>0</span>
                                        <button type="button" class="question-replay-btn"><i class="la la-comments"></i></button>
                                    </div>
                                </div><!-- fin question-upvote-action -->
                            </div>
                            <p class="meta-tags pt-1 fs-13">
                                <a href="#">Alex Smith</a>
                                <a href="#">Cours 20</a>
                                <span>Il y a 3 heures</span>
                            </p>
                        </div><!-- fin media-body -->
                    </div><!-- fin media -->
                    <div class="media media-card border-bottom border-bottom-gray py-4 px-3">
                        <div class="media-img rounded-full flex-shrink-0 avatar-sm">
                            <img class="rounded-full" src="images/small-avatar-5.jpg" alt="Image de l'utilisateur">
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="question-meta-content">
                                    <a href="javascript:void(0)" class="d-block">
                                        <h5 class="fs-16 pb-1">Options d'enregistrement</h5>
                                        <p class="text-truncate fs-15 text-gray">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation.
                                        </p>
                                    </a>
                                </div><!-- fin question-meta-content -->
                                <div class="question-upvote-action">
                                    <div class="number-upvotes pb-2 d-flex align-items-center">
                                        <span>0</span>
                                        <button type="button"><i class="la la-arrow-up"></i></button>
                                    </div>
                                    <div class="number-upvotes question-response d-flex align-items-center">
                                        <span>0</span>
                                        <button type="button" class="question-replay-btn"><i class="la la-comments"></i></button>
                                    </div>
                                </div><!-- fin question-upvote-action -->
                            </div>
                            <p class="meta-tags pt-1 fs-13">
                                <a href="#">Alex Smith</a>
                                <a href="#">Cours 20</a>
                                <span>Il y a 3 heures</span>
                            </p>
                        </div><!-- fin media-body -->
                    </div><!-- fin media -->
                </div>
                <div class="question-btn-box pt-35px text-center">
                    <button class="btn theme-btn theme-btn-transparent w-100" type="button">Voir plus</button>
                </div>
            </div><!-- fin lecture-overview-item -->
        </div>
    </div>
</div><!-- fin tab-pane --><div class="tab-pane fade" id="announcements" role="tabpanel" aria-labelledby="announcements-tab">
    <div class="lecture-overview-wrap lecture-announcement-wrap">
        <div class="lecture-overview-item">
            <div class="media media-card align-items-center">
                <a href="teacher-detail.html" class="media-img d-block rounded-full avatar-md">
                    <img src="images/small-avatar-1.jpg" alt="Avatar de l'instructeur" class="rounded-full">
                </a>
                <div class="media-body">
                    <h5 class="pb-1"><a href="teacher-detail.html">Alex Smith</a></h5>
                    <div class="announcement-meta fs-15">
                        <span>A publié une annonce</span>
                        <span> · Il y a 3 ans ·</span>
                        <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Signaler un abus"><i class="la la-flag"></i></a>
                    </div>
                </div>
            </div>
            <div class="lecture-owner-decription pt-4">
                <h3 class="fs-19 font-weight-semi-bold pb-3">Support Q&A important</h3>
                <p>Bonne année 2019 à tous, merci d'être étudiant et pour tout votre soutien.</p>
                <p><strong>Félicitations pour votre inscription et vos progrès dans le cours actuel. Je vous encourage à poursuivre vos rêves :)</strong></p>
                <p>Tout cela. Dans mon cours "Cours complet After Effects" rempli de toutes les techniques et méthodes (pas de trucs ni de gimmicks).</p>
                <p class="font-italic"><strong>Malheureusement, cela entraînera des réponses retardées de ma part dans la section Q&A et aux messages directs. Cela ne durera qu'une semaine et une fois de retour, je serai à 100%.</strong></p>
                <p>Je continuerai à faire de mon mieux pour répondre à autant de questions que possible, mais je ne suis qu'une seule personne. En général, je passe 4 à 5 heures par jour sur cela et avec plus de 440 000 étudiants, comme vous pouvez l'imaginer, c'est beaucoup de travail.</p>
                <p class="font-italic">Merci encore pour votre compréhension et pour tous les merveilleux étudiants avec qui j'ai eu l'occasion de communiquer régulièrement et pour tout votre encouragement.</p>
                <p>Passez une excellente journée</p>
                <p>Alex</p>
            </div>
            <div class="lecture-announcement-comment-wrap pt-4">
                <div class="media media-card align-items-center">
                    <div class="media-img rounded-full avatar-sm flex-shrink-0">
                        <img src="images/small-avatar-1.jpg" alt="Avatar de l'instructeur" class="rounded-full">
                    </div><!-- fin media-img -->
                    <div class="media-body">
                        <form action="#">
                            <div class="input-group">
                                <input class="form-control form--control form--control-gray pl-3" type="text" name="search" placeholder="Entrez votre commentaire">
                                <div class="input-group-append">
                                    <button class="btn theme-btn" type="button"><i class="la la-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div><!-- fin media-body -->
                </div><!-- fin media -->
                <div class="comments pt-40px">
                    <div class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                        <div class="media-img rounded-full avatar-sm flex-shrink-0">
                            <img src="images/small-avatar-2.jpg" alt="Avatar de l'instructeur" class="rounded-full">
                        </div><!-- fin media-img -->
                        <div class="media-body">
                            <div class="announcement-meta fs-15 lh-20">
                                <a href="#" class="text-color">Tony Olsson</a>
                                <span> · Il y a 3 ans ·</span>
                                <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Signaler un abus"><i class="la la-flag"></i></a>
                            </div>
                            <p class="pt-1">Occaecati cupiditate non provident, similique sunt in culpa fuga.</p>
                        </div><!-- fin media-body -->
                    </div><!-- fin media -->
                    <div class="media media-card mb-3 border-bottom border-bottom-gray pb-3">
                        <div class="media-img rounded-full avatar-sm flex-shrink-0">
                            <img src="images/small-avatar-3.jpg" alt="Avatar de l'instructeur" class="rounded-full">
                        </div><!-- fin media-img -->
                        <div class="media-body">
                            <div class="announcement-meta fs-15 lh-20">
                                <a href="#" class="text-color">Eduard-Dan</a>
                                <span> · Il y a 2 ans ·</span>
                                <a href="#" class="btn-text" data-toggle="modal" data-target="#reportModal" title="Signaler un abus"><i class="la la-flag"></i></a>
                            </div>
                            <p class="pt-1">Occaecati cupiditate non provident, similique sunt in culpa fuga.</p>
                        </div><!-- fin media-body -->
                    </div><!-- fin media -->
                </div><!-- fin comments -->
            </div><!-- fin lecture-announcement-comment-wrap -->
        </div><!-- fin lecture-overview-item -->
    </div>
</div><!-- fin tab-pane -->
</div><!-- fin tab-content -->
</div><!-- fin lecture-video-detail-body -->
</div><!-- fin lecture-video-detail -->
<div class="cta-area py-4 bg-gray">
<div class="container-fluid">
<div class="row align-items-center">
<div class="col-lg-6">
    <div class="cta-content-wrap">
        <h3 class="fs-18 font-weight-semi-bold">Les meilleures entreprises choisissent <a href="for-business.html" class="text-color hover-underline">Aduca pour les entreprises</a> pour développer des compétences professionnelles recherchées.</h3>
    </div>
</div><!-- fin col-lg-6 -->
<div class="col-lg-6">
    <div class="client-logo-wrap text-right">
        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="{{ asset('frontend/images/sponsor-img.png') }}" alt="image de marque"></a>
        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="{{ asset('frontend/images/sponsor-img2.png') }}" alt="image de marque"></a>
        <a href="#" class="client-logo-item client--logo-item-2 pr-3"><img src="{{ asset('frontend/images/sponsor-img3.png') }}" alt="image de marque"></a>
    </div><!-- fin client-logo-wrap -->
</div><!-- fin col-lg-6 -->
</div><!-- fin row -->
</div><!-- fin container-fluid -->
</div><!-- fin cta-area -->
@include('frontend.mycourse.body.footer')

</div><!-- fin course-dashboard-column -->
<div class="course-dashboard-sidebar-column">
<button class="sidebar-open" type="button"><i class="la la-angle-left"></i> Contenu du cours</button>
<div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
<div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
<h3 class="fs-18 font-weight-semi-bold">Contenu du cours</h3>
<button class="sidebar-close" type="button"><i class="la la-times"></i></button>
</div><!-- fin course-dashboard-side-heading -->
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
        </div><!-- fin card-header -->
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
                            </div><!-- fin course-item-content -->
                        </div><!-- fin course-item-content-wrap -->
                    </li>
                </ul>
            </div><!-- fin card-body -->
        </div><!-- fin collapse -->
    </div><!-- fin card -->
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
                        Comment évalueriez-vous ce cours ?
                    </h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- fin modal-header -->
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
                </div><!-- fin leave-rating -->
            </div><!-- fin modal-body -->
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div><!-- fin modal -->
<!-- Modal -->
<div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">Partager ce cours</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- fin modal-header -->
            <div class="modal-body">
                <div class="copy-to-clipboard">
                    <span class="success-message">Copié !</span>
                    <div class="input-group">
                        <input type="text" class="form-control form--control copy-input pl-3" value="https://www.aduca.com/share/101WxMB0oac1hVQQ==/">
                        <div class="input-group-append">
                            <button class="btn theme-btn theme-btn-sm copy-btn shadow-none"><i class="la la-copy mr-1"></i> Copier</button>
                        </div>
                    </div>
                </div><!-- fin copy-to-clipboard -->
            </div><!-- fin modal-body -->
            <div class="modal-footer justify-content-center border-top-gray">
                <ul class="social-icons social-icons-styled">
                    <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                    <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                    <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                </ul>
            </div><!-- fin modal-footer -->
        </div><!-- fin modal-content-->
    </div><!-- fin modal-dialog -->
</div><!-- fin modal -->
<!-- Modal -->
<div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Signaler un abus</h5>
                    <p class="pt-1 fs-14 lh-24">Le contenu signalé est examiné par le personnel d'Aduca pour déterminer s'il enfreint les Conditions d'utilisation ou les Directives de la communauté. Si vous avez une question ou un problème technique, veuillez contacter notre
                        <a href="contact.html" class="text-color hover-underline">équipe de support ici</a>.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- fin modal-header -->
            <div class="modal-body">
                <form method="post">
                    <div class="input-box">
                        <label class="label-text">Sélectionner le type de rapport</label>
                        <div class="form-group">
                            <div class="select-container w-auto">
                                <select class="select-container-select">
                                    <option value>-- Sélectionner un --</option>
                                    <option value="1">Contenu de cours inapproprié</option>
                                    <option value="2">Comportement inapproprié</option>
                                    <option value="3">Violation de la politique d'Aduca</option>
                                    <option value="4">Contenu spam</option>
                                    <option value="5">Autre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Écrire un message</label>
                        <div class="form-group">
                            <textarea class="form-control form--control pl-3" name="message" placeholder="Fournir des détails supplémentaires ici..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Soumettre <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div><!-- fin modal-body -->
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div><!-- fin modal -->
<!-- Modal -->
<div class="modal fade modal-container" id="insertLinkModal" tabindex="-1" role="dialog" aria-labelledby="insertLinkModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="insertLinkModalTitle">Insérer un lien</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- fin modal-header -->
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
                        <label class="label-text">Texte</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text" placeholder="Texte">
                            <i class="la la-pencil input-icon"></i>
                        </div>
                    </div>
                    <div class="btn-box text-right pt-2">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Insérer <i class="la la-arrow-right icon ml-1"></i></button>
                    </div>
                </form>
            </div><!-- fin modal-body -->
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div><!-- fin modal -->

<!-- Modal -->
<div class="modal fade modal-container" id="uploadPhotoModal" tabindex="-1" role="dialog" aria-labelledby="uploadPhotoModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="uploadPhotoModalTitle">Télécharger une image</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- fin modal-header -->
            <div class="modal-body">
                <div class="file-upload-wrap">
                    <input type="file" name="files[]" class="multi file-upload-input" multiple>
                    <span class="file-upload-text"><i class="la la-upload mr-2"></i>Déposez les fichiers ici ou cliquez pour télécharger</span>
                </div><!-- file-upload-wrap -->
                <div class="btn-box text-right pt-2">
                    <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Soumettre <i class="la la-arrow-right icon ml-1"></i></button>
                </div>
            </div><!-- fin modal-body -->
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div><!-- fin modal -->


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