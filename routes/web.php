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
    Route::get('Dashboard',[RedirectController::class,'getAdminDashboard']);
    Route::prefix('ManagePost')->group(function (){
        Route::get('getCategory/{topic_id}',[PostController::class,'getCategory']);
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
    Route::prefix('ManageTopic')->group(function (){
        Route::get('view',[TopicController::class,'viewTopic']);
        Route::get('getAdd',[TopicController::class,'getAddTopic']);
        Route::post('postAdd',[TopicController::class,'postAddTopic']);
        Route::post('delete/{id}',[TopicController::class,'delete']);
        Route::get('getEdit/{id}',[TopicController::class,'getEdit']);
        Route::post('postEdit/{id}',[TopicController::class,'postEdit']);
    });
    Route::prefix('ManageCategory')->group(function (){
        Route::get('view',[CategoryController::class,'viewCate']);
        Route::get('getAdd',[CategoryController::class,'getAddCate']);
        Route::post('postAdd',[CategoryController::class,'postAddCate']);
        Route::get('getEdit/{id}',[CategoryController::class,'getEdit']);
        Route::post('postEdit/{id}',[CategoryController::class,'postEdit']);
        Route::post('delete/{id}',[CategoryController::class,'delete']);
    });
    Route::prefix('ManageUser')->group(function(){
        Route::get('view',[UserController::class,'viewUser']);
        Route::get('getEdit/{idU}',[UserController::class,'getEdit']);
        Route::post('postEdit/{idU}',[UserController::class,'postEdit']);
        Route::post('delete/{idU}',[UserController::class,'delete']);
        Route::get('ViewPost/{id}',[UserController::class,'viewPost']);
    });
    Route::prefix('ManageReport')->group(function(){
        Route::get('view',[ReportController::class,'viewReport']);
        Route::get('ViewPost/{id}',[ReportController::class,'viewPost']);
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
Route::prefix('client')->group(function () {
    Route::get('/home',[ClientController::class,'listpost']);
    Route::get('/post/{slug}',[ClientController::class,'postDetail']);
});
Route::prefix('mod')->group(function (){
    Route::get('HomeMod/{id}',[ModControllers::class,'homeMod']);
    Route::get('/dtPost/{slug}/{idAcc}',[ModControllers::class,'postDetailApprove']);
    Route::get('accept/{id}',[ModControllers::class,'accept']);
    Route::get('delete/{id}',[ModControllers::class,'deletePost']);
    Route::get('listpostmod/{idMod}',[ModControllers::class,'listPostMod']);
    Route::get('detailPost/{slug}/{id}',[ModControllers::class,'detailPost']);

});
Route::prefix('account')->group(function (){
    Route::get('show/{id}',[MemberController::class,'showProfile']);
    Route::get('EditProfile/{id}',[MemberController::class,'getEditprofile']);
    Route::post('edit_profile/{id}',[MemberController::class,'postEditProfile']);
    Route::get('getEditPassword/{id}',[MemberController::class,'getEditPassword']);
    Route::post('postEditPassword/{id}',[MemberController::class,'postEditPassword']);
});
