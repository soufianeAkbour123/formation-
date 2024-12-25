@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

<div class="main-content-wrapper p-4">
    <!-- Calendar Container -->
    <div class="calendar-container bg-white rounded-xl shadow-lg">
        <!-- Calendar Header -->
        <div class="calendar-header p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button class="nav-btn hover:bg-gray-100 p-2 rounded-full transition-colors" id="prevMonth">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <h2 class="text-2xl font-bold text-gray-800" id="currentMonth"></h2>
                    <button class="nav-btn hover:bg-gray-100 p-2 rounded-full transition-colors" id="nextMonth">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                <div class="hidden md:flex items-center gap-2">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span class="text-sm text-gray-600">Active</span>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <span class="text-sm text-gray-600">Annulé</span>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                        <span class="text-sm text-gray-600">Passé</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Grid -->
        <div class="calendar-body p-4">
            <!-- Days Header -->
            <div class="grid grid-cols-7 mb-4">
                <div class="day-header">Dim</div>
                <div class="day-header">Lun</div>
                <div class="day-header">Mar</div>
                <div class="day-header">Mer</div>
                <div class="day-header">Jeu</div>
                <div class="day-header">Ven</div>
                <div class="day-header">Sam</div>
            </div>
            
            <!-- Calendar Days Grid -->
            <div class="calendar-days-grid" id="calendarDays"></div>
        </div>
    </div>
</div>

<style>
/* Base styles */
.calendar-container {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

/* Header styles */
.calendar-header {
    background: white;
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.nav-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: none;
    background: transparent;
    cursor: pointer;
    transition: all 0.2s ease;
}

.nav-btn:hover {
    background: #f3f4f6;
}

/* Days header */
.day-header {
    text-align: center;
    font-weight: 600;
    color: #4b5563;
    padding: 0.75rem;
    font-size: 0.875rem;
}

/* Calendar grid */
.calendar-days-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background: #e5e7eb;
    border-radius: 0.5rem;
    overflow: hidden;
}

/* Calendar day cell */
.calendar-day {
    background: white;
    min-height: 120px;
    padding: 0.5rem;
    transition: all 0.2s ease;
}

@media (min-width: 768px) {
    .calendar-day {
        min-height: 150px;
    }
}

.calendar-day:hover {
    background: #f9fafb;
}

.calendar-day.today {
    background: #f0f9ff;
}

/* Day number */
.day-number {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.today .day-number {
    color: #2563eb;
    background: #dbeafe;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

/* Event styles */
.course-event {
    background: #f3f4f6;
    border-left: 3px solid #2563eb;
    margin: 0.25rem 0;
    padding: 0.5rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    cursor: pointer;
}

.course-event:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.course-event.cancelled {
    background: #fef2f2;
    border-left-color: #dc2626;
}

.course-event.past {
    background: #f3f4f6;
    border-left-color: #9ca3af;
    opacity: 0.75;
}

.event-time {
    font-size: 0.75rem;
    color: #6b7280;
    margin-bottom: 0.25rem;
}

.event-title {
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 0.25rem;
    line-height: 1.2;
}

/* Buttons */
.btn-join {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
}

.btn-primary {
    background: #2563eb;
    color: white;
}

.btn-primary:hover {
    background: #1d4ed8;
}

.btn-secondary {
    background: #4b5563;
    color: white;
}

.btn-secondary:hover {
    background: #374151;
}

/* Text status */
.text-muted {
    color: #6b7280;
    font-size: 0.75rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .calendar-container {
        margin: 0.5rem;
    }
    
    .calendar-header {
        padding: 1rem;
    }
    
    .day-header {
        font-size: 0.75rem;
        padding: 0.5rem;
    }
    
    .calendar-day {
        padding: 0.25rem;
    }
    
    .course-event {
        padding: 0.375rem;
    }
    
    .event-title {
        font-size: 0.75rem;
    }
}

/* Animation classes */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.calendar-day {
    animation: fadeIn 0.3s ease-out;
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
            <div class="course-event ${section.is_cancelled ? 'cancelled' : ''} ${isPast ? 'past' : ''} ${isOngoing ? 'ongoing' : ''}">
                <div class="event-time">
                    ${formatTime(section.start_time)} - ${formatTime(section.end_time)}
                </div>
                <div class="event-title">${section.section_title}</div>`;

        if (!section.is_cancelled) {
            if (isOngoing || !isPast) {
                if (!section.link) {
                    eventHtml += `
                        <span class="text-muted">Le lien de la séance sera bientôt disponible</span>`;
                } else {
                    eventHtml += `
                        <a href="${section.link}" class="btn btn-primary btn-join" target="_blank">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Rejoindre
                        </a>`;
                }
            } else if (section.video_url) {
                eventHtml += `
                    <a href="/course/view/${section.course_id}" class="btn btn-secondary btn-join" target="_blank">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Voir l'enregistrement
                    </a>`;
            } else {
                eventHtml += `
                    <span class="text-muted">L'enregistrement sera bientôt disponible</span>`;
            }
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

    // Initialiser le calendrier
    updateCalendar();
});
</script>

@endsection