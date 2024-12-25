@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
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
        <input type="text" name="course_name" class="form-control" id="input1">
    </div>
    <div class="form-group col-md-6">
        <label for="input1" class="form-label">Titre du cours</label>
        <input type="text" name="course_title" class="form-control" id="input1">
    </div>

    <div class="form-group col-md-6">
        <label for="input2" class="form-label">Image du cours</label>
        <input class="form-control" name="course_image" type="file" id="image">
    </div>
    <div class="col-md-6">
        <img id="showImage" src="{{ url('upload/no_image.jpg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="100">
    </div>

    <div class="form-group col-md-6">
        <label for="input1" class="form-label">Vidéo d'introduction du cours</label>
        <input type="file" name="video" class="form-control" accept="video/mp4, video/webm">
    </div>
    <div class="form-group col-md-6">
    <label for="programme_file" class="form-label">Programme de formation détaillé</label>
    <input type="file" name="programme_file" class="form-control" accept=".pdf">
</div>

    <div class="form-group col-md-4">
        <label for="input1" class="form-label">Catégorie du cours</label>
        <select name="category_id" class="form-select mb-3" aria-label="Default select example">
            <option selected="" disabled>Ouvrir ce menu déroulant</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
            @endforeach
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
        <input type="text" name="selling_price" class="form-control" id="input1">
    </div>

    <div class="form-group col-md-4">
        <label for="input1" class="form-label">Prix réduit</label>
        <input type="text" name="discount_price" class="form-control" id="input1">
    </div>

    <div class="form-group col-md-4">
        <label for="input1" class="form-label">Durée</label>
        <input type="text" name="duration" class="form-control" id="input1">
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
    <input type="date" name="date_debut" class="form-control" id="date_debut" placeholder="Date de début">
    <div class="invalid-feedback" id="date_debut_error"></div>
</div>
<div class="form-group col-md-6">
    <label for="date_fin" class="form-label">Date de fin</label>
    <input type="date" name="date_fin" class="form-control" id="date_fin" placeholder="Date de fin">
    <div class="invalid-feedback" id="date_fin_error"></div>
</div>

    <div class="form-group col-md-12">
        <label for="input1" class="form-label">Prérequis du cours</label>
        <textarea name="prerequisites" class="form-control" id="input11" placeholder="Adresse ..." rows="3"></textarea>
    </div>

    <div class="form-group col-md-12">
    <label class="form-label">Description du cours</label>
    <div class="description-sections">
        <div class="row description-section">
            <div class="col-md-11">
                <input type="text" name="titles[]" class="form-control mb-2" placeholder="Titre de la section" required>
                <div class="content-sections">
                    <div class="row content-section">
                        <textarea name="contents[]" class="form-control mb-3" rows="3" placeholder="Contenu de la section" required></textarea>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-content-section"><i class="fa fa-minus-circle"></i> Supprimer</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success add-content-section mb-2"><i class="fa fa-plus-circle"></i> Ajouter un contenu</button>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-success add-description-section"><i class="fa fa-plus-circle"></i> Ajouter un Titre</button>
            </div>
        </div>
    </div>
</div>




    <p>Objectifs du cours </p>
             
             <!--   //////////// Goal Option /////////////// -->
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
                  </div> <!---end row-->
             <!--   //////////// End Goal Option /////////////// -->
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
$(document).ready(function() {
    // Vos scripts existants pour la gestion des sections
    $('.add-description-section').click(function() {
        var newSection = $('.description-section:first').clone();
        newSection.find('input, textarea').val('');
        newSection.find('.content-section').remove();
        $('.description-sections').append(newSection);
    });

    $(document).on('click', '.add-content-section', function() {
        var newContentSection = `
            <div class="row content-section">
                <textarea name="section_contents[][]" class="form-control mb-3" rows="3" placeholder="Contenu de la section"></textarea>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-content-section"><i class="fa fa-minus-circle"></i></button>
                </div>
            </div>`;
        $(this).siblings('.content-sections').append(newContentSection);
    });

    $(document).on('click', '.remove-content-section', function() {
        $(this).closest('.content-section').remove();
    });

    // Script pour la gestion des events (counter)
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
                    $('select[name="subcategory_id"]').html('');
                    var d = $('select[name="subcategory_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    });

    // Validation du formulaire avec jQuery Validate
    $('#myForm').validate({
        rules: {
            course_name: {
                required: true,
            },
            course_title: {
                required: true,
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
                required: 'Please Enter Course Name',
            },
            course_title: {
                required: 'Please Enter Course Title',
            },
            date_debut: {
                required: 'Please Enter Start Date',
                date: 'Please Enter Valid Date'
            },
            date_fin: {
                required: 'Please Enter End Date',
                date: 'Please Enter Valid Date'
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

    // Nouvelle validation personnalisée pour les dates
    $.validator.addMethod("dateRange", function(value, element) {
        var startDate = new Date($('#date_debut').val());
        var endDate = new Date($('#date_fin').val());
        return endDate >= startDate;
    }, "La date de fin doit être postérieure à la date de début");

    // Validation des dates en temps réel
    function validateDates() {
        var dateDebut = new Date($('#date_debut').val());
        var dateFin = new Date($('#date_fin').val());
        var today = new Date();
        today.setHours(0, 0, 0, 0);

        // Réinitialiser les messages d'erreur
        $('#date_debut, #date_fin').removeClass('is-invalid').next('.invalid-feedback').remove();

        // Vérification date de début dans le passé
        if (dateDebut < today) {
            $('#date_debut').addClass('is-invalid');
            $('<span class="invalid-feedback">La date de début ne peut pas être dans le passé</span>')
                .insertAfter('#date_debut');
            return false;
        }

        // Vérification cohérence des dates
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
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
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