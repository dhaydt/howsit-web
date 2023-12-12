<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\FeedController;
use App\Http\Controllers\admin\loansController;
use App\Http\Controllers\admin\moneyController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SaldoController;
use App\Http\Controllers\admin\sharesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AgoraVideoController;
use App\Http\Controllers\Api\ResetPasswordAPIController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ResetPhoneController;
use App\Http\Controllers\BackupCloudController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController as ControllersRoleController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

Route::get('qrcode', function () {
    return QrCode::size(300)->generate('https://soapless-worries.000webhostapp.com/register');
});

Route::get('assign_valor', function(){
    $user = User::where('email', 'valormcdonald@gmail.com')->first();
    if($user){
        $user->assignRole('Admin');
        dd('valor assigned as admin');
    }else{
        dd('user not found');
    }

});

Route::get('/notification', function () {
    return view('notification');
});

//----------------------RESET EMAIL PASSWORD----------------//

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/password/reset', [ResetPasswordAPIController::class, 'reset']);

//----------------------RESET PHONE PASSWORD----------------//

Route::get('/reset-phone', [ResetPhoneController::class, 'showLinkRequestForm'])->name('reset-phone');
Route::post('/postforget', [ResetPhoneController::class, 'postForget'])->name('postForget');
Route::get('/verify-phone', [OtpController::class, 'index'])->name('verify-phone');
Route::post('/post-verify', [OtpController::class, 'verify'])->name('post-verify');
Route::get('/phone-reset', [OtpController::class, 'resetForm'])->name('phoneReset');
Route::post('/phone-update', [OtpController::class, 'updatePassword'])->name('phone-updatePassword');

//-----------------------PHONE VERIFY----------------------//

Route::get('/phone/verify', function () {
    return view('auth.phone_verify');
})->name('phone-verify');

Route::post('/phone/check', [ProfileController::class, 'forgotVerify'])->name('phone-check');
Route::post('/phone/verif', [AuthController::class, 'phoneVerif'])->name('phone-verified');

//---------------------BACKUP CLOUD------------------//
// Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('test', [BackupCloudController::class, 'googleDrive']);

Route::get('glogin', [GoogleController::class, 'googleLogin'])->name('glogin');
Route::post('upload-file', [GoogleController::class, 'uploadFileUsingAccessToken'])->name('upload-file');

//--------------------AUTH------------------------//

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'cors']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('feeds', FeedController::class);
    Route::resource('saldos', SaldoController::class);
    Route::resource('loans', loansController::class);
    Route::resource('money', moneyController::class);
    Route::resource('shares', sharesController::class);

    Route::post('update_feed_admin/{id}', [FeedController::class, 'update'])->name('feeds.update_feed');

    Route::get('assign_admin', [ControllersRoleController::class, 'assign']);

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/admin', [AdminController::class, 'index']);

    Route::get('/feed', [App\Http\Controllers\HomeController::class, 'feed'])->name('feed');

    Route::get('/agora-chat', [AgoraVideoController::class, 'index']);
    Route::post('/agora/token', [AgoraVideoController::class, 'token']);
    Route::post('/agora/call-user', [AgoraVideoController::class, 'callUser']);

    Route::get('/messenger', [App\Http\Controllers\HomeController::class, 'messenger'])->name('messenger');
    Route::get('/contacts', [ContactController::class, 'get']);
    Route::get('/conversation/{id}', [ContactController::class, 'getMessagesFor']);
    Route::post('/conversation/send', [ContactController::class, 'send']);
    Route::post('/image/send/{id}', [ContactController::class, 'sendMMS']);

    Route::get('/home', [ImageController::class, 'index'])->name('home');
    Route::post('/image', [ImageController::class, 'post']);
    Route::delete('/image/{id}', [ImageController::class, 'destroy']);
    Route::post('/like-image/{image}', [HomeController::class, 'likeImage'])->name('image.like')->middleware('auth');

    Route::get('/info', [HomeController::class, 'info'])->name('info');
    Route::get('/info/saldo', [HomeController::class, 'get']);
    Route::get('/info/loans', [InfoController::class, 'getLoans']);

    Route::get('file-import-export', [HomeController::class, 'fileImportExport'])->name('backup');
    Route::post('file-import', [HomeController::class, 'fileImport'])->name('file-import');
    Route::post('file-export', [HomeController::class, 'fileExport'])->name('file-export');

    Route::get('/setting', [HomeController::class, 'setting'])->name('setting');
    Route::get('/delete-user', [HomeController::class, 'deleteModal'])->name('delete');
    Route::get('/setting/destroy', [HomeController::class, 'destroyAccount'])->name('delete-account');
    Route::get('/group', [HomeController::class, 'group'])->name('group');
    Route::get('/furnite', [HomeController::class, 'furnite'])->name('furnite');
    Route::get('/help', [HomeController::class, 'help'])->name('help');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'updateAvatar']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::get('/profile/phone', [ProfileController::class, 'phoneVerify']);

    Route::get('/profile/verify', function () {
        return view('auth.phoneVerify');
    })->name('verify');
    Route::post('/profile/verify', [AuthController::class, 'verify'])->name('verified');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});
