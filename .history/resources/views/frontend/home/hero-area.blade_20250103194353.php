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
      display: flex;
      align-items: center;
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
      line-height: 1.2;
    }
    
    .hero-text {
      color: #666;
      margin-bottom: 20px;
      line-height: 1.6;
    }
    
    .hero-btn-box {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      padding-top: 1rem;
    }
    
    .theme-btn {
      background-color: #EC5252;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 15px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      transition: background-color 0.3s ease;
    }
    
    .theme-btn:hover {
      background-color: #d64444;
    }
    
    .btn-text {
      color: #333;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      padding: 10px 20px;
      font-size: 15px;
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
      background: #EC5252;
    }
    
    .icon {
      margin-left: 8px;
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
          <img src="{{ asset('frontend/images/1-37.') }}" alt="Students studying online">
        </div>
      </div>
    </div>
    <div class="slide">
      <div class="lll">
        <div class="hero-content">
          <h1 class="hero-title">Devenez membre OpenSkillRoom</h1>
          <p class="hero-text">
            OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. 
            Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés.
            La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.
          </p>
          <div class="hero-btn-box">
            <a href="#s" class="theme-btn">
              Rejoignez-nous
              <i class="la la-arrow-right icon"></i>
            </a>
            <a href="https://www.youtube.com/embed/9tusoKSh0AU?si=34gz4OmOdTxqm2mh" class="btn-text video-play-btn mb-4" data-fancybox data-type="iframe">
              Regarder l'aperçu<i class="la la-play icon-btn ml-2"></i>
            </a>
          </div>
        </div>
        <div class="hero-image">
          <img src="{{ asset('frontend/images/OSRlogo.png') }}" alt="OpenSkillRoom platform">
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