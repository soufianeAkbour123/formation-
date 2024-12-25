<section class="hero-area">
    <style>
        /* Card Grid Layout */
.card {
  display: flex;
  flex-direction: column;
  height: 510px;
  margin-bottom: 30px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.card-image {
  position: relative;
  padding-top: 56.25%;
  overflow: hidden;
}

.card-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-top-left-radius: 8px;  
  border-top-right-radius: 8px;
}

.card-body {
  flex: 1;
  padding: 20px;
  display: flex;
  flex-direction: column;
}

/* Course Badge Styles */
.course-badge-labels {
  position: absolute;
  top: 15px;
  left: 15px;
  z-index: 1;
}

.course-badge {
  font-size: 13px;
  padding: 5px 10px;
  border-radius: 3px;
  margin-bottom: 5px;
  background: #ffd700;
  color: #000;
}

.course-badge.blue {
  background: #007bff;
  color: #fff; 
}

.course-badge.sky-blue {
  background: #00bcd4;
  color: #fff;
}

/* Rating Stars */
.rating-wrap {
  margin: 10px 0;
}

.review-stars {
  color: #ffa808;
}

/* Price & Action Buttons */
.d-flex.justify-content-between {
  margin-top: auto;
}

.card-price {
  font-size: 18px;
  font-weight: 600;
}

.before-price {
  text-decoration: line-through;
  color: #999;
  margin-left: 8px;
}

.icon-element {
  width: 35px;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: #f5f5f5;
  margin-left: 8px;
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

/* Responsive */
@media (max-width: 767px) {
  .card {
    height: auto;
    min-height: 450px;
  }
  
  .card-body {
    padding: 15px;
  }
}

@media (min-width: 768px) and (max-width: 1199px) {
  .card {
    height: 500px;
  }
}

/* Grid Container */
.row {
  display: flex;
  flex-wrap: wrap;
  margin: -15px;
}

.col-lg-4 {
  padding: 15px;
  display: flex;
}

/* Level/Label Ribbon */
.ribbon {
  margin: 0 0 15px;
  font-size: 14px;
  font-weight: 500;
  color: #007bff;
}

.ribbon-blue-bg {
  background: rgba(0, 123, 255, 0.1);
  padding: 5px 10px;
  border-radius: 3px;
}
        </style>
    <!-- <style>
        .hero-slider-item {
  padding-top: 100px; /* Adjust the top padding as needed */
  padding-bottom: 100px; /* Adjust the bottom padding as needed */
}

.hero-content .section__title {
  font-size: 40px; /* Adjust the font size of the title */
  line-height: 50px; /* Adjust the line height of the title */
  padding-bottom: 20px; /* Adjust the bottom padding of the title */
}

.hero-content .section__desc {
  font-size: 16px; /* Adjust the font size of the description */
  line-height: 24px; /* Adjust the line height of the description */
  padding-bottom: 20px; /* Adjust the bottom padding of the description */
}

.hero-content .hero-btn-box {
  padding-top: 10px; /* Adjust the top padding of the button box */
}

.hero-content .btn.theme-btn,
.hero-content .btn-text.video-play-btn {
  font-size: 14px; /* Adjust the font size of the buttons */
}

    </style> -->
    <div class="hero-slider owl-action-styled">
        <div class="hero-slider-item hero-bg-1" style="padding: 80px 0;">
            
            <div class="container">
                <div class="hero-content text-center">
                    <div class="section-heading">
                        <h2 class="section__title text-white fs-65 lh-80 pb-3">Devenez membre OpenMeetRoom <br> Et profiter des derniers experience learning</h2>
                        <p class="section__desc text-white pb-4">
                            Formations++ est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés. 
                            La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.
                        </p>
                    </div><!-- end section-heading -->
                    <div class="hero-btn-box d-flex flex-wrap justify-content-center pt-1">
                        <a href="#s" class="btn theme-btn mr-4 mb-4">Rejoignez-nous<i class="la la-arrow-right icon ml-1"></i></a>
                        <a href="https://www.facebook.com/plugins/video.php?href=https://www.facebook.com/suptechnology.casablanca/videos/649254646604064" class="btn-text video-play-btn mb-4" data-fancybox data-type="iframe">
                            Regarder l'aperçu<i class="la la-play icon-btn ml-2"></i>
                        </a>
                    
                        <script>
                            $(document).ready(function() {
                                $('[data-fancybox]').fancybox({
                                    iframe : {
                                        css : {
                                            width : '70%',
                                            height : '850px'
                                        }
                                    }
                                });
                            });
                        </script>
                    </div><!-- end hero-btn-box -->
                </div><!-- end hero-content -->
            </div><!-- end container -->
        </div><!-- end hero-slider-item -->
        <div class="hero-slider-item hero-bg-2" style="padding: 80px 0;">
            <div class="container">
                <div class="hero-content text-center">
                    <div class="section-heading">
                        <h2 class="section__title text-white fs-65 lh-80 pb-3">The Ultimate  <br> learning experience</h2>
                        <p class="section__desc text-white pb-4">
                            Formation++ révolutionne l'industrie de l'apprentissage 
                            au Maroc avec des cours synchrones de haute qualité, 
                            adaptés aux besoins actuels du marché. Découvrez une nouvelle façon 
                            d'apprendre avec notre plateforme innovante.
                        </p>
                    </div><!-- end section-heading -->
                    <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1 justify-content-center">
                        <a href="#" class="btn theme-btn mr-4 mb-4">Commencer <i class="la la-arrow-right icon ml-1"></i></a>
                        <a href="#" class="btn-text video-play-btn mb-4" data-fancybox data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                            Regarder l'aperçu<i class="la la-play icon-btn ml-2"></i>
                        </a>
                    </div><!-- end hero-btn-box -->
                </div><!-- end hero-content -->
            </div><!-- container -->
        </div><!-- end hero-slider-item -->
        <!-- <div class="hero-slider-item hero-bg-3">
            <div class="container">
                <div class="hero-content text-right">
                    <div class="section-heading">
                        <h2 class="section__title text-white fs-65 lh-80 pb-3">Learn Anything, <br> Anytime, Anywhere</h2>
                        <p class="section__desc text-white pb-4">Emply dummy text of the printing and typesetting industry orem Ipsum has been the
                            <br>industry's standard dummy text ever sinceprinting and typesetting industry.
                        </p>
                    </div>
                    <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1 justify-content-end">
                        <a href="#" class="btn-text video-play-btn mr-4 mb-4" data-fancybox data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                            <i class="la la-play icon-btn mr-2"></i>Watch Preview
                        </a>
                        <a href="admission.html" class="btn theme-btn mb-4"><i class="la la-arrow-left icon mr-1"></i>Get Enrolled </a>
                    </div>
                </div>
            </div>
        </div> -->
    </div><!-- end hero-slide -->
</section><!-- end hero-area -->