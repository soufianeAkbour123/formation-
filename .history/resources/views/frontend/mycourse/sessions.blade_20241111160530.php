@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
@php use Carbon\Carbon; @endphp

<div class="curriculum-content p-4">
    <h2 class="text-center mb-4">Vos Séances</h2>
    <div class="text-right mb-4">
        <button class="btn btn-primary" name="link">Rejoindre</button>
    </div>

    <style>
        /* Ajouté pour le bouton "Rejoindre" */
        .join-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background-color: #4f46e5;
            color: #fff;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: background-color 0.3s ease;
        }

        .join-btn:hover {
            background-color: #6366f1;
        }

        .join-btn i {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }
    </style>

    <div class="course-timeline">
        @foreach ($sections as $sec)
            @php
                $lecture = App\Models\CourseLecture::where('section_id', $sec->id)->get();
                $isCompleted = Carbon::now()->isAfter(Carbon::parse($sec->end_time));
            @endphp
            <div class="timeline-section {{ $isCompleted ? 'session-completed' : '' }}">
                <div class="timeline-header" data-toggle="collapse" data-target="#collapse{{ $sec->id }}" aria-expanded="false">
                    <div class="section-status">
                        <div class="status-indicator">
                            <i class="la la-book-open"></i>
                        </div>
                        <h3 class="section-title">{{ $sec->section_title }}</h3>
                        <div class="section-date"> <!-- Ajout de la section de date -->
                            <span class="schedule-badge">
                                <i class="la la-calendar"></i>
                                {{ Carbon::parse($sec->start_time)->format('d/m/Y') }}
                            </span>
                            <a href="#" class="join-btn">
                                <i class="la la-play-circle"></i>
                                Rejoindre
                            </a>
                        </div>
                    </div>
                    <div class="section-meta">
                        <div class="timeline-stats">
                            <div class="stat-item">
                                <i class="la la-book"></i>
                                <span>{{ count($lecture) }} Chapitres</span>
                            </div>
                            @if($sec->start_time && $sec->end_time)
                                <div class="schedule-badges">
                                    <span class="schedule-badge">
                                        <i class="la la-clock"></i>
                                        {{ Carbon::parse($sec->start_time)->format('H:i') }} -
                                        {{ Carbon::parse($sec->end_time)->format('H:i') }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if($isCompleted)
                    <div class="alert alert-warning">Séance réalisée le {{ Carbon::parse($sec->end_time)->format('d/m/Y H:i') }}</div>
                @endif

                <div id="collapse{{ $sec->id }}" class="collapse">
                    <div class="lectures-container">
                        <div class="lecture-grid">
                            @foreach ($lecture as $lect)
                                <div class="lecture-card">
                                    <div class="lecture-icon">
                                        <i class="la la-play-circle"></i>
                                    </div>
                                    <div class="lecture-info">
                                        <div class="lecture-title">{{ $lect->lecture_title }}</div>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: 0%"></div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-secondary">Voir Vidéo</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection