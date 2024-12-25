<style>
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
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    position: relative;
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
    justify-content: space-between;
    align-items: center;
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

.session-completed {
    background-color: #e5e7eb;
    color: #6b7280;
}
</style>

<div class="curriculum-content p-4">
    <h2 class="text-center mb-4">Vos Séances</h2>
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
                        <div class="float-right">
                            <a href="#" class="btn btn-primary btn-sm d-flex align-items-center">
                                <i class="la la-video-camera mr-2"></i>
                                Rejoindre
                            </a>
                            <span class="ml-3">{{ Carbon::parse($sec->start_time)->format('d/m/Y H:i') }}</span>
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
                                        <a href="#" class="btn btn-secondary btn-sm">Voir Vidéo</a>
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

<script>
document.querySelectorAll('.timeline-header').forEach(function(header) {
    header.addEventListener('click', function() {
        this.classList.toggle('active');
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + 'px';
        }
    });
});
</script>