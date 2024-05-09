<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;

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
Route::controller(HomeController::class)->group(function (){
    Route::get('/', 'index' )->name('index');
    Route::get('/home', 'index' )->name('home');
    Route::get('/menus', 'menu')->name('pelanggan.menu');
    Route::get('/cart', 'cart')->name('pelanggan.cart');
    Route::post('/add-cart/{menu_id}', 'addCart')->name('pelanggan.addCart');
    Route::post('/cart/remove/{order_id}', 'removeItem')->name('cart.remove');
    Route::post('/cart/checkout', 'checkoutOrder')->name('pelanggan.checkout.cart');

});

Route::controller(AuthController::class)->group(function (){
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::get('/logout', 'logout')->name('logout')->middleware(['auth']);
    Route::post('/auth', 'validation')->name('login.auth')->middleware('guest');
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware(['auth']);
});

Route::prefix('/superadmin')->controller(SuperAdminController::class)->group(function (){
    Route::get('/menu', 'menu')->name('superadmin.menu')->middleware(['auth','role:super admin']);
    Route::post('/add-menu', 'addMenu')->name('superadmin.add.menu')->middleware(['auth','role:super admin']);
    // Route::put('/update-menu/{id_menu}', 'updateMenu')->name('superadmin.update.menu')->middleware(['auth','role:super admin']);
    Route::delete('/menu/{id_menu}', 'destroyMenu')->name('superadmin.delete.menu')->middleware(['auth','role:super admin']);
    Route::get('/laporan', 'laporan')->name('superadmin.laporan')->middleware(['auth','role:super admin']);
    Route::post('/cetak-laporan', 'printLaporan')->name('superadmin.print.laporan')->middleware(['auth','role:super admin']);
    Route::get('/show-laporan', 'showPDF')->name('superadmin.show.report')->middleware(['auth','role:super admin']);
    Route::get('/karyawan', 'karyawan')->name('superadmin.karyawan')->middleware(['auth','role:super admin']);
    Route::post('/add-account', 'addAccount')->name('superadmin.add.account')->middleware(['auth','role:super admin']);
    Route::put('/update-account/{user_id}', 'updateAccount')->name('superadmin.update.account')->middleware(['auth','role:super admin']);
    Route::delete('/delete-account/{id_account}', 'destroyAccount')->name('superadmin.delete.account')->middleware(['auth','role:super admin']);
});

Route::prefix('/admin')->controller(AdminController::class)->group(function (){
    Route::get('/pesanan', 'pesanan')->name('admin.pesanan')->middleware(['auth','role:admin']);
    Route::get('/menu', 'menu')->name('admin.menu')->middleware(['auth','role:admin']);
    Route::put('/update-menu/{id_menu}', 'updateMenu')->name('admin.update.menu')->middleware(['auth']);
    Route::post('/add-pesanan', 'addPesanan')->name('admin.add.pesanan')->middleware(['auth','role:admin']);
    Route::put('/update-status-order/{pesanan_id}', 'updateStatusPesanan')->name('admin.update.status.order')->middleware(['auth','role:admin']);

});






















// Route::get('/', [HomeController::class, 'index'])->name('guest.menu')->middleware(['auth','role:super admin']);
// Route::get('/', [Controller::class, 'index'] )->name('Home');
// Route::get('/layout', [AdminController::class, 'layout'])->name('layout.dashboard');
// Route::get('/order', [AdminController::class, 'order'])->name('order.dashboard');


// Login
Route::post('/login', [UserController::class, 'authenticate'])->name('login.admin.auth');

// // Logout
// Route::get('logout', [UserController::class, 'logout'])->name('admin.logout');

// // Route::middleware('')->group(function () {
//     // Route::get('/home', [AdminController::class, 'home'])->name('home.dashboard');
//     Route::get('/menu', [AdminController::class, 'menu'])->name('menu.dashboard');
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// });