<?php

use App\Http\Controllers\ChatsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StadiumController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([ 'prefix' => 'auth'], function () {

    Route::post('login'            , 'App\Http\Controllers\AuthController@login');
    Route::post('signup'           , 'App\Http\Controllers\AuthController@signup');

    Route::post('social_login'     , 'App\Http\Controllers\AuthController@socialLogin');
    Route::post('forgot_password'  , 'App\Http\Controllers\AuthController@forgotPasswordCode');
    Route::post('recover_password' , 'App\Http\Controllers\AuthController@recoverPassword');
    Route::post('verify_user'      , 'App\Http\Controllers\AuthController@verifyUserWithCode');

    Route::group([ 'middleware' => 'auth:api'], function() {

        Route::post('user'                   , 'App\Http\Controllers\AuthController@user');
        Route::get('logout'                  , 'App\Http\Controllers\AuthController@logout');
        Route::post('change_social_password' , 'App\Http\Controllers\AuthController@changeSocialLoginPassword');
        Route::post('change_phone_number' , 'App\Http\Controllers\AuthController@updatePhoneNumber');

        //upload media
        Route::post('upload_media'   , [MediaController::class , 'uploadMedias']);
        Route::post('upload_post'    , [MediaController::class , 'uploadPost']);
        Route::post('get_post'       , [MediaController::class , 'getPost']);
        Route::post('update_comment' , [MediaController::class , 'postComment']);
        Route::post('update_like'    , [MediaController::class , 'postLike']);

        //profile
        Route::post('get_user'       , [ProfileController::class , 'getUser']);
        Route::post('update_profile' , [ProfileController::class , 'updateProfile']);

        //Stadium
        Route::post('update_stadium' , [StadiumController::class, 'updateStadium']);

        //invitation
        Route::post('update_invitation' , [InvitationController::class, 'updateInvitation']);
        Route::post('get_invitation'    , [InvitationController::class, 'getInvitation']);

        //rating
        Route::post('update_rating' , [RatingController::class, 'updateRating']);
        Route::post('get_rating'    , [RatingController::class, 'getRating']);

        //chat
        Route::post('create_chat'          , [ChatsController::class,'createChat']);
        Route::post('get_chat_messages'    , [ChatsController::class,'getChatMessages']);
        //    Route::post('get_chat_media' , [ChatsController::class,'getChatMedia']);
        Route::post('send_message'         , [ChatsController::class,'sendMessage']);
        Route::post('get_chats'            , [ChatsController::class,'getChats']);
        Route::post('delete_chat'          , [ChatsController::class,'deleteChat']);
        Route::post('delete_message'       , [ChatsController::class,'deleteMessage']);
        Route::post('chat_new_users'       , [ChatsController::class,'getNewUsers']);
        Route::post('get_existing_chat'    , [ChatsController::class,'getExistingChat']);

        // Payment
        Route::post('get_payment', [PaymentHistoryController::class, 'getPayment']);
        Route::post('update_payment', [PaymentHistoryController::class, 'updatePayment']);

        //favroutes
        Route::post('toggle_favorite', [FavoriteController::class, 'toggleFavorite']);

    });

});
