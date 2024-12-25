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
            <th>Subject</th>
            <th>User</th>
            <th>Date</th>
            <th>Messages</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($question as $key=> $item)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item['course']['course_name'] }}</td>
            <td>{{ $item->latest->subject }}</td>
            <td>{{ $item['user']['name'] }}</td>
            <td>{{ Carbon\Carbon::parse($item->latest_message)->diffForHumans() }}</td>
            <td>
                {{ $item->message_count }}
                @if($item->latest->created_at > auth()->user()->last_seen_message)
                    <span class="badge bg-danger rounded-pill">New</span>
                @endif
            </td>
            <td>
                <a href="{{ route('question.details', $item->latest->id) }}" class="btn btn-info" title="View">
                    <i class="lni lni-eye"></i>
                </a>
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