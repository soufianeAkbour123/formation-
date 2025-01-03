<!DOCTYPE html>
<html lang="fr">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .slider {
      width: 100%;
      height: 600px;
      overflow: hidden;
      position: relative;
      background-color: #f5f7fa;
    }

    .slide {
      width: 100%;
      height: 100%;
      position: absolute;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .slide.active {
      opacity: 1;
    }

    .slider-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 40px;
      height: 40px;
      background-color: rgba(236, 82, 82, 0.8);
      color: white;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .slider-arrow:hover {
      background-color: rgba(236, 82, 82, 1);
    }

    .slider-arrow.prev {
      left: 20px;
    }

    .slider-arrow.next {
      right: 20px;
    }

    .arrow-icon {
      border: solid white;
      border-width: 0 2px 2px 0;
      display: inline-block;
      padding: 4px;
    }

    .arrow-icon.right {
      transform: rotate(-45deg);
    }

    .arrow-icon.left {
      transform: rotate(135deg);
    }

    .lll {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
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
      font-size: 16px;
    }

    .theme-btn {
      background-color: #EC5252;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      transition: background-color 0.3s ease;
      white-space: nowrap;
    }

    .theme-btn:hover {
      background-color: #d64444;
    }

    .hero-image img {
      max-width: 100%;
      height: auto;
      object-fit: contain;
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
      background: rgba(0, 0, 0, 0.3);
      cursor: pointer;
    }

    .slider-dot.active {
      background: #EC5252;
    }

    @media (max-width: 768px) {
      .lll {
        flex-direction: column;
        padding: 20px;
        text-align: center;
      }

      .hero-image {
        order: 0;
        margin-bottom: 20px;
        max-width: 70%;
      }

      .hero-title {
        font-size: 1.8em;
      }

      .slider-arrow {
        width: 30px;
        height: 30px;
      }

      .slider-arrow.prev {
        left: 10px;
      }

      .slider-arrow.next {
        right: 10px;
      }

      .theme-btn {
        font-size: 13px;
        padding: 6px 14px;
      }
    }

    @media (max-width: 480px) {
      .hero-title {
        font-size: 1.5em;
      }

      .hero-text {
        font-size: 14px;
      }

      .hero-image {
        max-width: 65%;
      }

      .theme-btn {
        font-size: 12px;
        padding: 6px 12px;
      }
    }
  </style>
</head>
<body>
  <div class="slider">
    <button class="slider-arrow prev" onclick="prevSlide()">
      <i class="arrow-icon left"></i>
    </button>
    <button class="slider-arrow next" onclick="nextSlide()">
      <i class="arrow-icon right"></i>
    </button>

    <div class="slide active">
      <div class="lll">
        <div>
          <h1 class="hero-title">The ultimate experience</h1>
          <p class="hero-text">Devenez membre d'OpenSkillRoom et profitez des dernières expériences d'apprentissage adaptées à vos besoins.</p>
          <a href="#" class="theme-btn">Rejoignez-nous</a>
        </div>
        <div class="hero-image">
          <img src="{{ asset('frontend/images/OSRlogo.png') }}" alt="OpenSkillRoom platform">
        </div>
      </div>
    </div>

    <div class="slide">
      <div class="lll">
        <div>
          <h1 class="hero-title">Devenez membre OpenSkillRoom</h1>
          <p class="hero-text">OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés.</p>
          <a href="#" class="theme-btn">Se Connecter / S'inscrire</a>
        </div>
        <div class="hero-image">
          <img src="{{ asset('frontend/images/student-removebg-preview.png') }}" alt="Students studying online">
        </div>
      </div>
    </div>

    <div class="slider-nav">
      <div class="slider-dot active" onclick="showSlide(0)"></div>
      <div class="slider-dot" onclick="showSlide(1)"></div>
    </div>
  </div>

  <script>
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    let currentSlide = 0;

    function showSlide(n) {
      slides.forEach((slide, index) => {
        slide.classList.toggle('active', index === n);
        dots[index].classList.toggle('active', index === n);
      });
      currentSlide = n;
    }

    function nextSlide() {
      showSlide((currentSlide + 1) % slides.length);
    }

    function prevSlide() {
      showSlide((currentSlide - 1 + slides.length) % slides.length);
    }

    setInterval(nextSlide, 5000);
  </script>
</body>
</html>
