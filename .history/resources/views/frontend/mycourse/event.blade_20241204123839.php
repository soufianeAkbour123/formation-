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
        <div class="alert alert-info mt-4">
            <h5>Aucun cours planifié</h5>
            <p>Vous n'êtes inscrit à aucun cours pour le moment ou il n'y a pas de sessions planifiées ce mois-ci.</p>
        </div>
    @endif

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
</div>

<style>
/* Container principal */
.main-content-wrapper {
    padding: 1.5rem;
    background: #f8fafc;
}

/* Style de la carte du calendrier */
.card {
    background: white;
    border-radius: 1rem;
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

/* En-tête du calendrier */
.calendar-header-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    background: #f8fafc;
    padding: 1rem;
    gap: 1px;
}

.calendar-header-grid div {
    text-align: center;
    font-weight: 600;
    color: #64748b;
    padding: 0.75rem;
    font-size: 0.875rem;
}

/* Grille des jours */
.calendar-days-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background: #e2e8f0;
    padding: 1px;
    border-radius: 0.5rem;
}

/* Cellule de jour */
.calendar-day {
    background: white;
    min-height: 120px;
    padding: 0.75rem;
    transition: all 0.2s ease;
}

@media (min-width: 768px) {
    .calendar-day {
        min-height: 150px;
    }
}

.calendar-day:hover {
    background: #f8fafc;
}

.calendar-day.today {
    background: #f0f9ff;
}

/* Numéro du jour */
.day-number {
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.75rem;
    font-size: 0.875rem;
}

.today .day-number {
    background: #3b82f6;
    color: white;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

/* Style des événements */
.course-event {
    background: #f1f5f9;
    border-left: 3px solid #3b82f6;
    margin: 0.5rem 0;
    padding: 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.course-event:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.course-event.cancelled {
    background: #fef2f2;
    border-left-color: #ef4444;
}

.course-event.past {
    background: #f1f5f9;
    border-left-color: #94a3b8;
    opacity: 0.8;
}

/* Nom du cours */
.course-name {
    font-size: 0.75rem;
    color: #3b82f6;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

/* Horaires et titre */
.event-time {
    font-size: 0.75rem;
    color: #64748b;
    margin-bottom: 0.25rem;
    font-weight: 500;
}

.event-title {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.5rem;
    line-height: 1.25;
}

/* Alert styles */
.alert {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}

.alert-info {
    background-color: #f0f9ff;
    border: 1px solid #bae6fd;
    color: #0369a1;
}

/* Boutons */
.btn-join {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    font-size: 0.75rem;
    font-weight: 500;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
}

.btn-primary {
    background: #3b82f6;
    color: white;
    border: none;
}

.btn-primary:hover {
    background: #2563eb;
    transform: translateY(-1px);
}

.btn-secondary {
    background: #64748b;
    color: white;
    border: none;
}

.btn-secondary:hover {
    background: #475569;
    transform: translateY(-1px);
}

/* Texte d'état */
.text-muted {
    color: #64748b;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Boutons de navigation */
#prevMonth, #nextMonth {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
    color: #64748b;
    transition: all 0.2s ease;
}

#prevMonth:hover, #nextMonth:hover {
    background: #f8fafc;
    color: #0f172a;
    transform: translateY(-1px);
}

/* Titre du mois */
#currentMonth {
    font-size: 1.25rem;
    font-weight: 600;
    color: #0f172a;
    margin: 0 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .main-content-wrapper {
        padding: 0.5rem;
    }

    .calendar-day {
        padding: 0.5rem;
        min-height: 100px;
    }

    .course-event {
        padding: 0.5rem;
        margin: 0.25rem 0;
    }

    .btn-join {
        padding: 0.375rem 0.75rem;
    }

    .calendar-header-grid div {
        padding: 0.5rem;
        font-size: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Données des sections transmises depuis le contrôleur
    const sections = @json($sections);
    const now = new Date();

    const calendarDays = document.getElementById('calendarDays');
    const currentMonthElement = document.getElementById('currentMonth');
    const prevMonthButton = document.getElementById('prevMonth');
    const nextMonthButton = document.getElementById('nextMonth');
    
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function getEventsByDate(date) {
        return sections.filter(section => {
            const sectionDate = new Date(section.date);
            return sectionDate.getDate() === date &&
                   sectionDate.getMonth() === currentMonth &&
                   sectionDate.getFullYear() === currentYear;
        });
    }

    function formatTime(timeString) {
        return new Date('2000-01-01 ' + timeString).toLocaleTimeString('fr-FR', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function isSessionPast(section) {
        const sessionDate = new Date(section.date);
        const sessionEndTime = new Date(section.date + ' ' + section.end_time);
        return sessionDate < now || (sessionDate.getDate() === now.getDate() && sessionEndTime < now);
    }

    function isSessionOngoing(section) {
        const sessionDate = new Date(section.date);
        const sessionStartTime = new Date(section.date + ' ' + section.start_time);
        const sessionEndTime = new Date(section.date + ' ' + section.end_time);
        return sessionDate.getDate() === now.getDate() && 
               now >= sessionStartTime && 
               now <= sessionEndTime;
    }

    function createEventElement(section) {
        const isPast = isSessionPast(section);
        const isOngoing = isSessionOngoing(section);
        
        let eventHtml = `
            <div class="course-event ${section.is_cancelled ? 'cancelled' : ''} ${isPast ? 'past' : ''}">
                <div class="course-name">${section.course_name}</div>
                <div class="event-time">
                    ${formatTime(section.start_time)} - ${formatTime(section.end_time)}
                </div>
                <div class="event-title">${section.section_title}</div>`;

        if (!section.is_cancelled) {
            if (isOngoing) {
                if (section.link) {
                    eventHtml += `
                        <a href="${section.link}" class="btn btn-primary btn-join btn-sm mt-1" target="_blank">
                            Rejoindre la séance en direct
                        </a>`;
                } else {
                    eventHtml += `
                        <span class="text-muted small">En attente du lien...</span>`;
                }
            } else if (isPast && section.video_url) {
                eventHtml += `
                    <a href="/course/view/${section.course_id}" class="btn btn-secondary btn-join btn-sm mt-1">
                        Voir l'enregistrement
                    </a>`;
            } else if (!isPast) {
                eventHtml += `
                    <span class="text-muted small">À venir</span>`;
            }
        } else {
            eventHtml += `
                <span class="text-danger small">Cours annulé</span>`;
        }

        eventHtml += '</div>';
        return eventHtml;
    }

    function updateCalendar() {
        const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                          'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        currentMonthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;

        calendarDays.innerHTML = '';

        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);
        const startingDay = firstDay.getDay();
        
        for (let i = 0; i < 42; i++) {
            const dayCell = document.createElement('div');
            dayCell.className = 'calendar-day';
            
            const dayNumber = i - startingDay + 1;
            if (dayNumber > 0 && dayNumber <= lastDay.getDate()) {
                if (dayNumber === now.getDate() && 
                    currentMonth === now.getMonth() && 
                    currentYear === now.getFullYear()) {
                    dayCell.classList.add('today');
                }
                
                const dayNumberDiv = document.createElement('div');
                dayNumberDiv.className = 'day-number';
                dayNumberDiv.textContent = dayNumber;
                dayCell.appendChild(dayNumberDiv);

                const dayEvents = getEventsByDate(dayNumber);
                dayEvents.forEach(section => {
                    dayCell.innerHTML += createEventElement(section);
                });
            }
            
            calendarDays.appendChild(dayCell);
        }
    }

    prevMonthButton.addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        updateCalendar();
    });

    nextMonthButton.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        updateCalendar();
    });

    updateCalendar();
});
</script>

@endsection