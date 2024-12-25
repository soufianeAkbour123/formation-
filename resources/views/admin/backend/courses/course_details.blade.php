@extends('admin.admin_dashboard')
@section('admin')
@php
use Carbon\Carbon;
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Détails du Cours</div>
            
        <div class="ms-auto">
           
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                    <div class="flex-grow-1 ms-3">
                        <h5 class="mt-0">{{ $course->course_name }}</h5>
                        <p class="mb-0">{{ $course->course_title }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <table class="table mb-0">
                                <tbody>
                                    <tr> 
                                        <td><strong>Catégorie :</strong></td>
                                        <td> {{ $course['category']['category_name'] }} </td> 
                                    </tr>
                                    <tr> 
                                        <td><strong>Instructeur :</strong></td>
                                        <td> {{ $course['user']['name'] }}</td> 
                                    </tr>
                                    <tr> 
                                        <td><strong>Étiquette :</strong></td>
                                        <td>
                                            @if ($course->label == 'Begginer')
                                                Débutant
                                            @elseif ($course->label == 'Middle')
                                                Intermédiaire
                                            @elseif ($course->label == 'Advance')
                                                Avancé
                                            @else
                                                {{ $course->label }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td><strong>Durée :</strong></td>
                                        <td> {{ $course->duration }} H</td> 
                                    </tr>
                                    <tr> 
                                        <td><strong>Vidéo :</strong></td>
                                        <td>  
                                            <video width="300" height="200" controls>
                                                <source src="{{ asset($course->video) }}" type="video/mp4">
                                            </video>
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <table class="table mb-0">
                                <tbody>
                                    <tr> 
                                        <td><strong>Date Début :</strong></td>
                                        <td>{{ Carbon::parse($course->date_debut)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date Fin :</strong></td>
                                        <td>{{ Carbon::parse($course->date_fin)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr> 
    <td><strong>Certificat :</strong></td>
    <td>
        @if ($course->certificate)
            Oui
        @else
            Non
        @endif
    </td> 
</tr>
                                    <tr> 
                                        <td><strong>Prix de Vente :</strong></td>
                                        <td> {{ $course->selling_price }} DH</td> 
                                    </tr>
                                    <tr> 
                                        <td><strong>Prix Réduit :</strong></td>
                                        <td>{{ $course->discount_price }} DH</td> 
                                    </tr>
                                    <tr> 
                                        <td><strong>Statut :</strong></td>
                                        <td> 
                                            @if ($course->status == 1)
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-danger">Inactif</span>
                                            @endif
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection