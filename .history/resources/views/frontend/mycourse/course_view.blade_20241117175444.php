@foreach ($section as $sec)
    <div class="card">
        <div class="card-header" id="headingOne{{ $sec->id }}">
            <button class="btn btn-link" type="button" data-toggle="collapse" 
                    data-target="#collapseOne{{ $sec->id }}" 
                    aria-expanded="true" 
                    aria-controls="collapseOne">
                <i class="la la-angle-down"></i>
                <i class="la la-angle-up"></i>
                <span class="fs-15">{{ $sec->section_title }}</span>
            </button>
        </div><!-- end card-header -->
        <div id="collapseOne{{ $sec->id }}" class="collapse show" 
             aria-labelledby="headingOne{{ $sec->id }}" 
             data-parent="#accordionCourseExample">
            <div class="card-body p-0">
                <ul class="curriculum-sidebar-list">
                    <li class="course-item-link active">
                        <div class="course-item-content-wrap">
                            <div class="course-item-content">
                                <h4 class="fs-15 lecture-title" 
                                    data-video-url="{{ $sec->video_url }}">
                                    {{ $sec->video_title ?? $sec->section_title }}
                                </h4>
                            </div><!-- end course-item-content -->
                        </div><!-- end course-item-content-wrap -->
                    </li>
                </ul>
            </div><!-- end card-body -->
        </div><!-- end collapse -->
    </div><!-- end card -->
@endforeach