<style>
.footer-area {
    font-size: 14px;
    line-height: 1.6;
    word-wrap: break-word; /* Ajout pour éviter les débordements */
    word-break: keep-all; /* Garde les mots entiers */
}

.footer-area h3 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 15px;
    white-space: nowrap; /* Empêche les titres d'être coupés */
}

.footer-area .generic-list-item li {
    margin-bottom: 8px;
    word-break: keep-all; /* Garde les mots entiers */
    white-space: nowrap; /* Empêche les éléments de liste d'être coupés */
}

.footer-area .social-icons li {
    display: inline-block;
    margin-right: 10px; /* Espacement entre les icônes sociales */
}

.footer-area .social-icons li a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    color: #fff; /* Couleur des icônes */
    font-size: 16px;
}

.footer-area .social-icons li a.facebook-bg {
    background-color: #3b5998;
}

.footer-area .social-icons li a.whatsapp-bg {
    background-color: #25d366;
}

.footer-area .social-icons li a.instagram-bg {
    background-color: #e4405f;
}

.footer-area .social-icons li a.linkedin-bg {
    background-color: #0077b5;
}

.copyright-content p {
    font-size: 12px;
    text-align: center;
    color: #777;
}
</style>

<section class="footer-area pt-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <a href="index.html">
                        <img src="{{ asset('frontend/images/OSRlogo.png') }}" alt="footer logo" class="footer__logo" width="160" height="160">
                    </a>
                    <ul class="generic-list-item pt-4">
                        <br>
                        <br>
                        <br>

                        <li><a href="tel:+212522996566">+212 52299-6566</a></li>
                        <li><a href="mailto:contact@suptechnology.ma">contact@suptechnology.ma</a></li>
                        <li>Immeuble 4 - avenue cadi aiss (en face mac donald) 
                            <br>Maarif 20333 Casablanca</li>
                    </ul>
                    <style>
                        .social-icons {
    display: flex; /* Place les icônes sur une seule ligne */
    justify-content: start; /* Aligne les icônes au début (vous pouvez changer en "center" ou "space-around" si nécessaire) */
    gap: 10px; /* Ajoute de l'espace entre les icônes */
    padding: 0; /* Retire les espaces internes */
    margin: 0; /* Retire les marges externes */
    list-style: none; /* Retire les puces */
}

.social-icons li {
    display: inline-block; /* S'assure que chaque icône se comporte comme un élément en ligne */
}

.social-icons a {
    display: inline-flex; /* Maintient les styles flexibles pour les liens */
    align-items: center; /* Centre verticalement les icônes */
    justify-content: center; /* Centre horizontalement les icônes */
    width: 40px; /* Taille de chaque icône */
    height: 40px; /* Taille de chaque icône */
    border-radius: 50%; /* Rend les icônes circulaires */
    text-decoration: none; /* Supprime les soulignements */
    color: white; /* Définit la couleur du texte ou des icônes */
}

.social-icons a.facebook-bg {
    background-color: #3b5998; /* Couleur pour Facebook */
}

.social-icons a.whatsapp-bg {
    background-color: #25D366; /* Couleur pour WhatsApp */
}

.social-icons a.instagram-bg {
    background-color: #E1306C; /* Couleur pour Instagram */
}

.social-icons a.linkedin-bg {
    background-color: #0077B5; /* Couleur pour LinkedIn */
}

                        </style>
                    <h3>Nous en sommes à</h3>
                    <ul class="social-icons">
                        <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                        <li><a href="#" class="whatsapp-bg"><i class="la la-whatsapp"></i></a></li>
                        <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                        <li><a href="#" class="linkedin-bg"><i class="la la-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3>Entreprise</h3>
                    <ul class="generic-list-item">
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Qui sommes-nous ? </a></li>
                        <li><a href="#">Contactez-nous<br></a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3>Formation</h3>
                    <ul class="generic-list-item">
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Infrastructures</a></li>
                        <li><a href="#">Big Data & Intelligence Artificielle</a></li>
                        <li><a href="#">Admin. Systèmes & Cloud</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3>Autre</h3>
                    <ul class="generic-list-item">
                        <li><a href="{{ route('become.instructor') }}">Devenir Professeur</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section-block"></div>
    <div class="copyright-content py-4">
        <div class="container">
            <p>&copy; 2024 Suptechnology. All Rights Reserved.</p>
        </div>
    </div>
</section>
