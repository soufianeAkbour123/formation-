

Start new chat
Starred
Star chats you use often
Recents
Medical Education Platform Hero Section
Create Responsive Image Slider
Troubleshooting Sidebar Menu Issues
Responsive Course Content Styling
Protecting Site Index During Maintenance
SQL Error: Missing ID Value
SSL Certificate Issues for openskillroom.com
Fixing Image Display Issues in Laravel
View all
Free plan

SA
itsakbou123@gmail.com
Help & support
SA


Medical Education Platform Hero Section
1

image.png
SA
<section class="hero-area">    <div class="hero-slider owl-action-styled">        <!-- Premier slide - Logo -->        <div class="hero-slider-item" style="padding: 80px 0; background: #f8f9fa; height: auto;">    <div class="container">        <div style="display: flex; align-items: center; justify-content: center; min-height: 500px;">            <img                 src="{{ asset('frontend/images/OSRlogo.png') }}"                 alt="OpenSkillRoom Logo"                style="width: auto; max-width: 120%; max-height: 80vh; object-fit: contain; transform: scale(1.5);"            >        </div>    </div> </div>         <!-- Deuxième slide - inchangé -->        <div class="hero-slider-item hero-bg-1" style="padding: 80px 0;">            <div class="container">                <div class="hero-content text-center">                    <div class="section-heading">                        <h2 class="sectiontitle text-white fs-65 lh-80 pb-3">Devenez membre OpenSkillRoom <br> et profitez des dernières expériences d'apprentissage</h2>                        <p class="sectiondesc text-white pb-4">                            OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés.                             La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.                        </p>                    </div>                    <div class="hero-btn-box d-flex flex-wrap justify-content-center pt-1">                        <a href="#s" class="btn theme-btn mr-4 mb-4">Rejoignez-nous<i class="la la-arrow-right icon ml-1"></i></a>                        <a href="https://www.facebook.com/plugins/video.php?href=https://www.facebook.com/suptechnology.casablanca/videos/649254646604064" class="btn-text video-play-btn mb-4" data-fancybox data-type="iframe">                            Regarder l'aperçu<i class="la la-play icon-btn ml-2"></i>                        </a>                    </div>                </div>            </div>        </div>    </div>     <script>        $(document).ready(function() {            $('[data-fancybox]').fancybox({                iframe: {                    css: {                        width: '70%',                        height: '850px'                    }                }            });        });    </script> </section> je veux le même style qui dans image tu peux le faire


I'll help you recreate the hero section with a similar style to the image. Based on what I see, this appears to be a medical education platform with a modern design.


Medical Education Platform Hero Section
Click to open website
The code includes:

Responsive layout with flexbox
Modern color scheme with teal accent
Navigation menu
Two-column hero section with text and image
Call-to-action button
Clean typography
Want me to adjust anything about the design?

Copy
Retry


SA
je veux jsute slider le menu non



Sliding Navigation Menu
Click to open website
Copy
Retry


SA
je veux le slider



Hero Section Slider
Click to open website
Copy
Retry


Claude can make mistakes. Please double-check responses.



Aucun fichier choisi


3.5 Sonnet

Concise

Hero Section Slider
Preview
Code

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
        <img src="/api/placeholder/300/100" alt="Logo" class="logo">
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
Last edited il y a 9 minutes


Publish
