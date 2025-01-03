<!DOCTYPE html>
<html>
<head>
  <style>
    .slider {
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
      padding: 80px 0;
      display: flex;
      align-items: center;
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

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      text-align: center;
    }

    .logo {
      max-width: 300px;
      margin: 0 auto;
    }

    .content h2 {
      font-size: 2.5em;
      margin-bottom: 20px;
      color: #333;
    }

    .content p {
      color: #666;
      max-width: 800px;
      margin: 0 auto 30px;
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
      background: rgba(255,255,255,0.5);
      cursor: pointer;
    }

    .slider-dot.active {
      background: white;
    }

    .slider-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255,255,255,0.3);
      border: none;
      padding: 15px;
      cursor: pointer;
      color: white;
      font-size: 24px;
    }

    .prev {
      left: 20px;
    }

    .next {
      right: 20px;
    }
  </style>
</head>
<body>
  <div class="slider">
    <div class="slide active">
      <div class="container">
        <img src="{{ asset('frontend/images/OSRlogo.png') }}" alt="Logo" class="logo">
      </div>
    </div>
    <div class="slide">
      <div class="container">
        <div class="content">
          <h2>Êtes-vous Etudiant(e) en Médecine?</h2>
          <p>MonQcm est un site qui vous propose une banque de questions pour les étudiants en médecine (FMPC).</p>
        </div>
      </div>
    </div>
    <button class="slider-button prev">❮</button>
    <button class="slider-button next">❯</button>
    <div class="slider-nav">
      <span class="slider-dot active"></span>
      <span class="slider-dot"></span>
    </div>
  </div>

  <script>
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prev = document.querySelector('.prev');
    const next = document.querySelector('.next');
    let currentSlide = 0;

    function showSlide(n) {
      slides.forEach(slide => slide.classList.remove('active'));
      dots.forEach(dot => dot.classList.remove('active'));
      slides[n].classList.add('active');
      dots[n].classList.add('active');
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }

    next.addEventListener('click', nextSlide);
    prev.addEventListener('click', prevSlide);
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        currentSlide = index;
        showSlide(currentSlide);
      });
    });

    setInterval(nextSlide, 5000);
  </script>
</body>
</html>