<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier des cours</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .calendar-header {
            background-color: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background-color: #dee2e6;
        }
        
        .calendar-day {
            background-color: white;
            min-height: 150px;
            padding: 0.5rem;
        }
        
        .day-header {
            font-weight: bold;
            padding: 0.5rem;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }
        
        .event {
            background-color: #e7ebfd;
            border-left: 3px solid #696cff;
            margin: 0.25rem 0;
            padding: 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }
        
        .event.cancelled {
            background-color: #ffe7e7;
            border-left-color: #dc3545;
            text-decoration: line-through;
        }
        
        .event.past {
            background-color: #e9ecef;
            border-left-color: #6c757d;
        }
        
        .event-time {
            font-size: 0.75rem;
            color: #6c757d;
        }
        
        .event-title {
            font-weight: 500;
        }
        
        .btn-join {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        .today {
            background-color: #f8f9fa;
            border: 2px solid #696cff;
        }
        
        .day-number {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="calendar-header">
            <div class="calendar-nav">
                <button class="btn btn-light"><i class="fas fa-chevron-left"></i></button>
                <h2 class="mb-0">Février 2024</h2>
                <button class="btn btn-light"><i class="fas fa-chevron-right"></i></button>
                <div class="ms-auto">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> Nouvelle réunion</button>
                </div>
            </div>
        </div>
        
        <div class="calendar-grid">
            <!-- En-têtes des jours -->
            <div class="day-header">Dimanche</div>
            <div class="day-header">Lundi</div>
            <div class="day-header">Mardi</div>
            <div class="day-header">Mercredi</div>
            <div class="day-header">Jeudi</div>
            <div class="day-header">Vendredi</div>
            <div class="day-header">Samedi</div>
            
            <!-- Exemple de jours -->
            @for ($i = 1; $i <= 35; $i++)
                <div class="calendar-day {{ $i == 8 ? 'today' : '' }}">
                    <div class="day-number">{{ $i }}</div>
                    @if ($i == 6)
                    <div class="event cancelled">
                        <div class="event-time">19:00 - 21:00</div>
                        <div class="event-title">SEANCE 12 GP AGILE</div>
                        <small class="text-danger">Annulé</small>
                    </div>
                    @endif
                    @if ($i == 8)
                    <div class="event">
                        <div class="event-time">19:00 - 21:00</div>
                        <div class="event-title">PHP LARAVEL - SEANCE 1</div>
                        <button class="btn btn-primary btn-join btn-sm mt-1">Rejoindre</button>
                    </div>
                    @endif
                    @if ($i == 9)
                    <div class="event">
                        <div class="event-time">19:00 - 21:00</div>
                        <div class="event-title">SEANCE 12 JEE</div>
                        <button class="btn btn-primary btn-join btn-sm mt-1">Rejoindre</button>
                    </div>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>