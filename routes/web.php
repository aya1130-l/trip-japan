<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CroppieController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/ryojo', \App\Http\Controllers\Ryojo\HomeController::class)->name('ryojo.home');
Route::get('/ryojo/index', \App\Http\Controllers\Ryojo\IndexController::class)->name('ryojo.index');
Route::get('/ryojo/memory/{memoryId}', \App\Http\Controllers\Ryojo\MemoryDetailController::class)->name('ryojo.memory');



Route::middleware(['auth','verified'])->group(function() {
    Route::put('register', [RegisteredUserController::class, 'store'])->name('register');

    Route::get('/ryojo/form', \App\Http\Controllers\Ryojo\FormController::class)->name('ryojo.form');
    Route::post('/ryojo/confirm', \App\Http\Controllers\Ryojo\FormConfirmController::class)->name('ryojo.confirm');
    Route::get('/ryojo/revise', \App\Http\Controllers\Ryojo\PostReviseController::class)->name('ryojo.revise');
    Route::post('/ryojo/create', \App\Http\Controllers\Ryojo\CreateController::class)->name('ryojo.create');
    Route::delete('/ryojo/delete/{memoryId}',\App\Http\Controllers\Ryojo\DeleteController::class)->name('ryojo.delete');

    Route::get('/ryojo/textform/{memoryId}',\App\Http\Controllers\Ryojo\Update\TextFormController::class)->name('ryojo.update.textform'); 
    Route::post('/ryojo/select/{memoryId}',\App\Http\Controllers\Ryojo\Update\SelectController::class)->name('ryojo.update.select');
    Route::get('/ryojo/imageform/{memoryId}',\App\Http\Controllers\Ryojo\Update\ImageFormController::class)->name('ryojo.update.imageform'); 
    Route::get('/ryojo/textconfirm/{memoryId}',\App\Http\Controllers\Ryojo\Update\TextConfirmController::class)->name('ryojo.update.textconfirm'); 
    Route::get('/ryojo/textrevise',\App\Http\Controllers\Ryojo\Update\TextReviseController::class)->name('ryojo.update.textrevise'); 
    Route::post('/ryojo/imageconfirm/{memoryId}',\App\Http\Controllers\Ryojo\Update\ImageConfirmController::class)->name('ryojo.update.imageconfirm'); 
    Route::put('/ryojo/textupdate/{memoryId}',\App\Http\Controllers\Ryojo\Update\TextUpdateController::class)->name('ryojo.update.textupdate'); 
    Route::put('/ryojo/imageupdate/{memoryId}',\App\Http\Controllers\Ryojo\Update\ImageUpdateController::class)->name('ryojo.update.imageupdate'); 
    Route::get('/ryojo/updaterevise',\App\Http\Controllers\Ryojo\Update\PostReviseController::class)->name('ryojo.update.revise'); 
    Route::post('/ryojo/bookmark/create',\App\Http\Controllers\Ryojo\BookmarkController::class)->name('ryojo.bookmark.create');
    Route::delete('/ryojo/bookmark/delete', \App\Http\Controllers\Ryojo\BookmarkDeleteController::class)->name('ryojo.bookmark.delete');
    Route::get('/ryojo/bookmark', \App\Http\Controllers\Ryojo\ShowBookmarkController::class)->name('ryojo.bookmark');

    Route::get('/ryojo/mypage',\App\Http\Controllers\Ryojo\MypageController::class)->name('ryojo.mypage');
    Route::get('/ryojo/mypage/form',\App\Http\Controllers\Ryojo\MypageFormController::class)->name('ryojo.mypage.Updateform');
    Route::put('/ryojo/mypage/update',\App\Http\Controllers\Ryojo\MypageUpdateController::class)->name('ryojo.mypage.update');

    Route::get('/ryojo/userpage/{userId}',\App\Http\Controllers\Ryojo\UserpageController::class)->name('ryojo.userpage');

});




