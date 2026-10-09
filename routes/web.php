<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;


 //BERANDA


Route::get('/', function () {

    $services = \App\Models\Service::where('status', 1)
        ->latest()
        ->take(6)
        ->get();

    return view('home', compact('services'));

})->name('home');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');


 //REVIEW

Route::post(
    '/review/store',
    [ReviewController::class, 'store']
)->name('review.store');

Route::get(
    '/ulasan',
    [ReviewController::class, 'review']
)->name('ulasan');
Route::post(
    '/contact/store',
    [ContactController::class, 'store']
)->name('contact.store');


//LAYANAN 

Route::get(
    '/layanan',
    [ServiceController::class, 'userServices']
)->name('layanan.index');

Route::get(
    '/layanan/teknisi-air',
    [TechnicianController::class, 'teknisiAir']
)->name('layanan.teknisi-air');

Route::get(
    '/layanan/teknisi-bangunan',
    [TechnicianController::class, 'teknisiBangunan']
)->name('layanan.teknisi-bangunan');

Route::get(
    '/layanan/teknisi-elektronik',
    [TechnicianController::class, 'teknisiElektronik']
)->name('layanan.teknisi-elektronik');

Route::get(
    '/layanan/teknisi-kunci',
    [TechnicianController::class, 'teknisiKunci']
)->name('layanan.teknisi-kunci');

Route::get(
    '/layanan/teknisi-listrik',
    [TechnicianController::class, 'teknisiListrik']
)->name('layanan.teknisi-listrik');

Route::get('/layanan/{id}', [ServiceController::class, 'show'])
       ->whereNumber('id')
       ->name('layanan.show');

 //ACTIVITY

Route::middleware('auth')->group(function () {

    Route::get(
        '/activity/index',
        function () {
            return view('activity.index');
        }
    )->name('activity.index');

    Route::get(
        '/activity/riwayat',
        [OrderController::class, 'riwayat']
    )->name('activity.riwayat');

    Route::get(
        '/activity/dalam-proses',
        [OrderController::class, 'dalamProses']
    )->name('activity.dalam-proses');

});


 //PEMESANAN

Route::middleware('auth')->group(function () {

    Route::get(
        '/pemesanan/{id}',
        [OrderController::class, 'create']
    )->name('pemesanan');

    Route::post(
        '/orders/store',
        [OrderController::class, 'store']
    )->name('orders.store');

});

 //PROFILE
Route::middleware('auth')->group(function () {
    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


 //ADMIN
    Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

   //DASHBOARD
    Route::get(
        '/',
        [AdminController::class, 'dashboard']
    )->name('dashboard');

    Route::get('/orders',[AdminController::class, 'orders']
    )->name('orders');
    
    Route::get('/contacts',[AdminController::class, 'contacts']
    )->name('contacts');

    Route::get('/reviews',[AdminController::class, 'reviews']
    )->name('reviews');


        //USER MANAGEMENT
        

        Route::get(
            '/users',
            [AdminController::class, 'usersIndex']
        )->name('users.index');
        Route::patch(
        '/users/{id}/disable',
        [AdminController::class, 'disableUser']
        )->name('users.disable');

        Route::patch(
        '/users/{id}/enable',
        [AdminController::class, 'enableUser']
         )->name('users.enable');



         //ORDER ACTION
       
        Route::patch(
            '/orders/{id}/process',
            [OrderController::class, 'process']
        )->name('orders.process');

        Route::patch(
            '/orders/{id}/complete',
            [OrderController::class, 'complete']
        )->name('orders.complete');

    });


 //SUPERADMIN


Route::middleware('auth')->prefix('superadmin')->name('superadmin.')->group(function () {


   //DASHBOARD
    Route::get(
        '/',
        [SuperAdminController::class, 'dashboard']
    )->name('dashboard');

    Route::get(
        '/transactions',
        [SuperAdminController::class, 'transactions']
    )->name('transactions');

    Route::get(
        '/reports',
        [SuperAdminController::class, 'reports']
    )->name('reports');


 

//ADMIN MANAGEMENT



    Route::get('/admin', [SuperAdminController::class, 'adminsIndex'])
    ->name('admins.index');

    Route::post('/admin/store', [SuperAdminController::class, 'storeAdmin'])
        ->name('admins.store');


    Route::get('/admin/{id}/edit', [SuperAdminController::class, 'editAdmin'])
        ->name('admins.edit');

    Route::put('/admin/{id}', [SuperAdminController::class, 'updateAdmin'])
        ->name('admins.update');

    Route::delete('/admin/{id}', [SuperAdminController::class, 'destroyAdmin'])
        ->name('admins.destroy');


    //TECHNICIANS
    Route::get(
        '/technicians',
        [TechnicianController::class, 'index']
    )->name('technicians');

    Route::post(
        '/technicians/store',
        [TechnicianController::class, 'store']
    )->name('technicians.store');

    Route::get(
        '/technicians/{id}/edit',
        [TechnicianController::class, 'edit']
    )->name('technicians.edit');

    Route::put(
        '/technicians/{id}',
        [TechnicianController::class, 'update']
    )->name('technicians.update');

    Route::delete(
        '/technicians/{id}',
        [TechnicianController::class, 'destroy']
    )->name('technicians.destroy');


   
   // SERVICES
    Route::get(
        '/services',
        [ServiceController::class, 'index']
    )->name('services');

    Route::post(
        '/services/store',
        [ServiceController::class, 'store']
    )->name('services.store');

    Route::get(
        '/services/{id}/edit',
        [ServiceController::class, 'edit']
    )->name('services.edit');

    Route::put(
        '/services/{id}',
        [ServiceController::class, 'update']
    )->name('services.update');

    Route::patch(
        '/services/{id}/toggle',
        [ServiceController::class, 'toggle']
    )->name('services.toggle');

    Route::delete(
        '/services/{id}',
        [ServiceController::class, 'destroy']
    )->name('services.destroy');

});


require __DIR__.'/auth.php';
