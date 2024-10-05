<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\admin\ProductAdminController;
use App\Http\Controllers\Admin\AdminstrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\UserAdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\MyAccountController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/system', function () {
    return view('system');
})->name('system');

Route::get('/policy', function () {
    return view('policy');
})->name('policy');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');






Route::get('login', function () {
    return view('login');
})->name('login');
Route::post('login', [UserController::class, 'login'])->name('loginForm');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('forgetPassword', function () {
    return view('forgetPassword');
})->name('forgetPassword');
Route::post('forgetPassword', [UserController::class, 'forgetPassword'])->name('forgetPasswordForm');


Route::get('confirmation', function () {
    return view('confirmationCodePassword');
})->name('confirmationCodePassword');
Route::post('confirmation', [UserController::class, 'confirmationPassword'])->name('confirmationPasswordForm');

Route::get('resetPassword', function () {
    return view('reenterPassword');
})->name('resetPassword');
Route::post('resetPassword', [UserController::class, 'resetPassword'])->name('resetPassword');


Route::get('register', function () {
    return view('register');
})->name('register');
Route::post('register', [UserController::class, 'register'])->name('registerForm');

Route::get('cart', [CartController::class, 'getCart'])->name('cart');
Route::post('cartForm', [CartController::class, 'cartAdd'])->name('cartForm');
Route::get('increaseQuantity/{id}', [CartController::class, 'increaseQuantity'])->name('increaseQuantity');
Route::get('decreaseQuantity/{id}', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity');
Route::get('deleteItemCart/{id}', [CartController::class, 'deleteItemCart'])->name('deleteItemCart');
Route::get('deleteAllCart', [CartController::class, 'deleteAllCart'])->name('deleteAllCart');

Route::post('couponForm', [CouponController::class, 'couponApply'])->name('couponForm');
Route::get('couponDelete', [CouponController::class, 'couponDelete'])->name('couponDelete');

Route::get('member', [MyAccountController::class, 'member'])->name('member');
Route::get('purchase', [MyAccountController::class, 'purchase'])->name('purchase');
Route::get('informationPurchase/{id}', [MyAccountController::class, 'inforPurchase'])->name('inforPurchase');
Route::get('waitConfirmation', [MyAccountController::class, 'waitConfirmation'])->name('waitConfirmation');
Route::get('pendingPurchase', [MyAccountController::class, 'pendingPurchase'])->name('pendingPurchase');
Route::get('shipping', [MyAccountController::class, 'shipping'])->name('shipping');
Route::get('cancel', [MyAccountController::class, 'cancel'])->name('cancel');
Route::get('cancelConfirmation/{id}', [MyAccountController::class, 'cancelConfirmation'])->name('cancelConfirmation');


/* ----------------------------------- ROUTE ADMIN ------------------------------------ */
Route::get('admin/login', function () {
    return view('admin.login');
})->name('adminLogin');
Route::post('admin/login', [LoginController::class, 'login'])->name('adminLoginForm');

Route::prefix('admin')->middleware('admin')->group(function () { // prefix: được sử dụng để nhóm các route lại với nhau dưới một tiền tố chung.

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    Route::middleware(['admin:product'])->group(function () {
        Route::get('product', [ProductAdminController::class, 'product'])->name('product');
        Route::get('addProduct', [ProductAdminController::class, 'productAdd'])->name('addProduct');
        Route::post('add-Product', [ProductAdminController::class, 'productAdd'])->name('addFormProduct');
        Route::get('editProduct/{id}', [ProductAdminController::class, 'productEdit'])->name('editProduct');
        Route::put('editProduct/{id}', [ProductAdminController::class, 'productUpdate']);
        Route::post('deleteProduct', [ProductAdminController::class, 'productDeleteCheckbox'])->name('deleteProduct');
        Route::put('updateStatusProduct/{id}', [ProductAdminController::class, 'productUpdateStatus'])->name('productUpdateStatus');
        Route::post('searchProduct', [ProductAdminController::class, 'productSearch'])->name('searchProduct');
        Route::get('productDeleteImages/{product_id}', [ProductAdminController::class, 'productDeleteImages'])->name('productDeleteImages');
        Route::get('productDeleteDiscount/{id}', [ProductAdminController::class, 'productDeleteDiscount'])->name('productDeleteDiscount');
    });

    Route::middleware(['admin:administration'])->group(function () {
        Route::get('adminstration', [AdminstrationController::class, 'adminstration'])->name('adminstration');
        Route::get('addAdminstration', [AdminstrationController::class, 'adminstrationAdd'])->name('addAdminstration');
        Route::post('add-Adminstration', [AdminstrationController::class, 'adminstrationAdd'])->name('addFormAdminstration');
        Route::get('editAdminstration/{id}', [AdminstrationController::class, 'adminstrationEdit'])->name('editAdminstration');
        Route::put('editAdminstration/{id}', [AdminstrationController::class, 'adminstrationUpdate']);
        Route::post('deleteAdminstration', [AdminstrationController::class, 'adminstrationDeleteCheckbox'])->name('deleteAdminstration');
        Route::put('updateStatusAdminstration/{id}', [AdminstrationController::class, 'adminstrationUpdateStatus'])->name('adminstrationUpdateStatus');
        Route::get('searchAdminstration', [AdminstrationController::class, 'administrationSearch'])->name('searchAdminstration');
    });

    Route::middleware(['admin:administrationGroup'])->group(function () {
        Route::get('adminstrationGroup', [AdminstrationController::class, 'adminstrationGroup'])->name('adminstrationGroup');
        Route::get('addAdminstrationGroup', [AdminstrationController::class, 'adminstrationGroupAdd'])->name('addAdminstrationGroup');
        Route::post('add-AdminstrationGroup', [AdminstrationController::class, 'adminstrationGroupAdd'])->name('addFormAdminstrationGroup');
        Route::get('editAdminstrationGroup/{id}', [AdminstrationController::class, 'adminstrationGroupEdit'])->name('editAdminstrationGroup');
        Route::put('editAdminstrationGroup/{id}', [AdminstrationController::class, 'adminstrationGroupUpdate']);
        Route::post('deleteAdminstrationGroup', [AdminstrationController::class, 'adminstrationGroupDeleteCheckbox'])->name('deleteAdminstrationGroup');
    });

    Route::middleware(['admin:user'])->group(function () {
        Route::get('userAdmin', [UserAdminController::class, 'userAdmin'])->name('userAdmin');
    });

    Route::middleware(['admin:userGroup'])->group(function () {
        Route::get('userGroup', [UserAdminController::class, 'userGroup'])->name('userGroup');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('adminLogout');
});
