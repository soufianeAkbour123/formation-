<!DOCTYPE html>
<html>
<head>
  <style>
    .slider {
      position: relative;
      height: 600px;
      overflow: hidden;
      width: 100%;
    }

    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
      padding: 80px 0;
    }

    .slide.active {
      opacity: 1;
    }

    .slide:nth-child(1) {
      background: #f8f9fa;
    }

    .slide:nth-child(2) {
      background: #e9ecef;
    }

    .slide-content {
      flex: 1;
      padding-right: 40px;
    }

    .slide-image {
      flex: 1;
      text-align: right;
    }

    .slide-image img {
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
  <!-- Use your existing container class -->
  <div class="slider">
    <div class="slide active">
      <!-- Your existing container class will be used here -->
      <div class="container">
        <div class="slide-content">
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
        <div class="slide-image">
          <img src="/api/placeholder/600/400" alt="Medical Education">
        </div>
      </div>
    </div>
    <div class="slide">
      <div class="container">
        <div class="slide-content">
          <img src="/api/placeholder/300/100" alt="Logo" style="max-width: 300px;">
        </div>
        <div class="slide-image">
          <img src="{ asset('frontend/images/OSRlogo.png') }}" alt="Study Platform">
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