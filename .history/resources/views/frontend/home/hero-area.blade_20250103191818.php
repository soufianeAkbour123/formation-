<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .lll {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .slider {
      width: 100%;
      position: relative;
      min-height: 600px;
      overflow: hidden;
      background-color: #f5f7fa;
    }
    
    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }
    
    .slide.active {
      opacity: 1;
    }
    
    .slide .lll {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 40px;
    }
    
    .hero-content {
      flex: 1;
    }
    
    .hero-title {
      font-size: clamp(1.5rem, 4vw, 2.5rem);
      margin-bottom: 20px;
      color: #333;
      line-height: 1.2;
    }
    
    .section__title {
      font-size: clamp(1.8rem, 5vw, 3.5rem);
      line-height: 1.2;
      padding-bottom: 1rem;
      color: #333;
    }
    
    .section__desc, .hero-text {
      font-size: clamp(1rem, 2vw, 1.1rem);
      color: #666;
      margin-bottom: 20px;
      line-height: 1.6;
    }
    
    .hero-btn-box {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: 2rem;
    }
    
    .theme-btn {
      background-color: #00bfa5;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: clamp(0.9rem, 2vw, 1rem);
      text-decoration: none;
      display: inline-block;
      white-space: nowrap;
    }
    
    .btn-text {
      color: #333;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      font-size: clamp(0.9rem, 2vw, 1rem);
    }
    
    .hero-image {
      flex: 1;
      min-width: 280px;
    }
    
    .hero-image img {
      width: 100%;
      height: auto;
      max-width: 500px;
      display: block;
      margin: 0 auto;
    }
    
    .slider-nav {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 10px;
      z-index: 10;
    }
    
    .slider-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: rgba(0,0,0,0.3);
      cursor: pointer;
    }
    
    .slider-dot.active {
      background: #00bfa5;
    }
    
    .icon {
      margin-left: 0.5rem;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
      .slider {
        min-height: auto;
      }

      .slide .lll {
        flex-direction: column;
        padding: 40px 20px;
      }

      .hero-content {
        text-align: center;
        order: 1;
      }

      .hero-image {
        order: 0;
        margin-bottom: 2rem;
      }

      .hero-btn-box {
        justify-content: center;
      }

      .section__title, .hero-title {
        margin-bottom: 1rem;
      }
    }

    /* Small Mobile Styles */
    @media (max-width: 480px) {
      .hero-btn-box {
        flex-direction: column;
        align-items: stretch;
      }

      .theme-btn, .btn-text {
        text-align: center;
        justify-content: center;
      }
    }
  </style>
</head>
<body>
  <div class="slider">
    <div class="slide active">
      <div class="lll">
        <div class="hero-content">
          <h1 class="hero-title">
            Êtes-vous Etudiant(e) en Médecine?<br>
            profitez de nos QCM Par Cours
          </h1>
          <p class="hero-text">
            MonQcm est un site qui vous propose une banque de questions pour les étudiants en médecine (FMPC).
            Les questions sont organisées par Examen et par chapitre avec la posibilité de consulter le Cours de chaque chapitre.
          </p>
          <div class="hero-btn-box">
            <a href="#" class="theme-btn">Se Connecter / S'inscrire</a>
          </div>
        </div>
        <div class="hero-image">
          <img src="/api/placeholder/500/400" alt="Students studying online">
        </div>
      </div>
    </div>
    <div class="slide">
      <div class="lll">
        <div class="hero-content">
          <h2 class="section__title">
            Devenez membre OpenSkillRoom et profitez des dernières expériences d'apprentissage
          </h2>
          <p class="section__desc">
            OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. 
            Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés.
            La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.
          </p>
          <div class="hero-btn-box">
            <a href="#" class="theme-btn">Rejoignez-nous<i class="la la-arrow-right icon"></i></a>
            <a href="#" class="btn-text">
              Regarder l'aperçu<i class="la la-play icon"></i>
            </a>
          </div>
        </div>
        <div class="hero-image">
          <img src="/api/placeholder/500/400" alt="OpenSkillRoom platform">
        </div>
      </div>
    </div>
    <div class="slider-nav">
      <span class="slider-dot active"></span>
      <span class="slider-dot"></span>
    </div>
  </div>
  
  <script>
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    let currentSlide = 0;
    
    function showSlide(n) {
      slides.forEach(slide => slide.classList.remove('active'));
      dots.forEach(dot => dot.classList.remove('active'));
      slides[n].classList.add('active');
      dots[n].classList.add('active');
    }
    
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        currentSlide = index;
        showSlide(currentSlide);
      });
    });
    
    setInterval(() => {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }, 5000);
  </script>
</body>
</html>