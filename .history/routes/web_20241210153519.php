<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishLisController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PromoController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
   // return view('welcome');
//});
Route::get('/', [UserController::class, 'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth','roles:user','verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
/////User whishlist all route
Route::controller(WishLisController::class)->group(function(){
    Route::get('/user/wishlist','AllWishlist')->name('user.wishlist');

    Route::get('/get-wishlist-course/','GetWishlistCourse');
    
    Route::get('/wishlist-remove/{id}','RemoveWishlist');
    
});
// User My Course All Route 
Route::controller(OrderController::class)->group(function(){
    Route::get('/my/course','MyCourse')->name('my.course'); 
    Route::get('/user/course/{id}/sessions', [OrderController::class, 'showSessions'])->name('user.course.sessions');
    Route::get('/course/view/{course_id}','CourseView')->name('course.view');
   Route::get('/course/{id}', 'CourseController@show')
    ->middleware('prevent-recording');
    Route::get('/calendar','event')->name('calendar.event');

});
    // User Question All Route 
    Route::controller(QuestionController::class)->group(function(){
        Route::post('/user/question','UserQuestion')->name('user.question');  

    });

});

////

require __DIR__.'/auth.php';

//Admin middleware Group 
Route::middleware(['auth','roles:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    // Category All Route 
Route::controller(CategoryController::class)->group(function(){
    Route::get('/all/category','AllCategory')->name('all.category');

    Route::get('/add/category','AddCategory')->name('add.category');
    Route::post('/store/category','StoreCategory')->name('store.category');

    Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
    Route::post('/update/category','UpdateCategory')->name('update.category');

    Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');

    // SubCategory All Route 
    
Route::controller(CategoryController::class)->group(function(){
    Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
    Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
    Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
    Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
    Route::post('/update/subcategory','UpdateSubCategory')->name('update.subcategory');
    Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
});
// Admin Report All Route 
Route::controller(ReportController::class)->group(function(){
    Route::post('/search/by/date','SearchByDate')->name('search.by.date');
    Route::post('/search/by/month','SearchByMonth')->name('search.by.month');
    Route::post('/search/by/year','SearchByYear')->name('search.by.year');
    Route::get('/report/view','ReportView')->name('report.view'); 

});
// Admin Review All Route 
Route::controller(ReviewController::class)->group(function(){
    Route::get('/admin/pending/review','AdminPendingReview')->name('admin.pending.review');
    
    
    
});
    // Instructor All Route 
Route::controller(AdminController::class)->group(function(){
    Route::get('/all/instructor','AllInstructor')->name('all.instructor');
    Route::post('/update/user/stauts','UpdateUserStatus')->name('update.user.stauts');
    // Admin Coruses All Route 
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/all/course','AdminAllCourse')->name('admin.all.course');
    Route::post('/update/course/stauts','UpdateCourseStatus')->name('update.course.stauts');
    Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');
});
});
});
    

////////Admin all order route
Route::controller(OrderController::class)->group(function(){
    Route::get('/admin/pending/order','AdminPendingOrder')->name('admin.pending.order');
    Route::get('/admin/order/details/{id}','AdminOrderDetails')->name('admin.order.details');

    Route::get('/pending-confrim/{id}','PendingToConfirm')->name('pending-confrim');

    Route::get('/admin/confirm/order','AdminConfirmOrder')->name('admin.confirm.order');  
   
});

}); //End Admin middleware Group 

 // Admin LOGIN
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');
Route::post('/instructor/register', [AdminController::class, 'InstructorRegister'])->name('instructor.register');


///// Instructor Group Middleware
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
    
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');
    
    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');
    
    // Instructor All Route  COURSE 
    Route::controller(CourseController::class)->group(function(){
    Route::get('/all/course','AllCourse')->name('all.course'); 
    Route::get('/add/course','AddCourse')->name('add.course');  
    Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
    Route::post('/store/course','StoreCourse')->name('store.course');
    Route::get('/edit/course/{id}','EditCourse')->name('edit.course');
    Route::post('/update/course','UpdateCourse')->name('update.course');
    Route::post('/update/course/image','UpdateCourseImage')->name('update.course.image');
    Route::post('/update/course/video','UpdateCourseVideo')->name('update.course.video');
    Route::post('/update/course/pdf','UpdateCoursePdf')->name('update.course.pdf');
    Route::post('/update/course/goal','UpdateCourseGoal')->name('update.course.goal');
    Route::get('/delete/course/{id}','DeleteCourse')->name('delete.course');
    Route::get('/cours/{id}/pdf', [CourseController::class, 'generatePDF'])->name('course.pdf');
    Route::get('/courses/{id}/view-pdf', [CourseController::class, 'viewPDF'])->name('course.view.pdf');  

    });
    Route::controller(CourseController::class)->group(function(){
        Route::match(['GET', 'POST'], '/add/course/lecture/{id}', 'AddCourseLecture')->name('add.course.lecture');
        Route::post('/add/course/section/','AddCourseSection')->name('add.course.section');
        Route::post('/save-lecture/', 'SaveLecture')->name('save-lecture');
        Route::get('/edit/lecture/{id}','EditLecture')->name('edit.lecture');
        Route::post('/update/course/lecture','UpdateCourseLecture')->name('update.course.lecture');
        Route::get('/delete/lecture/{id}','DeleteLecture')->name('delete.lecture');
        Route::post('/delete/section/{id}','DeleteSection')->name('delete.section');
        Route::post('/update/course/section', 'UpdateCourseSection')->name('update.course.section'); // Ajout de la route pour la mise à jour de la section
        Route::post('/update-video-url','updateVideoUrl')->name('update.video.url');
        Route::post('/instructor/cancel-section', 'cancelSection')->name('cancel.section');
        Route::post('/instructor/restore-section', 'restoreSection')->name('restore.section');
        Route::post('/postpone-section','postponeSection')->name('postpone.section');
        Route::post('/reschedule-section', 'rescheduleSection')->name('reschedule.section');
        
    });
    
    // Question All Order Route 
Route::controller(QuestionController::class)->group(function(){
    Route::get('/instructor/all/question','InstructorAllQuestion')->name('instructor.all.question'); 
    Route::get('/question/details/{id}','QuestionDetails')->name('question.details');
    Route::post('/instructor/replay','InstructorReplay')->name('instructor.replay'); 


});

    
      //// Route Accessable for All 
      Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/course/details/{id}/{slug}', [IndexController::class, 'CourseDetails']);
Route::get('/category/{id}/{slug}', [IndexController::class, 'CategoryCourse']);
Route::get('/instructor/details/{id}', [IndexController::class, 'InstructorDetails'])->name('instructor.details');
Route::get('/instructor/details/{id}', [IndexController::class, 'InstructorDetails'])->name('instructor.details');
Route::get('/pricing', [IndexController::class, 'showPricingTable'])->name('pricing.table');
// Course Section and Lecture All Route 


Route::post('/add-to-wishlist/{id}', [WishLisController::class, 'AddToWishList']);

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::get('/cart/data/', [CartController::class, 'CartData']);

///////get data frm minicart
Route::get('/course/mini/cart', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/course/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

//// cart all route
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart','MyCart')->name('mycart');
    Route::get('/get-cart-course','GetCartCourse');
    Route::get('/cart-remove/{rowId}','CartRemove');
});

    Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
    Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
    Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
    /// Checkout Page Route 
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::post('/payment', [CartController::class, 'Payment'])->name('payment');
// Admin Coupon All Route 
Route::controller(CouponController::class)->group(function(){
    Route::get('/admin/all/coupon','AdminAllCoupon')->name('admin.all.coupon');
    Route::get('/admin/add/coupon','AdminAddCoupon')->name('admin.add.coupon');
    Route::post('/admin/store/coupon','AdminStoreCoupon')->name('admin.store.coupon');
    Route::get('/admin/coupon/select-courses/{id}', [CouponController::class, 'selectCourses'])->name('admin.coupon.select.courses');
    Route::post('/admin/coupon/update-courses/{id}', [CouponController::class, 'updateCourses'])->name('admin.coupon.update.courses');

    Route::get('/admin/edit/coupon/{id}','AdminEditCoupon')->name('admin.edit.coupon');
    Route::post('/admin/update/coupon','AdminUpdateCoupon')->name('admin.update.coupon');
    Route::get('/admin/delete/coupon/{id}','AdminDeleteCoupon')->name('admin.delete.coupon'); 

    //////////// valider(test email)
    Route::post('/test-email', 'sendTestEmail')->name('test.email.send');


});

///////////////////////POUR CODE PROMO////////////////////////////////
Route::controller(PromoController::class)->group(function(){
Route::get('/admin/all/promo','AdminAllPromo')->name('admin.all.promo');
Route::get('/admin/add/promo','AdminAddPromo')->name('admin.add.promo');
Route::post('/admin/store/promo','AdminStorePromo')->name('admin.store.promo');
Route::get('/admin/edit/promo/{id}','AdminEditPromo')->name('admin.edit.promo');
Route::post('/admin/update/promo','AdminUpdatePromo')->name('admin.update.promo');
Route::get('/admin/delete/promo/{id}','AdminDeletePromo')->name('admin.delete.promo'); 
Route::post('/admin/send/promo','AdminSendPromo')->name('admin.send.promo'); 

Route::get('/admin/all/promo/apply','AdminAllPromoApply')->name('admin.all.promo.apply');


Route::get('/admin/categories', 'AdminAllCategories')->name('admin.all.categories');

Route::post('/admin/apply-promo-to-categories',  'applyPromoToCategories')->name('admin.apply.promo.to.categories');
Route::post('/admin/apply-promo-to-courses',  'applyPromoToCourses')->name('admin.apply.promo.to.courses');




});
////////////////////

////////////////////promo F.E//////////////////////////////////
Route::post('/promo-apply', [PromoController::class, 'PromoApply']);
Route::get('/promo-calculation', [PromoController::class, 'PromoCalculation']);



// Admin paiement virement All Route 
Route::controller(CouponController::class)->group(function(){
    Route::get('/admin/all/virement','AdminAllVirement')->name('admin.all.virement');
    Route::get('/download-receipt/{id}','DownloadRecu')->name('admin.download.receipt');
    Route::post('/validate-coupon/{id}',  'ValidateVirement')->name('admin.validate.virement');
    Route::post('/invalidate-coupon/{id}', 'invalidateVirement')->name('admin.invalidate.virement');
    
// reviws frontend 
    Route::post('/store/review', [ReviewController::class, 'StoreReview'])->name('store.review');

});
///// End Route Accessable for All 
