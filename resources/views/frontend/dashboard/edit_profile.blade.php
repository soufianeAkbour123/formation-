@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

<div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
    <div class="media media-card align-items-center">
        <div class="media-img media--img media-img-md rounded-full">
            <img class="rounded-full" src="{{ (!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg')}}" alt="Image miniature de l'étudiant">
        </div>
        <div class="media-body">
            <h2 class="section__title fs-30">Bonjour, {{ $profileData->name }}</h2>

        </div><!-- end media-body -->
    </div><!-- end media -->

</div><!-- end breadcrumb-content -->


<div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
    <div class="setting-body">
        <h3 class="fs-17 font-weight-semi-bold pb-4">Modifier le profil</h3>


        <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" class="row pt-40px">
        @csrf

        <div class="media media-card align-items-center">
            <div class="media-img media-img-lg mr-4 bg-gray">
                <img class="mr-3" src="{{ (!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg')}}" alt="image d'avatar">
            </div>
            <div class="media-body">
                <div class="file-upload-wrap file-upload-wrap-2">
                <input type="file" name="photo" class="multi file-upload-input with-preview" multiple>
                <span class="file-upload-text"><i class="la la-photo mr-2"></i>Ajouter une photo</span>
            </div>

                <p class="fs-14">La taille maximale du fichier est de 5MB, dimensions minimales : 200x200. Les fichiers acceptés sont .jpg et .png</p>
            </div>
        </div><!-- end media -->

            <div class="input-box col-lg-6">
                <label class="label-text">Nom</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="name" value="{{ $profileData->name }}">
                    <span class="la la-user input-icon"></span>
                </div>
            </div><!-- end input-box -->
            <div class="input-box col-lg-6">
                <label class="label-text">Nom d'utilisateur</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="username" value="{{ $profileData->username }}">
                    <span class="la la-user input-icon"></span>
                </div>
            </div><!-- end input-box -->
            <div class="input-box col-lg-6">
                <label class="label-text">Email</label>
                <div class="form-group">
                    <input class="form-control form--control" type="email" name="email" value="{{ $profileData->email }}">
                    <span class="la la-user input-icon"></span>
                </div>
            </div><!-- end input-box -->


            <div class="input-box col-lg-6">
                <label class="label-text">Téléphone</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="phone" value="{{ $profileData->phone }}">
                    <span class="la la-user input-icon"></span>
                </div>
            </div><!-- end input-box -->

            <div class="input-box col-lg-6">
                <label class="label-text">Adresse</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="address" value="{{ $profileData->address }}">
                    <span class="la la-user input-icon"></span>
                </div>
            </div><!-- end input-box -->

            <div class="input-box col-lg-12 py-2">
                <button class="btn theme-btn">Enregistrer les modifications</button>
            </div><!-- end input-box -->
        </form>
    </div><!-- end setting-body -->
</div><!-- end tab-pane -->
@endsection
