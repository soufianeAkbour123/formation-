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
    }

    .slide {
      width: 100%;
      height: 100%;
      position: absolute;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .slide.active {
      opacity: 1;
    }

    .content {
      text-align: center;
      padding: 20px;
    }

    .title {
      font-size: 2.5em;
      margin-bottom: 20px;
      color: #333;
    }

    .text {
      color: #666;
      margin-bottom: 20px;
    }

    .btn {
      background-color: #EC5252;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }

    .btn:hover {
      background-color: #d64444;
    }

    .slider-nav {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 10px;
    }

    .dot {
      width: 12px;
      height: 12px;
      background: rgba(0, 0, 0, 0.3);
      border-radius: 50%;
      cursor: pointer;
    }

    .dot.active {
      background: #EC5252;
    }
  </style>
</head>
<body>
  <div class="slider">
    <div class="slide active">
      <div class="content">
        <h1 class="title">The ultimate experience</h1>
        <p class="text">Devenez membre d'OpenSkillRoom et profitez des dernières expériences d'apprentissage adaptées à vos besoins.</p>
        <a href="#" class="btn">Rejoignez-nous</a>
      </div>
    </div>

    <div class="slide">
      <div class="content">
        <h1 class="title">Devenez membre OpenSkillRoom</h1>
        <p class="text">OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés.</p>
        <a href="#" class="btn">Se Connecter / S'inscrire</a>
      </div>
    </div>

    <div class="slider-nav">
      <div class="dot active" onclick="goToSlide(0)"></div>
      <div class="dot" onclick="goToSlide(1)"></div>
    </div>
  </div>

  <script>
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    let currentIndex = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
        dots[i].classList.toggle('active', i === index);
      });
    }

    function nextSlide() {
      currentIndex = (currentIndex + 1) % slides.length;
      showSlide(currentIndex);
    }

    function goToSlide(index) {
      currentIndex = index;
      showSlide(index);
    }

    setInterval(nextSlide, 5000);
  </script>
</body>
</html>
