<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
class ReviewController extends Controller
{
    public function StoreReview(Request $request)
    {
        $userId = Auth::id();
        $courseId = $request->course_id;

        // Vérifiez si l'utilisateur est inscrit au cours
        $isEnrolled = Order::where('course_id', $courseId)->where('user_id', $userId)->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses')->with('error', 'Vous devez être inscrit à ce cours pour laisser un avis.');
        }

        // Vérifiez si l'utilisateur a assisté à au moins trois séances non annulées
        $attendedSessions = CourseSection::where('course_id', $courseId)
            ->where('is_cancelled', false)
            ->where('date', '<=', now()) // La date de la séance est passée
            ->count();

        if ($attendedSessions < 3) {
            return redirect()->back()->with('error', 'Vous devez avoir assisté à au moins trois séances pour laisser un avis.');
        }

        // Validation des données
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
            'created_at' => Carbon::now(),
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