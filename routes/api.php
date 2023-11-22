<?php

use App\Http\Controllers\Api\APIFeedController;
use App\Http\Controllers\Api\ForgotPasswordAPIController;
use App\Http\Controllers\Api\ResetPasswordAPIController;
use App\Http\Controllers\Api\SaldoController;
use App\Http\Controllers\APIcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Setup CORS */
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [APIController::class, 'login'])->name('login');
Route::post('signup', [APIController::class, 'register']);

// Route::post('forgot', [ForgotController::class, 'forgot']);

Route::post('/password/reset', [ResetPasswordAPIController::class, 'reset']);
Route::post('/password/email', [ForgotPasswordAPIController::class, 'sendResetLinkEmail']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/password/reset{token}', [ResetPasswordAPIController::class, 'showResetForm'])->name('password.reset');
    Route::get('user/detail', [APIController::class, 'details']);
    Route::post('logout', [APIController::class, 'logout']);

    Route::get('/home', [APIFeedController::class, 'index']);
    Route::post('/home/store', [APIFeedController::class, 'store']);
    Route::delete('/home/{id}', [APIFeedController::class, 'destroy']);

    Route::get('/saldo', [SaldoController::class, 'index']);
    Route::get('/loans', [SaldoController::class, 'getLoans']);
});
