@extends('instructor.instructor_dashboard') 
@section('instructor')  

<style>     
    .position-relative {         
        position: relative;     
    }      
    
    .position-absolute {         
        position: absolute;     
    }      
    
    .rounded-circle {         
        border-radius: 50%!important;         
        width: 10px;         
        height: 10px;     
    }      
    
    .bg-danger {         
        background-color: #dc3545!important;     
    }      
    
    .notification-dot {         
        position: absolute;         
        top: -5px;         
        right: -5px;     
    }      
    
    .nav-notification {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #dc3545;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>  

@section('header-notification')
<!-- À placer dans votre header -->
<div class="nav-item position-relative">
    <a class="nav-link">
        <i class="bx bx-bell"></i>
        @if($totalUnread > 0)
            <span class="nav-notification">{{ $totalUnread }}</span>
        @endif
    </a>
</div>
@endsection

<div class="page-content">     
    <div class="card radius-10">         
        <div class="card-body">             
            <div class="d-flex align-items-center">                 
                <div>                     
                    <h5 class="mb-0">Toutes les Questions</h5>                 
                </div>                 
                <div class="font-22 ms-auto">                     
                    <i class="bx bx-dots-horizontal-rounded"></i>                 
                </div>             
            </div>             
            <hr/>             
            <div class="table-responsive">                 
                <table class="table align-middle mb-0">                     
                    <thead class="table-light">                         
                        <tr>                             
                            <th>SL</th>                             
                            <th>Cours</th>                             
                            <th>Étudiant</th>                             
                            <th>Question</th>                             
                            <th>Action</th>                         
                        </tr>                     
                    </thead>                     
                    <tbody>                         
                        @foreach($question as $key => $item)                         
                        <tr>                             
                            <td>{{ $key+1 }}</td>                             
                            <td>{{ $item->course->course_name }}</td>                             
                            <td>{{ $item->user->name }}</td>                             
                            <td>{{ $item->latest->question }}</td>                             
                            <td>                                 
                                <div class="position-relative">                                     
                                    <a href="{{ route('question.details',$item->id) }}" class="btn btn-info" title="Voir">                                         
                                        <i class="lni lni-eye"></i>                                         
                                        @if($item->unread_count > 0)                                             
                                            <span class="position-absolute notification-dot p-1 bg-danger rounded-circle">                                                 
                                                <span class="visually-hidden">{{ $item->unread_count }} nouveau(x) message(s)</span>                                             
                                            </span>                                         
                                        @endif                                     
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

@endsection