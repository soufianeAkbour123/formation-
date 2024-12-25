@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
<div id="calendar"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['dayGrid', 'timeGrid'], // Choisissez vos vues
            initialView: 'timeGridWeek',     // Vue par défaut (semaine)
            events: '/get-calendar-events', // Route Laravel pour récupérer les données
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventClick: function(info) {
                if (info.event.url) {
                    window.open(info.event.url, "_blank");
                    info.jsEvent.preventDefault();
                }
            }
        });

        calendar.render();
    });
</script>
<style
@endsection