<!DOCTYPE html>
<html>
<head>
    <title>Calendrier</title>
    
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
            <div class="day-of-week">Dim</div>
            <div class="day-of-week">Lun</div>
            <div class="day-of-week">Mar</div>
            <div class="day-of-week">Mer</div>
            <div class="day-of-week">Jeu</div>
            <div class="day-of-week">Ven</div>
            <div class="day-of-week">Sam</div>
        </div>
        <div class="calendar-body">
            @php
                $today = new DateTime();
                $startDate = new DateTime($today->format('Y-m-01'));
                $endDate = new DateTime($today->format('Y-m-t'));
            @endphp

            @while ($startDate <= $endDate)
                <div class="calendar-day">
                    <div class="day-number">{{ $startDate->format('d') }}</div>
                    <div class="events">
                        @foreach ($events as $event)
                            @php
                                $eventStartDate = new DateTime($event->date_debut);
                                $eventEndDate = new DateTime($event->date_fin);
                            @endphp
                            @if ($eventStartDate <= $startDate && $eventEndDate >= $startDate)
                                <div class="event">
                                    <div class="event-title">{{ $event->course_title }}</div>
                                    <div class="event-time">{{ $eventStartDate->format('d/m/Y') }} - {{ $eventEndDate->format('d/m/Y') }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @php
                    $startDate->modify('+1 day');
                @endphp
            @endwhile
        </div>
    </div>

    <script src="{{ asset('js/calendar.js') }}"></script>
</body>

</html>