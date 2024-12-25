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

</ul>
</div>
<div class="lecture-video-detail-body">
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
    
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
                   
                    <li><span>Durée de la vidéo :</span>{{ $course->course->duration }} heures au total</li>
                    <li><span>Certificat :</span>{{ $course->course->certificate }}</li>

                    </ul>
                </div><!-- end lecture-overview-stats-item -->
            </div><!-- end lecture-overview-stats-wrap -->
        </div><!-- end lecture-overview-item -->
        
        <div class="lecture-overview-item">
        </div><!-- end lecture-overview-item -->
       
        <div class="lecture-overview-item">
            <div class="lecture-overview-stats-wrap d-flex">
               
            <div class="lecture-overview-stats-item">
            </div><!-- end lecture-overview-stats-item -->
            </div><!-- end lecture-overview-stats-wrap -->
            </div><!-- end lecture-overview-item -->
            

       
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
        
        
    </div>
</div><!-- fin tab-pane --><div class="tab-pane fade" id="announcements" role="tabpanel" aria-labelledby="announcements-tab">
    
</div><!-- fin tab-pane -->
</div><!-- fin tab-content -->
</div><!-- fin lecture-video-detail-body -->
</div><!-- fin lecture-video-detail -->
<div class="cta-area py-4 bg-gray">
<div class="container-fluid">
<div class="row align-items-center">


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
                        <input type="text" class="form-control form--control copy-input pl-3" value="http://127.0.0.1:8000/{{ Request::path() }} ">
                        <div class="input-group-append">
                            <button class="btn theme-btn theme-btn-sm copy-btn shadow-none"><i class="la la-copy mr-1"></i> Copy</button>
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
<SCR






@include('frontend.mycourse.body.footer')
</body>
</html>