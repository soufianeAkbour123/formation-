<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_goal;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
 use Gloudemans\Shoppingcart\Facades\Cart;
 use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use App\Models\Order;
use App\Models\User;
use App\Notifiations\OrderComplete;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{
    //
    public function AddToCart(Request $request,$id ){

        $course= Course::find($id);

        if (Session::has('promo')) {
            Session::forget('promo');
        }

        /// chercher le cours si il est dans panier
        $cartItem = Cart::search(function($cartItem, $rowId) use($id){
            return $cartItem->id == $id;
        });

        if($cartItem->isNotEmpty()){
            return response()->json(['error'=>'Le cours est déjà dans votre panier']);
        }
        if($course->discount_price==NULL){

            Cart::add([
                'id' => $id,
                 'name' => $request->course_name, 
                 'qty' => 1, 
                 'price' => $course->selling_price, 
                 'weight' => 1, 
                 'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                 ],
                ]);

        }else{
            Cart::add([
                'id' => $id,
                 'name' => $request->course_name, 
                 'qty' => 1, 
                 'price' => $course->discount_price, 
                 'weight' => 1, 
                 'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                 ],
                ]);
        }
        return response()->json(['success'=>'Ajouté avec succès à votre panier']);
    }///end

    public function CartData(){

        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' =>$carts,
            'cartTotal' =>$cartTotal,
            'cartQty' =>$cartQty,

        ));
    }///end

    public function AddMiniCart(){

        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' =>$carts,
            'cartTotal' =>$cartTotal,
            'cartQty' =>$cartQty,

        ));
    }///end

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success'=>'Cours supprimé du panier ']);

    }////

    public function MyCart(){

        return view ('frontend.mycart.view_mycart');

    }////end

    public function GetCartCourse(){
        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' =>$carts,
            'cartTotal' =>$cartTotal,
            'cartQty' =>$cartQty,

        ));
    }///end

    public function CartRemove($rowId){
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
 
            Session::put('coupon',[
             'coupon_name' => $coupon->coupon_name,
             'coupon_discount' => $coupon->coupon_discount,
             'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
             'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
         ]);
 
         }

        return response()->json(['success'=>'Cours supprimé du panier ']);

    }////

    public function CouponApply(Request $request)
    {
        try {
            if (!$request->coupon_name) {
                return response()->json([
                    'error' => 'Veuillez entrer un code promo'
                ], 400);
            }

            $coupon = Coupon::where('coupon_name', $request->coupon_name)
                           ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                           ->first();

            if (!$coupon) {
                return response()->json([
                    'error' => 'Coupon invalide ou expiré'
                ], 404);
            }

            // Vérifier si le panier n'est pas vide
            if (Cart::total() <= 0) {
                return response()->json([
                    'error' => 'Votre panier est vide'
                ], 400);
            }

            $total = floatval(str_replace(',', '', Cart::total()));
            $discount_amount = round(($total * $coupon->coupon_discount) / 100);
            $total_amount = round($total - $discount_amount);

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discount_amount,
                'total_amount' => $total_amount
            ]);

            return response()->json([
                'validity' => true,
                'success' => 'Coupon appliqué avec succès'
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Coupon Apply Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Une erreur est survenue lors de l\'application du coupon'
            ], 500);
        }
    }

    public function CouponCalculation()
    {
        try {
            if (Session::has('coupon')) {
                $total = floatval(str_replace(',', '', Cart::total()));
                return response()->json([
                    'subtotal' => number_format($total, 2),
                    'coupon_name' => session()->get('coupon')['coupon_name'],
                    'discount_amount' => number_format(session()->get('coupon')['discount_amount'], 2),
                    'total_amount' => number_format(session()->get('coupon')['total_amount'], 2)
                ], 200);
            }

            return response()->json([
                'total' => Cart::total()
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Coupon Calculation Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Erreur lors du calcul'
            ], 500);
        }
    }

    public function CouponRemove()
    {
        try {
            Session::forget('coupon');
            return response()->json([
                'success' => 'Coupon supprimé avec succès'
            ], 200);
            
        } catch (\Exception $e) {
            \Log::error('Coupon Remove Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Erreur lors de la suppression du coupon'
            ], 500);
        }
    } 


    public function CheckoutCreate(){

        if (Auth::check()) {

            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartTotal = Cart::total();
                $cartQty = Cart::count();

                return view('frontend.checkout.checkout_view',compact('carts','cartTotal','cartQty'));
            } else{

                $notification = array(
                    'message' => 'Add At list One Course',
                    'alert-type' => 'error'
                );
                return redirect()->to('/')->with($notification); 

            }

        }else{

            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification); 

        }

    }// End Method 

    /////////////////payement/////////////////////

    public function Payment(Request $request)
   
{
    $user = User::where('role','instructor')->get();
    // Validation des fichiers (optionnel)
    $request->validate([
        'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Taille max en Ko
    ]);

    // Calculer le montant total
    $total_amount = 0;
    if (Session::has('promo')) {
        $total_amount = Session::get('promo')['total_amount'];
    } else {
        $total_amount = round(floatval(str_replace(',', '', Cart::total())));
    }

    // Vérification avant d'ajouter une commande dans la base de données
    foreach ($request->course_title as $key => $course_title) {
        // Vérifier si l'utilisateur est déjà inscrit à ce cours
        $existingOrder = Order::where('user_id', Auth::user()->id)
            ->where('course_id', $request->course_id[$key])
            ->first();

        if ($existingOrder) {
            // Si l'utilisateur est déjà inscrit, retourner un message d'erreur et arrêter le processus
            $notification = array(
                'message' => 'Vous êtes déjà inscrit à ce cours',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification); // Redirige sans ajouter à la base de données
        }
    }

    // Créer un nouvel enregistrement de paiement (uniquement si l'utilisateur n'est pas déjà inscrit)
    $data = new Payment();
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->address = $request->address;
    $data->cash_delivery = $request->cash_delivery;
    $data->total_amount = $total_amount;
    $data->payment_type = 'Direct Payment';

    // Gérer le champ course_id
    if (isset($request->course_id) && is_array($request->course_id)) {
        // Assigner le premier course_id si c'est un tableau
        $data->course_id = $request->course_id[0]; // Ou ajustez selon votre logique
    } else {
        $data->course_id = null; // Ou gérez comme vous le souhaitez
    }

    // Gérer le fichier reçu
    if ($request->hasFile('receipt')) {
        $file = $request->file('receipt');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        
        // Stocker le fichier dans le chemin spécifié
        $file->move('C:\xampp\htdocs\formation\lms\public\upload\recu_virement', $filename);
        
        // Enregistrer le chemin relatif dans la base de données
        $data->receipt = 'upload/recu_virement/' . $filename;
    } else {
        $data->receipt = null; // Aucun fichier reçu téléchargé
    }

    // Remplir les autres champs
    $data->invoice_no = 'EOS' . mt_rand(10000000, 99999999);
    $data->order_date = Carbon::now()->format('d F Y');
    $data->order_month = Carbon::now()->format('F');
    $data->order_year = Carbon::now()->format('Y');
    $data->status = 'pending';
    $data->created_at = Carbon::now();
    $data->save();

    // Ensuite, enregistrer chaque cours associé
    foreach ($request->course_title as $key => $course_title) {
        $order = new Order();
        $order->payment_id = $data->id;
        $order->user_id = Auth::user()->id;
        $order->course_id = $request->course_id[$key];
        $order->instructor_id = $request->instructor_id[$key];
        $order->course_title = $course_title;
        $order->price = $request->price[$key];
        $order->save();
    }

    // Nettoyer le panier après paiement
    $request->session()->forget('cart');

    // Notification de succès
    $notification = array(
        'message' => 'Veuillez attendre la vérification de la part de l\'administrateur.',
        'alert-type' => 'success'
    );

    return redirect()->route('index')->with($notification);
}
    

    

/////////// Paiement par carte :::



}