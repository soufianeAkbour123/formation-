@extends('frontend.master')
@section('home')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                    <div class="section-heading">
                        <h2 class="section__title text-white">Tableau des Tarifs</h2>
                    </div>
                    <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                        <li><a href="index.html">Home</a></li>
                        <li>Abonnement Simplifié</li>
                        <li>Tableau des Tarifs</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START PACKAGE AREA
================================= -->
<section class="package-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item">
                    <div class="card-body">
                        <div class="package-price-box border-bottom border-bottom-gray pb-4 mb-4">
                            <h3 class="fs-45 font-weight-semi-bold pb-2"><span>1590</span> DH</h3>
                            <h4 class="fs-20 font-weight-semi-bold">PACK JUNIOR</h4>
                        </div><!-- end package-price-box -->
                        <ul class="generic-list-item">
                            <li><i class="la la-check text-success mr-2"></i> Nomber de formation 7</li>
                            <li><i class="la la-check text-success mr-2"></i> Niveau 1</li>
                            <li><i class="la la-check text-success mr-2"></i> Ce pack est idéal pour les étudiants ou les débutants en Informatique</li>
                            <li><i class="la la-check text-success mr-2"></i> Accès à 7 formations live de type 1Star </li>
                            <li><i class="la la-check text-success mr-2"></i> 1 an d’abonnement</li>
                            <li><i class="la la-check text-success mr-2"></i> Obtention de certificats de participa- tion aux formations (si prouvé)</li>
                            <li><i class="la la-close text-danger mr-2"></i> Options de Mise à Niveau</li>
                        </ul>
                        <div class="price-btn-box pt-30px">
                            <a href="#" class="btn theme-btn theme-btn-transparent w-100">Choisissez un Plan<i class="la la-arrow-right icon ml-1"></i></a>
                            <a href="#" class="btn theme-btn theme-btn-customize w-100 mt-2">Personnaliser l'Abonnement<i class="la la-cog icon ml-1"></i></a>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item package-item-active">
                    <div class="card-body">
                        <span class="package-tooltip">Recommended</span>
                        <div class="package-price-box border-bottom border-bottom-gray pb-4 mb-4">
                            <h3 class="fs-45 font-weight-semi-bold pb-2"><span>5900</span> DH</h3>
                            <h4 class="fs-20 font-weight-semi-bold">PACK INTERMEDIA</h4>
                        </div><!-- end package-price-box -->
                        <ul class="generic-list-item">
                            <li><i class="la la-check text-success mr-2"></i> Nomber de formation 10</li>
                            <li><i class="la la-check text-success mr-2"></i> Niveau 2</li>
                            <li><i class="la la-check text-success mr-2"></i> Ce pack est idéal pour les micro entreprises</li>
                            <li><i class="la la-check text-success mr-2"></i> Accès à 10 formations live de type 1Star et/ou 2Star </li>
                            <li><i class="la la-check text-success mr-2"></i> 1 an d’abonnement</li>
                            <li><i class="la la-check text-success mr-2"></i> Obtention de certificats de participa- tion aux formations (si prouvé)</li>
                            <li><i class="la la-close text-danger mr-2"></i> Options de Mise à Niveau</li>
                        </ul>
                        <div class="price-btn-box pt-30px">
                            <a href="#" class="btn theme-btn w-100">Choisissez un Plan <i class="la la-arrow-right icon ml-1"></i></a>
                            <a href="#" class="btn theme-btn theme-btn-customize w-100 mt-2">Personnaliser l'Abonnement<i class="la la-cog icon ml-1"></i></a>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item">
                    <div class="card-body">
                        <div class="package-price-box border-bottom border-bottom-gray pb-4 mb-4">
                            <h3 class="fs-45 font-weight-semi-bold pb-2"><span>11900</span> DH</h3>
                            <h4 class="fs-20 font-weight-semi-bold">PACK PRO</h4>
                        </div><!-- end package-price-box -->
                        <ul class="generic-list-item">
                            <li><i class="la la-check text-success mr-2"></i> Nomber de formation 12</li>
                            <li><i class="la la-check text-success mr-2"></i> Niveau 3</li>
                            <li><i class="la la-check text-success mr-2"></i> Ce pack est idéal pour les salariés et cadres d'entreprises en informatique.</li>
                            <li><i class="la la-check text-success mr-2"></i> Idéal our les salariés des entreprises </li>
                            <li><i class="la la-check text-success mr-2"></i> Accès à 12 formations live de type 1Star - 2Star -  3Star</li>
                            <li><i class="la la-check text-success mr-2"></i> 1 an d’abonnement</li>
                            <li><i class="la la-check text-success mr-2"></i> Options de Mise à Niveau</li>
                        </ul>
                        <div class="price-btn-box pt-30px">
                            <a href="#" class="btn theme-btn theme-btn-transparent w-100">Choisissez un Plan <i class="la la-arrow-right icon ml-1"></i></a>
                            <a href="#" class="btn theme-btn theme-btn-customize w-100 mt-2">Personnaliser l'Abonnement<i class="la la-cog icon ml-1"></i></a>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end package-area -->
<!-- ================================
       START PACKAGE AREA
================================= -->

<!-- ================================
         END FOOTER AREA
================================= -->
@endsection