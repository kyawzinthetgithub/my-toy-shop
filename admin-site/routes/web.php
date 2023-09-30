<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ajax\AjaxController;
use App\Http\Controllers\ajax\AjaxUserController;
use App\Http\Controllers\pdf\ExportPDFController;


// login / register
Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthController::class,'login'])->name('admin#login');
Route::get('registerPage',[AuthController::class,'register'])->name('admin#register');

Route::middleware(['auth'])->group(function () {
    // admin
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('admin#dashboard');
    Route::group(['prefix'=>'admin','middleware'=>'admin_auth'],function () {
        // profile
        Route::get('profile',[AdminController::class,'adminProfile'])->name('admin#profile');
        Route::get('profile/edit',[AdminController::class,'profileEdit'])->name('admin#profileEdit');
        Route::post('profile/update/{id}',[AdminController::class,'profileUpdate'])->name('admin#update');

        //change password
        Route::post('changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');

        //admin list
        Route::get('AdminList',[AdminController::class,'adminList'])->name('admin#adminList');
        Route::get('delete',[AdminController::class,'adminDelete']);
        Route::get('change/role',[AdminController::class,'adminChangeRole']);

        //user list
        Route::get('userList',[AjaxUserController::class,'userList'])->name('admin#userList');
        Route::get('user/delete',[AjaxUserController::class,'userDelete']);
        Route::get('user/change/role',[AjaxUserController::class,'userChangeRole']);

        //category
        Route::get('category/list',[CategoryController::class,'categoryList'])->name('admin#categoryList');
        Route::get('category/create',[CategoryController::class,'categoryCreate'])->name('admin#categoryCreatePage');
        Route::post('category/create',[CategoryController::class,'createCategory'])->name('admin#createCategory');
        Route::get('category/edit/{id}',[CategoryController::class,'categoryEdit'])->name('admin#categoryEdit');
        Route::post('category/update',[CategoryController::class,'update'])->name('admin#categoryUpdate');

        Route::get('ajax/category/list',[AjaxController::class,'deleteCatagory']);
        Route::get('ajax/category/delete',[AjaxController::class,'delete']);

        //product
        Route::get('product/list',[ProductController::class,'productList'])->name('admin#productList');
        Route::get('product/create',[ProductController::class,'productCreate'])->name('admin#productCreate');
        Route::post('product/post',[ProductController::class,'productPost'])->name('admin#productPost');
        Route::get('product/detail/{id}',[ProductController::class,'productDetail'])->name('admin#productDetail');
        Route::get('product/update/{id}',[ProductController::class,'productUpdate'])->name('admin#productUpdate');
        Route::post('product/update',[ProductController::class,'updateProduct'])->name('admin#updateProduct');

        //order
        Route::get('order/list',[OrderController::class,'orderList'])->name('admin#orderList');
        Route::get('order/sort',[OrderController::class,'sortOrder'])->name('admin#sortOrder');
        Route::get('check/order/porducts/{orderCode}',[OrderController::class,'checkOrderList'])->name('admin#checkOrderList');

        //contact message
        Route::get('customer/contact',[ContactController::class,'getContactMessage'])->name('admin#contactMessage');
        Route::get('customer/message/delete/{id}',[ContactController::class,'deleteMessage'])->name('admin#deleteMessage');

        //ajax
        Route::get('ajax/product/list',[AjaxController::class,'getProduct']);
        Route::get('ajax/product/delete',[AjaxController::class,'deleteProduct']);
        Route::get('change/order/status',[AjaxController::class,'changeStatus']);

    });
});

