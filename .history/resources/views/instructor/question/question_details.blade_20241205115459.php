@extends('instructor.instructor_dashboard')
@section('instructor')
@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp
<div class="page-content">
    <div class="chat-wrapper">
        <div class="chat-sidebar">
            <div class="chat-sidebar-header">
                <div class="d-flex align-items-center">
                    <div class="chat-user-online">
                        <img src="{{ (!empty($profileData->photo)) ? url('upload/instructor_images/'.$profileData->photo) : url('upload/no_image.jpg')}}" width="45" height="45" class="rounded-circle" alt="" />
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <p class="mb-0">{{ $profileData->name }}</p>
                    </div>
                    <div class="dropdown">
                        <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </div>
                    </div>
                </div>
                <div class="mb-3"></div>
                !!
            </div>
            <div class="chat-sidebar-content">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Chats">
                        <div class="p-3"></div>
                        <div class="chat-list">
                            <div class="list-group list-group-flush">
                                @foreach($allQuestions as $q)
                                <a href="{{ route('question.details', $q->id) }}" class="list-group-item">
                                    <div class="d-flex">
                                        <div class="chat-user-online">
                                            <img src="{{ (!empty($q->user->photo)) ? url('upload/user_images/'.$q->user->photo) : url('upload/no_image.jpg')}}" width="42" height="42" class="rounded-circle" alt="" />
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0 chat-title">{{ $q['user']['name'] }}</h6>
                                            <p class="mb-0 chat-msg">{{ Str::limit($q->question, 30) }}</p>
                                        </div>
                                        <div class="chat-time">{{ Carbon\Carbon::parse($q->created_at)->diffForHumans() }}</div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="chat-header d-flex align-items-center">
            <div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i></div>
            <h6>{{ $question['course']['course_name'] }}</h6>
        </div>

        <div class="chat-content">
            @foreach($allMessages as $message)
                @if($message->parent_id === null)
                    {{-- Message de l'étudiant --}}
                    <div class="chat-content-leftside">
                        <div class="d-flex">
                            <img src="{{ (!empty($message->user->photo)) ? url('upload/user_images/'.$message->user->photo) : url('upload/no_image.jpg')}}" width="48" height="48" class="rounded-circle" alt="" />
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 chat-time">{{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
                                <p class="chat-left-msg">{{ $message->question }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Réponse de l'instructeur --}}
                    <div class="chat-content-rightside">
                        <div class="d-flex ms-auto">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">you, {{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
                                <p class="chat-right-msg">{{ $message->question }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <form action="{{ route('instructor.replay') }}" method="POST">
            @csrf
            <input type="hidden" name="qid" value="{{ $question->id }}">
            <input type="hidden" name="course_id" value="{{ $question->course->id }}">
            <input type="hidden" name="user_id" value="{{ $question->user->id }}">
            <input type="hidden" name="instructor_id" value="{{ $profileData->id }}">

            <div class="chat-footer d-flex align-items-center">
                <div class="flex-grow-1 pe-2">
                    <div class="input-group">
                       
                        <input type="text" name="question" class="form-control" placeholder="Type a message">
                    </div>
                </div>
                <div class="chat-footer-menu">
                    <button type="submit"><i class="lni lni-reply"></i> Send </button>
                    
                </div>
            </div>
        </form>

        <div class="overlay chat-toggle-btn-mobile"></div>
    </div>
</div>
@endsection