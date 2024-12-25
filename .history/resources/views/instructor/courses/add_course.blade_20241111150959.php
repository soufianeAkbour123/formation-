@extends('instructor.instructor_dashboard')
@section('instructor')

<!-- CSS et Meta -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Contenu Principal -->
<div class="page-content">
    <div class="row">
        <div class="col-12">
            <!-- Affichage des messages d'erreur ou de succès -->
            @if(session('message'))
                <div class="alert alert-{{ session('alert-type') }}">
                    {{ session('message') }}
                </div>
            @endif

            <!-- En-tête du cours -->
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">{{ $course->course_name }}</h5>
                            <p class="mb-0">{{ $course->course_title }}</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                            Ajouter une Séance
                        </button>
                    </div>
                </div>
            </div>

            <!-- Liste des sections -->
            @foreach ($course->sections as $key => $section)
            <div class="container mt-4">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <!-- En-tête de section -->
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center section-header" data-section="{{ $key }}">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-chevron-right section-toggle {{ $key === 0 ? 'rotate' : '' }}"></i>
                                            <div class="editable-wrapper">
                                                <h6 class="editable mb-0" data-id="{{ $section->id }}">
                                                    {{ $section->section_title }}
                                                </h6>
                                                <i class="fas fa-edit edit-btn"></i>
                                                <div class="edit-controls" style="display: none;">
                                                    <button class="btn btn-sm btn-success save-btn">Sauvegarder</button>
                                                    <button class="btn btn-sm btn-danger cancel-btn">Annuler</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dates-info">
                                            <span>Début : </span>
                                            <span class="editable-date" id="start_time_display_{{ $section->id }}">
                                                {{ \Carbon\Carbon::parse($section->start_time)->format('Y-m-d H:i') }}
                                            </span>
                                            <i class="fas fa-edit edit-date-btn"></i>
                                            <span> - Fin : </span>
                                            <span class="editable-date" id="end_time_display_{{ $section->id }}">
                                                {{ \Carbon\Carbon::parse($section->end_time)->format('Y-m-d H:i') }}
                                            </span>
                                            <i class="fas fa-edit edit-date-btn"></i>
                                        </div>
                                        <h6 class="editable mb-0" data-id="{{ $section->id }}">
                                            {{ $section->link }}
                                        </h6>

                                        <div class="d-flex gap-2">
                                            <form action="{{ route('delete.section', $section->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-primary btn-sm add-lecture-btn" 
                                                    data-course="{{ $course->id }}" 
                                                    data-section="{{ $section->id }}">
                                                Ajouter chapitre
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contenu de la section (lectures) -->
                                <div class="card-body pt-0 section-content" style="display: {{ $key === 0 ? 'block' : 'none' }};">
                                    <div id="lectureContainer{{ $key }}">
                                        @foreach ($section->lectures as $lecture)
                                        <div class="lectureDiv mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="lecture-number me-2">{{ $loop->iteration }}.</span>
                                                    <div class="editable-wrapper">
                                                        <strong class="editable" data-id="{{ $lecture->id }}">
                                                            {{ $lecture->lecture_title }}
                                                        </strong>
                                                        <i class="fas fa-edit edit-btn"></i>
                                                        <div class="edit-controls" style="display: none;">
                                                            <button class="btn btn-sm btn-success save-btn">Sauvegarder</button>
                                                            <button class="btn btn-sm btn-danger cancel-btn">Annuler</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="{{ route('delete.lecture', $lecture->id) }}" class="btn btn-danger btn-sm delete-link">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            @if($lecture->content)
                                            <div class="lecture-content mt-2">
                                                {{ $lecture->content }}
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal d'ajout de section -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Séance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.course.section') }}" method="POST" id="addSectionForm">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Titre de la séance</label>
                        <input type="text" name="section_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure de début</label>
                        <input type="datetime-local" id="date_debut" name="start_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure de fin</label>
                        <input type="datetime-local" id="date_fin" name="end_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lien (Google Meet, Zoom, etc.)</label>
                        <input type="url" name="link" class="form-control" placeholder="https://meet.google.com/xyz-abc" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Template pour le formulaire de lecture -->
<template id="lectureFormTemplate">
    <form action="{{ route('save-lecture') }}" method="POST" class="lectureDiv mb-3 lecture-form">
        @csrf
        <input type="hidden" name="course_id" value="">
        <input type="hidden" name="section_id" value="">
        <div class="d-flex flex-column gap-2">
            <div class="d-flex align-items-center gap-2">
                <input type="text" name="lecture_title" class="form-control" placeholder="Titre du chapitre" required>
                <div class="btn-group">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fas fa-save"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm cancel-lecture">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <textarea name="content" class="form-control" placeholder="Contenu du chapitre" rows="3"></textarea>
        </div>
    </form>
</template>

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