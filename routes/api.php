<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\API\InvitationController;

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
// Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'index'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/get_invitation', [InvitationController::class, 'get_invitation_by_code'])->name('get_invitation');

Route::middleware(['auth:sanctum'])->group( function () {
    Route::post('/add_invitation', [InvitationController::class, 'create_invitation'])->name('add_invitation');
    Route::post('/add_galery', [InvitationController::class, 'add_galery'])->name('add_galery');
    Route::post('/delete_image', [InvitationController::class, 'delete_image'])->name('delete_image');
    Route::get('/get_invitation_all', [InvitationController::class, 'get_invitation_all'])->name('get_invitation_all');
    // Route::post('user/change_password', 'API\UserController@change_password_user_outlet');
    // Route::post('outlet/singout', 'API\UserController@logout_user_outlet');
    // Route::post('user/member_activation', 'API\UserController@resend_verify');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
