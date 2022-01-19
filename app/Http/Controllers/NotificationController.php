<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\NotificationPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class NotificationController extends Controller
{
    /**
     * Update Notification Setting
     *
     * @param Request $request
     * @return void
     */
    public function updateNotificationSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_uuid'                  => 'required|exist:users,uuid',
            'enable_email_notifications' => 'required|in:1,0',
            'enable_push_notifications'  => 'required|in:1,0',
            'enable_sms_notifications'   => 'requireds|in:1,0',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $uuid = (isset($request->user_uuid) && ($request->user_uuid != ''))? $request->user_uuid : $request->user()->profile->uuid;
        $profile = User::where('uuid', $uuid)->first();
        if(null == $profile){
            return sendError('Invalid or Expired information provided', []);
        }

        $result = NotificationPermission::updateSetting($request, $profile->id);
        if(!$result['status']){
            sendError('Something went wrong while updating Notification Permission', []);
        }
        $model = $result['data'];

        $data['notification_permissions'] = $model;
        return sendSuccess('Success', $data);
    }

    public function readNoti(Request $request){

        $validator = Validator::make($request->all(), [
            'notification_id' => 'exist:notifications,id',
        ]);

        $read_notiffications = notification::where('id',$request->notification_id)->where('is_read', '0')->update(['is_read' => '1']);

        return sendSuccess("User Notifications",$read_notiffications);


    }

    public function getNotifications(Request $request){


        $validator = Validator::make($request->all(), [
            'user_uuid' => 'exist:users,uuid',
        ]);

            if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user_id = user::where('uuid',$request->user_uuid)->first()->id ?? $request->user()->id;
        if(null == $user_id)
            return sendError('User Dont Exists',[]);

        $limit = null;
        if($request->limit){
            $limit = $request->limit;
        }

        if($limit){
            $notifications = Notification::where('receiver_id', $user_id)->with('sender')->latest()->take($limit)->get();
        }else{
            $notifications = Notification::where('receiver_id', $user_id)->with('sender')->latest()->get();
        }

        $notifications = $notifications->sortByDesc('created_at');

        $data['notifications'] = $notifications;

        return sendSuccess("User Notifications", $data);
    }

    // Needs to Update According to Sellx
    public function addNotification($sender_id, $receiver_id, $type_id, $noti_type, $noti_text, $noti_message,  $is_send_noti , $bo = false){


        $check = Notification::where('sender_id', $sender_id)->where('type_id', $type_id)->where('noti_type', $noti_type)->where('receiver_id', $receiver_id)->latest()->first();
        // dd($sender_id, $receiver_id, $type_id, $noti_type, $noti_text, $is_send_noti, $noti,  $bo = false, $check);

        if($check != null){
            if($sender_id == $receiver_id){
                return false;
            }
        }

        $noti = new Notification;
        $noti->sender_id   = $sender_id;
        $noti->receiver_id = $receiver_id;
        $noti->type_id     = $type_id;
        $noti->noti_type   = $noti_type;
        $noti->noti_text   = $noti_text;
        $noti->noti_message   = $noti_message ?? null;
        $noti->save();

        $sender_profile = User::where('id', $sender_id)->first();

        $noti = Notification::find($noti->id);
            // $noti = $noti->getAttributes();

	if($is_send_noti){
            $this->sendPushNotification([$receiver_id],$noti_text, $noti);
        }
        return $noti;
    }

    // Needs to Update According to Sellx
    public function sendPushNotification($ids, $text, $data){
        $filters = [];
        foreach ($ids as $i => $id){
            if($i > 0)
                array_push($filters, ["operator" => "OR"]);
            array_push($filters, ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => $id]);
        }

        Log::info($filters);

        $content = array(
            "en" => $text
        );

        $att1 = str_replace(':','=>', $data);

        $fields = array(
            'app_id' => config('onesignal.app_id'),
            //'included_segments' => array('Active Users'),
            'filters' => $filters,
            'data' => array("data" => array($att1)),
            'contents' => $content
        );

        $fields = json_encode($fields);

        Log::info($fields);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.config('onesignal.rest_api_key')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	// Log::info($ch);
        $response = curl_exec($ch);
        curl_close($ch);


	Log::info(config('onesignal.rest_api_key'));
        Log::info('NotificationsController => function sendPushNotification');
        Log::info($response);


        // dd($response);
        return $response;
    }

    public function getNotificationsPermission(Request $request){
        $profile_id = (isset($request->profile_id) && ($request->profile_id != ''))? $request->profile_id : $request->user()->profile->id;

        $notificationPermissions = NotificationPermission::where('profile_id' ,$profile_id)->first();

        $data['notification_permissions'] = $notificationPermissions;

        return sendSuccess("User Notifications Permissions", $data);
    }

    public function getUnreadNotificationsCount(Request $request){

        // $validator = Validator::make($request->all(), [
        //     'user_uuid' => 'exist:users,uuid',
        // ]);

        // if ($validator->fails()) {
        //     $data['validation_error'] = $validator->getMessageBag();
        //     return sendError($validator->errors()->all()[0], $data);
        // }

        $user_id = user::where('uuid',$request->user_uuid)->first()->id??$request->user()->id;
        // dd($request->all(), $user_id);

        $unreadCount = Notification::whereRaw("id IN (SELECT id FROM notifications WHERE is_read = 0 and receiver_id = {$user_id})")->count();
        // $unreadCount = Notification::where('is_read', 0)->where('receiver_id', $user_id)->count();

        $data['unreadCount'] = $unreadCount;

        return sendSuccess("Notification Unread Counts.", $data);
    }


}
