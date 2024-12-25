@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
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
    <!--end breadcrumb-->

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
                    <div class="invalid-feedback" id="date_debut_error"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" class="form-control" id="date_fin" placeholder="Date de fin" required>
                    <div class="invalid-feedback" id="date_fin_error"></div>
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
                            <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals " required>
                        </div>
                    </div>
                    <div class="form-group col-md-6" style="padding-top: 30px;">
                        <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Ajouter plus...</a>
                    </div>
                </div> <!---end row-->

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

<!--========== Start of add multiple class with ajax ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="goals">Objectif</label>
                        <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals  ">
                    </div>
                    <div class="form-group col-md-6" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Ajouter</i></span>
                        <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Supprimer</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>      

<script>
    function validateDates() {
    var dateDebut = new Date($('#date_debut').val());
    var dateFin = new Date($('#date_fin').val());
    var today = new Date();
    today.setHours(0, 0, 0, 0);

    $('#date_debut, #date_fin').removeClass('is-invalid').next('.invalid-feedback').remove();

    if (dateDebut < today) {
        $('#date_debut').addClass('is-invalid');
        $('<span class="invalid-feedback">La date de début ne peut pas être dans le passé</span>')
            .insertAfter('#date_debut');
        return false;
    }

    if (dateFin < dateDebut) {
        $('#date_fin').addClass('is-invalid');
        $('<span class="invalid-feedback">La date de fin doit être postérieure à la date de début</span>')
            .insertAfter('#date_fin');
        return false;
    }

    return true;
}

// Event listeners pour la validation des dates
$('#date_debut, #date_fin').on('change', validateDates);
</script>
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

    // Script pour la gestion des catégories
    $('select[name="category_id"]').on('change', function() {
        var category_id = $(this).val();
        if (category_id) {
            $.ajax({
                url: "/subcategory/ajax/" + category_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var subcategorySelect = $('select[name="subcategory_id"]');
                    subcategorySelect.empty();
                    $.each(data, function(key, value) {
                        subcategorySelect.append(
                            $('<option></option>')
                                .val(value.id)
                                .text(value.subcategory_name)
                        );
                    });
                },
                error: function() {
                    alert('Erreur lors du chargement des sous-catégories');
                }
            });
        }
    });

    // Validation du formulaire avec jQuery Validate
    $('#myForm').validate({
        rules: {
            course_name: {
                required: true,
                minlength: 3,
                maxlength: 500
            },
            course_title: {
                required: true,
                minlength: 3,
                maxlength: 500
            },
            course_image: {
                required: true,
                accept: "image/jpeg,image/png,image/jpg,image/gif"
            },
            video: {
                required: true,
                accept: "video/mp4"
            },
            category_id: {
                required: true
            },
            selling_price: {
                required: true,
                number: true,
                min: 0,
                max: 999999.99
            },
            discount_price: {
                number: true,
                min: 0,
                max: 999999.99,
                lessThan: "#selling_price"
            },
            date_debut: {
                required: true,
                date: true
            },
            date_fin: {
                required: true,
                date: true
            }
        },
        messages: {
            course_name: {
                required: 'Veuillez entrer le nom du cours',
                minlength: 'Le nom doit contenir au moins 3 caractères',
                maxlength: 'Le nom ne peut pas dépasser 500 caractères'
            },
            course_title: {
                required: 'Veuillez entrer le titre du cours',
                minlength: 'Le titre doit contenir au moins 3 caractères',
                maxlength: 'Le titre ne peut pas dépasser 500 caractères'
            },
            course_image: {
                required: 'Veuillez sélectionner une image',
                accept: 'Format accepté: jpeg, png, jpg, gif'
            },
            video: {
                required: 'Veuillez sélectionner une vidéo',
                accept: 'Format accepté: mp4'
            },
            category_id: {
                required: 'Veuillez sélectionner une catégorie'
            },
            selling_price: {
                required: 'Veuillez entrer le prix de vente',
                number: 'Veuillez entrer un nombre valide',
                min: 'Le prix ne peut pas être négatif',
                max: 'Le prix ne peut pas dépasser 999999.99'
            },
            date_debut: {
                required: 'Veuillez entrer la date de début',
                date: 'Veuillez entrer une date valide'
            },
            date_fin: {
                required: 'Veuillez entrer la date de fin',
                date: 'Veuillez entrer une date valide'
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    // Validation personnalisée pour le prix réduit
    $.validator.addMethod("lessThan", function(value, element, param) {
        var target = $(param);
        if (this.optional(element) || this.optional(target[0])) {
            return true;
        }
        return Number(value) < Number(target.val());
    }, "Le prix réduit doit être inférieur au prix de vente");

    // Validation des dates
    function validateDates() {
        var dateDebut = new Date($('#date_debut').val());
        var dateFin = new Date($('#date_fin').val());
        var today = new Date();
        today.setHours(0, 0, 0, 0);

        $('#date_debut, #date_fin').removeClass('is-invalid').next('.invalid-feedback').remove();

        if (dateDebut < today) {
            $('#date_debut').addClass('is-invalid');
            $('<span class="invalid-feedback">La date de début ne peut pas être dans le passé</span>')
                .insertAfter('#date_debut');
            return false;
        }

        if (dateFin < dateDebut) {
            $('#date_fin').addClass('is-invalid');
            $('<span class="invalid-feedback">La date de fin doit être postérieure à la date de début</span>')
                .insertAfter('#date_fin');
            return false;
        }

        return true;
    }

    // Event listeners pour la validation des dates
    $('#date_debut, #date_fin').on('change', validateDates);

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

    // Validation finale avant soumission du formulaire
    $('#myForm').on('submit', function(e) {
        if (!validateDates()) {
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endsection