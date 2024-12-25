@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
@php use Carbon\Carbon; @endphp

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
    /* ... existing styles ... */
</style>

<div class="course-timeline">
    @foreach ($sections as $sec)
        <div class="timeline-section">
            <div class="timeline-header" data-toggle="collapse" data-target="#collapse{{ $sec->id }}" aria-expanded="false">
                <div class="section-status">
                    <div class="status-indicator">
                        <i class="la la-book-open"></i>
                    </div>
                    <h3 class="section-title">{{ $sec->section_title }}</h3>
                </div>
                <a href="{{ $sec->link }}" class="modern-btn" target="_blank">Rejoindre</a>
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
                        {{ Carbon::parse($sec->start_time)->format('d/m/Y') }}
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