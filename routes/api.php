<?php

use App\Http\Controllers\API\AdminProfileSettingController;
use App\Http\Controllers\API\AllergyController;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\FoodOfferController;
use App\Http\Controllers\API\MyOrderController;
use App\Http\Controllers\API\MysteryTypeController;
use App\Http\Controllers\API\PickupAddressController;
use App\Http\Controllers\API\PrivacyController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\TutorialStep;
use App\Http\Controllers\API\TutorialStepController;
use App\Http\Controllers\API\UserProfileController;
use App\Models\MyOrder;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication Controller 
Route::post('/register',[AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);


//RatingController
Route::get('/u-id',[RatingController::class,'uid']);
Route::get('/ratings',[RatingController::class,'index']);
Route::post('/ratings',[RatingController::class,'store']);
Route::post('/ratings/{id}',[RatingController::class,'update']);
Route::delete('/ratings/{id}',[RatingController::class,'destroy']);

Route::get('/tutorial-steps',[TutorialStepController::class,'index'])->middleware(['auth:sanctum', 'userCheck']);
Route::get('/user-info',[TutorialStepController::class,'userInfo'])->middleware(['auth:sanctum']);
Route::post('/tutorial-status-update',[TutorialStepController::class,'statusUpdate'])->middleware(['auth:sanctum']);

Route::get('/user-profile',[UserProfileController::class,'index'])->middleware(['auth:sanctum', 'userCheck']);
Route::post('/user-profile',[UserProfileController::class,'updateProfile'])->middleware(['auth:sanctum', 'userCheck']);

Route::get('/privacy-policy',[PrivacyController::class,'index'])->middleware(['auth:sanctum', 'userCheck']);

Route::get('/food-offers',[FoodOfferController::class,'index'])->middleware(['auth:sanctum']);

Route::get('/allergies',[AllergyController::class,'index'])->middleware(['auth:sanctum']);


Route::get('/order-history',[MyOrderController::class,'history'])->middleware(['auth:sanctum']);
Route::post('/get-stock',[MyOrderController::class,'getStock'])->middleware(['auth:sanctum']);
Route::post('/store-order',[MyOrderController::class,'store'])->middleware(['auth:sanctum', 'userCheck']);


Route::get('/mystery-types',[MysteryTypeController::class,'index'])->middleware(['auth:sanctum']);

Route::get('/pickup-addresses', [PickupAddressController::class, 'index'])->middleware(['auth:sanctum']);

// Sanctum middleware group 
Route::post('/fcm/id', [AuthenticationController::class, 'fcmRetriever'])->middleware(['auth:sanctum']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);
Route::group(['middleware' => ['auth:sanctum', 'adminCheck']], function () {


    // Pickup Addresses Controller
    Route::post('/pickup-addresses', [PickupAddressController::class, 'store']);
    Route::post('/pickup-addresses/{id}', [PickupAddressController::class, 'update']);
    Route::delete('/pickup-addresses/{id}', [PickupAddressController::class, 'destroy']);

    //TutorialStep Controller
    Route::post('/tutorial-steps',[TutorialStepController::class,'store']);
    Route::post('/tutorial-steps/{id}',[TutorialStepController::class,'update']);
    Route::delete('/tutorial-steps/{id}',[TutorialStepController::class,'delete']);


    //FoodOfferController
    Route::post('/food-offers',[FoodOfferController::class,'store']);
    Route::post('/food-offers/{id}',[FoodOfferController::class,'update']);
    Route::delete('/food-offers/{id}',[FoodOfferController::class,'delete']);
    Route::post('/food-offers/hide-show/{id}',[FoodOfferController::class,'hideShow']);

    //AllergyController
    Route::post('/allergies',[AllergyController::class,'store']);
    Route::post('/allergies/{id}',[AllergyController::class,'update']);
    Route::delete('/allergies/{id}',[AllergyController::class,'delete']);

    //AdminProfileSettingController
    Route::get('/profile-settings',[AdminProfileSettingController::class,'index']);
    Route::post('/profile-settings/{id}',[AdminProfileSettingController::class,'update']);

    //MyOderController
    //payment status: unpaid = 0, paid = 1, booked = 2, coupon = 3, species = 4;
    //order status:  new 0, In process =1, ready for pick up = 2, delivered =3;
    Route::get('/my-orders',[MyOrderController::class,'index']);
    Route::get('/user-order/{id}',[MyOrderController::class,'userOrder']);
    Route::post('/my-orders/update/status/{id}',[MyOrderController::class,'updateStatus']); 
    Route::delete('/my-orders/{id}',[MyOrderController::class,'delete']);
    Route::post('user-detail', [AuthenticationController::class, 'userDetail']);

    
});

    
