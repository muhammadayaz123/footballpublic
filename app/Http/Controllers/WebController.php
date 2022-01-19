<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\Post;
use App\Models\User;
use App\Models\Block;
use App\Models\ChatBox;
use App\Models\AdminMeta;
use App\Models\ChatMember;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\InvitationController;

class WebController extends Controller
{

    private $authApiCntrl;
    private $profileApiCntrl;
    private $mediaApiCntrl;
    private $invitationApiCntrl;
    private $stadiumApiCntrl;
    private $ratingApiCntrl;
    private $favoriteController;
    private $chatApiCntrl;
    private $notificationController;

    public function __construct(
                        AuthController $authApiCntrl,
                        ProfileController $profileApiCntrl,
                        InvitationController $invitationController,
                        MediaController $mediaApiCntrl,
                        InvitationController $invitationApiCntrl,
                        StadiumController $stadiumApiCntrl,
                        RatingController $ratingApiCntrl,
                        FavoriteController $favoriteController,
                        ChatsController $chatApiCntrl,
                        NotificationController $notificationController
                        )
    {
        $this->authApiCntrl         = $authApiCntrl;
        $this->invitationController = $invitationController;
        $this->profileApiCntrl      = $profileApiCntrl;
        $this->mediaApiCntrl        = $mediaApiCntrl;
        $this->invitationApiCntrl   = $invitationApiCntrl;
        $this->stadiumApiCntrl      = $stadiumApiCntrl;
        $this->ratingApiCntrl       = $ratingApiCntrl;
        $this->favoriteController   = $favoriteController;
        $this->chatApiCntrl         = $chatApiCntrl;
        $this->noti                 = $notificationController;
    }

    public function signup(Request $request)
    {
        if($request->getMethod() == 'GET')
            return view('auth.signup');

        $request->merge([
            'is_twilio'     => 1,
            // 'is_email'      => 1,
            'favorite_club' => $request->favouriteclub,
            'phone_number'  => $request->phone_no,
            'dob'           => $request->date_of_birth,
            'is_social'     => 0,
        ]);



        if(isset($request->media) &&  ('' !== $request->media))
        {
            $profile_image = $this->mediaApiCntrl;
            $apiResponseMedia = $profile_image->uploadMedias($request, 'media', 'profile_image')->getData();
            // dd($apiResponseMedia);
            $Image_path = null;
            if($apiResponseMedia->status ) {
                $Image_path = $apiResponseMedia->data['0']->path;
            }

            $request->merge([
                'profile_image' => $Image_path,
            ]);
        }

            $authCntrl = $this->authApiCntrl;
            $apiResponse = $authCntrl->signup($request)->getData();

            if($apiResponse->status)
            {
                // return redirect()->route('login')->with('message', 'Signup done Successfully');

                return sendSuccess('Signup done successfully', $apiResponse->data);

            }

            return sendError('Something went wrong', $apiResponse->message, 422);

            // return redirect()->back()->with('error', $apiResponse->message)->withInput();


    }

    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET')
            return view('auth.login');

        $authCntrl = $this->authApiCntrl;
        $apiResponse = $authCntrl->login($request)->getData();
        // dd($apiResponse);

        if ($apiResponse->status)
        {
            return sendSuccess('Login successfully', $apiResponse->data);
        }
        return sendError('Invalid Password', [],422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');

    }



    public function home(Request $request, $position = null)
    {

        if(isset($position)) {

            $request->merge([
                'position' => $position,
            ]);

        }
        if (isset($request->total_min_rating) && (isset($request->total_max_rating)))
        {
            $total_rating = $request->total_max_rating - $request->total_min_rating;

            $request->merge([
                'total_rating' => $total_rating,
                'min' => $request->total_min_rating,
                'max' => $request->total_max_rating
            ]);


            $filterRating = $this->profileApiCntrl;
            $apiResponseFilteringRating = $filterRating->getFilterRating($request)->getData();
            // dd($apiResponseFilteringRating);

            if($apiResponseFilteringRating->status)
            {
                $filterRating = $apiResponseFilteringRating->data->ratings;

                return view('index', ['position' => $position, 'filterRating' => $filterRating]);
            }
        }

        if (isset($request->min_price) && (isset($request->max_price)))
        {
            $total_price = $request->max_price - $request->min_price;

            // dd($request->all(), $total_price);
            $request->merge([
                // 'price' => $total_price,
                'min_price' => $request->min_price,
                'max_price' => $request->max_price
            ]);

            $filterRating = $this->profileApiCntrl;
            $apiResponseFilteringRating = $filterRating->getFilterRating($request)->getData();
            // dd($apiResponseFilteringRating);

            if ($apiResponseFilteringRating->status) {
                $filterRating = $apiResponseFilteringRating->data->ratings;

                return view('index', ['position' => $position, 'filterRating' => $filterRating]);
            }

        }

        if(isset($request->lat1) && isset($request->long1)){

            $locationFilter = $this->profileApiCntrl;
            $apilocationFilter = $locationFilter->getFilterLocation($request)->getData();

            // dd($apilocationFilter);

            if ($apilocationFilter->status) {
                $filterRating = $apilocationFilter->data->location_filter;
                //  dd($filterRating);
                return view('index', ['position' => $position, 'filterRating' => $filterRating ]);
            }
        }

        $getUser = $this->profileApiCntrl;
        $apiResponseGetUser = $getUser->getUser($request)->getData();

        if ($apiResponseGetUser->status ) {
            $allUser = $apiResponseGetUser->data;

            return view('index', ['allUsers' => $allUser, 'position' => $position]);
        }
    }


    public function playersByLocation(Request $request)
    {
        $locationFilter = $this->profileApiCntrl;
        $apilocationFilter = $locationFilter->showFilterLocation($request);
        // dd($apilocationFilter);
        if ($apilocationFilter['status'] == 'success') {
            $filterLocation = $apilocationFilter['0'];

            return sendSuccess('Players by location', $filterLocation);

            // return view('index', ['position' => $position, 'filterRating' => $filterRating]);
        }
    }


    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $updateProfile = $this->profileApiCntrl;
        $request->merge([
            'profile_uuid' => Auth::user()->profile->uuid,
        ]);


        if(isset($request->media) && (' ' !=$request->media))
        {
            // dd($request->all(), "123");

            $profile_image = $this->mediaApiCntrl;
            $apiResponseMedia = $profile_image->uploadMedias($request, 'media', 'profile_image')->getData();
            // dd($apiResponseMedia);
            $Image_path = null;
            if ($apiResponseMedia->status) {
                $Image_path = $apiResponseMedia->data['0']->path;
            }
            // dd($Image_path);

            $request->merge([
                'profile_image' => $Image_path,
            ]);
        }
        else {
            $Image_path = Auth::user()->profile->profile_image;
            $request->merge([
                'profile_image' => $Image_path,
            ]);
        }

        // dd($request->all(), "oka");

        $apiResponseGetUser = $updateProfile->updateProfile($request)->getData();
        if ($apiResponseGetUser->status) {
            // return redirect()->back()->with('update_Profile', 'Profile updated Successfully');

           return sendSuccess('Profile updated successfully', []);
        }
        return sendError(' Fail to update', null);
        // return redirect()->back()->with('error_update_Profile', 'Profile updated Successfully');

    }

    // update password
    public function updateForgotPassword(Request $request)
    {
        $updatePassword = $this->authApiCntrl;

        // dd($request->all());

        $apiResponse = $updatePassword->updatePassword($request)->getData();
        // dd($apiResponse);
        if ($apiResponse->status) {
            return sendSuccess('Email accepted ', []);
        }
        return sendError('Incorrect Email', null);
    }


    // update password
    public function updatePassword(Request $request)
    {
        $updatePassword = $this->authApiCntrl;

        // dd($request->all());

        $apiResponse = $updatePassword->updatePassword($request)->getData();
        // dd($apiResponse);
        if ($apiResponse->status) {
            return sendSuccess('Email accepted ', []);
        }
        return sendError('Internal Server Error, fail to update', null);
    }

    //validate reset password code
    public function validateResetPasswordCode(Request $request)
    {
        // dd($request->all());
       $request->merge([
           'code' => $request->activation_code,
       ]);

       $activation_code = $this->authApiCntrl;
        $apiResponse = $activation_code->validateCode($request)->getData();
        if ($apiResponse->status) {
            return sendSuccess('Code accepted ', $apiResponse->data);
        }
        return sendError(' Invalid code ', null);
    }


    public function validateCode(Request $request)
    {
        $request->merge([
            'code' => $request->activation_code,
            'phone_code' => $request->activation_code,
        ]);
        // dd($request->all(), $request->code);

        $activation_code = $this->authApiCntrl;
        $apiResponse = $activation_code->validateCode($request)->getData();
        // dd($apiResponse);
        if ($apiResponse->status) {
            return sendSuccess('Code accepted ', $apiResponse->data);
        }
        return sendError(' Invalid code ', null);
    }

    // update new password without auth
    public function updateNewResetPassword(Request $request)
    {
        $email = Auth::user()->email ?? $request->email;

        $request->merge([
            'code' => $request->code_hdn,
            'email' => $email,
        ]);
        // if(null == $email)


        // dd($request->all());
        $updateNewPassword = $this->authApiCntrl;
        $apiResponse = $updateNewPassword->updateNewPassword($request)->getData();
        if ($apiResponse->status) {
            return sendSuccess('Password updated successfully  ', []);
        }
        return sendError(' Invalid Error ', null);
    }


    public function updateNewPassword(Request $request)
    {
        $email = Auth::user()->email ?? $request->email;

        $request->merge([
            'code' => $request->code_hdn,
            'email' => $email,
        ]);
        // if(null == $email)


        // dd($request->all());
        $updateNewPassword = $this->authApiCntrl;
        $apiResponse = $updateNewPassword->updateNewPassword($request)->getData();
        if ($apiResponse->status) {
            return sendSuccess('Password updated successfully ', []);
        }
        return sendError(' Invalid Error ', null);
    }


    public function updateEmail(Request $request)
    {
        $updateEmail = $this->authApiCntrl;

        $apiResponse = $updateEmail->createNewEmail($request)->getData();
        // dd($apiResponse);
        if ($apiResponse->status) {
            return sendSuccess('Code send successfully', []);
        }
        return sendError('Incorrect password', null);
    }

    public function createNewEmail(Request $request)
    {
        $request->merge([
            'code' => $request->code_hdn_email,
        ]);

        // dd($request->all());
        $createNewEmail = $this->authApiCntrl;
        $apiResponse = $createNewEmail->updateNewEmail($request)->getData();
        if ($apiResponse->status) {

            return sendSuccess('Email updated successfully ', []);
        }

        return sendError(' Invalid Error ', null);
    }



    //Invitaions

    public function getInvitations($uuid = null, $type = null, Request $request){

        // $apiResponse = $this->invitationController->getInvitation($request)->getData();
        $getInvitation = $this->invitationApiCntrl;
        $apiResponse = $getInvitation->getInvitation($request)->getData();
        // dd($apiResponse);

        if ($apiResponse->status) {

            $invitations = $apiResponse->data->invitations;

            if (isset($request->date) && (' ' != $request->date)) {
                $date = $request->date;
                // dd(Carbon::parse($format_date)->format('d M Y'));
                // $invitations = $apiResponse->data->invitations;

            }
            // dd($type);

            if(isset($type) && $type != null && $type != '')
            {
                // dd($type);
                Notification::where('receiver_id',Auth::User()->id)->where('type_id', $type)->update(['is_read' => 1]);


            }

            return view('game_invitation', [ 'invitations' => $invitations, 'date' => $date ?? '' ]);
        }



    }

    public function changeStatus($uuid, $status){

        $request = new Request();

        $request->merge([
            'invitation_uuid' => $uuid,
            'status' => $status
        ]);

        $response = $this->invitationController->updateInvitation($request)->getData();

        return redirect()->back();

    }

    public function cancelInvitation($uuid = null, Request $request)
    {
        $request->merge([
            'invitation_uuid' => $request->invitation_uuid,
        ]);

        // dd($request->all());
        $response = $this->invitationController->cancelInvitation($request)->getData();
        if($response->status)
        {
            return sendSuccess('Invitation has been cancelled successfully ', []);
        }
        return sendSuccess('Internal Server Error ', []);

        // dd($response);
    }


    public function updatePhoneNo(Request $request)
    {

        $request->merge([
            'old_phone' => $request->phone_number,
            'new_phone' => $request->new_phone_number,
            'phone_code' => '+92',
        ]);

        // dd($request->all());

        $createNewPhoneCode = $this->authApiCntrl;
        $apiResponse = $createNewPhoneCode->updatePhoneNumber($request)->getData();
        if ($apiResponse->status) {
            if($apiResponse->message == 'code')
            {
                // dd('code', $apiResponse->data);
                return sendSuccess('Phone code send  successfully ', $apiResponse->data);
            }
            // dd('not code');

            return sendSuccess('Phone Number updated  successfully ', []);

        }
        return sendError('Incorrect password ', null);
    }

    public function getUserProfile(Request $request)
    {
        $user = Auth::user()->uuid;
        $uuid = Auth::user()->profile->uuid;
        $id = Auth::user()->profile->id;

        $request->merge([
            'user_uuid' => $user,
            'profile_uuid' => $uuid,
            'profile_id' => $id,
        ]);

        // $date = Carbon::now();
        // $date->formatLocalized('%B');

        // dd($request->all(), $date->formatLocalized('%B'));

        $userProfile = $this->profileApiCntrl;
        $apiResponse = $userProfile->getUser($request)->getData();

        $getPost = $this->mediaApiCntrl;;
        $apiResponsePost = $getPost->getPost($request)->getData();

        $getRatingSum = $this->ratingApiCntrl;;
        $apiResponseRating = $getRatingSum->ratingSum($request)->getData();


        $share = \Share::page(
            'https://makitweb.com/datatables-ajax-pagination-with-search-and-sort-in-laravel-8/'
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();

        // $comment = AdminMeta::orderBy('created_at', 'desc')->first();
        // $comment_length = $comment->post_comment_length ?? '5';
        // dd($comment_length);

        if ($apiResponse->status  && $apiResponsePost->status) {
            $profile = $apiResponse->data;
            $postProfile = $apiResponsePost->data;
            $profileRating = $apiResponseRating->data;
            return view('user_profile', [
                'userProfile' => $profile ,
                'postProfile' =>$postProfile,
                'share' => $share ,
                'rating' => $profileRating ,
                'comment_length'=> $comment_length ?? '',
                'video_comment_lenght' => $comment_length ?? ''
            ]);
        }
    }

    //others profile
    public function othersProfile($user_uuid, $profile_uuid, $id, Request $request)
    {

        $request->merge([
            'user_uuid' => $user_uuid,
            'profile_uuid' => $profile_uuid,
            'profile_id' => $id,
        ]);

        $userProfile = $this->profileApiCntrl;
        $apiResponse = $userProfile->getUser($request)->getData();

        $getPost = $this->mediaApiCntrl;;
        $apiResponsePost = $getPost->getPost($request)->getData();

        $getRatingSum = $this->ratingApiCntrl;;
        $apiResponseRating = $getRatingSum->ratingSum($request)->getData();

        $share = \Share::page(
            'https://makitweb.com/datatables-ajax-pagination-with-search-and-sort-in-laravel-8/'
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();

        $comment = AdminMeta::orderBy('created_at', 'desc')->first();
        $comment_length = $comment->post_comment_length ?? '5';


        if ($apiResponse->status  && $apiResponsePost->status) {
            $profile = $apiResponse->data;
            $postProfile = $apiResponsePost->data;
            $profileRating = $apiResponseRating->data;
            return view('others_profile', ['userProfile' => $profile, 'postProfile' => $postProfile, 'share' => $share,'rating' => $profileRating, 'comment_length' => $comment_length, 'video_comment_length' => $comment_length]);
        }
    }



    public function userMedia(Request $request)
    {
        $media = $request->media;
        $type = $media->getClientOriginalExtension();


        $uuid = Auth::user()->profile->uuid;


        $video_xtensions = ['flv', 'mp4', 'mpeg', 'mkv', 'avi'];
        $image_xtensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp'];
        $doc_xtensions   = ['pdf'];

        if(in_array($type, $video_xtensions))
        {
            $type = 'video';
        }
        else if(in_array($type, $image_xtensions))
        {
            $type = 'photo';

        }
        else if(in_array($type, $doc_xtensions))
        {
            $type = 'pdf';
        }
        else {
            return redirect()->back()->with('error', 'Invalid media format');
        }
        // dd($request->all(), $type);

        $request->merge([
            'type' => $type,
            'profile_uuid' => $uuid,
        ]);
        // dd($request->all(), $type);

        // dd($type);
        $media = $this->mediaApiCntrl;
        $apiResponse = $media->uploadPost($request)->getData();
        // dd($apiResponse);
        if($apiResponse->status)
        {
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Invalid media format');

    }

    public function getUserMediaPost(Request $request)
    {

        $getPost = $this->mediaApiCntrl;;
        $apiResponse = $getPost->getPost($request)->getData();

        if($apiResponse->status)
        {
            return sendSuccess('media comment', $apiResponse->data);
        }
        return sendError(' Invalid Error ', null);

    }

    public function postComment(Request $request)
    {
        // dd($request->all());
        $profile_uuid = Auth::user()->profile->uuid;

        $request->merge([
            'profile_uuid' => $profile_uuid,
        ]);

        // dd($request->all());

        $apiResponse = $this->mediaApiCntrl->postComment($request)->getData();
        // dd($apiResponse);

        if ($apiResponse->status) {
            $comment_data = $apiResponse->data;
            $date = $apiResponse->data->comment->created_at;
            $comment_date = Carbon::parse($date)->diffForHumans();

            $comment_time = Carbon::parse($date)->format('g:i a');

            // dd($apiResponse->data, $date, $comment_date, $comment_time);
            $data['response'] =  $comment_data;
            $data['comment_date'] =  $comment_date;
            $data['comment_time'] =  $comment_time;


            return sendSuccess('Post Comment Successfully', $data);
        }
        return sendError('Something went wrong', null);


    }


    //send Invitation
    public function getSignleUser($uuid, Request $request)
    {
        if($request->getMethod() == 'GET')
        {

            $request->merge([
                'user_uuid' =>$uuid,
                'profile_id' => Auth::user()->profile->id,
            ]);
            // dd($request->all());
            $profile = $this->profileApiCntrl;;

            $apiResponse = $profile->getUser($request)->getData();

            $allUserStadiums = $this->stadiumApiCntrl;
            $apiResponseGetStadium = $allUserStadiums->userStadiums($request)->getData();
            // dd($apiResponseGetStadium, Auth::user()->profile->id, Auth::user()->id);
            if ($apiResponse->status || $apiResponseGetStadium->status) {
                $user = $apiResponse->data;
                $userStadiums = $apiResponseGetStadium->data;
                return view('home_send_invitation', ['user' => $user, 'userStadiums' => $userStadiums]);
            }
        }


        // dd($request->all(), $uuid);

        // $hours = $request->select_hours;
        // $mins = $request->select_mins;
        // $am_pm = $request->select_am_pm;
        $date = $request->date;

        $time = $request->invitation_time;

        $now =  date("Y-m-d");
        if($date < $now) {

            return redirect()->back()->with('invitation_error', 'you cant not select previous date');
        }

        // $time = $hours . ':' . $mins . ' ' . $am_pm;

        // $time_in_24_hour = date("H:i:s", strtotime($time));

        // $date_time =  $date. ' ' .$time_in_24_hour;
        $date_time =  $date . ' ' . $time;

        // dd($request->all(), $date_time, $time, $time_in_24_hour);

        $request->merge([
            'host_uuid' => Auth::user()->profile->uuid,
            'date_time' => $date_time,
            'price'         => $request->price,
            'commission' => $request->discount,
            'total' => $request->subtotal,
            'user_uuid' => $uuid,
        ]);

        // dd($request->all(),$uuid);
        $sendInvitation = $this->invitationApiCntrl;
        $apiResponse = $sendInvitation->updateInvitation($request)->getData();
        // dd($apiResponse);

        $getNotiCount = $this->noti->getUnreadNotificationsCount($request)->getData();
        // dd($getNotiCount);


        // dd($apiResponse);
        if ($apiResponse->status) {
            $notiData = $getNotiCount->data;
            // Session::flash('message', 'Author has been successfully added');
            // return redirect()->route('home')->with('success_invitation', 'Invitation send Successfully');
            return sendSuccess('Invitation send Successfully', [$notiData, $uuid]);

        }
        // return sendError(' Invalid Error ', null);
        // return redirect()->back()->with('invitation_error', $apiResponse->message);

        return sendError('Invitation did not send Successfully', null);



    }

    public function addNewStadium(Request $request)
    {
        // dd($request->all());
        $newStadium = $this->stadiumApiCntrl;
        $apiResponse = $newStadium->updateStadium($request)->getData();
        // dd($apiResponse);
        if ($apiResponse->status) {
            return sendSuccess('Stadium Added Successfully', $apiResponse->data);
        }
        return sendError(' Invalid Error ', null);
    }


    public function acceptRejectInvitation(Request $request)
    {
        if(isset($request->host_user_uuid) && (' ' !=$request->host_user_uuid))
        {
            $user_uuid = $request->host_user_uuid;
        }
        // dd($request->all());

        $updateInvitation = $this->invitationApiCntrl;
        $apiResponse = $updateInvitation->updateInvitation($request)->getData();

        $getNotiCount = $this->noti->getUnreadNotificationsCount($request)->getData();

        if($apiResponse->status)
        {
            $notiData = $getNotiCount->data;

            return sendSuccess('Status Updated Successfully', [$notiData, $user_uuid ?? '']);
        }
        return sendError(' Invalid Error ', null);
    }

    public function hirePlayer($uuid = null, $type = null, Request $request)
    {

        $getInvitation = $this->invitationApiCntrl;
        $apiResponse = $getInvitation->getHirePlayer($request)->getData();
        // dd($apiResponse);

        if ($apiResponse->status) {
            $invitations = $apiResponse->data;
            // $invitations = $apiResponse->data->invitations;
            // $invitations_by_hour = $apiResponse->data->invitations_by_hour;
            // dd($invitations, $invitations_by_hour);

            if(isset($request->date) && (' ' !=$request->date))
            {
                $date = $request->date;

            }

            if (isset($type) && $type != null && $type != '') {
                // dd($type);
                Notification::where('receiver_id', Auth::User()->id)->where('type_id', $type)->update(['is_read' => 1]);
            }


            return view('hire_player', ['invitations' => $invitations, 'date' => $date ?? '']);
        }
    }

    public function ratedPlayer( Request $request)
    {
        // dd($request->all());
        $rated = $this->ratingApiCntrl;
        $apiResponse = $rated->getRating($request)->getData();
        // dd($apiResponse);
        if ($apiResponse->status == true) {
            return sendSuccess('Player Already Rated', $apiResponse->data);
        }
        else {
            return sendSuccess('No Rating Yet', null);
        }
    }


    //rate player
    public function ratePlayer($uuid,$invitation_id, Request $request)
    {
        if($request->getMethod() == 'GET')
        {
            // dd('ok', $uuid);
            $request->merge([
                'profile_uuid' => $uuid,
                'invitation_id' => $invitation_id
            ]);
            // dd($request->all());

            $userRating = $this->profileApiCntrl;
            $apiResponse = $userRating->getProfile($request)->getData();
            if($apiResponse->status)
            {
                $userRate = $apiResponse->data;
                return view('rate_player', ['uuid'=> $uuid, 'invitation_id'=> $invitation_id,  'userRate'=>$userRate]);
            }
        }

        // dd('DumpMan');

        $request->merge([
            'player_uuid' => $uuid,
            'rater_uuid' => Auth::user()->profile->uuid,
            'appearance' => 0,
            'invitation_id' => $invitation_id
        ]);

        // dd($request->all());


        $rating = $this->ratingApiCntrl;
        $apiResponse = $rating->updateRating($request)->getData();
        // dd($apiResponse);
        if ($apiResponse->status) {
            return sendSuccess('Rated done Successfully', $apiResponse->data);
            // return redirect()->route('hirePlayer');
        }
    }

    public function favorite($uuid, $is_favorite = null, Request $request){

        // dd($request->all());
        $request->merge([
            'profile_uuid' => Auth::User()->profile->uuid,
            'player_uuid'  => $uuid,
            'is_favorite'  => $is_favorite,
        ]);

        $apiResponse = $this->favoriteController->toggleFavorite($request)->getData();

        return redirect()->back();

    }

    public function favoritePlayers(Request $request){

        $apiResponse = $this->favoriteController->getFavorite($request)->getData();

        return view('favorite_player',['allUsers' => $apiResponse->data ]);
    }

    // like post
    public function likePost(Request $request)
    {
        $profile_uuid = Auth::user()->profile->uuid;

        $request->merge([
            'profile_uuid' => $profile_uuid,
        ]);

        // dd($request->all());

        $apiResponse = $this->mediaApiCntrl->postLike($request)->getData();
        // dd($apiResponse);

        if ($apiResponse->status) {
            return sendSuccess('Status Updated Successfully', $apiResponse->data);
        }
        return sendError('Something went wrong', null);
    }


    // delete post
    public function deletePost(Request $request)
    {
        $profile_id = Auth::user()->id;

        $request->merge([
            'profile_id' => $profile_id,
        ]);

        // return sendSuccess('ok', $profile_id);


        $apiResponse = $this->mediaApiCntrl->deletePost($request)->getData();
        // dd($apiResponse);

        if ($apiResponse->status) {
            return sendSuccess('Post deleted successfully', $apiResponse->data);
        }
        return sendError('Post did not delete successfully', null);
    }



    // chat start
    public function chat($uuid = null, $type = null, Request $request)
    {
        // dd($uuid, $type);
        if (isset($type) && $type != null && $type != '') {
            // dd($type);
            $chat_id = array();
            $chat_id[] = $type;
            Notification::where('receiver_id', Auth::User()->id)->whereIn('type_id', $chat_id)->update(['is_read' => 1]);
        }
        // else {
        //     $type = null;
        // }

        // dd(date('Y-m-d H:i:s'));
        $member_uuid = $uuid;
        // dd($request->all());
        // $user_uuid = Auth::user()->profile->uuid;
        // $profile_uuid = Auth::user()->profile->uuid;

        $user_uuid = $request->profile_uuid;
        $profile_uuid = $request->profile_uuid;

        $request->merge([
            'user_uuid' => $user_uuid,
            'member_uuid'  => $member_uuid,
            'profile_uuid' => $profile_uuid,
        ]);
                // dd($request->all());


        if($request->getMethod() == 'GET')
        {
            // dd($request->all());

            if(isset($member_uuid) && (''!= $member_uuid ) && ("null" != $member_uuid))
            {
                // dd($request->all(), "12/23");
                $request->merge([
                    // 'profile_uuid' => $member_uuid
                ]);
                $existingChat = $this->chatApiCntrl;
                $apiResponse = $existingChat->getExistingChat($request)->getData();
                // dd($apiResponse, $member_uuid, $apiResponse->data);

                if(null === $apiResponse->data)
                {
                    // dd($request->all(), 'asdasdas');
                    $chat = $this->chatApiCntrl;
                    $apiResponseChat = $chat->createChat($request)->getData();
                    // dd($apiResponseChat);

                    $request->merge([
                        // 'profile_uuid' => $profile_uuid
                    ]);

                    $existingChat = $this->chatApiCntrl;
                    $apiResponse = $existingChat->getExistingChat($request)->getData();

                    if ($apiResponseChat->status) {
                        $newChat = $apiResponseChat->data;
                        $isExistingChat = $apiResponse->data;

                        return view('chat', ['newChat' => $newChat, 'existingChat' => $isExistingChat , 'single_chat' => 0]);
                    }
                }
                else {
                    //    dd($apiResponse, "else part");
                    $request->merge([
                        // 'profile_uuid' => $profile_uuid,
                        // 'member_uuid' => $member_uuid
                    ]);

                    // dd($request->all(), "asdasdas", $member_uuid);

                    $existingChat = $this->chatApiCntrl;
                    $apiResponse = $existingChat->getExistingChat($request)->getData();
                    // dd($apiResponse->data, "asdasd", $member_uuid);



                    // if($apiResponse->data)

                    // $single_Member = "";


                    if ($apiResponse->status) {
                        $isExistingChat = $apiResponse->data;

                        foreach ($apiResponse->data as $data) {
                            // dd($data);
                            $user_chats = $data;
                            // dd($user_chats, $data);

                            foreach ($data->members as $key => $value) {
                                // dd($value);
                                if ($value->user->uuid == $member_uuid) {
                                // if ($value->user->uuid != Auth::user()->uuid) {
                                    // dd("found");
                                    $single_Member = $value;
                                }
                            }
                        }

                        return view('chat', ['existingChat' => $isExistingChat, 'single_chat' => 1, 'member_uuid' => $member_uuid, 'single_Member'=> $single_Member, 'user_chats'=> $user_chats]);
                    }
                }

            }
            if(isset($request->chat_uuid) && ('' !=$request->chat_uuid))
            {
                $request->merge([
                    'profile_uuid' => Auth::user()->profile->uuid,
                    'member_id' => $request->chat_member_id,
                ]);

                // $member =

                // dd($request->all(), "asdasdassqq22");

                $getMessages = $this->chatApiCntrl;
                $apiResponsegGetMessages = $getMessages->getChatMessages($request)->getData();
                // dd($apiResponsegGetMessages->data);

                $existingChat = $this->chatApiCntrl;
                $apiResponse = $existingChat->getExistingChat($request)->getData();
                // dd($apiResponse, "else");
                if ($apiResponse->status || $apiResponsegGetMessages->status ) {
                    $isExistingChat = $apiResponse->data;
                    $getMessagesUser = $apiResponsegGetMessages->data;

                    // return view('chat', ['existingChat' => $isExistingChat, 'getMessagesUser'=> $getMessagesUser]);
                   $data['isExistingChat'] =  $isExistingChat;
                   $data['getMessagesUser'] = $getMessagesUser;

                   return $data;
                }

            }




            $chatMembers = ChatMember::where('member_id',Auth::user()->profile->id)->pluck('chat_id')->toArray();
            // dd($chatMembers);
            $request->merge([
                'profile_uuid' =>Auth::user()->profile->uuid,
                'members_id' => $chatMembers
            ]);
            // dd($request->all());

            $existingChat = $this->chatApiCntrl;
            $apiResponse = $existingChat->getExistingChat($request)->getData();
            // dd($apiResponse, "else");
            if ($apiResponse->status) {
                $isExistingChat = $apiResponse->data;
                // dd($isExistingChat);
                // dd(now());
                $single_chat = 1;
                return view('chat', ['existingChat' => $isExistingChat, 'single_chat' => $single_chat, 'get_check'=> '1']);
                // return sendSuccess('get all chats', $isExistingChat);

                // return view('chat', ['existingChat' => $isExistingChat]);
            }
        }

        // dd($request->all(), '343');


        // // dd($request->all());
        // $chat = $this->chatApiCntrl;
        // $apiResponse = $chat->createChat($request)->getData();

        // $existingChat = $this->chatApiCntrl;
        // $apiResponseExistingChat = $existingChat->getExistingChat($request)->getData();

        // if ($apiResponse->status || $apiResponseExistingChat->status ) {
        //     $singleChat = $apiResponse->data;
        //     $isExistingChat = $apiResponseExistingChat->data;

        //     return view('chat', ['singleChat' => $singleChat, 'existingChat' => $isExistingChat]);
        // }
    }

    public function userChat(Request $request)
    {
        dd($request->data);
        return view('chat');
    }

    public function chatUnReadCount(Request $request)
    {
        $existingChat = $this->chatApiCntrl;
        $apiResponse = $existingChat->getChatMessages($request)->getData();
        if ($apiResponse->status) {
                return sendSuccess('un read chat count 0 ',[]);

        }

    }


    // send Message
    public function sendMessageToUser(Request $request)
    {

        $request->merge([
            'chat_uuid' => $request->chat_uuid,
        ]);
        if(isset($request->chat_message_id) && (' ' !=$request->chat_message_id))
        {
            $request->merge([
                'id' => $request->chat_message_id,
            ]);
        }

        if(isset($request->media2) && (' ' !=$request->media2))
        {
            $extension = pathinfo($request->media2, PATHINFO_EXTENSION);
            // dd($extension);
            $request->merge([
                'type' => $extension,
            ]);
        }

        // dd($request->all());

        $sendMessage = $this->chatApiCntrl;

        $apiResponse = $sendMessage->sendMessage($request)->getData();
        // dd($apiResponse);

        $request->merge([
            'profile_uuid' => Auth::user()->profile->uuid
        ]);

        $getChat = $this->chatApiCntrl;
        $apiResponseChat = $getChat->getFindChat($request)->getData();

        // dd($apiResponseChat);

        if ($apiResponse->status && $apiResponseChat->status) {

            return sendSuccess('Status Updated Successfully', [$apiResponse->data, $apiResponseChat->data]);
        }
        return sendError('Something went wrong', null);
    }

    // delete Message
    public function deleteUserMessage(Request $request)
    {

        // dd($request->all());



        $deleteMessage = $this->chatApiCntrl;

        $apiResponse = $deleteMessage->deleteMessage($request)->getData();
        // dd($apiResponse);

        if ($apiResponse->status) {
            return sendSuccess('Message deleted Successfully', $apiResponse->data);
        }
        return sendError('Something went wrong', null);
    }


    public function getNotifications(){

        // Notification::where('receiver_id',Auth::User()->id)->update(['is_read' => 1]);
        $noti  = Notification::where('receiver_id',Auth::User()->id)->latest()->get();

        // $user = User::where('id',Auth::User()->id)->first();
        // // dd($noti_result, $noti);
        // dd($noti);

        return $noti;

    }

    public function deleteChat(Request $request,$uuid)
    {
        $deleteChat = $this->chatApiCntrl;


        $request->merge([ 'chat_uuid' => $uuid ]);
        $apiResponse = $deleteChat->deleteChat($request)->getData();

        if ($apiResponse->status) {
            return redirect()->route('chat');
        }
    }


    // public function filterRating(Request $request)
    // {

    //     // dd($request->all());
    //    $filterRating =$this->profileApiCntrl;
    //    $apiResponse = $filterRating->getFilterRating($request)->getData();
    // //    dd($apiResponse->data->ratings);

    //    if($apiResponse->status)
    //    {
    //        $filterRating = $apiResponse->data->ratings;
    //         // return view('index', ['filterRating' => $filterRating]);
    //         return redirect()->back()->with(['filterRating' => $filterRating]);

    //     //    return view('ind')
    //    }
    // }


    public function getAllUsers(Request $request)
    {
        $allUser = $this->profileApiCntrl;
        $apiResponse = $allUser->getUser($request)->getData();

        if ($apiResponse->status) {
            $allUsers = $apiResponse->data;
            return view('all_users', ['allUsers' => $allUsers]);
        }
    }

    public function deleteUser(Request $request)
    {
        // dd($request->all());
        $deleteUser = $this->profileApiCntrl;
        $apiResponse = $deleteUser->deleteUser($request)->getData();

        if ($apiResponse->status) {
            return sendSuccess('User deleted successfully', []);
        }
        return sendError('User did not deleted', []);
    }

    public function allStadium(Request $request)
    {
        $allStadium = $this->stadiumApiCntrl;
        $apiResponse = $allStadium->getStadium($request)->getData();

        if ($apiResponse->status) {
            $allStadiums = $apiResponse->data;
            return view('all_stadiums', ['allStadiums' => $allStadiums]);
        }
    }

    public function settings(Request $request)
    {
        $comment = AdminMeta::orderBy('created_at', 'desc')->first();

        return view('admin_settings', ['comment' => $comment]);

    }

    public function setPostCommentLength(Request $request)
    {
        $set_comment = new AdminMeta();
        $set_comment->post_comment_length = $request->post_comment_length;
        $set_comment->save();
        return sendSuccess('Success', []);
        // return redirect()->route('admin_settings');
    }

    public function bankDetails(Request $request)
    {
        // dd($request->all() , json_encode($request->payment_method));

        $profile_id = Auth::user()->profile->id;
        $name  = Auth::user()->profile->username;
        $request->merge([
            'profile_id' => $profile_id,
            'card_holder_name' => $name,
        ]);


        $payment_method = array();

        if(isset($request->kent) && (' ' !=$request->kent))
        {
            $payment_method[] = $request->kent;
        }
        if (isset($request->credit) && (' ' != $request->credit)) {
            $payment_method[] = $request->credit;
        }
        if (isset($request->bookey) && (' ' != $request->bookey)) {
            $payment_method[] = $request->bookey;
        }
        if (isset($request->amex) && (' ' != $request->amex)) {
            $payment_method[] = $request->amex;
        }
        // dd($request->all(), json_encode($payment_method));

        $payment_method = json_encode($payment_method);

        $card = new Card;
        $card->profile_id = $profile_id;
        $card->card_holder_name = $name;
        $card->account_title_name = $request->account_name;
        $card->isdn_code = $request->isdn_code;
        $card->Ibn_no = $request->iban_no;
        $card->swift_code = $request->swift_code;
        $card->select_payment_type = $payment_method;
        $card->save();

          return sendSuccess('Bank Details have been saved', []);
        // return redirect()->route('payment')->with('success_bank_details', 'Bank Details have been saved');



    }


    public function blockPlayer(Request $request)
    {
        // dd($request->all());

        $blockPlayer = new Block;
        $blockPlayer->blocker_id = $request->blocker_id;
        if(isset($request->player_id)&& ('' != $request->player_id))
        {
            $blockPlayer->player_id = $request->player_id;

        }

        if(isset($request->post_id)&&('' != $request->post_id))
        {
            $blockPlayer->post_id = $request->post_id;

        }

        $blockPlayer->reason = $request->reason;

        $blockPlayer->save();

        return sendSuccess('Player is reported', []);
    }


    public function postViewsCount(Request $request)
    {
        // dd($request->all());
        $post_uuid = $request->post_uuid;
        // dd($post_uuid);
        $posts = Post::where('uuid', $post_uuid)->first();
        // dd($posts);
        $post_uuid = array($request->profile_ids);
        // dd($post_uuid);

        if($posts)
        {
            $meta_id = $posts->meta_ids;

            if($meta_id == null)
            {
                // dd("okasd");
                 $posts->meta_ids = $request->profile_ids. ',' ;
                $posts->view_count += 1;
                $posts->save();
                return $posts;
            }


            $total_meta_id = explode(",", $meta_id);

            if(in_array($request->profile_ids, $total_meta_id))
            {
                // dd("asdakaksd");
                return ;
            }
            else {
                // dd("23234");
                $posts->meta_ids .=  $request->profile_ids . ',';
                $posts->view_count += 1;
                $posts->save();
                return $posts;
            }
        }
        return false;
    }


    public function chatBoxSendMessage(Request $request)
    {

        // dd($request->all());

        // return sendSuccess ("ok", []);

        $chatBox = new ChatBox;
        $chatBox->uuid = Str::uuid();
        $chatBox->message = $request->message;
        $chatBox->user_type = Auth::user()->user_type == 'user' ? 'sender' : 'reciever';
        $chatBox->user_id = Auth::user()->id;
        $chatBox->save();

        return sendSuccess('chatbox send message ', $chatBox);
    }


}
