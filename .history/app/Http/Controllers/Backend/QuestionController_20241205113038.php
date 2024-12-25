<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseSection;
use App\Models\Question;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
class QuestionController extends Controller
{
    public function UserQuestion(Request $request){
        $course_id = $request->course_id;
        $instructor_id = $request->instructor_id;
        Question::insert([
            'course_id' => $course_id,
            'user_id' => Auth::user()->id,
            'instructor_id' => $instructor_id,
            'subject' => $request->subject,
            'question' => $request->question,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => '
Message envoyé avec succès.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  
    } // End Method 
    public function InstructorAllQuestion(){
        $id = Auth::user()->id;
        
        // Grouper les questions par utilisateur et prendre la plus récente
        $question = Question::where('instructor_id', $id)
            ->where('parent_id', null)
            ->select('user_id', 'course_id')
            ->selectRaw('MAX(id) as id')
            ->selectRaw('COUNT(*) as message_count')
            ->selectRaw('MAX(created_at) as latest_message')
            ->groupBy('user_id', 'course_id')
            ->with(['user', 'course', 'latestMessage'])
            ->orderBy('latest_message', 'desc')
            ->get()
            ->map(function($q) {
                $q->latest = Question::find($q->id);
                return $q;
            });
    
        return view('instructor.question.all_question', compact('question'));
    }
    public function QuestionDetails($id){
        $question = Question::find($id);
        
        // Récupérer toutes les questions du même utilisateur pour ce cours
        $allQuestions = Question::where('course_id', $question->course_id)
            ->where('user_id', $question->user_id)
            ->where('parent_id', null)
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Récupérer toutes les réponses
        $replay = Question::whereIn('parent_id', $allQuestions->pluck('id'))
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('instructor.question.question_details', compact('question', 'replay', 'allQuestions'));
    }

    public function InstructorReplay(Request $request){

        $que_id = $request->qid;
        $user_id = $request->user_id;
        $course_id = $request->course_id;
        $instructor_id = $request->instructor_id;

        Question::insert([
            'course_id' => $course_id,
            'user_id' => $user_id,
            'instructor_id' => $instructor_id,
            'parent_id' => $que_id,
            'question' => $request->question,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '
Message envoyé avec succès.',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all.question')->with($notification); 


    }// End Method 

  
}