@extends('instructor.instructor_dashboard')
@section('instructor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Question</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Sl</th>
            <th>Course Name</th>
           
            
            <th>User</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($question as $key=> $item)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item['course']['course_name'] }}</td>
           
           td class="test-style">
    {{ $item['user']['name'] }}
    @if($item->created_at > auth()->user()->last_seen_message)
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
            <span class="visually-hidden">New message</span>
        </span>
    @endif
</td>
            <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
            <td>
                <div class="position-relative">
                    <a href="{{ route('question.details',$item->id) }}" class="btn btn-info" title="View">
                        <i class="lni lni-eye"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>




</div>

<style>
    .position-relative {
        position: relative;
    }

    .position-absolute {
        position: absolute;
    }

    .bg-danger {
        background-color: #ff0000 !important;
        width: 10px;
        height: 10px;
        animation: blink 1s infinite; /* Ajout de l'animation */
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    @keyframes blink {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
    }

    /* Style de test */
    .test-style {
        border: 2px solid blue;
    }
</style>


@endsection