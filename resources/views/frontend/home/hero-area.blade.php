<section class="hero-area">
   <style>
   /*-=========== hero-slider-item ==========-*/
   .hero-slider-item:first-child {
       background: #ffffff;  
       position: relative;
       z-index: 2;
       padding-top: 200px;
       padding-bottom: 270px;
   }

   /* Les pseudo-éléments sont désactivés pour le premier slide */
   .hero-slider-item:first-child:after,
   .hero-slider-item:first-child:before {
       display: none;
   }

   /* Styles pour le deuxième slide */
   .hero-slider-item:not(:first-child) {
       position: relative;
       z-index: 2;
       padding-top: 200px;
       padding-bottom: 270px;
   }

   .hero-slider-item:not(:first-child):after {
       position: absolute;
       left: 0;
       top: 0;
       height: 100%;
       width: 100%;
       background-color: #233d63;
       opacity: .90;
       content: "";
       z-index: -1;
   }

   .hero-slider-item:not(:first-child):before {
       position: absolute;
       content: '';
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background-size: cover;
       background-position: center;
       z-index: 1;
       opacity: 0.1;
       pointer-events: none;
   }

   @media (max-width: 480px) {
       .hero-slider-item, 
       .hero-slider-item:first-child {
           padding-top: 120px;
           padding-bottom: 200px;
       }
   }
   </style>

   <div class="hero-slider owl-action-styled">
       <!-- Premier slide - Logo -->
       <div class="hero-slider-item" style="height: auto;">
           <div class="container">
               <div style="display: flex; align-items: center; justify-content: center; min-height: 500px;">
                   <img 
                       src="{{ asset('frontend/images/OSRlogo.png') }}" 
                       alt="OpenSkillRoom Logo"
                       style="width: auto; max-width: 120%; max-height: 80vh; object-fit: contain; transform: scale(1.5);"
                   >
               </div>
           </div>
       </div>

       <!-- Deuxième slide - inchangé -->
       <div class="hero-slider-item hero-bg-1">
           <div class="container">
               <div class="hero-content text-center">
                   <div class="section-heading">
                       <h2 class="section__title text-white fs-65 lh-80 pb-3">Devenez membre OpenSkillRoom <br> et profitez des dernières expériences d'apprentissage</h2>
                       <p class="section__desc text-white pb-4">
                           OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés. 
                           La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.
                       </p>
                   </div>
                   <div class="hero-btn-box d-flex flex-wrap justify-content-center pt-1">
                       <a href="#s" class="btn theme-btn mr-4 mb-4">Rejoignez-nous<i class="la la-arrow-right icon ml-1"></i></a>
                       <a href="https://www.facebook.com/plugins/video.php?href=https://www.facebook.com/suptechnology.casablanca/videos/649254646604064" class="btn-text video-play-btn mb-4" data-fancybox data-type="iframe">
                           Regarder l'aperçu<i class="la la-play icon-btn ml-2"></i>
                       </a>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <script>
       $(document).ready(function() {
           $('[data-fancybox]').fancybox({
               iframe: {
                   css: {
                       width: '70%',
                       height: '850px'
                   }
               }
           });
       });
   </script>
</section>