<!DOCTYPE html>
<html>
<head>
    <title>Calendrier</title>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
</head>
<style>
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