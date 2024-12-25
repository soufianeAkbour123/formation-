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
    {
        $userId = Auth::id();
        $message = null; // Défini la variable message par défaut
    
        // Vérifier si l'utilisateur est inscrit au cours
        $isEnrolled = Order::where('course_id', $courseId)->where('user_id', $userId)->exists();
    
        if (!$isEnrolled) {
            // L'utilisateur n'est pas inscrit
            $message = 'Vous devez être inscrit à ce cours pour laisser un avis.';
            return view('frontend.review.add_review', [
                'course' => null,
                'message' => $message, // Passe la variable message
                'canSubmit' => false,
            ]);
        }
    
        // Vérifier si l'utilisateur a assisté à au moins une séance
        $attendedSessions = CourseSection::where('course_id', $courseId)
            ->where('is_cancelled', false) // Séances non annulées
            ->where('date', '<=', now()) // Séances passées
            ->count();
    
        if ($attendedSessions < 1) {
            // L'utilisateur est inscrit mais n'a pas assisté à de séances
            $message = 'Vous devez avoir assisté à au moins une séance pour laisser un avis.';
            return view('frontend.review.add_review', [
                'course' => null,
                'message' => $message, // Passe la variable message
                'canSubmit' => false,
            ]);
        }
    
        // L'utilisateur est éligible pour laisser un avis
        $course = Order::where('course_id', $courseId)
            ->where('user_id', $userId)
            ->first();
    
        return view('frontend.review.add_review', [
            'course' => $course,
            'message' => $message, // Passe la variable message
            'canSubmit' => true, // Autorisé à soumettre un avis
        ]);
    }
    
    
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