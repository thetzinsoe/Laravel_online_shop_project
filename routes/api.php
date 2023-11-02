<?php

use App\Http\Controllers\api\RouteController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RouteCompiler;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pizza/list',[RouteController::class,'pizzaList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('order/list',[RouteController::class,'orderList']);
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/product',[RouteController::class,'createProduct']);
Route::get('message/list',[RouteController::class,'messageList']);
Route::post('message/send',[RouteController::class,'messageSend']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);


/*
To get All Pizza => loclhost:8000/api/pizza/list
To get All Categories => localhost:8000/api/category/list
To See Order => localhost:8000/api/order/list
To create Category => localhost:8000/api/create/category
{
    'name' : 'category_name',
}
to send message => localhost:8000/api/message/send
{
    'name' : 'enter_your_name',
    'email' : 'enter your email',
    'message' : 'enter your want to send',
}






*/
