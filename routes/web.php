<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('pages.dashboard.index');
// });
// Route::prefix("")->group(function (){
//     Route::resource("",)
// })


// Route::get('/test', function () {
//      $data= Customer::get();
//      foreach ($data as $key => $value) {
//        echo  $value->customer_name;
//         foreach ($value->address as $key => $value) {
//           echo   $value->address;
//         } ;

//      }
// });
// Route::prefix("/people")->group(function(){
//     Route::resource('customers', CustomerController::class);

// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {

   Route::get('/', function () {
    return view('pages.dashboard.index');
    })->name('dashboard');
    Route::get('/inventory/low-stock', [ProductController::class, 'lowStockReport'])
    ->name('inventory.low-stock');

    Route::prefix('/people')->group(function () {
        Route::resource('customers',CustomerController::class);
    });
    Route::prefix('/inventory')->group(function () {
        Route::resource('products', ProductController::class);
    });

});
