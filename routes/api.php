<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\API\RegisterController;
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

Route::get('main',[RegisterController::class,'main'])->name('main');
Route::get('regindex', [MainController::class, 'regindex'])->name('regindex');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('logindex', [MainController::class, 'logindex'])->name('logindex');
Route::post('login', [RegisterController::class, 'login'])->name('login');
Route::post('logout', [RegisterController::class, 'logout'])->name('logout');
Route::get('updateindex/{todo}', [MainController::class, 'updateindex'])->name('updateindex');
// Route::get('/login',[MainController::class,'login']);
Route::post('/update-data/{id}',[MainController::class,'UpdateData']);
Route::post('/store',[MainController::class,'store'])->name('store'); //Store
   // Route::get('/todo',[MainController::class,'index'])->name('get'); //Get
   Route::get('/todo/{todo}',[MainController::class,'show'])->name('getunique'); //View Unique
   Route::patch('/update/{todo}',[MainController::class,'update'])->name('update'); //Update
   Route::delete('/todo/{todo}',[MainController::class,'destroy'])->name('delete'); //Delete
Route::group(['middleware' => ['auth:api']], function()
{
   Route::resource('tasks', MainController::class);
});