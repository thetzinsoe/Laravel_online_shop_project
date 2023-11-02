<?php

use App\Http\Controllers\admin\UserListController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\api\RouteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\ContactController;
use App\Http\Controllers\UserController;
use Laravel\Jetstream\Rules\Role;

// login and register page
Route::middleware('admin_auth')->group(function(){
    Route::redirect('/','/loginPage');
    Route::get('/loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});

Route::middleware(['auth'])
->group(function () {

    // dashboard
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin Side
    Route::middleware('admin_auth')->group(function(){
        //admin password
        Route::prefix('admin')->group(function(){
            Route::get('/password/changePage',[AdminController::class,'passwordChangePage'])->name('admin#passwordChangePage');
            Route::post('/password/change',[AdminController::class,'passwordChange'])->name('admin#passwordChange');
            Route::get('/account/details',[AdminController::class,'accountDetail'])->name('admin#accountDetail');
            Route::get('/account/edit',[AdminController::class,'accountEdit'])->name('admin#accountEdit');
            Route::post('/account/update',[AdminController::class,'accountUpdate'])->name('admin#accountUpdate');
            Route::get('/account/list',[AdminController::class,'accountList'])->name('admin#accountList');
            Route::get('/account/delete/{id}',[AdminController::class,'accountDelete'])->name('admin#accountDelete');
            Route::get('remove/account/{id}',[AdminController::class,'accountRemove'])->name('admin#accountRemove');
        });

        // category
        Route::prefix('category')->group(function(){
            Route::get('/list',[CategoryController::class,'list'])->name('category#list');
            Route::get('/createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('/create',[CategoryController::class,'create'])->name('category#create');
            Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('/update',[CategoryController::class,'update'])->name('category#update');

        });
        // pizza
        Route::prefix('product')->group(function(){
            Route::get('/pizzaList',[ProductController::class,'pizzaList'])->name('product#pizzaList');
            Route::get('pizzaCreatePage',[ProductController::class,'pizzaCreatePage'])->name('product#pizzaCreatePage');
            Route::post('pizzaCreate',[ProductController::class,'pizzaCreate'])->name('product#pizzaCreate');
            Route::get('pizzaSeemore/{id}',[ProductController::class,'pizzaSeemore'])->name('product#pizzaSeemore');
            Route::get('pizzaEditPage/{id}',[ProductController::class,'pizzaEditPage'])->name('product#pizzaEditPage');
            Route::get('pizzaEdit',[ProductController::class,'pizzaEdit'])->name('product#pizzaEdit');
            Route::post('pizzaUpdate',[ProductController::class,'pizzaUpdate'])->name('product#pizzaUpdate');
            Route::get('pizzaDelete/{id}',[ProductController::class,'pizzaDelete'])->name('product#pizzaDelete');
        });

        // order List
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'list'])->name('order#list');
            Route::get('detail/{code}',[OrderController::class,'detail'])->name('order#detail');
            Route::get('sorting',[OrderController::class,'sorting'])->name('order#sorting');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('order#changeStatus');
        });
        Route::prefix('user')->group(function(){
            Route::get('list',[UserListController::class,'userList'])->name('admin#userList');
            Route::get('changeRole',[UserListController::class,'changeRole'])->name('admin#userChangeRole');
            Route::get('message/show',[UserListController::class,'messageShow'])->name('admin#userMessageShow');
            Route::post('message/delete/{id}',[UserListController::class,'messageDelete'])->name('admin#userMessageDelete');
        });


    });

    // User Side
    Route::group(['prefix' => 'user' , 'middleware' => 'user_auth'],function () {
        Route::get('/home',[UserController::class,'home'])->name('user#home');
        Route::get('account/edit',[UserController::class,'accountEdit'])->name('user#accountEdit');
        Route::post('account/update/{id}',[UserController::class,'accountUpdate'])->name('user#accountUpdate');
        Route::get('account/changePasswordPage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
        Route::post('account/changePassword/{id}',[UserController::class,'changePassword'])->name('user#changePassword');
        Route::get('category/filter/{id}',[UserController::class,'categoryFilter'])->name('user#categoryFilter');

        // user product
        Route::prefix('product')->group(function(){
        Route::get('pizzaDetail/{id}',[UserController::class,'pizzaDetail'])->name('user#productPizzaDetail');
        Route::get('cart',[UserController::class,'cart'])->name('user#cart');
        Route::post('cart/remove/{id}',[UserController::class,'cartRemove'])->name('user#cartRemove');
        Route::get('order/history',[UserController::class,'orderHistory'])->name('user#orderHistory');
        Route::get('order/history/detail/{code}',[UserController::class,'orderHistoryDetail'])->name('user#orderHistoryDetail');
        });
        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('user#ajaxPizzaList');
            Route::get('pizza/addToCart',[AjaxController::class,'pizzaAddToCart'])->name('user#ajaxPizzaAddToCart');
            Route::get('order',[AjaxController::class,'order'])->name('user#ajaxOrder');
            Route::get('pizza/viewCount',[AjaxController::class,'pizzaViewCount'])->name('user#ajaxPizzaViewCount');
        });
        Route::prefix('contact')->group(function(){
            Route::get('page',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('sendMessage',[ContactController::class,'sendMessage'])->name('users#contactSendMessage');
        });
    });
});

