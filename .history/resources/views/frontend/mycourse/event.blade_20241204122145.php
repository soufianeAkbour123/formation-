@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

<div class="main-content-wrapper">
    <!-- Header du Calendrier -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light" id="prevMonth">
                        <i class="la la-chevron-left"></i>
                    </button>
                    <h4 class="mb-0" id="currentMonth"></h4>
                    <button class="btn btn-light" id="nextMonth">
                        <i class="la la-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if($sections->isEmpty())
        <div class="alert alert-info">
            Vous n'êtes inscrit à aucun cours pour ce mois.
        </div>
    @else
        <!-- Grille du Calendrier -->
        <div class="card">
            <div class="card-body p-0">
                <div class="calendar-grid">
                    <!-- En-têtes des jours -->
                    <div class="calendar-header-grid">
                        <div>Dimanche</div>
                        <div>Lundi</div>
                        <div>Mardi</div>
                        <div>Mercredi</div>
                        <div>Jeudi</div>
                        <div>Vendredi</div>
                        <div>Samedi</div>
                    </div>
                    
                    <!-- Grille des jours -->
                    <div class="calendar-days-grid" id="calendarDays"></div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    /* Vos styles CSS restent les mêmes */
</style>

<script>
// Vérifier si des sections existent avant de les passer au JSON
const sections = @json($sections ?? []);
const now = new Date();

document.addEventListener('DOMContentLoaded', function() {
    if (!sections || sections.length === 0) {
        return; // Sortir si aucune section n'est disponible
    }

    const calendarDays = document.getElementById('calendarDays');
    const currentMonthElement = document.getElementById('currentMonth');
    const prevMonthButton = document.getElementById('prevMonth');
    const nextMonthButton = document.getElementById('nextMonth');
    
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function getEventsByDate(date) {
        if (!Array.isArray(sections)) return [];
        
        return sections.filter(section => {
            const sectionDate = new Date(section.date);
            return sectionDate.getDate() === date &&
                   sectionDate.getMonth() === currentMonth &&
                   sectionDate.getFullYear() === currentYear;
        });
    }

    function formatTime(timeString) {
        if (!timeString) return '';
        return new Date('2000-01-01 ' + timeString).toLocaleTimeString('fr-FR', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function createEventElement(section) {
        if (!section) return '';

        const isPast = isSessionPast(section);
        const isOngoing = isSessionOngoing(section);
        
        let eventHtml = `
            <div class="course-event ${section.is_cancelled ? 'cancelled' : ''} ${isPast ? 'past' : ''}">
                <div class="event-time">
                    ${formatTime(section.start_time)} - ${formatTime(section.end_time)}
                </div>
                <div class="event-title">
                    ${section.section_title}
                    <small class="d-block text-muted">${section.course_name || ''}</small>
                </div>`;

        if (!section.is_cancelled) {
            if (isOngoing || !isPast) {
                if (!section.link) {
                    eventHtml += `<span class="text-muted small">Le lien sera bientôt disponible</span>`;
                } else {
                    eventHtml += `
                        <a href="${section.link}" class="btn btn-primary btn-join btn-sm mt-1" target="_blank">
                            Rejoindre
                        </a>`;
                }
            } else if (section.video_url) {
                eventHtml += `
                    <a href="/course/view/${section.course_id}" class="btn btn-secondary btn-join btn-sm mt-1">
                        Voir l'enregistrement
                    </a>`;
            }
        }

        eventHtml += '</div>';
        return eventHtml;
    }

    // Le reste de votre code JavaScript reste le même...
    // Assurez-vous juste d'ajouter des vérifications de null/undefined où nécessaire

});
</script>

@endsection