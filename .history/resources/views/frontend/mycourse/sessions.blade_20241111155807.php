@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
@php use Carbon\Carbon; @endphp

<div class="curriculum-content p-4">
    <h2 class="mb-4">Vos Séances</h2>

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
                        @if(!$isCompleted)
                            <button class="btn btn-primary ml-auto">Rejoindre</button>
                        @endif
                    </div>

                    <div class="section-meta">
                        <div class="timeline-stats">
                            <div class="stat-item">
                                <i class="la la-book"></i>
                                <span>{{ count($lecture) }} Chapitres</span>
                            </div>
                        </div>
                        @if($sec->start_time && $sec->end_time)
                            <div class="schedule-badges">
                                <span class="schedule-badge">
                                    <i class="la la-calendar"></i>
                                    {{ Carbon::parse($sec->start_time)->format('d/m/Y') }}
                                </span>
                                <span class="schedule-badge">
                                    <i class="la la-clock"></i>
                                    {{ Carbon::parse($sec->start_time)->format('H:i') }} - 
                                    {{ Carbon::parse($sec->end_time)->format('H:i') }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="collapse" id="collapse{{ $sec->id }}">
                    <div class="lectures-container">
                        <div class="lecture-grid">
                            @foreach ($lecture as $lec)
                                <div class="lecture-card">
                                    <div class="lecture-icon">
                                        <i class="la la-video"></i>
                                    </div>
                                    <div class="lecture-info">
                                        <h4 class="lecture-title">{{ $lec->title }}</h4>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: {{ $lec->progress }}%;"></div>
                                        </div>
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