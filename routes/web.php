<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\BMIController;
use App\Http\Controllers\FoodMenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('welcome');
   });
});

Auth::routes();
// navidate to home page if not routing parm given
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('todo', [TodoController::class, 'index']);
Route::get('create', [TodoController::class, 'create']);
Route::post('todo/store', [TodoController::class, 'store']);
Route::post('todo/update', [TodoController::class, 'update']);
// Route::resource('todo', TodoController::class);
Route::get('/bmi',[BMIController::class,'index']);
Route::post('/bmi',[BMIController::class,'storebmi']);
Route::get('/chart',[BMIController::class,'getChart']);
Route::get('/recipes',[FoodMenuController::class,'getRecipes']);
Route::post('recipes/delete',[FoodMenuController::class,'deleteRecipes']);
Route::get('/foodmenu',[FoodMenuController::class,'index']);
Route::post('foodmenu/save',[FoodMenuController::class,'storefood']);
