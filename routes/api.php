<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('test',function(){
    return bcrypt('123456789');
});

Route::post('VisLogIn',['uses'=>'ApiController@VisitorLogIn']);

Route::post('VisRegister',['uses'=>"ApiController@VisitorRegister"]);

Route::get('CategoryAll/{limit}/{SortKey}/{SortType}',['uses'=>'ApiController@CategoryAll']);

Route::get('CategoryOne/{CatId}',['uses'=>'ApiController@CategoryOne']);

Route::get('ServiceAll/{limit}/{SortKey}/{SortType}',['uses'=>'ApiController@ServiceAll']);

Route::get('ServiceOne/{ServiceId}',['uses'=>'ApiController@ServiceOne']);

Route::get('ServiceByCat/{CatId}/{limit}/{SortType}/{SortKey}',['uses'=>"ApiController@ServiceByCat"]);

Route::get('ServiceByCmp/{CmpId}/{limit}/{SortType}/{SortKey}',['uses'=>"ApiController@ServiceByCmp"]);

Route::group(['middleware' =>  [ 'auth:api','jwt.auth']], function () {
    
    Route::get('VisInfo',['uses'=>'ApiController@VisitorInfo']);

    Route::post('VisUpdate',['uses'=>'ApiController@VisitorUpdate']);

    Route::get('VisLogOut',['uses'=>'ApiController@VisitorLogOut']);

    Route::post('SaveRate',['uses'=>'ApiController@SaveRate']);

    Route::post('SaveOrder',['uses'=>'ApiController@SaveOrder']);

    Route::get('OrderAll/{limit}/{SortType}/{SortKey}',['uses'=>'ApiController@OrderAll']);

    Route::get('OrderOne/{OrderId}',['uses'=>'ApiController@OrderOne']);

    Route::post('NotifAll',['uses'=>'ApiController@NotifAll']);

    Route::post('MessageAll',['uses'=>'ApiController@MessageAll']);

    Route::post('SaveRateCmp',['uses'=>'ApiController@SaveRateCmp']);

    Route::post('SaveCommentCmp',['uses'=>'ApiController@SaveCommentCmp']);

    Route::get('CmpRateAll/{limit}/{CmpId}',['uses'=>'ApiController@CmpRateAll']);

    Route::get('CmpCommentAll/{limit}/{CmpId}',['uses'=>'ApiController@CmpCommentAll']);
    
});

Route::group(['middleware' => ['auth:apiCompany','jwt.auth']], function () {

    Route::post('SaveService',['uses'=>'ApiController@SaveService']);

    Route::post('NotifAll',['uses'=>'ApiController@NotifAll']);

    Route::post('MessageAll',['uses'=>'ApiController@MessageAll']);
    
});




