@extends('frontend.master')

@section('home')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">S'inscrire</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Accueil</a></li>
                <li>Pages</li>
                <li>S'inscrire</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START CONTACT AREA
================================= -->
<section class="contact-area section--padding position-relative">
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="card-title text-center fs-24 lh-35 pb-4">Créez un compte et <br> Commencez à apprendre !</h3>
                        <div class="section-block"></div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Nom -->
                            <div class="input-box">
                                <x-input-label for="name" :value="__('Nom')" />
                                <div class="form-group">
                                    <x-text-input id="name" class="form-control form--control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <span class="la la-user input-icon"></span>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div><!-- end input-box -->

                            <!-- Email -->
                            <div class="input-box">
                                <x-input-label for="email" :value="__('Email')" />
                                <div class="form-group">
                                    <x-text-input id="email" class="form-control form--control" type="email" name="email" :value="old('email')" required autocomplete="email" />
                                    <span class="la la-envelope input-icon"></span>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div><!-- end input-box -->

                            <!-- Mot de passe -->
                            <div class="input-box">
                                <x-input-label for="password" :value="__('Mot de passe')" />
                                <div class="form-group">
                                    <x-text-input id="password" class="form-control form--control" type="password" name="password" required autocomplete="new-password" />
                                    <span class="la la-lock input-icon"></span>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div><!-- end input-box -->

                            <!-- Confirmation du mot de passe -->
                            <div class="input-box">
                                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                                <div class="form-group">
                                    <x-text-input id="password_confirmation" class="form-control form--control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    <span class="la la-lock input-icon"></span>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div><!-- end input-box -->

                            <!-- Conditions et soumission -->
                            <div class="btn-box">
                                <div class="custom-control custom-checkbox mb-4 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="agreeCheckbox" required>
                                    <label class="custom-control-label custom--control-label" for="agreeCheckbox">En vous inscrivant, vous acceptez les 
                                        <a href="terms-and-conditions.html" class="text-color hover-underline">termes et conditions</a> et 
                                        <a href="privacy-policy.html" class="text-color hover-underline">la politique de confidentialité</a>.
                                    </label>
                                </div>
                                <button class="btn theme-btn" type="submit">Créer un compte <i class="la la-arrow-right icon ml-1"></i></button>
                                <p class="fs-14 pt-2">Déjà inscrit ? <a href="{{ route('login') }}" class="text-color hover-underline">Connexion</a></p>
                            </div><!-- end btn-box -->
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end contact-area -->

@endsection
