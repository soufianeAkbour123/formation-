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
.calendar-grid {
    background-color: #fff;
    border-radius: 0.5rem;
}

.calendar-header-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
    font-weight: 600;
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.calendar-days-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    grid-auto-rows: minmax(150px, auto);
    gap: 1px;
    background-color: #e5e7eb;
}

.calendar-day {
    background-color: white;
    padding: 0.5rem;
    min-height: 150px;
    position: relative;
}

.calendar-day.today {
    background-color: #f8f9fa;
}

.day-number {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.course-event {
    background-color: #e7ebfd;
    border-left: 3px solid #696cff;
    margin: 0.25rem 0;
    padding: 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
}

.course-event.cancelled {
    background-color: #ffe7e7;
    border-left-color: #dc3545;
    text-decoration: line-through;
}

.course-event.past {
    background-color: #e9ecef;
    border-left-color: #6c757d;
}

.event-time {
    font-size: 0.75rem;
    color: #6c757d;
    margin-bottom: 0.25rem;
}

.event-title {
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.btn-join {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.today .day-number {
    color: #696cff;
    font-weight: 700;
}
</style>

<script>
// Données des sections transmises depuis le contrôleur
const sections = @json($sections);
const now = new Date();

document.addEventListener('DOMContentLoaded', function() {
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
                <div class="event-time">
                    ${formatTime(section.start_time)} - ${formatTime(section.end_time)}
                </div>
                <div class="event-title">${section.section_title}</div>`;

        if (!section.is_cancelled) {
            if (isOngoing) {
                eventHtml += `
                    <a href="${section.link}" class="btn btn-primary btn-join btn-sm mt-1" target="_blank">
                        Rejoindre
                    </a>`;
            } else if (!isPast) {
                eventHtml += `
                    <a href="${section.link}" class="btn btn-primary btn-join btn-sm mt-1" target="_blank">
                        Rejoindre
                    </a>`;
            } else if (section.video_url) {
                eventHtml += `
                    <a href="/course/view/${section.course_id}" class="btn btn-secondary btn-join btn-sm mt-1" target="_blank">
                        Voir l'enregistrement
                    </a>`;
            } else {
                eventHtml += `
                    <span class="text-muted small">L'enregistrement sera bientôt disponible</span>`;
            }
        }

        eventHtml += '</div>';
        return eventHtml;
    }

    function updateCalendar() {
        // Mise à jour du titre du mois
        const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                          'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        currentMonthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;

        // Vider la grille
        calendarDays.innerHTML = '';

        // Obtenir le premier jour du mois
        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);
        const startingDay = firstDay.getDay();
        
        // Créer les cellules du calendrier
        for (let i = 0; i < 42; i++) {
            const dayCell = document.createElement('div');
            dayCell.className = 'calendar-day';
            
            const dayNumber = i - startingDay + 1;
            if (dayNumber > 0 && dayNumber <= lastDay.getDate()) {
                // Vérifier si c'est aujourd'hui
                if (dayNumber === now.getDate() && 
                    currentMonth === now.getMonth() && 
                    currentYear === now.getFullYear()) {
                    dayCell.classList.add('today');
                }
                
                // Ajouter le numéro du jour
                const dayNumberDiv = document.createElement('div');
                dayNumberDiv.className = 'day-number';
                dayNumberDiv.textContent = dayNumber;
                dayCell.appendChild(dayNumberDiv);

                // Ajouter les événements du jour
                const dayEvents = getEventsByDate(dayNumber);
                dayEvents.forEach(section => {
                    dayCell.innerHTML += createEventElement(section);
                });
            }
            
            calendarDays.appendChild(dayCell);
        }
    }

    // Gestionnaires d'événements pour la navigation
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

    // Initialiser le calendrier
    updateCalendar();
});
</script>

@endsection