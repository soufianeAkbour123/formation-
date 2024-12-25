<!DOCTYPE html>
<html>
<head>
    <title>Calendrier</title>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
</head>
<style>
    /* Styles CSS pour le calendrier */
.calendar {
    font-family: Arial, sans-serif;
    margin: 20px;
}

.calendar-header {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    grid-gap: 10px;
    background-color: #f1f1f1;
    padding: 10px;
}

.calendar-body {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    grid-gap: 10px;
}

.calendar-day {
    border: 1px solid #ddd;
    padding: 10px;
}

.day-number {
    font-weight: bold;
}

.events {
    margin-top: 10px;
}

.event {
    background-color: #4f46e5;
    color: white;
    padding: 5px;
    margin-bottom: 5px;
    border-radius: 4px;
}

.event-title {
    font-weight: bold;
}

.event-time {
    font-size: 0.8em;
}
    </style>
<body>
    <div class="calendar">
        <div class="calendar-header">
            <div class="day-of-week">Dimanche</div>
            <div class="day-of-week">Lundi</div>
            <div class="day-of-week">Mardi</div>
            <div class="day-of-week">Mercredi</div>
            <div class="day-of-week">Jeudi</div>
            <div class="day-of-week">Vendredi</div>
            <div class="day-of-week">Samedi</div>
        </div>
        <div class="calendar-body"></div>
    </div>

    <script>
        const events = @json($events);

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString();
        }

        function createCalendar() {
            const today = new Date();
            const startDate = new Date(today.getFullYear(), today.getMonth(), 1);
            const endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);

            const calendarBody = document.querySelector('.calendar-body');
            calendarBody.innerHTML = '';

            while (startDate <= endDate) {
                const calendarDay = document.createElement('div');
                calendarDay.classList.add('calendar-day');

                const dayNumber = document.createElement('div');
                dayNumber.classList.add('day-number');
                dayNumber.textContent = startDate.getDate();
                calendarDay.appendChild(dayNumber);

                const eventsDiv = document.createElement('div');
                eventsDiv.classList.add('events');

                events.forEach(event => {
                    const eventStartDate = new Date(event.date_debut);
                    const eventEndDate = new Date(event.date_fin);
                    if (
                        eventStartDate.getDate() <= startDate.getDate() &&
                        eventEndDate.getDate() >= startDate.getDate() &&
                        eventStartDate.getMonth() === startDate.getMonth()
                    ) {
                        const eventDiv = document.createElement('div');
                        eventDiv.classList.add('event');

                        const eventTitleDiv = document.createElement('div');
                        eventTitleDiv.classList.add('event-title');
                        eventTitleDiv.textContent = event.course_title;
                        eventDiv.appendChild(eventTitleDiv);

                        const eventTimeDiv = document.createElement('div');
                        eventTimeDiv.classList.add('event-time');
                        eventTimeDiv.textContent = `${formatDate(event.date_debut)} - ${formatDate(event.date_fin)}`;
                        eventDiv.appendChild(eventTimeDiv);

                        eventsDiv.appendChild(eventDiv);
                    }
                });

                calendarDay.appendChild(eventsDiv);
                calendarBody.appendChild(calendarDay);

                startDate.setDate(startDate.getDate() + 1);
            }
        }

        createCalendar();
    </script>
    

</body>
</html>