<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use App\Models\CourseSection;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function ShowReviewForm($courseId)

   $userId = Auth::id();
   
   // Initialisation des variables
   $message = null;
   $canSubmit = false;
   $course = null;
   
   // Vérifier si l'utilisateur est inscrit au cours
   $isEnrolled = Order::where('course_id', $courseId)
                     ->where('user_id', $userId)
                     ->where('status', '1') // Assurez-vous que la commande est validée
                     ->exists();
   
   if (!$isEnrolled) {
       $message = 'Vous devez être inscrit à ce cours pour laisser un avis. 
                  <a href="' . route('all.courses') . '" class="btn theme-btn">Découvrir nos formations</a>';
       return view('frontend.review.add_review', compact('message', 'canSubmit', 'course'));
   }
   
   // Vérifier si l'utilisateur a assisté à au moins 3 séances
   $currentDateTime = now();
   $attendedSessions = CourseSection::where('course_id', $courseId)
       ->where(function($query) use ($currentDateTime) {
           $query->whereDate('date', '<', $currentDateTime->toDateString())
                 ->orWhere(function($q) use ($currentDateTime) {
                     $q->whereDate('date', '=', $currentDateTime->toDateString())
                       ->whereTime('end_time', '<', $currentDateTime->toTimeString());
                 });
       })
       ->where('is_cancelled', 0)
       ->where('is_rescheduled', 0)
       ->count();
   
   if ($attendedSessions < 3) {
       $message = "Vous devez avoir assisté à au moins 3 séances pour laisser un avis. 
                  Séances complétées : $attendedSessions/3";
       return view('frontend.review.add_review', compact('message', 'canSubmit', 'course'));
   }
   
   // Vérifier si l'utilisateur a déjà laissé un avis
   $existingReview = Review::where('user_id', $userId)
                         ->where('course_id', $courseId)
                         ->exists();
   
   if ($existingReview) {
       $message = "Vous avez déjà laissé un avis pour ce cours.";
       return view('frontend.review.add_review', compact('message', 'canSubmit', 'course'));
   }
   
   // Si l'utilisateur est éligible pour laisser un avis
   $course = Order::where('course_id', $courseId)
                 ->where('user_id', $userId)
                 ->first();
   
   // L'utilisateur peut soumettre un avis
   $canSubmit = true;
   
   return view('frontend.review.add_review', compact('course', 'message', 'canSubmit'));
    
    
    
    public function StoreReview(Request $request)
    {
        $userId = Auth::id();
        $courseId = $request->course_id;

        // Validation
        $request->validate([
            'comment' => 'required',
            'rate' => 'required|integer|min:1|max:5',
        ]);

        // Sauvegarde de l'avis
        Review::create([
            'course_id' => $courseId,
            'user_id' => $userId,
            'comment' => $request->comment,
            'rating' => $request->rate,
            'instructor_id' => $request->instructor_id,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Votre avis sera approuvé par l\'administrateur.');
    }
    public function AdminPendingReview(){

        $review = Review::where('status',0)->orderBy('id','DESC')->get();
        return view('admin.backend.review.pending_review',compact('review'));
    }// End Method 
    public function UpdateReviewStatus(Request $request){

        $reviewId = $request->input('review_id');
        $isChecked = $request->input('is_checked',0);
        $review = Review::find($reviewId);
        if ($review) {
            $review->status = $isChecked;
            $review->save();
        }
        return response()->json(['message' => 'Review Status Updated Successfully']);
    }// End Method 

    public function AdminActiveReview(){
        $review = Review::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.backend.review.active_review',compact('review'));
    }// End Method 
    
 public function InstructorAllReview(){
        $id = Auth::user()->id;
        $review = Review::where('instructor_id',$id)->where('status',1)->orderBy('id','DESC')->get();
        return view('instructor.review.active_review',compact('review'));
    }// End Method 
}