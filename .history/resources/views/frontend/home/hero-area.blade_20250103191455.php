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

    .hero-text {
      color: #666;
      margin-bottom: 20px;
      line-height: 1.6;
    }

    .hero-button {
      background-color: #00bfa5;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
      display: inline-block;
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
          <a href="#" class="hero-button">Se Connecter / S'inscrire</a>
        </div>
        <div class="hero-image">
          <img src="{{ asset('frontend/images/OSRlogo.png') }}" alt="Students studying online">
        </div>
      </div>
    </div>
    <div class="slide">
      <div class="container">
        <div class="hero-content">
          <!-- Second slide content -->
        </div>
        <div class="hero-image">
          <img src="{{ asset('frontend/images/another-image.png') }}" alt="Another slide">
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