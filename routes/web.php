<?php

use App\Http\Controllers\Backend\PhotoController;
use App\Http\Controllers\Backend\RingtoneController;

use App\Http\Controllers\Frontend\FrontendPhotoController;
use App\Http\Controllers\Frontend\FrontendRingtoneController;
use Illuminate\Support\Facades\Route;

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


Auth::routes(['register'=>false]);

//backend
Route::group(array('middleware'=>'auth'), function(){
    Route::get('/home', [RingtoneController::class, 'index'])->name('home');
    Route::resource('ringtones', RingtoneController::class);
    Route::resource('photos', PhotoController::class);
});

//Frontend
Route::group(array(), function(){
    Route::get('/', [FrontendRingtoneController::class, 'index']);
    Route::get('/ringtones/{id}/{slug}',[FrontendRingtoneController::class, 'show'])->name('ringtones.show');
    Route::post('ringtones/download/{id}', [FrontendRingtoneController::class, 'downloadRingtone'])->name('ringtones.download');
    Route::get('/category/{id}',[FrontendRingtoneController::class, 'category'])->name('ringtones.category');
    Route::get('/wallpapers',[FrontendPhotoController::class, 'wallpaper']);
    Route::post('download1/{id}', [FrontendPhotoController::class, 'download800x600'])->name('download1');
    Route::post('download2/{id}', [FrontendPhotoController::class, 'download1280x1024'])->name('download2');
    Route::post('download3/{id}', [FrontendPhotoController::class, 'download316x255'])->name('download3');
    Route::post('download4/{id}', [FrontendPhotoController::class, 'download118x95'])->name('download4');

});
