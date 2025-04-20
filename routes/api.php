<?php

use App\Http\Controllers\NetworkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\User\DrugTypeController;
use App\Http\Controllers\Api\User\DrugController;
use App\Http\Controllers\Api\Pharmacy\DrugController as PharmacyDrugController;

use App\Http\Controllers\Api\User\OrderController;

use App\Http\Controllers\Api\Pharmacy\OrderController as PharmacyOrderController;


use App\Http\Controllers\Api\Auth\RegisterUserController;
use App\Http\Controllers\Api\Pharmacy\PharmacyController;
use App\Http\Controllers\Api\Pharmacy\PharmacyBranchController;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group and "App\Http\Controllers\Api" namespace.
| and "api." route's alias name. Enjoy building your API!
|
*/
// Route to handle email verification

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterUserController::class, 'register']);

Route::post('/password/forget', 'ResetPasswordController@forget')->name('password.forget');
Route::post('/password/code', 'ResetPasswordController@code')->name('password.code');
Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.reset');
Route::get('/select/users', 'UserController@select')->name('users.select');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('password', 'VerificationController@password')->name('password.check');
    Route::post('verification/send', 'VerificationController@send')->name('verification.send');
    Route::post('verification/verify', 'VerificationController@verify')->name('verification.verify');
    Route::get('profile', 'ProfileController@show')->name('profile.show');
    Route::match(['put', 'patch'], 'profile', 'ProfileController@update')->name('profile.update');
    Route::as('user.')->prefix('user')->group(function () {
        Route::get('drug-types', [DrugTypeController::class, 'index'])->name('drugs.types');
        Route::get('drugs', [DrugController::class, 'index'])->name('drugs.index');
        Route::post('drugs', [DrugController::class, 'store'])->name('drugs.store');
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
        Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('points', function () {
            return response()->json(['points' => auth()->user()?->points]);
        });
    });
    Route::as('pharmacy.')->prefix('pharmacy')->group(function () {
        Route::get('drug-types', [DrugTypeController::class, 'index'])->name('drugs.types');
        Route::get('drugs', [PharmacyDrugController::class, 'index'])->name('drugs.index');
        Route::post('drugs', [PharmacyDrugController::class, 'store'])->name('drugs.store');

        Route::post('/pharmacy-branches', [PharmacyBranchController::class, 'store']);
        Route::get('/pharmacies', [PharmacyController::class, 'index']);
        Route::get('/pharmacies/{id}', [PharmacyController::class, 'show']);
        Route::get('/branches', [PharmacyBranchController::class, 'index']);

        Route::get('/orders', [PharmacyOrderController::class, 'getAllOrders']); // Get all orders
        Route::get('/orders/{order}', [PharmacyOrderController::class, 'getOrderById']); // Get order by ID
        Route::patch('/orders/{order}', [PharmacyOrderController::class, 'markOrderAsCompleted']); // Mark order as completed
        Route::delete('/orders/{order}', [PharmacyOrderController::class, 'cancelOrder']); // Cancel order

        Route::get('network', [NetworkController::class, 'index']);
        Route::put('network/{network}/accept', [NetworkController::class, 'update']);
        Route::post('requests', [NetworkController::class, 'store']);
        Route::get('my-requests', [NetworkController::class, 'getMyRequests']);
        Route::get('approved-requests', [NetworkController::class, 'getMyApprovedRequests']);
    });
});
Route::post('/editor/upload', 'MediaController@editorUpload')->name('editor.upload');
Route::get('/settings', 'SettingController@index')->name('settings.index');
Route::get('/settings/pages/{page}', 'SettingController@page')
    ->where('page', 'about|terms|privacy')->name('settings.page');

Route::get('notifications/count', 'NotificationController@count')->name('notifications.count');
Route::middleware('auth:sanctum')->get('notifications', 'NotificationController@index')->name('notifications.index');

Route::post('feedback', 'FeedbackController@store')->name('feedback.send');
