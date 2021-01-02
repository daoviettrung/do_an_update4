<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\RedirectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Mod\ModControllers;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AccountControllers;

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

// auth and verified

//=========================Trung==================================

Route::prefix('admin')->group(function(){
    Route::get('dashboard',[RedirectController::class,'getAdminDashboard']);
    Route::prefix('manage-post')->group(function (){
        Route::get('get-category/{topic_id}',[PostController::class,'getCategory']);
        Route::get('list/my-post', [PostController::class, 'getMyPost']);
        Route::get('list/post-i-manage/{id?}', [PostController::class, 'showPost']);
        Route::post('list/post-i-manage/{id?}', [PostController::class, 'filter']);
        Route::get('/add', [PostController::class, 'getAddPost']);
        Route::post('/add', [PostController::class, 'postAddPost']);
        Route::get('/edit/{id}', [PostController::class, 'getEditPost']);
        Route::post('/edit', [PostController::class, 'postEditPost']);
        Route::post('/delete', [PostController::class, 'postDeletePost']);
        //Route::get('ListPost',[PostController::class,'showPost']);
        // Route::get('ViewPost/{id}',[PostController::class,'viewPost']);
        // Route::post('filter',[PostController::class,'filter']);
    });
    Route::prefix('manage-topic')->group(function (){
        Route::get('view',[TopicController::class,'viewTopic']);
        Route::get('get-add',[TopicController::class,'getAddTopic']);
        Route::post('post-add',[TopicController::class,'postAddTopic']);
        Route::post('delete/{id}',[TopicController::class,'delete']);
        Route::get('get-edit/{id}',[TopicController::class,'getEdit']);
        Route::post('post-edit/{id}',[TopicController::class,'postEdit']);
    });
    Route::prefix('manage-category')->group(function (){
        Route::get('view',[CategoryController::class,'viewCate']);
        Route::get('get-add',[CategoryController::class,'getAddCate']);
        Route::post('post-add',[CategoryController::class,'postAddCate']);
        Route::get('get-edit/{id}',[CategoryController::class,'getEdit']);
        Route::post('post-edit/{id}',[CategoryController::class,'postEdit']);
        Route::post('delete/{id}',[CategoryController::class,'delete']);
        Route::post('filter',[CategoryController::class,'filter']);
    });
    Route::prefix('manage-user')->group(function(){
        Route::get('view',[UserController::class,'viewUser']);
        Route::get('get-edit/{idU}',[UserController::class,'getEdit']);
        Route::post('post-edit/{idU}',[UserController::class,'postEdit']);
        Route::post('delete/{idU}',[UserController::class,'delete']);
        Route::get('view-post/{id}',[UserController::class,'viewPost']);
        Route::post('ban/{id}',[UserController::class,'banUser']);
    });
    Route::prefix('manage-report')->group(function(){
        Route::get('view',[ReportController::class,'viewReport']);
        Route::get('view-post/{id}',[ReportController::class,'viewPost']);
        Route::post('month',[ReportController::class,'getMonth']);

    });
    Route::prefix('/account')->group(function () {
        Route::get('/profile', [AccountControllers::class, 'getProfile']);
        Route::post('/profile', [AccountControllers::class, 'postProfile']);
        Route::get('/security', [AccountControllers::class, 'getSecurity']);
        Route::get('/forgot-password', [AccountControllers::class, 'getForgotPassword']);
        Route::post('/change-password', [AccountControllers::class, 'postChangePassword']);
    });

});



Route::get('lg',[AuthController::class,'login']);
Route::post('login',[AuthController::class,'checkLogin']);
