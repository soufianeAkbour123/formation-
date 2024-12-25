@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
@php use Carbon\Carbon; @endphp

<div class="curriculum-content p-4">
    <h2 class="mb-4">Vos Séances</h2>

    <style>
        .timeline-section {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .timeline-section:hover {
            transform: translateY(-2px);
        }

        .section-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
        }

        .schedule-badges {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .schedule-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background-color: #f1f5f9;
            border-radius: 8px;
            font-size: 0.875rem;
            color: #475569;
        }

        .schedule-badge i {
            margin-right: 0.5rem;
            color: #6366f1;
        }

        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: #fff;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6366f1;
            border-color: #6366f1;
        }
    </style>

    <div class="course-timeline">
        @foreach ($sections as $sec)
            @php
                $lecture = App\Models\CourseLecture::where('section_id', $sec->id)->get();
                $isCompleted = Carbon::now()->isAfter(Carbon::parse($sec->end_time));
            @endphp
            <div class="timeline-section {{ $isCompleted ? 'session-completed' : '' }}">
                <div class="section-info">
                    <h3 class="section-title">{{ $sec->section_title }}</h3>
                    <div class="schedule-badges">
                        <span class="schedule-badge">
                            <i class="la la-book"></i>
                            {{ count($lecture) }} Chapitres
                        </span>
                        @if($sec->start_time && $sec->end_time)
                            <span class="schedule-badge">
                                <i class="la la-calendar"></i>
                                {{ Carbon::parse($sec->start_time)->format('d/m/Y') }}
                            </span>
                        @endif
                    </div>
                </div>
                @if(!$isCompleted)
                    <button class="btn btn-primary">Rejoindre</button>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection