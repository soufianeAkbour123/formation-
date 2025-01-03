<!DOCTYPE html>
<html>
<head>
  <style>
    .lll {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    .slider {
      width: 100%;
      position: relative;
      height: 600px;
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
    
    .hero-content {
      flex: 1;
      padding-right: 40px;
    }
    
    .hero-title {
      font-size: 2.5em;
      margin-bottom: 20px;
      color: #333;
    }
    
    .section__title {
      font-size: 65px;
      line-height: 80px;
      padding-bottom: 1rem;
      color: #333;
    }
    
    .section__desc {
      color: #666;
      padding-bottom: 1rem;
      line-height: 1.6;
    }
    
    .hero-text {
      color: #666;
      margin-bottom: 20px;
      line-height: 1.6;
    }
    
    .theme-btn {
      background-color: #00bfa5;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
      display: inline-block;
      margin-right: 1rem;
    }
    
    .btn-text {
      color: #333;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      font-size: 16px;
    }
    
    .hero-image {
      flex: 1;
      text-align: right;
    }
    
    .hero-image img {
      max-width: 100%;
      height: auto;
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
  </style>
</head>
<body>
  <div class="slider">
    <div class="slide active">
      <div class="lll">
        <div class="hero-content">
          <h1 class="hero-title">
            Êtes-vous Etudiant(e)<br>
            en Médecine?<br>
            profitez de nos<br>
            QCM Par Cours
          </h1>
          <p class="hero-text">
            MonQcm est un site qui vous propose une banque de questions pour les étudiants en médecine (FMPC).
            Les questions sont organisées par Examen et par chapitre avec la posibilité de consulter le Cours de chaque chapitre.
          </p>
          <a href="#" class="theme-btn">Se Connecter / S'inscrire</a>
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
            Devenez membre OpenSkillRoom<br>
            et profitez des dernières expériences d'apprentissage
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