<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseSection;
use App\Models\Question;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Ajoutez cette ligne
class QuestionController extends Controller
{
    public function UserQuestion(Request $request){
        $course_id = $request->course_id;
        $instructor_id = $request->instructor_id;
        Question::insert([
            'course_id' => $course_id,
            'user_id' => Auth::user()->id,
            'instructor_id' => $instructor_id,
            'question' => $request->question,
            'is_read' => false,  // Nouveau message non lu
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Message envoyé avec succès.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  
    }

    public function InstructorAllQuestion(){
        $id = Auth::user()->id;
        
        // Récupérer les questions avec le compteur de messages non lus
        $question = Question::select(
            'user_id', 
            'course_id', 
            DB::raw('MAX(id) as id'),
            DB::raw('COUNT(CASE WHEN is_read = 0 THEN 1 END) as unread_count')
        )
        ->where('instructor_id', $id)
        ->where('parent_id', null)
        ->groupBy('user_id', 'course_id')
        ->with(['user', 'course'])
        ->orderBy('id', 'desc')
        ->get()
        ->map(function($q) {
            $q->latest = Question::find($q->id);
            return $q;
        });
    
        return view('instructor.question.all_question', compact('question'));
    }

    public function QuestionDetails($id){
        $question = Question::find($id);
        
        // Marquer tous les messages de cette conversation comme lus
        Question::where('course_id', $question->course_id)
               ->where('user_id', $question->user_id)
               ->where('is_read', false)
               ->update(['is_read' => true]);

        // Récupérer tous les utilisateurs uniques qui ont des questions
        $allQuestions = Question::where('instructor_id', Auth::user()->id)
            ->where('parent_id', null)
            ->select('user_id', 'course_id', DB::raw('MAX(id) as id'))
            ->groupBy('user_id', 'course_id')
            ->with(['user', 'course'])
            ->orderBy('id', 'desc')
            ->get()
            ->map(function($q) {
                return Question::find($q->id);
            });
        
        // Récupérer tous les messages de la conversation actuelle
        $allMessages = Question::where(function($query) use ($question) {
            $query->where('course_id', $question->course_id)
                  ->where('user_id', $question->user_id)
                  ->where(function($q) {
                      $q->where('parent_id', null)
                        ->orWhereNotNull('parent_id');
                  });
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return view('instructor.question.question_details', compact('question', 'allMessages', 'allQuestions'));
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
            'is_read' => false,  // Marquer la réponse comme non lue pour l'étudiant
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Message envoyé avec succès.',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all.question')->with($notification); 
    }
}
  
}