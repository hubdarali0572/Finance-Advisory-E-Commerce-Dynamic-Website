<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DraftBlogController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubscriptionController;

// frontend routes

Route::get('/login', function () {
    return redirect()->route('login');
});


Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/Privacy', [FrontendController::class, 'Privacy'])->name('Privacy');
Route::get('/Terms', [FrontendController::class, 'Terms'])->name('Terms');
Route::get('/detailPage/{id}', [FrontendController::class, 'detailPage'])->name('frontend.show');
Route::get('/frontend-blogs', [FrontendController::class, 'blogs'])->name('frontend.blogs');
Route::post('/contact-submit', [FrontendController::class, 'send'])->name('contact.send');
Route::post('/apply', [FrontendController::class, 'sendRegistration'])->name('student.register');



// Admin Dashboard Routes

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Route
    Route::resource('dashboard', DashboardController::class);

    //  User Route
    Route::resource('users', UserController::class);

    //  Category Route

    Route::resource('category', CategoryController::class);

    Route::resource('subcategory', SubCategoryController::class);
    //  SubCategory Route


    //  Blogs Route
    Route::resource('blogs', BlogController::class);
    Route::post('/blogs/{id}/approve', [BlogController::class, 'approve'])->name('blogs.approve');
    Route::post('/blogs/{id}/reject', [BlogController::class, 'reject'])->name('blogs.reject');
    Route::get('/get-subcategories/{category_id}', [BlogController::class, 'getSubcategories']);

    //  Draft Blogs Route
    Route::resource('draft', DraftBlogController::class);

    //  Subscription Route
    Route::resource('subscriptions', SubscriptionController::class);


    //  Subscription Route
    Route::resource('usersubscriptions', UserSubscriptionController::class);
    Route::post('/subscribe', [UserSubscriptionController::class, 'subscribe'])->name('subscribe');

    Route::get('/user/subscriptions', [UserSubscriptionController::class, 'table'])->name('user.subscription.table');

    Route::post('/subscriptions/{id}/renew', [UserSubscriptionController::class, 'renew'])->name('subscriptions.renew');

    // Show all available subscription plans to upgrade
    Route::get('/upgrade', [UserSubscriptionController::class, 'upgrade'])->name('subscriptions.upgrade');

    //  Role Route
    Route::resource('roles', RoleController::class);
    Route::get('/assign-role', [RoleController::class, 'showAssignRole'])->name('show.assign.role.form');
    Route::post('/assign-role', [RoleController::class, 'assignRole'])->name('assign.role');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
