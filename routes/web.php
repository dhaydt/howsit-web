<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\admin\SaldoController;

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

// Route::get('/', function () {
//         return view('home');
// });

Route::get('qrcode', function () {
    return QrCode::size(300)->generate('https://soapless-worries.000webhostapp.com/register');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('feeds', FeedController::class);
    Route::resource('saldos', SaldoController::class);

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/admin', [AdminController::class, 'index']);

    Route::get('/feed', [App\Http\Controllers\HomeController::class, 'feed'])->name('feed');

    Route::get('/agora-chat', 'App\Http\Controllers\AgoraVideoController@index');
    Route::post('/agora/token', 'App\Http\Controllers\AgoraVideoController@token');
    Route::post('/agora/call-user', 'App\Http\Controllers\AgoraVideoController@callUser');

    Route::get('/messenger', [App\Http\Controllers\HomeController::class, 'messenger'])->name('messenger');
    Route::get('/contacts', [ContactController::class, 'get']);
    Route::get('/conversation/{id}', [ContactController::class, 'getMessagesFor']);
    Route::post('/conversation/send', [ContactController::class, 'send']);

    Route::get('/home', [ImageController::class, 'index'])->name('home');
    Route::post('/image', [ImageController::class, 'post']);
    Route::delete('/image/{id}', [ImageController::class, 'destroy']);
    Route::post('/like-image/{image}', [HomeController::class, 'likeImage'])->name('image.like')->middleware('auth');

    Route::get('/info', [HomeController::class, 'info'])->name('info');

    Route::get('/setting', [HomeController::class, 'setting'])->name('setting');
    Route::get('/group', [HomeController::class, 'group'])->name('group');
    Route::get('/furnite', [HomeController::class, 'furnite'])->name('furnite');
    Route::get('/help', [HomeController::class, 'help'])->name('help');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'updateAvatar']);
    Route::post('/profile/update', [ProfileController::class, 'update']);

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

});
