<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\SubCategory;

use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Orderconfirm;
use App\Mail\InvalidationMail;
use App\Models\Course; // Assurez-vous que cela correspond au bon namespace
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
class CouponController extends Controller
{
    public function AdminAllCoupon(){

        $coupon = Coupon::latest()->get();
        return view('admin.backend.coupon.coupon_all',compact('coupon'));

    } /// End Method 

    private function generateUniqueCouponCode($length = 8) {
        do {
            $code = strtoupper(Str::random($length));
        } while (Coupon::where('coupon_name', $code)->exists());
        
        return $code;
    }

    public function AdminAddCoupon() {
        $courses = Course::all();
        return view('admin.backend.coupon.coupon_add', compact('courses'));
    }

    public function AdminStoreCoupon(Request $request) {
        $request->validate([
            'coupon_discount' => 'required|numeric|between:0,100',
            'coupon_validity' => 'required|date|after:today',
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id'
        ]);

        $coupon = Coupon::create([
            'coupon_name' => $this->generateUniqueCouponCode(),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        // Associer les formations sélectionnées au code promo
        $coupon->courses()->attach($request->courses);

        $notification = array(
            'message' => 'Code Promo inséré avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.coupon')->with($notification);
    }

    public function AdminEditCoupon($id) {
        $coupon = Coupon::with('courses')->findOrFail($id);
        $courses = Course::all();
        $selectedCourses = $coupon->courses->pluck('id')->toArray();
        
        return view('admin.backend.coupon.coupon_edit', compact('coupon', 'courses', 'selectedCourses'));
    }

    public function AdminManageCourses($id)
    {
        $coupon = Coupon::findOrFail($id);
        $categories = Category::with(['courses' => function($query) {
            $query->select('id', 'title', 'category_id');
        }])->get();
        
        // Récupérer les IDs des cours déjà associés
        $selectedCourses = $coupon->courses->pluck('id')->toArray();
        
        return view('admin.backend.coupon.manage_courses', compact('coupon', 'categories', 'selectedCourses'));
    }

    public function AdminUpdateCourses(Request $request, $id)
    {
        $request->validate([
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id'
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->courses()->sync($request->courses);

        $notification = array(
            'message' => 'Formations mises à jour avec succès pour le code promo',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.coupon')->with($notification);
    }
    public function validateCoupon(Request $request) {
        $coupon = Coupon::where('coupon_name', $request->coupon_code)
                       ->where('coupon_validity', '>=', Carbon::now())
                       ->first();

        if (!$coupon) {
            return response()->json(['valid' => false, 'message' => 'Code promo invalide ou expiré']);
        }

        // Vérifier si le code promo est applicable à la formation
        $courseId = $request->course_id;
        if (!$coupon->courses->contains($courseId)) {
            return response()->json(['valid' => false, 'message' => 'Ce code promo n\'est pas applicable à cette formation']);
        }

        return response()->json([
            'valid' => true,
            'discount' => $coupon->coupon_discount,
            'message' => 'Code promo appliqué avec succès'
        ]);
    }
    public function AdminDeleteCoupon($id) {
        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Code promo supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

///////////////////////////////////pour paiement virment
//////////////////////////////////pour paiement virment
public function AdminAllVirement()
{
    $payments = Payment::with('course')->latest()->get(); 
    return view('admin.backend.payment.virement_all', compact('payments'));
}



////////////////////////////


public function DownloadRecu($id)
{
    $payment = Payment::find($id);
    if (!$payment || !$payment->receipt) {
        return redirect()->back()->with('error', 'Fichier introuvable.');
    }

    // Construire le chemin complet du fichier
    $path = public_path($payment->receipt);

    if (!file_exists($path)) {
        return redirect()->back()->with('error', 'Fichier introuvable.');
    }

    return response()->download($path);
}

///////////
public function ValidateVirement($id)
{
    $payment = Payment::find($id);

    if (!$payment) {
        return redirect()->back()->with('error', 'Le paiement n\'existe pas.');
    }

    if ($payment->is_validated) {
        return redirect()->back()->with('error', 'Ce coupon a déjà été validé.');
    }

    $payment->is_validated = true;
    $payment->save();

    session()->flash('success', 'Le virement a été effectué avec succès.');

    return redirect()->back();
}

public function sendTestEmail(Request $request)
{
    $recipientEmail = $request->input('recipient_email', 'itsakbou123@gmail.com');
    $paymentId = $request->input('payment_id');

    $payment = Payment::find($paymentId);

    if (!$payment) {
        return redirect()->back()->with('error', 'Paiement non trouvé.');
    }

    $data = [
        'invoice_no' => $payment->invoice_no,
        'amount' => $payment->total_amount,
        'name' => $payment->name,
        'email' => $recipientEmail,
        'order_date' => $payment->order_date,
        'send_date' => now()->format('d/m/Y H:i'),
        'course_title' => $payment->course ? $payment->course->course_title : 'Aucune formation',
    ];

    $pdf = \PDF::loadView('mail.order_mail', compact('data'));
    $pdfPath = storage_path('app/public/pdfs/invoice_' . $paymentId . '.pdf');
    $pdf->save($pdfPath);

    Mail::to($recipientEmail)->send(new Orderconfirm($data, $pdfPath));

    $payment->is_validated = true;
    $payment->save();

    session()->flash('success', 'L\'email a été envoyé avec succès et le virement a été validé !');

    return redirect()->back();
}

public function invalidateVirement($id)
{
    $payment = Payment::findOrFail($id);

    // Assurez-vous que le chemin n'est pas déjà complet
    $receiptPath = $payment->receipt;
    if (!str_starts_with($receiptPath, 'upload/recu_virement/')) {
        $receiptPath = 'upload/recu_virement/' . $receiptPath;
    }

    $imagePath = public_path($receiptPath);

    // Debug: Afficher le chemin pour vérifier
    

    if (!file_exists($imagePath)) {
        return redirect()->back()->with('error', 'Le reçu n\'a pas été trouvé dans la base de données.');
    }

    Mail::to('itsakbou123@gmail.com')->send(new InvalidationMail($payment, $imagePath));

    $payment->is_invalidated = true;
    $payment->save();

    return redirect()->back()->with('error', 'Un e-mail a été envoyé pour l\'invalidation.');
}
}














