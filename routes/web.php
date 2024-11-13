<?php

use App\Http\Controllers\front\FrontHomeController;
use App\Http\Controllers\front\FrontUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryController;
use Laravel\Socialite\Facades\Socialite;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::group(['middleware' => ['guest']], function () {
    Route::view('admin', 'admin/auth/login')->name('login');
    Route::post('admin/user_login', [AdminController::class, 'admin_login_func'])->name('admin.login');
});
Route::group(['middleware' => ['auth:web']], function () {

    Route::view('admin/dashboard', 'admin/dashboard')->name('admin.dashboard');
    Route::get('admin/profile', [AdminController::class, 'get_admin_info_func'])->name('admin.getinfo');
    Route::get('admin/logout', [AdminController::class, 'admin_logout_func'])->name('admin.logout');
    Route::post('admin/update_admin_info', [Admincontroller::class, 'update_admin_generalinfo'])->name('update_admin_info');
    Route::post('admin/update_password', [Admincontroller::class, 'update_admin_password_func'])->name('update_admin_password');
    Route::post('admin/upload-images', [AdminController::class, 'storeImage'])->name('admin.uploadimage');

    Route::get('admin/all-user', [UsersController::class, 'get_users_list'])->name('all_user');
    Route::post('admin/insert-users', [UsersController::class, 'insert_users'])->name('admin.insertuser');
    Route::get('admin/delete-users/{id}', [UsersController::class, 'delete_users'])->name('admin.deleteuser');
    Route::post('admin/edit-users', [UsersController::class, 'edit_users'])->name('admin.editusers');
    Route::post('admin/check-email-existance', [UsersController::class, 'check_email_existance'])->name('admin.checkemailexistance');

    // Route::get('admin/all-subadmin', [SubadminController::class,'get_subadmin_list'])->name('admin.all_subadmin');
    // Route::post('admin/insert-subadmin',[SubadminController::class, 'insert_subadmin'])->name('admin.insertsubadmin');
    // Route::post('admin/check-subadminuser-existance',[SubadminController::class,'check_subadmin_user_existance'])->name('admin.checksubadminuser');
    // Route::post('admin/edit-subadmin', [SubadminController::class, 'edit_subadmin'])->name('admin.edtsubadmin');
    // Route::get('admin/delete-subadmin/{id}',[SubadminController::class, 'delete_subadmin'])->name('admin.deletesubadmin');


    // Route::get('admin/all-blogs', [BlogController::class, 'all_blogs_list'])->name('all_blog');
    // Route::post('admin/insert-blog', [BlogController::class, 'insert_blog'])->name('insertblog');
    // Route::post('admin/edit-blog', [BlogController::class, 'edit_blog'])->name('editblog');
    // Route::delete('admin/delete-blog/{id}', [BlogController::class, 'delete_blog'])->name('deleteblog');

    Route::get('admin/all-category', [CategoryController::class, 'get_all_categories_list'])->name('allcategorieslist');
    Route::post('admin/insert-cat', [CategoryController::class, 'insert_cat']);
    Route::post('admin/edit-cat', [CategoryController::class, 'edit_cat']);
    Route::get('admin/category-delete/{id}', [CategoryController::class, 'categoryDelete'])->name('admin.category.delete');
    Route::post('admin/check-unique-category', [CategoryController::class, 'check_unique_category'])->name('admin.checkuniquecategory');
});
// Route::get('admin/sendpushnotification', [AdminController::class,'sendPushNotification'] )->name('admin.sendPushNotification');


/**
 * ROUTE FOR GUEST USER
 */

Route::group(['middleware' => ['guest']], function () {
    Route::get('front/register', [FrontHomeController::class, 'showFrontRegistrationForm'])->name('front.user.register');
    Route::post('front/register', [FrontUserController::class, 'storeFrontUser'])->name('front.user.store');
    Route::post('/front.sign.up.email.verify', [FrontUserController::class, 'signUpEmailverify'])->name('front.sign.up.email.verify');
    Route::get('/sing-in', [FrontHomeController::class, 'showFrontSignInForm'])->name('front.login.form');
    Route::post('/login-in', [FrontUserController::class, 'userLogin'])->name('front.login');
    Route::post('front/password/email', [FrontUserController::class, 'passwordEmail'])->name('front.password.email');
    Route::post('front/password/verifyOtp', [FrontUserController::class, 'verifyOtp'])->name('front.password.verifyOtp');
    Route::patch('front/password/update', [FrontUserController::class, 'userPasswordUpdate'])->name('front.password.update');
});
Route::get('/auth/{provider}/redirect', function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name('socialite.login');


Route::get('login/{provider}/callback',[FrontUserController::class,'socialiteCallback']);


/**
 * ROUTE FOR AUTH USER
 */
Route::group(['middleware' => ['auth:user']], function () {
    Route::get('/', [FrontHomeController::class, 'home'])->name('front.home');
    Route::get('front/user/edit/{id}', [FrontUserController::class, 'editFrontUser'])->name('front.user.edit');
    Route::put('front/user/update/{id}', [FrontUserController::class, 'updateFrontUser'])->name('front.user.update');
    Route::delete('front/user/delete/{id}', [FrontUserController::class, 'destroyFrontUser'])->name('front.user.delete');
    Route::get('/user-logout', [FrontUserController::class, 'userLogout'])->name('front.user.logout');

    /**
     * ROUTE FOR ADDRESS
     */
    Route::get('front/addresses', [FrontUserController::class, 'showAddressList'])->name('front.address.list');
    Route::get('front/addresses/create', [FrontUserController::class, 'showCreateAddressForm'])->name('front.address.create');
    Route::post('front/addresses', [FrontUserController::class, 'storeAddress'])->name('front.address.store');
    Route::get('front/addresses/edit/{id}', [FrontUserController::class, 'editAddress'])->name('front.address.edit');
    Route::put('front/addresses/{id}', [FrontUserController::class, 'updateAddress'])->name('front.address.update');
    Route::delete('front/addresses/{id}', [FrontUserController::class, 'destroyAddress'])->name('front.address.delete');

});