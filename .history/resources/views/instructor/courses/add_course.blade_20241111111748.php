```php:resources/views/instructor/courses/add_course.blade.php
@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un Cours</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Ajouter un Cours</h5>

            <form id="myForm" action="{{ route('store.course') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Nom du cours</label>
                    <input type="text" name="course_name" class="form-control" id="input1" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Titre du cours</label>
                    <input type="text" name="course_title" class="form-control" id="input1" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Image du cours</label>
                    <input class="form-control" name="course_image" type="file" id="image" required>
                </div>
                <div class="col-md-6">
                    <img id="showImage" src="{{ url('upload/no_image.jpg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="100">
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Vidéo d'introduction du cours</label>
                    <input type="file" name="video" class="form-control" accept="video/mp4, video/webm" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="programme_file" class="form-label">Programme de formation détaillé</label>
                    <input type="file" name="programme_file" class="form-control" accept=".pdf">
                </div>

                <div class="form-group col-md-4">
                    <label for="input1" class="form-label">Catégorie du cours</label>
                    <select name="category_id" class="form-select mb-3" aria-label="Default select example" required>
                        <option selected="" disabled>Ouvrir ce menu déroulant</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="input1" class="form-label">Sous-catégorie du cours</label>
                    <select name="subcategory_id" class="form-select mb-3" aria-label="Default select example">
                        <option></option>
                        <!-- Ajouter ici les sous-catégories si nécessaire -->
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="input1" class="form-label">Certificat disponible</label>
                    <select name="certificate" class="form-select mb-3" aria-label="Default select example">
                        <option selected="" disabled>Ouvrir ce menu déroulant</option>
                        <option value="Yes">Oui</option>
                        <option value="No">Non</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="input1" class="form-label">Étiquette du cours</label>
                    <select name="label" class="form-select mb-3" aria-label="Default select example">
                        <option selected="" disabled>Ouvrir ce menu déroulant</option>
                        <option value="Begginer">Débutant</option>
                        <option value="Middle">Intermédiaire</option>
                        <option value="Advance">Avancé</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="input1" class="form-label">Prix du cours</label>
                    <input type="text" name="selling_price" class="form-control" id="input1" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="input1" class="form-label">Prix réduit</label>
                    <input type="text" name="discount_price" class="form-control" id="input1">
                </div>

                <div class="form-group col-md-4">
                    <label for="input1" class="form-label">Durée</label>
                    <input type="text" name="duration" class="form-control" id="input1" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="nombre_maxDInscrit" class="form-label">Nombre maximum d'inscrits</label>
                    <input type="number" name="nombre_maxDInscrit" class="form-control" id="nombre_maxDInscrit" placeholder="Nombre maximum d'inscrits">
                </div>

                <div class="form-group col-md-4">
                    <label for="type_formation" class="form-label">Type de formation</label>
                    <select name="type_formation" class="form-select mb-3" aria-label="Default select example">
                        <option selected="" disabled>Choisissez le type de formation</option>
                        <option value="présentiel">Présentiel</option>
                        <option value="hybride">Hybride</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <input type="date" name="date_debut" class="form-control" id="date_debut" placeholder="Date de début" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" class="form-control" id="date_fin" placeholder="Date de fin" required>
                </div>

                <div class="form-group col-md-12">
                    <label for="input1" class="form-label">Prérequis du cours</label>
                    <textarea name="prerequisites" class="form-control" id="input11" placeholder="Adresse ..." rows="3"></textarea>
                </div>

                <p>Objectifs du cours </p>
                <div class="row add_item">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="goals" class="form-label">Objectifs </label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals ">
                        </div>
                    </div>
                    <div class="form-group col-md-6" style="padding-top: 30px;">
                        <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Ajouter plus...</a>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bestseller" value="1" id="flexCheckDefault1">
                            <label class="form-check-label" for="flexCheckDefault1">Meilleure vente</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" value="1" id="flexCheckDefault2">
                            <label class="form-check-label" for="flexCheckDefault2">En vedette</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="highestrated" value="1" id="flexCheckDefault3">
                            <label class="form-check-label" for="flexCheckDefault3">Le mieux noté</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Sauvegarder les modifications</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Script pour la gestion des objectifs (counter)
    var counter = 0;
    $(document).on("click", ".addeventmore", function() {
        var whole_extra_item_add = $("#whole_extra_item_add").html();
        $(this).closest(".add_item").append(whole_extra_item_add);
        counter++;
    });
    
    $(document).on("click", ".removeeventmore", function(event) {
        $(this).closest("#whole_extra_item_delete").remove();
        counter -= 1;
    });

    // Preview de l'image
    $('#image').change(function(e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
@endsection