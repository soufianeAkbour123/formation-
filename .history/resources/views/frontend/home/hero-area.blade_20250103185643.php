<!DOCTYPE html>
<html>
<head>
  <style>
    .hero {
      padding: 80px 0;
      background-color: #ffffff;
      font-family: Arial, sans-serif;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
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
    
    .nav {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }
    
    .nav a {
      color: #666;
      text-decoration: none;
    }
  </style>
</head>
<body>
 
  
  <section class="hero">
    <div class="container">
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
        <img src="/api/placeholder/600/400" alt="Students studying online">
      </div>
    </div>
  </section>
</body>
</html>