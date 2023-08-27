<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamanController;
use App\Http\Controllers\RekamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/getdata',[RekamController::class, 'index']);
    Route::get('/show/{id}',[RekamController::class, 'show']);
    //CRUD
    Route::post('/create',[RekamController::class, 'store']);
    Route::post('/update/{id}',[RekamController::class, 'update']);
    Route::post('/destroy/{id}',[RekamController::class, 'destroy']);
    
    Route::post('/destroyuser/{id}',[AuthenticationController::class, 'destroyuser']);
    


    Route::get('/logout',[AuthenticationController::class,'logout']);
    Route::get('/me',[AuthenticationController::class,'me']);
    Route::get('/getalluser',[AuthenticationController::class,'getalluser']);
    Route::get('/getuser/{id}',[AuthenticationController::class,'getuser']);
    Route::get('/getdatarekammedis',[RekamController::class,'getdatarekammedis']);
    Route::get('/getallpasien',[RekamController::class,'getallpasien']);
    Route::get('/getdaftarepasien',[RekamController::class,'getdaftarepasien']);



    ////////////revisi
    Route::get('/getpasien',[PasienController::class,'index']);
    Route::get('/getpasiendetail/{id}',[PasienController::class,'show']);
    Route::post('/tambahpasien',[PasienController::class,'tambah_pasien']);
    Route::post('/deletepasien/{id}',[PasienController::class,'delete_pasien']);

    Route::post('/buatrekaman',[RekamanController::class,'buatrekaman']);
    Route::post('/updaterekaman/{id}',[RekamanController::class,'updaterekaman']);
    Route::post('/hapusrekaman/{id}',[RekamanController::class,'hapusrekaman']);
    Route::get('/indexall',[PasienController::class,'indexall']);
    Route::get('/getdaftarepasien2',[RekamanController::class,'getdaftarepasien2']);
    Route::get('/lihatdatarekampasien/{id}',[PasienController::class,'lihatdatarekampasien']);
    Route::get('/getallpasien2',[RekamanController::class,'getallpasien2']);
    
});






Route::post('/login',[AuthenticationController::class,'login']);
Route::post('/register',[AuthenticationController::class,'register']);
