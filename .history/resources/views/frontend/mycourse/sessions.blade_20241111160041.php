@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
@php use Carbon\Carbon; @endphp

<div class="curriculum-content p-4">
    <h2 class="mb-4">Vos Séances</h2>

    <style>
        .timeline-section {
            background: #fff;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
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

        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6366f1;
            border-color: #6366f1;
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
    </style>

    <div class="course-timeline">
        @foreach ($sections as $sec)
            @php
                $lecture = App\Models\CourseLecture::where('section_id', $sec->id)->get();
                $isCompleted = Carbon::now()->isAfter(Carbon::parse($sec->end_time));
            @endphp
            <div class="timeline-section {{ $isCompleted ? 'session-completed' : '' }}">
                <div class="section-info">
                    <div class="status-indicator">
                        <i class="la la-book-open"></i>
                    </div>
                    <h3 class="section-title">{{ $sec->section_title }}</h3>
                </div>
                <div class="section-meta">
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
                    <div class="stat-item">
                        <i class="la la-book"></i>
                        <span>{{ count($lecture) }} Chapitres</span>
                    </div>
                    @if(!$isCompleted)
                        <button class="btn btn-primary">Rejoindre</button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection