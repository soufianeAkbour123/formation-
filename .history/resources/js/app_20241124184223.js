import './bootstrap';
import Alpine from 'alpinejs';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import '@fullcalendar/daygrid/main.css';
import '@fullcalendar/timegrid/main.css';
import '@fullcalendar/interaction/main.css';


window.Alpine = Alpine;

Alpine.start();

// Initialisation du calendrier après le chargement de la page
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar'); // ID du conteneur HTML pour le calendrier

    if (calendarEl) {
        const events = [
            {
                title: "Séance 1 : Introduction à HTML",
                start: "2024-11-22T10:00:00",
                end: "2024-11-22T12:00:00",
                backgroundColor: "#3778ff",
                borderColor: "#3778ff",
                url: "https://votre-lien.com",
            },
            {
                title: "Séance 2 : Mise en forme avec CSS",
                start: "2024-11-23T10:00:00",
                end: "2024-11-23T12:00:00",
                backgroundColor: "#3778ff",
                borderColor: "#3778ff",
                url: "https://votre-lien.com",
            },
            // Ajoutez d'autres événements ici
        ];

        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            events: events, // Charge les événements
        });

        calendar.render();
    }
});
