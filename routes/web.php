<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GeneralPageController;

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


Route::get('/index', function () {
    return view('layout.app');
});

// Route::get('/payment', function () {
//     return view('payment');
// })->name('payment');

// Route::get('/home', function () {
//     return view('index');
// });

Route::get('/favorite_player', function () {
    return view('favorite_player');
});

Route::get('/payment-now', function () {
    return view('pay_now');
})->name('payNow');


// Route::get('/game_invitation', function () {
//     return view('game_invitation');
// });



Route::get('/user_profile', function () {
    return view('user_profile');
});


// Route::get('/about-us', function () {
//     return view('about_us2');
// })->name('about_us2');

Route::get('/about-us', [GeneralPageController::class, 'aboutUs'])->name('aboutUs');


Route::get('/contact-us', function () {
    return view('auth.contact_us');
})->name('contact_us');



// Route::get('/help', function () {
//     return view('help');
// });

Route::get('/help',[GeneralPageController::class, 'help'])->name('help');


Route::get('/calander', function () {
    return view('calander');
});

Route::get('/home_send_invitation', function () {
    return view('home_send_invitation');
});


Route::get('/terms-and-conditions',[GeneralPageController::class, 'termsAndConditions'])->name('termsAndConditions');
// Route::get('/terms-and-conditions', function () {
//     return view('terms_and_condition');
// })->name('termsAndondition');


// Route::get('/terms-and-conditions', function () {
//     return view('terms_and_condition');
// })->name('termsAndondition2');


Route::get('/privacy-policy', function () {
    return view('privacy_policy');
})->name('privacyPolicy');


Route::group(['middleware' => 'guest'],function () {

    // web auth signup / login
    Route::any('signup', [WebController::class, 'signup'])->name('signup');

    Route::any('login', [WebController::class, 'login'])->name('login');


    // Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');


    //update forgot  password
    Route::any('update-forgot-password', [WebController::class, 'updateForgotPassword'])->name('updateForgotPassword');
    Route::any('validate-reset-code', [WebController::class, 'validateResetPasswordCode'])->name('validateResetPasswordCode');
    Route::any('update-new-reset-password', [WebController::class, 'updateNewResetPassword'])->name('updateNewResetPassword');

});


Route::group(['middleware' => 'auth'],function () {

    Route::get('/logout', [WebController::class, 'logout'])->name('logout');

    Route::any('home/{position?}', [WebController::class, 'home'])->name('home');


    Route::any('/', [WebController::class, 'home']);

    // Route::get('/about_us', function () {
    //     return view('about_us');
    // })->name('about_us');


    Route::get('/more', function () {
        return view('more');
    })->name('more');

    Route::get('/edit_profile', function () {
        return view('edit_profile');
    });

    // update profile
    Route::any('update-profile', [WebController::class, 'updateProfile'])->name('updateProfile');

    //update email
    Route::any('update-email', [WebController::class, 'updateEmail'])->name('updateEmail');
    Route::any('create-new-email', [WebController::class, 'createNewEmail'])->name('createNewEmail');


    //update password
    Route::any('update-password', [WebController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/code', [WebController::class, 'validateCode'])->name('validateCode');
    Route::any('update-new-password', [WebController::class, 'updateNewPassword'])->name('updateNewPassword');



    //invitation
    Route::get('/game_invitation/{uuid?}/{type?}', [WebController::class, 'getInvitations'])->name('game_invitation');
    Route::get('/game_invitation/{uuid}/{status}', [WebController::class, 'changeStatus'])->name('change_status');

    Route::any('/cancel-invitation/{uuid?}', [WebController::class, 'cancelInvitation'])->name('cancelInvitation');

    // update phone no
    Route::post('update-phone-no', [WebController::class, 'updatePhoneNo'])->name('updatePhoneNo');


    // user profile
    Route::get('user-profile', [WebController::class, 'getUserProfile'])->name('getUserProfile');


    // others profile
    Route::any('others-profile/{user_uuid}/{profile_uuid}/{id}', [WebController::class, 'othersProfile'])->name('othersProfile');


    //upload media
    Route::post('user-media', [WebController::class, 'userMedia'])->name('userMedia');

    // get post
    Route::get('user-media-post', [WebController::class, 'getUserMediaPost'])->name('getUserMediaPost');

    //post new comment
    Route::post('user-post-commment', [WebController::class, 'postComment'])->name('postComment');


    //send Invitation
    Route::any('/home_send_invitation/{uuid}', [WebController::class, 'getSignleUser'])->name('getSignleUser');

    // update stadium
    Route::post('add-new-stadium', [WebController::class, 'addNewStadium'])->name('addNewStadium');


    //accept or reject invitation
    Route::any('/accept-reject-invitation', [WebController::class, 'acceptRejectInvitation'])->name('acceptRejectInvitation');

    Route::any('/hire_player/{uuid?}/{type?}',[WebController::class, 'hirePlayer'])->name('hirePlayer');

    Route::get('/rated_player', [WebController::class, 'ratedPlayer'])->name('ratedPlayer');

    Route::any('/rate_player/{uuid}/{id}',[WebController::class, 'ratePlayer'])->name('ratePlayer');


    //favroute

    Route::get('/favroute/{uuid?}/{is_favorite?}',[WebController::class, 'favorite'])->name('favorite');
    Route::get('/favoriteplayer',[WebController::class, 'favoritePlayers'])->name('favoriteplayers');
    Route::get('/deletechat/{uuid?}',[WebController::class, 'deleteChat'])->name('deleteChat');


    // like post
    Route::any('/like-post', [WebController::class, 'likePost'])->name('likePost');

    //delete post
    Route::any('/delete-post', [WebController::class, 'deletePost'])->name('deletePost');

    //chat
    Route::any('/chat/{uuid?}/{type?}', [WebController::class, 'chat'])->name('chat');
    Route::post('send-message', [WebController::class, 'sendMessageToUser'])->name('sendMessageToUser');
    Route::any('/noti', [WebController::class, 'getNotifications'])->name('notifications');
    Route::get('delete-message', [WebController::class, 'deleteUserMessage'])->name('deleteUserMessage');

    //user chat
    Route::get('/get-user-chat', [WebController::class, 'userChat'])->name('userChat');


    // // filter rating
    // Route::any('filter-rating', [WebController::class, 'filterRating'])->name('filterRating');

    // admin routes
    Route::get('/admin', [WebController::class, 'getAllUsers'])->name('getAllUsers');
    Route::get('/admin/all-stadium', [WebController::class, 'allStadium'])->name('all_stadium');
    Route::get('/admin/settings', [WebController::class, 'settings'])->name('settings');

    Route::get('/admin/delete-user', [WebController::class, 'deleteUser'])->name('delete_user');

    Route::post('/admin/set-post-comment-length', [WebController::class, 'setPostCommentLength'])->name('set_post_comment_length');

    // update bank Details
    Route::post('/bank-details', [WebController::class, 'bankDetails'])->name('bank_details');

    //payment
    Route::get('/payment/{status?}/{invitation_uuid?}',[PaymentController::class, 'payment'])->name('payment');

    //is_played
    Route::post('/played/{uuid}', [PaymentController::class, 'isPlayed'])->name('is_played');


    Route::get('/payment-now/{uuid}',[PaymentController::class, 'paymentNow'])->name('pay_now');
    //send payment
    Route::post('/send-payment/{uuid}/{price}', [PaymentController::class, 'sendPayment'])->name('send_payment');


    Route::get('/block-player', [WebController::class, 'blockPlayer'])->name('block_player');






    // no of views in other profiles
    Route::get('post-views', [WebController::class, 'postViewsCount'])->name('postViewsCount');


    // chat box send message
    Route::post('/chat-box-message', [WebController::class, 'chatBoxSendMessage'])->name('chatBoxSendMessage');


    //set unread count 0
    Route::get('unread-count-messages', [WebController::class, 'chatUnReadCount'])->name('chatUnReadCount');


    // for getting users by getting location information

    Route::any('location', [WebController::class, 'playersByLocation'])->name('playersByLocation');


});
