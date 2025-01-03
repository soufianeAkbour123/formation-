<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .container {
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
      transition: opacity 0.8s ease-in-out;
      display: flex;
      align-items: center;
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
      z-index: 20;
      transition: all 0.3s ease;
    }

    .slider-arrow:hover {
      background-color: rgba(236, 82, 82, 1);
      transform: translateY(-50%) scale(1.1);
    }

    .slider-arrow.prev { left: 20px; }
    .slider-arrow.next { right: 20px; }

    .arrow-icon {
      border: solid white;
      border-width: 0 2px 2px 0;
      display: inline-block;
      padding: 4px;
    }

    .arrow-icon.right { transform: rotate(-45deg); }
    .arrow-icon.left { transform: rotate(135deg); }

    .content {
      flex: 1;
      padding-right: 40px;
    }
    
    .title {
      font-size: 2.5em;
      margin-bottom: 20px;
      color: #333;
      line-height: 1.2;
    }
    
    .text {
      color: #666;
      margin-bottom: 20px;
      line-height: 1.6;
      font-size: 16px;
    }
    
    .btn-group {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      padding-top: 1rem;
    }
    
    .primary-btn {
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
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .primary-btn:hover {
      background-color: #d64444;
      transform: translateY(-2px);
    }
    
    .secondary-btn {
      color: #333;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      padding: 10px 20px;
      font-size: 15px;
      white-space: nowrap;
      transition: all 0.3s ease;
    }

    .secondary-btn:hover {
      color: #EC5252;
    }
    
    .image-wrapper {
      flex: 1;
      text-align: right;
    }
    
    .image-wrapper img {
      max-width: 100%;
      height: auto;
      object-fit: contain;
    }

    @media (max-width: 1024px) {
      .slider { height: 500px; }
      .title { font-size: 2em; }
      .text { font-size: 15px; }
      .slider-arrow {
        width: 35px;
        height: 35px;
      }
    }

    @media (max-width: 768px) {
      .slider {
        height: auto;
        min-height: 600px;
      }

      .container {
        flex-direction: column;
        padding: 20px;
        text-align: center;
      }

      .content {
        padding-right: 0;
        order: 1;
      }

      .image-wrapper {
        order: 0;
        margin-bottom: 20px;
        max-width: 70%;
      }

      .title { font-size: 1.8em; }
      
      .btn-group {
        justify-content: center;
        gap: 15px;
      }

      .slider-arrow {
        width: 30px;
        height: 30px;
      }
    }

    @media (max-width: 480px) {
      .slider { min-height: 650px; }
      .title { font-size: 1.5em; }
      .text { font-size: 14px; }
      .image-wrapper { max-width: 65%; }
      
      .btn-group {
        flex-direction: column;
        gap: 10px;
      }

      .secondary-btn, .primary-btn {
        width: auto;
        justify-content: center;
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

    <div class="slide">
      <div class="container">
        <div class="content">
          <h1 class="title">The ultimate experience</h1>
          <p class="text">
            Devenez membre d'OpenSkillRoom et profitez des dernières expériences d'apprentissage adaptées à vos besoins
          </p>
          <div class="btn-group">
            <a href="#" class="primary-btn">
              Rejoignez-nous
              <i class="la la-arrow-right icon"></i>
            </a>
            <a href="https://www.youtube.com/embed/9tusoKSh0AU?si=34gz4OmOdTxqm2mh" class="secondary-btn video-play-btn">
              Regarder l'aperçu<i class="la la-play icon-btn"></i>
            </a>
          </div>
        </div>
        <div class="image-wrapper">
          <img src="{{ asset('frontend/images/OSRlogo.png') }}" alt="OpenSkillRoom platform">
        </div>
      </div>
    </div>

    <div class="slide active">
      <div class="container">
        <div class="content">
          <h1 class="title">
            Devenez membre<br>
            OpenSkillRoom
          </h1>
          <p class="text">
            OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. 
            Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés.
          </p>
          <a href="#" class="primary-btn">Se Connecter / S'inscrire</a>
        </div>
        <div class="image-wrapper">
          <img src="{{ asset('frontend/images/student-removebg-preview.png') }}" alt="Students studying online">
        </div>
      </div>
    </div>
  </div>
  
  <script>
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    
    function showSlide(n) {
      slides[currentSlide].classList.remove('active');
      currentSlide = n >= slides.length ? 0 : n < 0 ? slides.length - 1 : n;
      slides[currentSlide].classList.add('active');
    }
    
    function nextSlide() {
      showSlide(currentSlide + 1);
    }
    
    function prevSlide() {
      showSlide(currentSlide - 1);
    }
    
    setInterval(nextSlide, 7000);
  </script>
</body>
</html>