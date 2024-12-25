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
                    <h4 class="mb-0" id="currentMonth">Février 2024</h4>
                    <button class="btn btn-light" id="nextMonth">
                        <i class="la la-chevron-right"></i>
                    </button>
                </div>
                <div>
                    <button class="btn btn-primary">
                        <i class="la la-plus"></i> Nouvelle réunion
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
document.addEventListener('DOMContentLoaded', function() {
    const calendarDays = document.getElementById('calendarDays');
    const currentMonthElement = document.getElementById('currentMonth');
    const prevMonthButton = document.getElementById('prevMonth');
    const nextMonthButton = document.getElementById('nextMonth');
    
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

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
                const today = new Date();
                if (dayNumber === today.getDate() && 
                    currentMonth === today.getMonth() && 
                    currentYear === today.getFullYear()) {
                    dayCell.classList.add('today');
                }
                
                // Ajouter le numéro du jour
                const dayNumberDiv = document.createElement('div');
                dayNumberDiv.className = 'day-number';
                dayNumberDiv.textContent = dayNumber;
                dayCell.appendChild(dayNumberDiv);

                // Ajouter les événements pour certains jours (exemple)
                if (dayNumber === 6) {
                    dayCell.innerHTML += `
                        <div class="course-event cancelled">
                            <div class="event-time">19:00 - 21:00</div>
                            <div class="event-title">SEANCE 12 GP AGILE</div>
                            <small class="text-danger">Annulé</small>
                        </div>
                    `;
                }
                if (dayNumber === 8) {
                    dayCell.innerHTML += `
                        <div class="course-event">
                            <div class="event-time">19:00 - 21:00</div>
                            <div class="event-title">PHP LARAVEL - SEANCE 1</div>
                            <button class="btn btn-primary btn-join btn-sm mt-1">Rejoindre</button>
                        </div>
                    `;
                }
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