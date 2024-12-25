<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Category;
use App\Models\Course;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PromoEmail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;




class PromoController extends Controller
{
    public function AdminAllPromo()
 {
    // Met à jour les promos dont la date d'expiration est passée
    Promo::where('expiration_date', '<', now())
        ->where('status', '!=', 'inactive')
        ->update(['status' => 'inactive']);

    // Garder les promotions dont la date d'expiration est égale à aujourd'hui comme actives
    Promo::where('expiration_date', '=', now()->format('Y-m-d'))
        ->where('status', '!=', 'active')
        ->update(['status' => 'active']);

    $promo = Promo::latest()->get();
    return view('admin.backend.promo.promo_all', compact('promo'));
 }///////end


    public function AdminAddPromo(){
        return view('admin.backend.promo.promo_add');
    }/// End Method 

    public function AdminStorePromo(Request $request)
    {
        // Validation des données
        $request->validate([
            'discount' => 'required|numeric|min:1', // Assurez-vous que la réduction est remplie et est un nombre
            'expiration_date' => 'required|date|after_or_equal:today', // Vérifiez que la date d'expiration est valide
        ]);
    
        // Génération du code promo
        $promoCode = $this->generatePromoCode();
        
        // Insertion du code promo dans la base de données
        Promo::insert([
            'code' => $promoCode,
            'discount' => $request->discount,
            'expiration_date' => $request->expiration_date,
        ]);
        
        // Notification de succès
        $notification = array(
            'message' => 'Code Promo inséré avec succès',
            'alert-type' => 'success'
        );
    
        return redirect()->route('admin.all.promo')->with($notification);  
    }
    
    
 // Fonction pour générer un code promo unique
    function generatePromoCode()
    {
        $letters = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3));
        $numbers = substr(str_shuffle("0123456789"), 0, 2);
        return $letters . $numbers;
    }/// End Method 

    public function AdminEditPromo($id){

        $promo = Promo::find($id);
        return view('admin.backend.promo.promo_edit',compact('promo'));

    }/// End Method 

    public function AdminUpdatePromo(Request $request)
    {
        // Récupération de l'ID du code promo
        $promo_id = $request->id;
    
        // Recherche du code promo par son ID et mise à jour des champs
        $promo = Promo::find($promo_id);
    
        // Vérification que le code promo existe
        if ($promo) {
            // Mise à jour des informations
            $promo->update([
                'discount' => $request->discount, // Assurez-vous que 'discount' est bien passé
                'expiration_date' => $request->expiration_date,
            ]);
    
            // Mise à jour du statut en fonction de la date d'expiration
            if ($promo->expiration_date && $promo->expiration_date < now()) {
                $promo->update([
                    'status' => 'expired', // Mettre à jour le statut en "expired" si la date d'expiration est passée
                ]);
            } elseif ($promo->status !== 'expired') {
                // Si le code promo n'est pas encore expiré et que son statut n'est pas déjà "expired", il reste "active"
                $promo->update([
                    'status' => 'active',
                ]);
            }
    
            // Notification de succès
            $notification = array(
                'message' => 'Code promo mis à jour avec succès',
                'alert-type' => 'success'
            );
        } else {
            // Notification d'erreur si le code promo n'est pas trouvé
            $notification = array(
                'message' => 'Code promo introuvable',
                'alert-type' => 'error'
            );
        }
    
        // Redirection vers la page des codes promo
        return redirect()->route('admin.all.promo')->with($notification);
    }////END UPDATE
    
    public function AdminDeletePromo($id){

        Promo::find($id)->delete();

        $notification = array(
            'message' => 'Code promo est supprimer avec succès',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }/// End Method 

    public function AdminSendPromo(Request $request)
    {
        // Récupérer la promotion avec les cours associés
        $promo = Promo::with('courses')->find($request->promo_id);
    
        if (!$promo) {
            return back()->with('error', 'Promotion non trouvée.');
        }
    
        // Récupérer tous les cours associés à la promotion
        $courses = $promo->courses;
    
        // Récupérer le code promo et la date d'expiration
        $code = $promo->code;
        $expirationDate = $promo->expiration_date;
    
        // Pour déboguer
        // dd($courses, $code, $expirationDate);
    
        // Envoyer l'email
        try {
            // Envoyer l'email avec tous les cours associés
            Mail::to('itsakbou123@gmail.com')->send(new PromoEmail($code, $expirationDate, $courses));
            return back()->with('success', 'Email envoyé avec succès !');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
        }
    }////SENDING
    

    public function AdminAllCategories()
    {
        // Récupérer toutes les catégories
       
        $courses = Course::all();


        $promos = Promo::all();
        
        // Retourner la vue avec les catégories
        return view('admin.backend.category.category_all_promo', compact('courses','promos'));
    }/////////end

    public function AdminAllPromoApply()
    {
        // Récupérer les codes promo qui ont au moins un cours associé
        $promos = Promo::has('courses')->get();
    
        // Passer les données à la vue
        return view('admin.backend.promo.promo_all_apply', compact('promos'));
    }
    

    

    public function applyPromoToCourses(Request $request)
    {
        // Valider que des cours ont été sélectionnés et un promo_id a été fourni
        $request->validate([
            'selected_courses' => 'required|array',
            'selected_courses.*' => 'exists:courses,id',  // Vérifier que les cours existent
            'promo_id' => 'required|exists:promos,id',  // Vérifier que le code promo existe
        ]);
    
        // Récupérer les cours sélectionnés et le code promo choisi
        $courseIds = $request->input('selected_courses');
        $promoId = $request->input('promo_id');
    
        // Vérifier si le code promo existe et est actif
        $promo = Promo::find($promoId);
    
        if (!$promo) {
            return redirect()->back()->with('error', 'Code promo invalide.');
        }
    
        // Vérifier si la promotion est active (ajouter cette condition selon ton modèle)
        if ($promo->status != 'active') {
            return redirect()->back()->with('error', 'Le code promo n\'est pas actif.');
        }
    
        // Mettre à jour la table des cours avec le nouveau code promo
        $coursesUpdated = Course::whereIn('id', $courseIds)
            ->update(['promo_id' => $promoId]);
    
        // Vérifier si des cours ont été mis à jour
        if ($coursesUpdated) {
            // Message de succès
            $notification = [
                'message' => 'Code promo appliqué aux cours sélectionnés avec succès.',
                'alert-type' => 'success',
            ];
        } else {
            // Message si aucun cours n'a été mis à jour
            $notification = [
                'message' => 'Aucun cours sélectionné ou l\'application du code promo a échoué.',
                'alert-type' => 'error',
            ];
        }
    
        // Récupérer tous les cours pour la vue
        $courses = Course::all();
        // Récupérer tous les codes promo
        $promos = Promo::all();
    
        // Passer les variables à la vue
        return redirect()->back()->with($notification);
    }////
    
    
    
//////////////////////////////////////////Front.End promo//////////////////////////////////

public function PromoApply(Request $request)
{
    // Récupérer le code promo saisi
    $promoCode = $request->promo_name;
    $courseId = $request->course_id;

    // Vérifier si un code promo correspond au code saisi et si le code n'est pas expiré
    $promo = Promo::where('code', $promoCode)
                  ->first();
    $course = Course::where('id', $courseId)
                  ->first();

    // Vérification si le code promo existe
    if ($promo) {
        $cId = $course->promo_id;
        $pId = $promo->id;
        if ($cId == $pId) {
            return response()->json([
                            'validity' => true,
                            'message' => 'Le code est valide pour le cour' 
                        ]);
                    } else {
                        return response()->json([
                            'validity' => false,
                            'message' => 'Le code non valide pour le cour'
                        ]);
                    }
                
        // Vérifier si le code promo est expiré
        if (Carbon::now()->format('Y-m-d') > $promo->expiration_date) {
            return response()->json([
                'validity' => false,
                'message' => 'Le code promo est expiré.'
            ]);
        }

        // Si le code est valide et pas expiré
        return response()->json([
            'validity' => true,
            'message' => 'Le code promo existe et est valide.'
        ]);
    } else {
        return response()->json([
            'validity' => false,
            'message' => 'Le code promo n\'existe pas.'
        ]);
    }
    
}//////////


///////////////////////

public function PromoCalculation() {
    $subtotal = Cart::total(); // Sous-total avant la réduction

    if (Session::has('promo')) {
        $discountPercentage = session()->get('promo')['discount'];
        $discountAmount = ($subtotal * $discountPercentage) / 100;
        $totalAmount = $subtotal - $discountAmount;

        // Stocker toutes les informations dans la session
        session()->put('promo', [
            'code' => session()->get('promo')['code'],
            'discount' => $discountPercentage,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'subtotal' => $subtotal,
            'promo_code' => session()->get('promo')['code'],
            'promo_discount' => $discountPercentage,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
        ]);
    } else {
        return response()->json([
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ]);
    }
}












    


}