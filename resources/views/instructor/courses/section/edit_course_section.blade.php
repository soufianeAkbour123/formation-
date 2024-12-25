@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit section</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
               <a href="{{ route('add.course.lecture',['id' => $csection->course_id]) }}" class="btn btn-primary px-5">Back</a>  
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Modifier le nom de la séance</h5>
            <form id="myForm" action="{{ route('update.course.section') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="id" value="{{ $csection->id }}">

                <div class="form-group col-md-6">
                    <label for="section_title" class="form-label">Titre de la Séance</label>
                    <input type="text" name="section_title" class="form-control" id="input1" value="{{ $csection->section_title }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="start_time" class="form-label">Heure de début</label>
                    <input type="datetime-local" name="start_time" class="form-control" id="start_time" value="{{ $csection->start_time ? \Carbon\Carbon::parse($csection->start_time)->format('Y-m-d\TH:i') : '' }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="end_time" class="form-label">Heure de fin</label>
                    <input type="datetime-local" name="end_time" class="form-control" id="end_time" value="{{ $csection->end_time ? \Carbon\Carbon::parse($csection->end_time)->format('Y-m-d\TH:i') : '' }}" required>
                </div>

                <!-- Ajout du champ 'link' -->
                @if($csection->link)
    <div class="mb-3">
        <label class="form-label">Lien actuel</label>
        <a href="{{ $csection->link }}" target="_blank">{{ $csection->link }}</a>
    </div>
@endif

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
