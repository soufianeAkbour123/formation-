@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
@php 
use Carbon\Carbon;
$now = Carbon::now();
@endphp


<div class="curriculum-content p-4">
    <div class="d-flex align-items-center justify-content-center mb-4">
        <a href="{{ route('my.course') }}" class="btn btn-secondary d-flex align-items-center">
            <i class="la la-arrow-left mr-2"></i> Retour
        </a>
        <h2 class="mb-0 mx-auto">Vos Séances</h2>
    </div>
    <div class="text-right mb-4"></div>
</div>

<style>
    .btn-secondary {
        background-color: #4f46e5;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .btn-secondary:hover {
        background-color: #6366f1;
        transform: translateY(-2px);
    }
    .btn-secondary:active {
        background-color: #4f46e5;
        transform: translateY(0);
    }
    .la-arrow-left {
        font-size: 1.2rem;
    }

    .curriculum-content {
        background: #f8fafc;
        padding: 2rem;
        border-radius: 12px;
    }

    .course-timeline {
        position: relative;
    }

    .timeline-section {
        background: #fff;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .timeline-section:hover {
        transform: translateY(-2px);
    }

    .timeline-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .timeline-header:hover {
        background-color: #f9fafb;
    }

    .section-status {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .status-indicator {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(45deg, #4f46e5, #6366f1);
        color: white;
        font-size: 1.2rem;
    }

    .section-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }

    .timeline-stats {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: #f1f5f9;
        border-radius: 8px;
        font-size: 0.875rem;
        color: #64748b;
    }

    .schedule-badges {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .schedule-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        font-size: 0.875rem;
        color: #475569;
    }

    .schedule-badge i {
        margin-right: 0.5rem;
        color: #6366f1;
    }

    .lectures-container {
        padding: 1.5rem;
    }

    .lecture-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
    }

    .lecture-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .lecture-card:hover {
        background: #f1f5f9;
        transform: translateX(5px);
    }

    .lecture-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e0e7ff;
        border-radius: 8px;
        color: #4f46e5;
    }

    .lecture-info {
        flex: 1;
    }

    .lecture-title {
        font-weight: 500;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .progress-bar {
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #4f46e5, #6366f1);
        width: 0%;
        transition: width 0.3s ease;
    }

    .collapse {
        transition: all 0.3s ease-in-out;
    }

    .collapse:not(.show) {
        display: none;
    }

    .collapse.show {
        display: block;
    }

    .session-completed {
        background-color: #e5e7eb;
        color: #6b7280;
    }

    @media (max-width: 768px) {
        .timeline-stats {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        .lecture-grid {
            grid-template-columns: 1fr;
        }
    }

    .modern-btn {
        background-color: #4f46e5;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modern-btn:hover {
        background-color: #6366f1;
        transform: translateY(-2px);
    }

    .modern-btn:active {
        background-color: #4f46e5;
        transform: translateY(0);
    }

    .lecture-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .lecture-item {
        margin-top: 0.5rem;
        font-size: 0.9rem;
        color: #475569;
        display: flex;
        align-items: center;
    }

    .lecture-item i {
        margin-right: 0.5rem;
        color: #4f46e5;
    }
    .modern-btn {
        background-color: #4f46e5;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-right: 10px;
    }

    .modern-btn:hover {
        background-color: #6366f1;
        transform: translateY(-2px);
    }

    .modern-btn:active {
        background-color: #4f46e5;
        transform: translateY(0);
    }

    /* Nouveau style pour le bouton d'enregistrement */
    .modern-btn-recording {
        background-color: #059669;
    }

    .modern-btn-recording:hover {
        background-color: #047857;
    }

    .modern-btn-recording:active {
        background-color: #059669;
    }
    .cancelled-session {
    opacity: 0.8;
}

.cancelled-session .timeline-header {
    background-color: #ffe5e5;
}

.cancelled-session .modern-btn {
    display: none;
}

.badge.bg-danger {
    font-size: 0.8em;
    padding: 0.3em 0.6em;
    margin-left: 1em;
}

    /* Styles existants... */

    .past-session {
        opacity: 0.7;
        background-color: #f3f4f6;
    }

    .past-session .timeline-header {
        background-color: #f3f4f6;
    }

    .past-session .join-btn {
        display: none;
    }

    .past-session .status-indicator {
        background: linear-gradient(45deg, #9ca3af, #d1d5db);
    }

    .session-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.875rem;
        margin-left: 1rem;
    }

    .status-completed {
        background-color: #e5e7eb;
        color: #374151;
    }

    /* Style pour le message d'attente d'enregistrement */
    .waiting-recording {
        font-size: 0.875rem;
        color: #6b7280;
        font-style: italic;
        display: inline-block;
        margin-left: 1rem;
    }
</style>


<div class="course-timeline">
    @foreach ($sections as $sec)
    @php
    $sessionStartTime = Carbon::parse($sec->start_time);
    $sessionEndTime = Carbon::parse($sec->end_time);
    $isPastSession = $sessionEndTime->lt($now);
@endphp
    <div class="timeline-section {{ $sec->is_cancelled ? 'cancelled-session' : '' }} {{ $isPastSession ? 'past-session' : '' }}">
        <div class="timeline-header" data-toggle="collapse" data-target="#collapse{{ $sec->id }}" aria-expanded="false">
            <div class="section-status">
                <div class="status-indicator">
                    <i class="la {{ $sec->is_cancelled ? 'la-ban text-danger' : ($isPastSession ? 'la-check' : 'la-book-open') }}"></i>
                </div>
                <h3 class="section-title">
                    {{ $sec->section_title }}
                    @if($sec->is_cancelled)
                        <span class="badge bg-danger">Annulée</span>
                        <small class="d-block text-danger">
                        Raison: {{ $sec->cancellation_reason }}</small>
                    @elseif($isPastSession)
                        <span class="session-status status-completed">Terminée</span>
                    @endif
                </h3>
            </div>
            <div>
                @if(!$sec->is_cancelled)
                    @if(!$isPastSession)
                        <a href="{{ $sec->link }}" class="modern-btn join-btn" target="_blank">Rejoindre</a>
                    @else
                        @if($sec->video_url)
                            <a href="{{ route('course.view', $sec->course_id) }}" class="modern-btn modern-btn-recording" target="_blank">
                                Voir le cours enregistré
                            </a>
                        @else
                            <span class="waiting-recording">L'enregistrement sera bientôt disponible</span>
                        @endif
                    @endif
                @endif
            </div>
        </div>
        <div class="section-meta">
            <div class="timeline-stats">
                <div class="stat-item">
                    <i class="la la-book"></i>
                    <span>{{ count(App\Models\CourseLecture::where('section_id', $sec->id)->get()) }} Chapitres</span>
                </div>
            </div>
            <div class="schedule-badges justify-content-end">
                <span class="schedule-badge">
                    <i class="la la-calendar"></i>
                    {{ Carbon::parse($sec->date)->format('d/m/Y') }}
                </span>
                <span class="schedule-badge">
                    <i class="la la-clock"></i>
                    {{ Carbon::parse($sec->start_time)->format('H:i') }} - 
                    {{ Carbon::parse($sec->end_time)->format('H:i') }}
                </span>
            </div>
        </div>
        <div id="collapse{{ $sec->id }}" class="collapse">
            <div class="lectures-container">
                <ul class="lecture-list">
                    @foreach ($sec->lectures as $lec)
                        <li class="lecture-item">
                            <i class="la la-file"></i>
                            <span>{{ $lec->lecture_title }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection