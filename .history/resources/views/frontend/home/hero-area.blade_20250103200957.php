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
  transition: background-color 0.3s ease;
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

.ll-content {
  flex: 1;
  padding-right: 40px;
}

.ll-title {
  font-size: 2.5em;
  margin-bottom: 20px;
  color: #333;
  line-height: 1.2;
}

.ll-text {
  color: #666;
  margin-bottom: 20px;
  line-height: 1.6;
  font-size: 16px;
}

.ll-btn-box {
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
  white-space: nowrap;
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
  white-space: nowrap;
}

.ll-image {
  flex: 1;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 15px;
}

.ll-image img {
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

/* Tablette */
@media (max-width: 1024px) {
  .slider {
    height: 500px;
  }

  .ll-title {
    font-size: 2em;
  }

  .ll-text {
    font-size: 15px;
  }

  .slider-arrow {
    width: 35px;
    height: 35px;
  }

  .slide:nth-child(2) .ll-image {
    padding: 20px;
  }
  
  .slide:nth-child(2) .ll-image img {
    max-width: 60%;
    width: auto;
    height: auto;
    max-height: 200px;
  }
}

/* Mobile Large */
@media (max-width: 768px) {
  .slider {
    height: auto;
    min-height: 550px;
  }

  .lll {
    flex-direction: column;
    padding: 15px;
    gap: 20px;
  }

  .ll-content {
    padding-right: 0;
    order: 1;
  }

  .ll-image {
    order: 0;
    margin: 10px 0;
    width: 100%;
  }

  .slide:nth-child(2) .ll-image img {
    max-width: 45%;
    width: auto;
    height: auto;
    max-height: 150px;
  }

  .slide:first-child .ll-image img {
    max-width: 80%;
  }

  .ll-title {
    font-size: 1.8em;
  }

  .ll-btn-box {
    justify-content: center;
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
}

/* Mobile Petit */
@media (max-width: 480px) {
  .slider {
    min-height: 500px;
  }

  .ll-title {
    font-size: 1.5em;
  }

  .ll-text {
    font-size: 14px;
  }

  .slide:nth-child(2) .ll-image img {
    max-width: 40%;
    width: auto;
    height: auto;
    max-height: 120px;
  }

  .slide:first-child .ll-image img {
    max-width: 90%;
  }

  .ll-btn-box {
    flex-direction: column;
    gap: 10px;
  }

  .btn-text, .theme-btn {
    width: 100%;
    justify-content: center;
  }

  .ll-content {
    padding: 10px;
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
        <div class="ll-content">
          <h1 class="ll-title">
            Êtes-vous Etudiant(e)<br>
            en Médecine?<br>
            profitez de nos<br>
            QCM Par Cours
          </h1>
          <p class="ll-text">
            MonQcm est un site qui vous propose une banque de questions pour les étudiants en médecine (FMPC).
            Les questions sont organisées par Examen et par chapitre avec la posibilité de consulter le Cours de chaque chapitre.
          </p>
          <a href="#" class="theme-btn">Se Connecter / S'inscrire</a>
        </div>
        <div class="ll-image">
          <img src="{{ asset('frontend/images/student.jpg') }}" alt="Students studying online">
        </div>
      </div>
    </div>

    <div class="slide">
      <div class="lll">
        <div class="ll-content">
          <h1 class="ll-title">Devenez membre OpenSkillRoom</h1>
          <p class="ll-text">
            OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. 
            Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés.
            La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.
          </p>
          <div class="ll-btn-box">
            <a href="#s" class="theme-btn">
              Rejoignez-nous
              <i class="la la-arrow-right icon"></i>
            </a>
            <a href="https://www.youtube.com/embed/9tusoKSh0AU?si=34gz4OmOdTxqm2mh" class="btn-text video-play-btn mb-4" data-fancybox data-type="iframe">
              Regarder l'aperçu<i class="la la-play icon"></i>
            </a>
          </div>
        </div>
        <div class="ll-image">
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
    let autoSlideInterval;
    
    function showSlide(n) {
      if (n >= slides.length) n = 0;
      if (n < 0) n = slides.length - 1;
      
      currentSlide = n;
      
      slides.forEach(slide => slide.classList.remove('active'));
      dots.forEach(dot => dot.classList.remove('active'));
      slides[currentSlide].classList.add('active');
      dots[currentSlide].classList.add('active');
    }
    
    function nextSlide() {
      showSlide(currentSlide + 1);
      resetAutoSlide();
    }
    
    function prevSlide() {
      showSlide(currentSlide - 1);
      resetAutoSlide();
    }
    
    function resetAutoSlide() {
      clearInterval(autoSlideInterval);
      startAutoSlide();
    }
    
    function startAutoSlide() {
      autoSlideInterval = setInterval(() => {
        nextSlide();
      }, 5000);
    }
    
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        showSlide(index);
        resetAutoSlide();
      });
    });
    
    startAutoSlide();
  </script>
</body>
</html>