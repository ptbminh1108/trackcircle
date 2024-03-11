<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Manufacturer\ManufacturerController;
use App\Http\Controllers\User\UserGroupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// // })->name('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','checkPermission'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // USER ROUTE
    // list user
    Route::get('/user', [UserController::class, 'index'])->name('user.list');       
    // edit user 
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    // edit user submit
    Route::post('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    // create user
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    // create user submit
    Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
    // delte user
    Route::post('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // USERGROUP
    // list user-group
    Route::get('/user-group', [UserGroupController::class, 'index'])->name('user-group.list');       
    // edit user-group 
    Route::get('/user-group/edit/{id}', [UserGroupController::class, 'edit'])->name('user-group.edit');
    // edit user-group submit
    Route::post('/user-group/edit/{id}', [UserGroupController::class, 'update'])->name('user-group.update');
    // create user-group
    Route::get('/user-group/create', [UserGroupController::class, 'create'])->name('user-group.create');
    // create user-group submit
    Route::post('/user-group/create', [UserGroupController::class, 'create'])->name('user-group.create');
    // delte user-group
    Route::post('/user-group/delete/{id}', [UserGroupController::class, 'destroy'])->name('user-group.destroy');

    // ITEM
    // list item
    Route::get('/item', [ItemController::class, 'index'])->name('item.list');       
    // edit item
    Route::get('/item/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
    // edit item submit
    Route::post('/item/edit/{id}', [ItemController::class, 'update'])->name('item.update');
    // create item
    Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
    // create item submit
    Route::post('/item/create', [ItemController::class, 'create'])->name('item.create');
    // delte uitem
    Route::post('/item/delete/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
      // list item
      Route::get('/item/all', [ItemController::class, 'all'])->name('item.list');    
      
    // MANUFACTURER
    // list manufacturer
    Route::get('/manufacturer', [ManufacturerController::class, 'index'])->name('manufacturer.list');       
    // edit manufacturer
    Route::get('/manufacturer/edit/{id}', [ManufacturerController::class, 'edit'])->name('manufacturer.edit');
    // edit manufacturer submit
    Route::post('/manufacturer/edit/{id}', [ManufacturerController::class, 'update'])->name('manufacturer.update');
    // create manufacturer
    Route::get('/manufacturer/create', [ManufacturerController::class, 'create'])->name('manufacturer.create');
    // create manufacturer submit
    Route::post('/manufacturer/create', [ManufacturerController::class, 'create'])->name('manufacturer.create');
    // delte umanufacturer
    Route::post('/manufacturer/delete/{id}', [ManufacturerController::class, 'destroy'])->name('manufacturer.destroy');
      // list manufacturer
    Route::get('/manufacturer/all', [ManufacturerController::class, 'all'])->name('manufacturer.list');    

    Route::get('/', [HomeController::class, 'index'])->name('profile.edit');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

require __DIR__.'/auth.php';


Auth::routes();
