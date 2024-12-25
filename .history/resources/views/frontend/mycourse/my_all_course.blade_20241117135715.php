@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
@php
use Carbon\Carbon;
@endphp
<div class="container-fluid">

    <div class="section-block mb-5"></div>
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">Mes Cours</h3>
    </div>
    <div class="dashboard-cards mb-5">

       @foreach ($mycourse as $item)
        <div class="card card-item card-item-list-layout">
            <div class="card-image">
                <<a href="{{ route('course.view',$item->course_id) }}" class="d-block">
                    <img class="card-img-top" src="{{ asset($item->course->course_image) }}" alt="Image de la carte">
                </a>

            </div><!-- end card-image -->
            <div class="card-body">
            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
        @if ($item->course->label == 'Begginer')
            Débutant
        @elseif ($item->course->label == 'Middle')
            Intermédiaire
        @elseif ($item->course->label == 'Advance')
            Avancé
        @else
            {{ $item->course->label }}
        @endif
    </h6>

    <h5 class="card-title"><a href="{{ route('course.view',$item->course_id) }}">{{ $item->course->course_name }}</a></h5>
                <p class="card-text"><a href="teacher-detail.html">{{ $item->course->user->name }}</a></p>
                <div class="rating-wrap d-flex align-items-center py-2">
                    <div class="review-stars">
                        <span class="rating-number">4.4</span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star-o"></span>
                    </div>
                    <span class="rating-total pl-1">(157)</span>
                </div><!-- end rating-wrap -->
                <ul class="card-duration d-flex align-items-center fs-15 pb-2">
                    <li class="mr-2">
                        <span class="text-black">Statut :</span>
                        <span class="badge badge-success text-white">Publié</span>
                    </li>
                    <li class="mr-2">
                        <span class="text-black">Durée :</span>
                        <span>{{ $item->course->duration }} heures </span>
                    </li>
                   
                    <li class="mr-2">
                        <span class="text-black">Date Début :</span>
                        <span>{{ Carbon::parse($item->course->date_debut)->format('d/m/Y') }} </span>
                    </li>
                    <li class="mr-2">
                        <span class="text-black">Date Fin :</span>
                        <span>{{ Carbon::parse($item->course->date_fin)->format('d/m/Y') }}</span>
                    </li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
    <p class="card-price text-black font-weight-bold">{{ $item->course->selling_price }} DHS</p>
    <div class="card-action-wrap d-flex pl-3">
            <!-- Button for Live Sessions -->
      
            <a href="{{ route('user.course.sessions', $item->course->id) }}" class="btn btn-info d-flex align-items-center mr-3" data-toggle="tooltip" data-placement="top" data-title="Vos Séance">
                <i class="la la-video mr-1"></i> Vos Séance
            </a>
    
    <!-- Button for Course Support -->
    @if($item->course->programme_file)
        <a href="{{ asset($item->course->programme_file) }}" class="btn btn-info d-flex align-items-center mr-3" target="_blank" data-toggle="tooltip" data-placement="top" data-title="Support de Cours" style="background-color: #FFC107; color: black;">
            <i class="la la-book mr-1" style="font-size:24px;color:black"></i> Support de Cours
        </a>
    @else
        <span class="btn btn-info d-flex align-items-center mr-3" data-toggle="tooltip" data-placement="top" data-title="Aucun PDF disponible" style="background-color: #BDBDBD; color: black;">
            <i class="la la-book mr-1" style="font-size:24px;color:black"></i> Support de Cours
        </span>
    @endif
       
    </div>
</div>
            </div><!-- end card-body -->
        </div><!-- end card --> 
        @endforeach



    </div><!-- end col-lg-12 -->


</div><!-- end container-fluid -->



@endsection