<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Course_goal;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
 use Gloudemans\Shoppingcart\Facades\Cart;
 use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Question;

class OrderController extends Controller
{
    //

    public function AdminPendingOrder(){
        
        $payment = Payment::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.backend.orders.pending_orders',compact('payment'));

    }////end

    public function AdminOrderDetails($payment_id){

        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();

        return view('admin.backend.orders.admin_order_details',compact('payment','orderItem'));

    }// End Method 

    public function PendingToConfirm($payment_id){
        Payment::find($payment_id)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Order Confrim Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.confirm.order')->with($notification);   


    }// End Method 

    public function AdminConfirmOrder(){

        $payment = Payment::where('status','confirm')->orderBy('id','DESC')->get();
        return view('admin.backend.orders.confirm_orders',compact('payment'));

    } // End Method 
    public function MyCourse(){
        $id = Auth::user()->id;

        $latestOrders = Order::where('user_id',$id)->select('course_id', \DB::raw('MAX(id) as max_id'))->groupBy('course_id');

        $mycourse = Order::joinSub($latestOrders, 'latest_order', function($join) {
            $join->on('orders.id', '=', 'latest_order.max_id');
        })->orderBy('latest_order.max_id','DESC')->get();

        return view('frontend.mycourse.my_all_course',compact('mycourse'));

    }// End Method 
    public function showSessions($id)
    {
        $course = Course::findOrFail($id);
        $sections = $course->sections; // Assuming you have a relationship defined
        return view('frontend.mycourse.sessions', compact('course', 'sections'));
    }
    public function CourseView($course_id){
        $id = Auth::user()->id;
        $course = Order::where('course_id',$course_id)->where('user_id',$id)->first();
        $section = CourseSection::where('course_id',$course_id)->orderBy('id','asc')->get();

        $allquestion = Question::latest()->get();

        return view('frontend.mycourse.course_view',compact('course','section','allquestion'));


    }// End Method 
    public function event()
{
    $sections = CourseSection::with('lectures')
                      ->orderBy('date')
                      ->get();
    
    return view('frontend.mycourse.event', compact('sections'));
}
public function calendar()
{
    try {
        $now = Carbon::now();
        $userId = Auth::user()->id;

        // Vérifier si l'utilisateur a des commandes valides
        $validOrders = Order::with(['payment', 'course'])
            ->whereHas('payment', function($query) {
                $query->where('status', 'confirm');
            })
            ->where('user_id', $userId)
            ->get();

        // Debug
        \Log::info('Valid Orders:', [
            'userId' => $userId,
            'orderCount' => $validOrders->count(),
            'orderIds' => $validOrders->pluck('id')
        ]);

        // Si pas de commandes valides
        if ($validOrders->isEmpty()) {
            return view('frontend.mycourse.event', [
                'sections' => [],
                'userHasNoCourses' => true
            ]);
        }

        // Récupérer les IDs des cours achetés
        $purchasedCourseIds = $validOrders->pluck('course_id')->unique()->toArray();

        \Log::info('Purchased Course IDs:', $purchasedCourseIds);

        // Récupérer les sections uniquement pour les cours achetés
        $sections = CourseSection::query()
            ->whereIn('course_id', $purchasedCourseIds)
            ->where('date', '>=', $now->copy()->startOfMonth())
            ->where('date', '<=', $now->copy()->endOfMonth())
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        \Log::info('Sections found:', [
            'count' => $sections->count(),
            'sectionIds' => $sections->pluck('id')
        ]);

        $formattedSections = $sections->map(function ($section) {
            return [
                'id' => $section->id,
                'section_title' => $section->section_title,
                'date' => $section->date,
                'start_time' => $section->start_time,
                'end_time' => $section->end_time,
                'is_cancelled' => $section->is_cancelled,
                'cancellation_reason' => $section->cancellation_reason,
                'link' => $section->link,
                'course_id' => $section->course_id,
                'video_url' => $section->video_url,
                'lectures_count' => $section->CourseLecture->count()
            ];
        });

        return view('frontend.mycourse.event', [
            'sections' => $formattedSections,
            'userHasNoCourses' => false
        ]);

    } catch (\Exception $e) {
        \Log::error('Calendar Error: ' . $e->getMessage());
        
        return view('frontend.mycourse.event', [
            'sections' => [],
            'userHasNoCourses' => true,
            'error' => 'Une erreur est survenue lors du chargement du calendrier'
        ]);
    }
}
  
}