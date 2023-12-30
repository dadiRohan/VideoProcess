<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
* Book APIs
*/
Route::prefix('/books')->group(function(){
	Route::get('/',[BooksController::class,'index'])->name('index');
	Route::post('/store',[BooksController::class,'store'])->name('store');
	Route::get('/{id}',[BooksController::class,'view'])->name('view');
	Route::post('/update/{id}',[BooksController::class,'update'])->name('update');
	Route::delete('/delete/{id}',[BooksController::class,'delete'])->name('delete');
});

/*
* Video Apis
*/ 
Route::post('/video',[VideoController::class,'store'])->name('store');
