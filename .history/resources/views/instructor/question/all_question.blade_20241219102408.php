<!-- all_question.blade.php -->
@extends('instructor.instructor_dashboard')
@section('instructor')

<div class="page-content">
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Toutes les Questions</h5>
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
                                    </a>
                                    @if($item->unread_count > 0)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $item->unread_count }}
                                            <span class="visually-hidden">messages non lus</span>
                                        </span>
                                    @endif
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