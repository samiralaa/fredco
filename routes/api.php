<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HeederController;
use App\Http\Controllers\PerantController;
use App\Http\Controllers\ServesController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\ContactinfoController;
use App\Http\Controllers\DesigningGateController;
use App\Http\Controllers\CaregryProductController;
use App\Http\Controllers\ValuableclientController;
use App\Http\Controllers\CaregryProductProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    // Routes that require sanctum authentication
    // Add more protected routes here
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('index', [UserController::class, 'index'])->name('index');
});

Route::delete('users/delete/{id}', [UserController::class, 'destroy']);
Route::post('users/update/{id}', [UserController::class, 'update']);
Route::get('user/show/{id}', [UserController::class, 'show'])->middleware('guest');


Route::post('register', [UserController::class, 'store']);
Route::get('total/users', [UserController::class, 'totalUsers']);
Route::post('login', [UserController::class, 'login'])->name('login')->middleware('guest');

//perenr

Route::post('perent/store', [PerantController::class, 'store'])->name('perent.store');
Route::get('perent/index', [PerantController::class, 'index'])->name('perent.index');
Route::get('perent/show/{id}', [PerantController::class, 'show'])->name('perent.show');
Route::put('perent/update/{id}', [PerantController::class, 'update'])->name('perent.update');
Route::delete('perent/delete/{id}', [PerantController::class, 'destroy'])->name('perent.destroy');


//category

Route::post('category/create', [CategoryController::class, 'store'])->name('category.store');
Route::get('category/index', [CategoryController::class, 'getAllCategories'])->name('category.index');
Route::get('category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');



Route::post('project/create', [ProjectController::class, 'store'])->name('category.store');
Route::get('latest/project', [ProjectController::class, 'latestProject'])->name('category.create');
Route::get('project/index', [ProjectController::class, 'index'])->name('category.index');
Route::get('project/totla', [ProjectController::class, 'totalProject'])->name('category.index');
Route::get('project/show/{id}', [ProjectController::class, 'show'])->name('category.show');
Route::delete('project/delete/{id}', [ProjectController::class, 'destroy'])->name('category.delete');
Route::post('project/update/{id}', [ProjectController::class, 'update'])->name('category.update');





Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('contact/index', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact/index', [ContactController::class, 'index'])->name('contact.index');
Route::get('contact/index', [ContactController::class, 'index'])->name('contact.index');
Route::delete('contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
Route::get('contact/index', [ContactController::class, 'index'])->name('contact.index');

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);
Route::post('/newvidoestore', [ProductController::class, 'newvidoestore']);
Route::get('/getallnewvidoestore', [ProductController::class, 'getnewvidoestore']);

Route::get('latest/products', [ProductController::class, 'latestproducts'])->name('products');


// elwarsha

use App\Http\Controllers\InvoiceController;

Route::post('/invoices', [InvoiceController::class, 'store']);
Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
