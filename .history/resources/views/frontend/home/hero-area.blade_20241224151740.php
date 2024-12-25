<section class="hero-area">
  <style>
    .card {
      height: auto;
      min-height: 510px;
      display: flex;
      flex-direction: column;
    }

    .card-body {
      flex: 1;
      padding: 1.25rem;
    }

    .hero-slider-item {
      padding: 80px 0;
      background-size: cover;
      background-position: center;
    }

    .section__title {
      font-size: clamp(2.5rem, 5vw, 4rem);
      line-height: 1.2;
      margin-bottom: 1rem;
    }

    .section__desc {
      font-size: 1rem;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    .hero-btn-box {
      gap: 1rem;
    }

    .icon-element.active {
      background-color: #22c55e;
      color: white;
    }

    @media (max-width: 767px) {
      .hero-slider-item {
        padding: 40px 0;
      }
      
      .card-title {
        font-size: 1.125rem;
      }
    }

    @media (min-width: 768px) and (max-width: 1199px) {
      .card-title {
        font-size: 1.25rem;
      }
    }
  </style>

  <div class="hero-slider owl-action-styled">
    <div class="hero-slider-item hero-bg-1">
      <div class="container">
        <div class="hero-content text-center">
          <div class="section-heading">
            <h2 class="section__title text-white">Devenez membre OpenMeetRoom <br> Et profitez des dernières expériences d'apprentissage</h2>
            <p class="section__desc text-white">
              Formations++ est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés. 
              La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.
            </p>
          </div>
          <div class="hero-btn-box d-flex flex-wrap justify-content-center">
            <a href="#" class="btn theme-btn">Rejoignez-nous<i class="la la-arrow-right icon"></i></a>
            <a href="#" class="btn-text video-play-btn" data-fancybox>
              Regarder l'aperçu<i class="la la-play icon-btn"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="hero-slider-item hero-bg-2">
      <div class="container">
        <div class="hero-content text-center">
          <div class="section-heading">
            <h2 class="section__title text-white">The Ultimate <br> learning experience</h2>
            <p class="section__desc text-white">
              Formation++ révolutionne l'industrie de l'apprentissage 
              au Maroc avec des cours synchrones de haute qualité, 
              adaptés aux besoins actuels du marché. Découvrez une nouvelle façon 
              d'apprendre avec notre plateforme innovante.
            </p>
          </div>
          <div class="hero-btn-box d-flex flex-wrap justify-content-center">
            <a href="#" class="btn theme-btn">Commencer <i class="la la-arrow-right icon"></i></a>
            <a href="#" class="btn-text video-play-btn" data-fancybox data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
              Regarder l'aperçu<i class="la la-play icon-btn"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      $('[data-fancybox]').fancybox({
        iframe: {
          css: {
            width: '70%',
            maxWidth: '1200px',
            height: '80vh'
          }
        }
      });
    });
  </script>
</section>