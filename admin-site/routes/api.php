<?php

use App\Http\Controllers\api\UserCartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserAuthController;
use App\Http\Controllers\api\UserProductController;
use App\Http\Controllers\api\UserCategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/register', [UserAuthController::class, 'register']);
Route::post('user/login', [UserAuthController::class, 'login']);
Route::get('user/all', [UserAuthController::class, 'getAllUser']);


Route::get('category/all', [UserCategoryController::class, 'getAllCategory']);
Route::post('category/search',[UserCategoryController::class,'searchCategory']);


Route::get('product/all', [UserProductController::class, 'getAllProduct']);
Route::post('product/search',[UserProductController::class,'searchProduct']);
Route::post('product/details',[UserProductController::class,'productDetails']);


Route::post('add/cart',[UserCartController::class,'addProduct']);
Route::post('get/cartItems',[UserCartController::class,'getCartItems']);
Route::post('remove/currentCart',[UserCartController::class,'removeCurrentCart']);


Route::post('create/order',[OrderController::class,'CreateOrder']);
Route::post('get/order',[OrderController::class,'getOrder']);


Route::post('get/order/list',[OrderListController::class,'getOrderList']);


Route::post('rating/product',[RatingController::class,'ratingProduct']);
Route::post('get/ratings',[RatingController::class,'getRating']);
Route::post('average/ratings',[RatingController::class,'averageRating']);

Route::post('customer/contact',[ContactController::class,'customerContact']);
