@extends('instructor.instructor_dashboard')
@section('instructor')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="{{ asset('css/course.css') }}">
<script src="{{ asset('js/course.js') }}"></script>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <!-- Course Header Card -->
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90" height="90" alt="">
                        <div class="flex-grow-1 ms-3">
                            <h5>{{ $course->course_name }}</h5>
                            <p class="mb-0">{{ $course->course_title }}</p>
                        </div>
                        <!-- Bouton pour ajouter une séance -->
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                            <i class="las la-plus me-1"></i>Ajouter Séance
                        </button>
                        <!-- Bouton pour planifier une séance en Teams -->
                        <button 
                            type="button" 
                            class="btn btn-secondary" 
                            onclick="window.open('https://teams.microsoft.com/v2/?meetingjoin=true', '_blank')">
                            <i class="las la-video me-1"></i>Planifier en Teams
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sections List -->
            <div class="curriculum-content mt-4">
                <div class="accordion" id="courseAccordion">
                    @foreach ($sections->sortBy('date') as $key => $item)
                    <div class="course-section 
                        {{ $item->is_cancelled ? 'cancelled-section' : '' }}
                        {{ $item->is_postponed ? 'postponed-section' : '' }}
                        {{ \Carbon\Carbon::parse($item->date)->isPast() ? 'past-section' : '' }}" 
                        id="section-container-{{ $item->id }}">
                        <div class="section-header" data-section="{{ $item->id }}">
                            @if($item->is_cancelled)
                                <div class="cancellation-badge">ANNULÉ</div>
                                <div class="cancellation-reason">
                                    Raison : {{ $item->cancellation_reason }}
                                </div>
                            @endif

                            @if($item->is_postponed)
                                <div class="postponement-banner">
                                    <div class="postponement-icon">
                                        <i class="las la-clock"></i>
                                    </div>
                                    <div class="postponement-details">
                                        <strong>Séance Reportée</strong>
                                        <p>{{ $item->note }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="section-header-content">
                                <div class="section-main-info">
                                    <div class="section-title-container">
                                        <div class="toggle-icon">
                                            <i class="las la-angle-down"></i>
                                        </div>
                                        <h6 class="mb-0 editable-section-title" data-id="{{ $item->id }}">
                                            <span class="section-title-text">{{ $item->section_title }}</span>
                                            @if(!$item->is_cancelled && !\Carbon\Carbon::parse($item->date)->isPast())
                                                <i class="las la-edit edit-icon" style="cursor: pointer;"></i>
                                            @endif
                                        </h6>
                                        <span class="chapter-count">{{ count($item->lectures) }} Chapitres</span>
                                    </div>
                                    <div class="action-buttons">
                                        @if($item->is_cancelled)
                                            <!-- Boutons spécifiques pour séance annulée -->
                                            <button class="btn btn-sm btn-warning reschedule-section" 
            data-id="{{ $item->id }}" 
            title="Reprogrammer la séance">
        <i class="las la-calendar-alt"></i> Reprogrammer
    </button>
    <button class="btn btn-sm btn-success restore-section" 
            data-id="{{ $item->id }}" 
            title="Rétablir la séance">
        <i class="las la-undo-alt"></i> Rétablir
    </button>
    <button class="btn btn-sm btn-danger delete-section" 
            data-id="{{ $item->id }}" 
            data-title="{{ $item->section_title }}">
        <i class="las la-trash"></i> Supprimer
    </button>
                                        @elseif($item->is_postponed)
                                            <button class="btn btn-sm btn-success restore-section" 
                                                    data-id="{{ $item->id }}" 
                                                    title="Rétablir la séance">
                                                <i class="las la-undo-alt"></i> Rétablir
                                            </button>
                                        @elseif(\Carbon\Carbon::parse($item->date)->isPast())
                                            <!-- Pour les séances passées, seul le bouton de suppression reste actif -->
                                            <button class="btn btn-sm btn-info add-video-url" data-id="{{ $item->id }}" data-video="{{ $item->video_url }}">
                                                <i class="las la-video"></i> Vidéos enregistrées
                                            </button>
                                            <button class="btn btn-sm btn-danger delete-section" 
                                                    data-id="{{ $item->id }}" 
                                                    data-title="{{ $item->section_title }}">
                                                <i class="las la-trash"></i>
                                            </button>
                                        @else
                                            <!-- Code original pour les séances futures -->
                                            <button class="btn btn-sm btn-primary add-lecture-btn" onclick="addLecture({{ $course->id }}, {{ $item->id }})">
                                                <i class="las la-plus"></i>Chapitre
                                            </button>
                                            <button class="btn btn-sm btn-info add-video-url" data-id="{{ $item->id }}" data-video="{{ $item->video_url }}">
                                                <i class="las la-video"></i> Vidéos enregistrées
                                            </button>
                                            <button class="btn btn-sm btn-warning cancel-section" 
                                                    data-id="{{ $item->id }}" 
                                                    data-title="{{ $item->section_title }}">
                                                <i class="las la-ban"></i> Annuler
                                            </button>
                                            <button class="btn btn-sm btn-danger delete-section" 
                                                    data-id="{{ $item->id }}" 
                                                    data-title="{{ $item->section_title }}">
                                                <i class="las la-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="section-details">
                                    <div class="detail-item">
                                        <label>Date</label>
                                        <span class="value editable-date" data-id="{{ $item->id }}">
                                            <span class="date-text">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</span>
                                            @if(!$item->is_cancelled && !\Carbon\Carbon::parse($item->date)->isPast())
                                                <i class="las la-edit edit-icon" style="cursor: pointer;"></i>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="detail-item">
                                        <label>Horaires</label>
                                        <span class="value editable-time" data-id="{{ $item->id }}">
                                            <span class="start-time-text">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}</span> -
                                            <span class="end-time-text">{{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</span>
                                            @if(!$item->is_cancelled && !\Carbon\Carbon::parse($item->date)->isPast())
                                                <i class="las la-edit edit-icon" style="cursor: pointer;"></i>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="detail-item">
                                        <label>Lien</label>
                                        <span class="value editable-link" data-id="{{ $item->id }}">
                                            <a href="{{ $item->link }}" target="_blank" title="{{ $item->link }}" class="section-link">
                                                {{ Str::limit($item->link, 30, '...') }}
                                            </a>
                                            @if(!$item->is_cancelled && !\Carbon\Carbon::parse($item->date)->isPast())
                                                <i class="las la-edit edit-icon" style="cursor: pointer;"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-body" id="section-body-{{ $item->id }}">
                            <div id="lecture-form-{{ $item->id }}" style="display: none;" class="mb-3 p-3 bg-white rounded">
                                <!-- Formulaire de lecture -->
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="lecture-title-{{ $item->id }}" placeholder="Titre du Chapitre">
                                </div>
                                
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-secondary" onclick="cancelLecture({{ $item->id }})">Annuler</button>
                                    <button class="btn btn-primary" onclick="saveLecture({{ $course->id }}, {{ $item->id }})">Sauvegarder</button>
                                </div>
                            </div>

                            <div id="lecture-list-{{ $item->id }}">
                                @foreach ($item->lectures as $lecture)
                                <div class="lecture-item">
                                    <div>
                                        <i class="las la-play-circle me-2"></i>
                                        <span class="editable-lecture-title" data-id="{{ $lecture->id }}">
                                            <span class="lecture-title-text">{{ $lecture->lecture_title }}</span>
                                            @if(!$item->is_cancelled && !\Carbon\Carbon::parse($item->date)->isPast())
                                                <i class="las la-edit edit-icon" style="cursor: pointer;"></i>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="action-buttons">
                                        @if(!$item->is_cancelled && !\Carbon\Carbon::parse($item->date)->isPast())
                                            <button class="btn btn-sm btn-danger delete-lecture" 
                                                    data-id="{{ $lecture->id }}" 
                                                    data-title="{{ $lecture->lecture_title }}">
                                                <i class="las la-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal pour reprogrammer une séance -->
<div class="modal fade" id="rescheduleSectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reprogrammer la séance</h5>
                <button type="button" data-bs-toggle="modal" data-bs-target="#rescheduleSectionModal">
    Reprogrammer
</button>
            </div>
            <div class="modal-body">
                <form id="rescheduleSectionForm">
                    @csrf
                    <input type="hidden" id="reschedule_original_section_id" name="original_section_id">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Titre de la séance</label>
                        <input type="text" id="reschedule_section_title" name="section_title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Heure de début</label>
                        <input type="time" id="reschedule_start_time" name="start_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Heure de fin</label>
                        <input type="time" id="reschedule_end_time" name="end_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lien de la séance</label>
                        <input type="url" id="reschedule_link" name="link" class="form-control" placeholder="https://meet.google.com/xyz-abc" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Reprogrammer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cancelSectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Annuler la séance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="cancelSectionForm">
                    @csrf
                    <input type="hidden" id="cancel_section_id" name="section_id">
                    <div class="mb-3">
                        <label class="form-label">Raison de l'annulation</label>
                        <textarea class="form-control" id="cancellation_reason" name="cancellation_reason" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-warning">Confirmer l'annulation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Postpone Section Modal -->
<!-- <div class="modal fade" id="postponeSectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark">
                    <i class="las la-clock me-2"></i>Reporter la séance : 
                    <span id="section-title-display" class="text-dark"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="postponeSectionForm">
                    @csrf
                    <input type="hidden" id="postpone_section_id" name="section_id">
                    
                    <div class="alert alert-warning" role="alert">
                        <i class="las la-exclamation-triangle me-2"></i>
                        Vous êtes sur le point de reporter cette séance. Veuillez fournir une raison détaillée.
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Raison du report</label>
                        <textarea class="form-control" id="postpone_note" name="note" required 
                                  placeholder="Expliquez en détail pourquoi cette séance est reportée" 
                                  rows="4"
                                  maxlength="500"></textarea>
                        <small class="form-text text-muted">
                            <i class="las la-info-circle"></i> 
                            Maximum 500 caractères
                        </small>
                    </div>

                   

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="las la-times me-1"></i>Annuler
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class="las la-clock me-1"></i>Confirmer le report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
<!-- Modal pour l'URL de la vidéo -->
<div class="modal fade" id="videoUrlModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter l'URL de l'enregistrement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="videoUrlForm">
                    @csrf
                    <input type="hidden" id="section_id" name="section_id">
                    <div class="mb-3">
                        <label class="form-label">URL de l'enregistrement</label>
                        <input type="url" id="video_url" name="video_url" class="form-control" 
                               placeholder="https://drive.google.com/recording">
                        <div class="error-message text-danger mt-1"></div>
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
<!-- Modal pour ajouter une séance -->
<div class="modal fade" id="addSectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Séance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.course.section') }}" method="POST" id="addSectionForm">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Titre de la séance</label>
                        <input type="text" name="section_title" class="form-control" required>
                        <div class="error-message text-danger mt-1"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required pattern="\d{4}-\d{2}-\d{2}" min="<?php echo date('Y-m-d'); ?>"
>
                        <div class="error-message text-danger mt-1"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Heure de début</label>
                        <input type="time" name="start_time" class="form-control" required>
                        <div class="error-message text-danger mt-1"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Heure de fin</label>
                        <input type="time" name="end_time" class="form-control" required>
                        <div class="error-message text-danger mt-1"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lien de la séance</label>
                        <input type="url" name="link" class="form-control" placeholder="https://meet.google.com/xyz-abc" required>
                        <div class="error-message text-danger mt-1"></div>
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

<script>
    
  $('#rescheduleSectionForm').on('submit', function(e) {
    e.preventDefault();
    
    // Récupérer les données originales
    var originalData = $('#rescheduleSectionModal').data('originalData');

    // Préparer les données
    var formData = new FormData(this);
    formData.append('chapters', JSON.stringify(originalData.chapters));

    $.ajax({
        url: '{{ route("reschedule.course.section") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Séance reprogrammée',
                    text: 'La séance a été reprogrammée avec succès.'
                }).then(() => {
                    location.reload(); // Recharger la page
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: response.message
                });
            }
        },
        error: function(xhr) {
            // Gérer les erreurs de validation
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                
                // Afficher les erreurs de validation
                Object.keys(errors).forEach(function(field) {
                    var errorMessage = errors[field][0];
                    
                    // Trouver l'input correspondant et afficher l'erreur
                    var input = $('[name="' + field + '"]');
                    input.addClass('is-invalid');
                    
                    // Créer ou mettre à jour le message d'erreur
                    var errorElement = input.next('.invalid-feedback');
                    if (errorElement.length === 0) {
                        errorElement = $('<div class="invalid-feedback"></div>');
                        input.after(errorElement);
                    }
                    errorElement.text(errorMessage);
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Erreurs de validation',
                    text: 'Veuillez corriger les erreurs dans le formulaire.'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors de la reprogrammation.'
                });
            }
        }
    });
});

// Ajouter un écouteur pour effacer les erreurs de validation lors de la modification
$('#rescheduleSectionModal').on('input', 'input, textarea', function() {
    $(this).removeClass('is-invalid');
    $(this).next('.invalid-feedback').remove();
});
    </script>
  
<script>
$(document).ready(function() {
    // Postpone section event handler
    $('.postpone-section').on('click', function() {
        const sectionId = $(this).data('id');
        const sectionTitle = $(this).data('title');
        
        $('#section-title-display').text(sectionTitle);
        $('#postpone_section_id').val(sectionId);
        $('#postponeSectionModal').modal('show');
    });

    $('#postponeSectionForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '{{ route('postpone.section') }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.fire({
                    title: 'Séance Reportée',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
                $('#postponeSectionModal').modal('hide');
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Impossible de reporter la séance';
                Swal.fire({
                    title: 'Erreur',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Gestionnaire pour l'annulation de section
    $('#cancelSectionForm').on('submit', function(e) {
        e.preventDefault();
        
        const sectionId = $('#cancel_section_id').val();
        const cancellationReason = $('#cancellation_reason').val();

        $.ajax({
            url: '/instructor/cancel-section',
            method: 'POST',
            data: {
                section_id: sectionId,
                cancellation_reason: cancellationReason,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    const sectionContainer = $(`#section-container-${sectionId}`);
                    
                    // Ajouter la classe cancelled-section
                    sectionContainer.addClass('cancelled-section');
                    
                    // Ajouter le badge et la raison d'annulation
                    const titleContainer = sectionContainer.find('.section-title-container');
                    titleContainer.append(`
                        <div class="cancellation-badge">ANNULÉ</div>
                        <div class="cancellation-reason">
                            Raison : ${cancellationReason}
                        </div>
                    `);
                    
                    // Mettre à jour les boutons d'action
                    const actionButtons = sectionContainer.find('.action-buttons');
                    actionButtons.html(`
                        <button class="btn btn-sm btn-success restore-section" 
                                data-id="${sectionId}" 
                                title="Rétablir la séance">
                            <i class="las la-undo-alt"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-section" 
                                data-id="${sectionId}" 
                                data-title="${sectionContainer.find('.section-title-text').text()}">
                            <i class="las la-trash"></i>
                        </button>
                    `);
                    
                    // Fermer le modal
                    $('#cancelSectionModal').modal('hide');
                    
                    // Afficher un message de succès
                    Swal.fire('Succès', 'La séance a été annulée', 'success');
                    
                    // Réinitialiser les gestionnaires d'événements
                    initializeEventHandlers();
                }
            },
            error: function(xhr) {
                Swal.fire('Erreur', 'Une erreur est survenue', 'error');
            }
        });
    });

    // Fonction pour réinitialiser les gestionnaires d'événements
    function initializeEventHandlers() {
        // Réinitialiser le gestionnaire de restauration
        $('.restore-section').off('click').on('click', function() {
            const sectionId = $(this).data('id');
            
            Swal.fire({
                title: 'Rétablir la séance ?',
                text: 'Voulez-vous vraiment rétablir cette séance ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Oui, rétablir',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/instructor/restore-section',
                        method: 'POST',
                        data: {
                            section_id: sectionId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                const sectionContainer = $(`#section-container-${sectionId}`);
                                
                                // Supprimer les classes et éléments d'annulation
                                sectionContainer
                                    .removeClass('cancelled-section')
                                    .find('.cancellation-badge, .cancellation-reason')
                                    .remove();
                                
                                // Restaurer les boutons d'origine
                                const actionButtons = sectionContainer.find('.action-buttons');
                                actionButtons.html(`
                                    <button class="btn btn-sm btn-primary" onclick="addLecture(${courseId}, ${sectionId})">
                                        <i class="las la-plus"></i>
                                    </button>
                                    <button class="btn btn-sm btn-info add-video-url" data-id="${sectionId}" data-video="">
                                        <i class="las la-video"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning cancel-section" 
                                            data-id="${sectionId}" 
                                            data-title="${sectionContainer.find('.section-title-text').text()}">
                                        <i class="las la-ban"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-section" 
                                            data-id="${sectionId}" 
                                            data-title="${sectionContainer.find('.section-title-text').text()}">
                                        <i class="las la-trash"></i>
                                    </button>
                                `);
                                
                                Swal.fire('Succès', 'La séance a été rétablie', 'success');
                                
                                // Réinitialiser les gestionnaires d'événements
                                initializeEventHandlers();
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Erreur', 'Une erreur est survenue', 'error');
                        }
                    });
                }
            });
        });

        // Réinitialiser les autres gestionnaires si nécessaire
        $('.cancel-section').off('click').on('click', function() {
            const sectionId = $(this).data('id');
            $('#cancel_section_id').val(sectionId);
            $('#cancelSectionModal').modal('show');
        });
    }

    // Initialiser les gestionnaires d'événements au chargement
    initializeEventHandlers();
});
</script>
<script>
    // Gestionnaire pour ouvrir le modal d'URL vidéo
$(document).on('click', '.add-video-url', function() {
    const sectionId = $(this).data('id');
    const videoUrl = $(this).data('video');
    
    $('#section_id').val(sectionId);
    $('#video_url').val(videoUrl || '');
    $('#videoUrlModal').modal('show');
});

// Gestionnaire pour sauvegarder l'URL de la vidéo
$('#videoUrlForm').on('submit', function(e) {
    e.preventDefault();
    
    const sectionId = $('#section_id').val();
    const videoUrl = $('#video_url').val();
    
    $.ajax({
        url: '/update-video-url', // Créez cette route
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            section_id: sectionId,
            video_url: videoUrl
        },
        success: function(response) {
            if (response.success) {
                // Mettre à jour le bouton avec la nouvelle URL
                $(`.add-video-url[data-id="${sectionId}"]`).data('video', videoUrl);
                
                // Afficher une notification de succès
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: 'URL de la vidéo mise à jour avec succès',
                    timer: 1500
                });
                
                $('#videoUrlModal').modal('hide');
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Une erreur est survenue lors de la mise à jour'
            });
        }
    });
});
    </script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('addSectionForm');
    if (!form) return;

    const inputs = {
        date: form.querySelector('[name="date"]'),
        startTime: form.querySelector('[name="start_time"]'),
        endTime: form.querySelector('[name="end_time"]')
    };

    const errorHandlers = {
        showError: (input, message) => {
            input.nextElementSibling.textContent = message;
            input.classList.add('is-invalid');
        },
        clearError: (input) => {
            input.nextElementSibling.textContent = '';
            input.classList.remove('is-invalid');
        },
        clearAllErrors: () => {
            Object.values(inputs).forEach(input => {
                errorHandlers.clearError(input);
            });
        }
    };

    const validators = {
    date: () => {
        const selectedDate = new Date(inputs.date.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        errorHandlers.clearError(inputs.date);

        // Vérification que la date est valide
        if (!inputs.date.value) {
            errorHandlers.showError(inputs.date, 'La date est requise');
            return false;
        }

        // Vérification du format de la date
        if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.date.value)) {
            errorHandlers.showError(inputs.date, 'Format de date invalide (YYYY-MM-DD)');
            return false;
        }

        if (selectedDate < today) {
            errorHandlers.showError(inputs.date, 'Impossible de planifier une séance dans le passé');
            return false;
        }

        return true;
    },

        times: () => {
            const { startTime, endTime, date } = inputs;
            
            if (!startTime.value || !endTime.value) {
                !startTime.value && errorHandlers.showError(startTime, 'L\'heure de début est requise');
                !endTime.value && errorHandlers.showError(endTime, 'L\'heure de fin est requise');
                return false;
            }

            errorHandlers.clearError(startTime);
            errorHandlers.clearError(endTime);

            if (!date.value) return false;

            const startDateTime = new Date(`${date.value}T${startTime.value}`);
            const endDateTime = new Date(`${date.value}T${endTime.value}`);
            const startHour = parseInt(startTime.value.split(':')[0]);
            const endHour = parseInt(endTime.value.split(':')[0]);

            // Nouvelle validation pour l'heure de début (08:00)
            if (startHour < 8) {
                errorHandlers.showError(startTime, 'Les cours ne peuvent pas commencer avant 08:00');
                return false;
            }

            // Nouvelle validation pour l'heure de fin (23:00)
            if (endHour >= 23 || (endHour === 23 && parseInt(endTime.value.split(':')[1]) > 0)) {
                errorHandlers.showError(endTime, 'Les cours doivent se terminer au plus tard à 23:00');
                return false;
            }

            if (endDateTime <= startDateTime) {
                errorHandlers.showError(endTime, 'L\'heure de fin doit être après l\'heure de début');
                return false;
            }

            const durationHours = (endDateTime - startDateTime) / (1000 * 60 * 60);
            if (durationHours > 8) {
                errorHandlers.showError(endTime, 'La durée d\'une séance ne peut pas dépasser 8 heures');
                return false;
            }

            return true;
        }
    };

    // Attach event listeners
    Object.entries(inputs).forEach(([key, input]) => {
        ['input', 'change'].forEach(event => {
            input.addEventListener(event, () => validators[key === 'date' ? 'date' : 'times']());
        });
    });

    form.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (validators.date() && validators.times()) {
        try {
            const formData = new FormData(form);
            const modal = bootstrap.Modal.getInstance(document.getElementById('addSectionModal'));
            
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            // Désactiver le formulaire pendant le traitement pour éviter les doubles soumissions
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;

            if (data.success) {
                // Cacher la modal avant de montrer le message de succès
                modal.hide();
                
                await Swal.fire({
                    title: 'Succès!',
                    text: data.message,
                    icon: 'success'
                });

                // Recharger la page seulement après que l'alert soit fermée
                window.location.reload();
            } else {
                // Réactiver le bouton en cas d'erreur
                submitButton.disabled = false;

                // Gestion des erreurs
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input) {
                            errorHandlers.showError(input, messages[0]);
                        }
                    });
                } else if (data.message) {
                    // Afficher l'erreur dans Swal.fire au lieu des champs de formulaire
                    Swal.fire({
                        title: 'Erreur',
                        text: data.message,
                        icon: 'error'
                    });
                }
            }
        } catch (error) {
            console.error('Erreur:', error);
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = false;
            
            Swal.fire({
                title: 'Erreur!',
                text: 'Une erreur est survenue lors de l\'ajout de la séance',
                icon: 'error'
                            });
                        }
                    }
                }
            } catch (error) {
                console.error('Erreur:', error);
                Swal.fire({
                    title: 'Erreur!',
                    text: 'Une erreur est survenue lors de l\'ajout de la séance',
                    icon: 'error'
                });
            }
        }
    });
});
    </script>
<script>
    
    class EditableField {
    constructor({
        editableClass = '',
        fieldTextClass = '',
        updateUrl = '',
        fieldType = 'text',
        fieldName = '',
        successMessage = '',
        editTrigger = '.edit-icon'
    } = {}) {
        this.config = { editableClass, fieldTextClass, updateUrl, fieldType, fieldName, successMessage, editTrigger };
        this.isProcessing = false;
        this.bindEvents();
    }

    bindEvents() {
        const handlers = {
            [this.config.editTrigger]: (e) => this.startEditing($(e.target).closest(this.config.editableClass)),
            '.save-field': async (e) => {
                e.preventDefault();
                if (!this.isProcessing) {
                    await this.saveField($(e.target).closest(this.config.editableClass));
                }
            },
            '.cancel-field': (e) => this.cancelEditing($(e.target).closest(this.config.editableClass))
        };

        Object.entries(handlers).forEach(([selector, handler]) => {
            $(document).on('click', selector, handler);
        });
    }

    generateInputHtml(currentValue, isTimeRange = false) {
        if (isTimeRange) {
            const [startTime = '', endTime = ''] = currentValue || ['', ''];
            return `
                <div class="time-range-inputs">
                    <input type="time" class="form-control start-time" value="${startTime}" style="width: auto; display: inline-block;" />
                    <span class="mx-2">-</span>
                    <input type="time" class="form-control end-time" value="${endTime}" style="width: auto; display: inline-block;" />
                </div>`;
        }
        return `<input type="${this.config.fieldType}" class="form-control" value="${currentValue || ''}" style="width: auto; display: inline-block;" />`;
    }

    getFieldValue(container) {
        const { fieldType, fieldTextClass } = this.config;
        if (fieldType === 'time-range') {
            return [
                container.find('.start-time-text').text()?.trim() || '',
                container.find('.end-time-text').text()?.trim() || ''
            ];
        }
        let value = container.find(`.${fieldTextClass}`).text()?.trim() || '';
        return fieldType === 'date' ? this.formatDateForInput(value) : value;
    }

    async startEditing(container) {
        if (!container.length) return console.error("Container not found");

        try {
            const currentValue = this.getFieldValue(container);
            // Removed the validation of currentValue
            
            const inputHtml = this.generateInputHtml(
                this.config.fieldType === 'time-range' ? currentValue : currentValue,
                this.config.fieldType === 'time-range'
            );

            if (this.config.fieldType === 'time-range') {
                container.find('.start-time-text, .end-time-text').hide();
                container.find('.start-time-text').after(inputHtml);
            } else {
                const textElement = container.find(`.${this.config.fieldTextClass}`);
                textElement.hide().after(inputHtml);
            }

            container.find('.edit-icon').hide();
            container.append(`
                <div class="action-buttons">
                    <button class="btn btn-success btn-sm save-field mx-1">Sauvegarder</button>
                    <button class="btn btn-secondary btn-sm cancel-field">Annuler</button>
                </div>
            `);
        } catch (error) {
            console.error('Erreur lors de l\'édition:', error);
            this.cancelEditing(container);
            this.showError(error.message);
        }
    }

    getTimeRangeValues(container) {
        const startTime = container.find('.start-time').val();
        const endTime = container.find('.end-time').val();
        
        if (!startTime || !endTime) {
            throw new Error('Les horaires ne peuvent pas être vides.');
        }

        // Vérifier que l'heure de fin est après l'heure de début
        if (startTime >= endTime) {
            throw new Error('L\'heure de fin doit être postérieure à l\'heure de début');
        }

        return {
            start_time: `${startTime}:00`,
            end_time: `${endTime}:00`,
            startTime,
            endTime
        };
    }

    getTimeRangeValues(container) {
        const startTime = container.find('.start-time').val();
        const endTime = container.find('.end-time').val();
        
        if (!startTime || !endTime) {
            throw new Error('Les horaires ne peuvent pas être vides.');
        }

        // Vérifier que l'heure de fin est après l'heure de début
        if (startTime >= endTime) {
            throw new Error('L\'heure de fin doit être postérieure à l\'heure de début');
        }

        // Validation des horaires entre 08:00 et 23:00
        const minTime = '08:00';
        const maxTime = '23:00';

        if (startTime < minTime || endTime > maxTime) {
            throw new Error('Les séances doivent être programmées entre 08:00 et 23:00');
        }

        return {
            start_time: `${startTime}:00`,
            end_time: `${endTime}:00`,
            startTime,
            endTime
        };
    }

    async saveField(container) {
        if (!container.length || this.isProcessing) return;
        this.isProcessing = true;

        try {
            const formData = new FormData();
            const id = container.data('id');
            if (!id) throw new Error('ID non trouvé');

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('id', id);

            // Récupérer les nouvelles valeurs
            const newValues = {};
            if (this.config.fieldType === 'date') {
                const newDate = container.find('input').val();
                this.validateDate(newDate);
                newValues['date'] = newDate;
            } else if (this.config.fieldType === 'time-range') {
                const { start_time, end_time } = this.getTimeRangeValues(container);
                newValues['start_time'] = start_time;
                newValues['end_time'] = end_time;
            } else {
                newValues[this.config.fieldName] = container.find('input').val();
            }

            // Ajouter les nouvelles valeurs au formData
            Object.entries(newValues).forEach(([key, value]) => formData.append(key, value));

            const response = await fetch(this.config.updateUrl, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const data = await response.json();
            if (!data.success) throw new Error(data.message);

            // Mettre à jour l'affichage avec les nouvelles valeurs
            this.updateFieldDisplay(container, newValues);
            await this.showSuccess();
        } catch (error) {
            console.error('Erreur de sauvegarde:', error);
            this.showInputError(container, error.message);
        } finally {
            this.isProcessing = false;
        }
    }
    updateFieldDisplay(container, value) {
        if (this.config.fieldType === 'time-range') {
            container.find('.time-range-inputs').remove();
            container.find('.start-time-text').text(value.startTime).show();
            container.find('.end-time-text').text(value.endTime).show();
        } else {
            const displayValue = this.config.fieldType === 'date' 
                ? this.formatDateForDisplay(value.value) 
                : value.value;
            container.find(`.${this.config.fieldTextClass}`).text(displayValue).show();
            container.find('input').remove();
        }
        container.find('.action-buttons').remove();
        container.find('.edit-icon').show();
        container.find('.error-message').remove();
    }

    showInputError(container, message) {
        // Supprimer les messages d'erreur précédents
        container.find('.error-message').remove();
        
        // Ajouter le nouveau message d'erreur
        const errorDiv = $(`<div class="error-message text-danger mt-1">${message}</div>`);
        container.find('input, .time-range-inputs').after(errorDiv);
        
        // Ajouter une classe d'erreur à l'input
        container.find('input').addClass('is-invalid');
        
        // Supprimer le message après 5 secondes
        setTimeout(() => {
            errorDiv.fadeOut(() => {
                errorDiv.remove();
                container.find('input').removeClass('is-invalid');
            });
        }, 5000);
    }

    cancelEditing(container) {
        if (this.config.fieldType === 'time-range') {
            container.find('.time-range-inputs').remove();
            container.find('.start-time-text, .end-time-text').show();
        } else {
            container.find('input').remove();
            container.find(`.${this.config.fieldTextClass}`).show();
        }
        container.find('.action-buttons').remove();
        container.find('.edit-icon').show();
        container.find('.error-message').remove();
    }

    async showSuccess() {
        return Swal.fire({
            title: 'Succès!',
            text: this.config.successMessage,
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        });
    }

    async showError(message) {
        return Swal.fire({
            title: 'Erreur!',
            text: message || 'Une erreur est survenue.',
            icon: 'error'
        });
    }
}

// Initialisation
$(document).ready(() => {
    const fields = [
        {
            editableClass: '.editable-date',
            fieldTextClass: 'date-text',
            fieldType: 'date',
            fieldName: 'date',
            successMessage: 'Date mise à jour avec succès.'
        },
        {
            editableClass: '.editable-time',
            fieldTextClass: 'time-text',
            fieldType: 'time-range',
            successMessage: 'Horaires mis à jour avec succès.'
        },
        {
            editableClass: '.editable-link',
            fieldTextClass: 'link-text',
            fieldType: 'text',
            fieldName: 'link',
            successMessage: 'Lien mis à jour avec succès.'
        }
    ];

    fields.forEach(field => new EditableField({
        ...field,
        updateUrl: '/update/course/section'
    }));
});
</script>

<script>
    // Fonctions de gestion des chapitres
    function addLecture(courseId, sectionId) {
    // Masquer tous les autres formulaires ouverts
    $('.section-body .lecture-form').hide();
    
    // Ouvrir automatiquement la section si elle est fermée
    const sectionBody = $(`#section-body-${sectionId}`);
    const sectionHeader = $(`[data-section="${sectionId}"]`);
    
    if (!sectionBody.is(':visible')) {
        // Fermer toutes les autres sections
        $('.section-body').slideUp();
        $('.toggle-icon').removeClass('active');
        
        // Ouvrir cette section
        sectionBody.slideDown();
        sectionHeader.find('.toggle-icon').addClass('active');
    }
    
    // Afficher le formulaire d'ajout pour cette section
    $(`#lecture-form-${sectionId}`).slideDown();
    
    // Vider le champ du formulaire
    $(`#lecture-title-${sectionId}`).val('').focus();
}

function cancelLecture(sectionId) {
    // Masquer le formulaire
    $(`#lecture-form-${sectionId}`).slideUp();
    
    // Vider le champ
    $(`#lecture-title-${sectionId}`).val('');
}

function saveLecture(courseId, sectionId) {
    const title = $(`#lecture-title-${sectionId}`).val().trim();
    
    if (!title) {
        Swal.fire('Erreur!', 'Le titre ne peut pas être vide.', 'error');
        return;
    }
    
    // Créer l'objet FormData
    const formData = new FormData();
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('course_id', courseId);
    formData.append('section_id', sectionId);
    formData.append('lecture_title', title);
    
    // Envoyer la requête AJAX
    $.ajax({
        url: '/save-lecture',  // Utilisation de la route correcte
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                // Ajouter le nouveau chapitre à la liste
                const newLecture = `
                    <div class="lecture-item">
                        <div>
                            <i class="las la-play-circle me-2"></i>
                            <span class="editable-lecture-title" data-id="${response.lecture.id}">
                                <span class="lecture-title-text">${response.lecture.lecture_title}</span>
                                <i class="las la-edit edit-icon" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <div class="action-buttons">
                            <a href="/edit/lecture/${response.lecture.id}" class="btn btn-sm btn-primary">
                                <i class="las la-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger delete-lecture" data-id="${response.lecture.id}" data-title="${response.lecture.lecture_title}">
                                <i class="las la-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                $(`#lecture-list-${sectionId}`).append(newLecture);
                
                // Masquer le formulaire
                cancelLecture(sectionId);
                
                // Afficher le message de succès
                Swal.fire({
                    title: 'Succès!',
                    text: 'Chapitre ajouté avec succès.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });

                // Mettre à jour le compteur de chapitres
                updateChapterCount(sectionId);
            }
        },
        error: function(xhr) {
            const message = xhr.responseJSON?.message || 'Une erreur est survenue lors de l\'ajout du chapitre.';
            Swal.fire('Erreur!', message, 'error');
        }
    });
}
// Fonction pour mettre à jour le compteur de chapitres
function updateChapterCount(sectionId) {
    const lectureCount = $(`#lecture-list-${sectionId} .lecture-item`).length;
    const chapterCountElement = $(`#section-container-${sectionId} .chapter-count`);
    chapterCountElement.text(`${lectureCount} Chapitres`);
}
  // Gestion des titres éditables (sections et chapitres)
class EditableTitle {
    constructor(options) {
        this.options = {
            editableClass: '',
            titleClass: '',
            updateUrl: '',
            successMessage: '',
            ...options
        };
        this.initializeEvents();
    }

    initializeEvents() {
        $(document).on('click', this.options.editTrigger, (e) => {
            const container = $(e.target).closest(this.options.editableClass);
            const titleElement = container.find(this.options.titleClass);
            this.startEditing(container, titleElement);
        });

        $(document).on('click', '.save-title', (e) => {
            const container = $(e.target).closest(this.options.editableClass);
            this.saveTitle(container);
        });

        $(document).on('click', '.cancel-title', (e) => {
            const container = $(e.target).closest(this.options.editableClass);
            this.cancelEditing(container);
        });
    }

    startEditing(container, titleElement) {
        const currentTitle = titleElement.text().trim();
        const sanitizedTitle = this.escapeHtml(currentTitle);
        titleElement.replaceWith(`<input type="text" class="form-control" value="${sanitizedTitle}" style="width: auto; display: inline-block;" />`);
        container.find('.edit-icon').replaceWith(`
            <button class="btn btn-success save-title">Sauvegarder</button>
            <button class="btn btn-secondary cancel-title">Annuler</button>
        `);
    }

    escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    async saveTitle(container) {
        const input = container.find('input');
        const newTitle = input.val().trim();
        const id = container.data('id');

        if (!newTitle) {
            await Swal.fire('Erreur!', 'Le titre ne peut pas être vide.', 'error');
            return;
        }

        try {
            const formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('id', id);
            formData.append(this.options.titleField, newTitle);

            const response = await $.ajax({
                url: this.options.updateUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json'
            });

            if (response && response.success) {
                this.updateTitleDisplay(container, newTitle);
                await Swal.fire({
                    title: 'Succès!',
                    text: this.options.successMessage,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(response.message || 'Une erreur est survenue lors de la mise à jour.');
            }
        } catch (error) {
            console.error('Erreur lors de la sauvegarde:', error);
            
            const errorMessage = error.responseJSON?.message || error.message || 'Une erreur est survenue lors de la mise à jour.';
            
            await Swal.fire('Erreur!', errorMessage, 'error');
            
            this.cancelEditing(container);
        }
    }

    cancelEditing(container) {
        const input = container.find('input');
        const originalTitle = input.val();
        this.updateTitleDisplay(container, originalTitle);
    }

    updateTitleDisplay(container, title) {
        const sanitizedTitle = this.escapeHtml(title);
        container.find('input').replaceWith(`<span class="${this.options.titleClass.slice(1)}">${sanitizedTitle}</span>`);
        container.find('.save-title, .cancel-title').remove();
        container.append('<i class="las la-edit edit-icon" style="cursor: pointer;"></i>');
    }
}

// Gestionnaire de sections
class SectionManager {
    constructor() {
        this.initializeEvents();
    }

    initializeEvents() {
        // Toggle sections
        $('.section-header').on('click', (e) => {
            if (!e.target.closest('.action-buttons') && !$(e.target).is('input')) {
                this.toggleSection($(e.target).closest('.section-header').data('section'));
            }
        });

        // Validation du formulaire d'ajout
        this.initializeFormValidation();
    }

    toggleSection(sectionId) {
        const body = $(`#section-body-${sectionId}`);
        const icon = $(`[data-section="${sectionId}"] .toggle-icon`);
        
        $('.section-body').not(body).slideUp();
        $('.toggle-icon').not(icon).removeClass('active');
        
        body.slideToggle();
        icon.toggleClass('active');
    }

    initializeFormValidation() {
        $('#addSectionForm, #rescheduleSectionForm').on('submit', async function(e) {
            e.preventDefault();
            if (!await validateDateTime(this)) return;

            try {
                const formData = new FormData(this);
                const response = await $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json'
                });

                if (response.success) {
                    await Swal.fire({
                        title: 'Succès!',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    location.reload();
                } else {
                    throw new Error(response.message || 'Une erreur est survenue.');
                }
            } catch (error) {
                const errorMessage = error.responseJSON?.message || error.message || 'Une erreur est survenue.';
                await Swal.fire('Erreur!', errorMessage, 'error');
            }
        });
    }
}

// Gestionnaire de suppression
class DeletionManager {
    static async confirmDelete(options) {
        const result = await Swal.fire({
            title: 'Êtes-vous sûr?',
            text: `Voulez-vous supprimer ${options.itemType} "${options.title}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        });

        if (result.isConfirmed) {
            try {
                const formData = new FormData();
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                const response = await $.ajax({
                    url: options.deleteUrl,
                    type: options.method || 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json'
                });

                if (response && response.success) {
                    await Swal.fire({
                        title: 'Supprimé!',
                        text: `${options.itemType} a été supprimé avec succès.`,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    options.element.fadeOut(400, () => {
                        options.element.remove();
                        location.reload();
                    });
                } else {
                    throw new Error(response.message || 'Une erreur est survenue lors de la suppression.');
                }
            } catch (error) {
                console.error('Erreur lors de la suppression:', error);
                const errorMessage = error.responseJSON?.message || error.message || 'Une erreur est survenue lors de la suppression.';
                await Swal.fire('Erreur!', errorMessage, 'error');
            }
        }
    }
}

// Fonctions utilitaires
function validateDateTime(form) {
    const date = new Date($(form).find('input[name*="date"]').val());
    const startTime = $(form).find('input[name*="start_time"]').val();
    const endTime = $(form).find('input[name*="end_time"]').val();
    
    const now = new Date();
    now.setHours(0, 0, 0, 0);
    
    if (date < now) {
        Swal.fire('Erreur!', 'Impossible de planifier dans le passé', 'error');
        return false;
    }

    const [startHour] = startTime.split(':').map(Number);
    if (startHour < 7) {
        Swal.fire('Erreur!', 'Les cours ne peuvent pas commencer avant 07:00', 'error');
        return false;
    }

    const start = new Date(`2000/01/01 ${startTime}`);
    const end = new Date(`2000/01/01 ${endTime}`);
    if (end <= start) {
        Swal.fire('Erreur!', 'L\'heure de fin doit être postérieure à l\'heure de début', 'error');
        return false;
    }

    return true;
}

// Initialisation
$(document).ready(() => {
    // Initialiser les gestionnaires de titres éditables
    new EditableTitle({
        editableClass: '.editable-section-title',
        titleClass: '.section-title-text',
        updateUrl: '/update/course/section',
        titleField: 'section_title',
        successMessage: 'Titre de la séance mis à jour avec succès.',
        editTrigger: '.edit-icon'
    });

    new EditableTitle({
        editableClass: '.editable-lecture-title',
        titleClass: '.lecture-title-text',
        updateUrl: '/update/course/lecture',
        titleField: 'lecture_title',
        successMessage: 'Titre du chapitre mis à jour avec succès.',
        editTrigger: '.edit-icon'
    });

    // Initialiser le gestionnaire de sections
    new SectionManager();

    // Initialiser les gestionnaires de suppression
    $('.delete-section').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        DeletionManager.confirmDelete({
            itemType: 'la séance',
            title: $(this).data('title'),
            deleteUrl: `/delete/section/${$(this).data('id')}`,
            element: $(`#section-container-${$(this).data('id')}`)
        });
    });

    $('.delete-lecture').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        DeletionManager.confirmDelete({
            itemType: 'le chapitre',
            title: $(this).data('title'),
            deleteUrl: `/delete/lecture/${$(this).data('id')}`,
            method: 'GET',
            element: $(this).closest('.lecture-item')
        });
    });
});
</script>
<style>
    .course-section {
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.course-section:hover {
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.section-header {
    padding: 1.25rem;
    background-color: #ffffff;
    cursor: pointer;
    border-radius: 0.75rem;
}

.section-header:hover {
    background-color: #f8fafc;
}

.section-header-content {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.section-main-info {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.section-title-container {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.section-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 0.5rem;
    padding: 0.75rem;
    background-color: #f8fafc;
    border-radius: 0.5rem;
    font-size: 0.875rem;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.detail-item label {
    font-weight: 600;
    color: #4b5563;
    font-size: 0.75rem;
    text-transform: uppercase;
}

.detail-item .value {
    color: #1f2937;
}

.section-body {
    padding: 1.25rem;
    display: none;
    background-color: #f8fafc;
    border-bottom-left-radius: 0.75rem;
    border-bottom-right-radius: 0.75rem;
}

.lecture-item {
    padding: 1rem;
    margin-bottom: 0.5rem;
    border-radius: 0.5rem;
    background-color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.2s ease;
}

.lecture-item:hover {
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.action-buttons .btn {
    padding: 0.5rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.section-link {
    color: #2563eb;
    text-decoration: none;
    word-break: break-all;
}

.section-link:hover {
    text-decoration: underline;
}

.toggle-icon i {
    transition: transform 0.3s ease;
}

.toggle-icon.active i {
    transform: rotate(180deg);
}

.chapter-count {
    background-color: #e5e7eb;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    color: #4b5563;
}

.error-message {
    font-size: 0.875rem;
    min-height: 20px;
}
.edit-icon {
    margin-left: 5px;
    color: #007bff;
    cursor: pointer;
}

.edit-icon:hover {
    color: #0056b3;
}

.save-section-title, .cancel-section-title, .save-lecture-title, .cancel-lecture-title {
    margin-left: 5px;
}
/* Ajoutez ces styles à votre fichier course.css */
.error-message {
    display: block;
    font-size: 0.875rem;
    color: #dc3545;
    margin-top: 0.25rem;
    transition: all 0.3s ease;
}

.is-invalid {
    border-color: #dc3545 !important;
    padding-right: calc(1.5em + 0.75rem) !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

/* Animation des messages d'erreur */
.error-message {
    opacity: 0;
    transform: translateY(-10px);
}

.is-invalid + .error-message {
    opacity: 1;
    transform: translateY(0);
}
.add-video-url {
    position: relative;
}

.add-video-url[data-video]:not([data-video=""]) {
    background-color: #28a745;
    color: white;
}

.add-video-url[data-video=""]:not(:hover)::after {
    content: "Aucun enregistrement";
    position: absolute;
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
    display: none;
}

.add-video-url[data-video=""]:hover::after {
    display: block;
}
</style>
<style>
.course-section {
    position: relative;
    margin-bottom: 1rem;
}

.cancelled-section {
    position: relative;
}

.cancelled-section .section-header {
    background-color: #ffe5e5 !important;
    opacity: 0.9;
}

.cancellation-badge {
    position: absolute;
    top: 5px;
    right: 10px;
    color: #dc3545;
    font-weight: bold;
    font-size: 0.9rem;
    padding: 2px 6px;
    border-radius: 3px;
    background-color: rgba(255, 255, 255, 0.8);
}

.cancellation-reason {
    font-style: italic;
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 5px;
    margin-left: 10px;
}

/* Désactiver les interactions pour les sections annulées */
.cancelled-section .editable-section-title .edit-icon,
.cancelled-section .add-lecture-btn {
    display: none;
}
.restore-section {
    margin-right: 5px;
}

.restore-section i {
    font-size: 1.1em;
}

.cancelled-section .restore-section:hover {
    background-color: #28a745;
    color: white;
}


.postponed-section {
    border-left: 4px solid #ffc107;
    background-color: rgba(255, 193, 7, 0.05);
}

.postponement-banner {
    display: flex;
    align-items: center;
    background-color: #fff3cd;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
}

.postponement-icon {
    font-size: 2.5rem;
    color: #ffc107;
    margin-right: 15px;
}

.postponement-details {
    flex-grow: 1;
}

.postponement-details strong {
    display: block;
    color: #856404;
    margin-bottom: 5px;
}

.postponement-details p {
    margin-bottom: 5px;
    color: #856404;
}

.postponement-details small {
    color: #6c757d;
}
.past-section {
        opacity: 0.7;
        background-color: #f4f4f4;
    }
    .past-section .edit-icon {
        display: none;
    }
</style>
@endsection
 