<section class="hero-area">
    <div class="hero-slider owl-carousel">
        <!-- Slide 2 (devenu premier slide) -->
        <div class="hero-slider-item hero-bg-2">
            <div class="container">
                <div class="hero-content text-center">
                    <div class="section-heading">
                        <h2 class="section__title text-white">Rejoignez Formations++ et obtenez <br> Vos cours synchrones pour la première fois au Maroc !</h2>
                        <p class="section__desc text-white">
                            Formation++ révolutionne l'industrie de l'apprentissage 
                            au Maroc avec des cours synchrones de haute qualité, 
                            adaptés aux besoins actuels du marché. Découvrez une nouvelle façon 
                            d'apprendre avec notre plateforme innovante.
                        </p>
                    </div>
                    <div class="hero-btn-box d-flex flex-wrap justify-content-center">
                        <a href="#" class="btn theme-btn mr-3">Commencer <i class="la la-arrow-right icon ml-1"></i></a>
                        <a href="#" class="btn-text video-play-btn" data-fancybox data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                            Regarder l'aperçu<i class="la la-play icon-btn ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 1 (devenu deuxième slide) -->
        <div class="hero-slider-item hero-bg-1">
            <div class="container">
                <div class="hero-content text-center">
                    <div class="section-heading">
                        <h2 class="section__title text-white">Nous vous aidons à apprendre <br> ce que vous aimez</h2>
                        <p class="section__desc text-white">
                            Formations++ est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. Elle permet aux 
                            étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés. 
                            La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.
                        </p>
                    </div>
                    <div class="hero-btn-box d-flex flex-wrap justify-content-center">
                        <a href="#s" class="btn theme-btn mr-3">Rejoignez-nous<i class="la la-arrow-right icon ml-1"></i></a>
                        <a href="https://www.facebook.com/plugins/video.php?href=https://www.facebook.com/suptechnology.casablanca/videos/649254646604064" 
                            class="btn-text video-play-btn" data-fancybox data-type="iframe">
                            Regarder l'aperçu<i class="la la-play icon-btn ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-slider-item {
    padding: 80px 0;
}

.section__title {
    font-size: 40px;
    line-height: 50px;
    padding-bottom: 20px;
}

.section__desc {
    font-size: 16px;
    line-height: 24px;
    padding-bottom: 20px;
}

.hero-btn-box .btn {
    font-size: 14px;
    margin-bottom: 10px;
}

.hero-btn-box .btn-text {
    font-size: 14px;
}
</style>

<script>
    $(document).ready(function() {
        $('.hero-slider').owlCarousel({
            items: 1,
            loop: true,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000
        });

        $('[data-fancybox]').fancybox({
            iframe: {
                css: {
                    width: '70%',
                    height: '850px'
                }
            }
        });
    });
</script>
