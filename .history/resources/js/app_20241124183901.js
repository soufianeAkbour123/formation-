import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid'; // Vue calendrier mensuel
import timeGridPlugin from '@fullcalendar/timegrid'; // Vue calendrier horaire
import interactionPlugin from '@fullcalendar/interaction'; // Pour interagir (drag & drop, clics)
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
