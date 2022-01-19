<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Profile;
use App\Models\ChatMember;
use App\Models\ChatMessage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationPermission;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\NotificationController;

class ChatsController extends Controller
{
    private $noti;

    public function __construct(NotificationController $noti)
    {
        $this->noti   = $noti;
    }

    /**
     * Discard Media by URL
     *
     * @param Request $request
     * @return void
     */

    public function getFindChat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chat_uuid' => 'required|exists:chats,uuid',
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $chat = Chat::where('uuid',$request->chat_uuid)->with(['messages','members'])->get();

        return sendSuccess('Chat',$chat);

    }

    public function discardMediaByUrl(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'path' => 'required'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }
        // return sendSuccess('Success', null);

        // find media at local db
        // delete from local db
        $m = ChatMessage::where('file_path', 'LIKE', "%{$request->path}%")->orWhere('thumbnail', 'LIKE', "%{$request->path}%")->first();
        if(null != $m){
            $m->forceDelete();
            \Storage::disk('s3')->delete($request->path);
        }


        return sendSuccess('Success', null);

        // find media at aws server
        // delete media from aws server
    }


    public function createChat(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'member_uuid' => 'required|exists:profiles,uuid',
            'user_uuid'   => 'required|exists:profiles,uuid',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


        $user   = Profile::where('uuid',$request->user_uuid)->first();
        $to_add_member = Profile::where('uuid',$request->member_uuid)->first();

        if($user->id == $to_add_member->id)
            return sendError('Same user',[]);


        $user_chat_ids = ChatMember::where('member_id',$user->id)->pluck('chat_id');
        $member_chat = ChatMember::whereIn('chat_id',$user_chat_ids)->where('member_id',$to_add_member->id)->first();

        $chat = '';
        if(isset($member_chat->chat_id))
            $chat = Chat::where('id', $member_chat->chat_id)->first();

        if(NULL == $chat){

            $chat = new Chat;
            $chat->uuid = Str::uuid();
            $chat->admin_id = $user->id;
            $chat->type = 'single';
            $chat->save();


            $member = new ChatMember;
            $member->uuid = Str::uuid();
            $member->chat_id = $chat->id;
            $member->member_id = $to_add_member->id;
            $member->save();

            $member = new ChatMember;
            $member->uuid = Str::uuid();
            $member->chat_id = $chat->id;
            $member->member_id = $user->id;
            $member->save();
        }

        $data['chat'] = Chat::where('id', $chat->id)->with('members', function ($q) use($user){
            $q->where('member_id', '!=', $user->id)->with('user');
        })->first();


            return sendSuccess('Chat created successful.', $data);
    }

    // public function getExistingChat(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'profile_uuid' => 'required|exists:profiles,uuid',
    //     ]);

    //     if($validator->fails()){
    //         $data['validation_error'] = $validator->getMessageBag();
    //         return sendError($validator->errors()->all()[0], $data);
    //     }

    //     $profile = Profile::where('uuid',$request->profile_uuid)->first();

    //     $chat_member_ids = ChatMember::where('member_id',$profile->id)->pluck('chat_id')->toArray();

    //     // $get_chat_member_ids = ChatMember::where('member_id', $profile->id)->pluck('member_id')->toArray();

    //     if(!$chat_member_ids){
    //         return sendSuccess('No Existing Chat Found.', null);
    //     }

    //     // dd($chat_member_ids, $get_chat_member_ids, $profile->id );

    //     // $chat = Chat::whereIn('id',$chat_member_ids)->where('admin_id', Auth::user()->id)->with(['messages','members'])->get();
    //     $chat = Chat::whereIn('id', $chat_member_ids)->with(['messages', 'members'])->get();
    //     dd($chat);

    //     if(!$chat){
    //         return sendSuccess('No Existing Chat Found.', null);
    //     }

    //     return sendSuccess('Chat Found.', $chat);
    // }


    public function getExistingChat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_uuid' => 'required|exists:profiles,uuid',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $profile = Profile::where('uuid', $request->profile_uuid)->first();
        $profile_chats = ChatMember::where('member_id', $profile->id)->pluck('chat_id')->toArray();

        // dd($request->member_uuid);

        $member_id = null;
        // dd($request->member_id);
        if (isset($request->member_uuid) && (' ' != $request->member_uuid) && ("null" != $request->member_uuid)) {
        // if (isset($request->member_uuid) && (' ' != $request->member_uuid) ) {
        //     dd($request->member_uuid, $request->type);
        // dd($request->all());

            $member = Profile::where('uuid', $request->member_uuid)->first();
            $member_id = $member->id;

            $chat_member = ChatMember::whereIn('chat_id', $profile_chats)->where('member_id', $member_id)->first();

            if ($chat_member == null) {
                // dd('bnot');
                return sendSuccess('No Existing Chat Found.', null);
            }
        }

        if (isset($request->member_id) && (' ' != $request->member_id)) {
            $member_id = $request->member_id;

            $chat_member = ChatMember::whereIn('chat_id', $profile_chats)->where('member_id', $member_id)->first();

            if ($chat_member == null) {
                // dd('bnot');
                return sendSuccess('No Existing Chat Found.', null);
            }
        }

        // dd($request->all(), $profile->id, $request->members_id);


        // dd($profile_chats);
        // if(!$member_id)
        // {
        //     return sendSuccess('No Existing Chat Found.', null);
        // }


        // $chat_member = ChatMember::whereIn('chat_id', $profile_chats)->where('member_id', $member_id)->first();
        // $chat_member = ChatMember::whereIn('chat_id', $profile_chats)->where('member_id', $member_id)->pluck('chat_id')->toArray();
        // dd($profile_chats, $chat_member);

        // if ($chat_member == null) {
        //     return sendSuccess('No Existing Chat Found.', null);
        // }

        if(isset($request->members_id) && ($request->members_id))
        {
            // dd("ok");
            // dd($request->members_id);
            $members_ids = $request->members_id;
            $chat_members = ChatMember::whereIn('chat_id', $profile_chats)->whereIn('member_id', $members_ids)->get();
            // dd($chat_members);
            if (!$chat_members) {
                return sendSuccess('No Existing Chat Found.', null);
            }
        }

        // $chat = Chat::where('id', $chat_member->chat_id)->with(['messages', 'members'])->get();
        $chat = Chat::orderBy('created_at', 'DESC')->whereIn('id', $profile_chats)->with(['messages', 'members'])->get();
        // dd($chat);

        return sendSuccess('Chat Found.', $chat);
    }





    public function getChatMessages(Request $request){
        $validator = Validator::make($request->all(), [
            'chat_uuid' => 'required|exists:chats,uuid'
        ]);
        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user_id = (int)$request->user()->profile->id;
        // dd($user_id);
        $chat_id = Chat::where('uuid',$request->chat_uuid)->first();
        $chat_id = $chat_id->id;

        $check = ChatMember::where('chat_id', $chat_id)->where('member_id', $user_id)->first();
        if(!$check){
            return sendError('Chat not found.', null);
        }
        // $check->unread_count = 0;
        // $check->save();

        $chat_members = ChatMember::where('chat_id', $chat_id)->pluck('member_id')->toArray();

        $profile = Profile::whereIn('id', $chat_members)->where('id', '!=', $user_id)->first();
        // dd($profile->id, $user_id, $chat_id, $chat_members);

        $chatMember =  ChatMember::where('chat_id', $chat_id)->where('member_id', $profile->id)->first();
        // dd($chatMember, $profile->id, $user_id);
            $chatMember->unread_count = 0;
            $chatMember->save();
            //->update(['unread_count' => 0]);


        $chat_status = ChatMessage::where('chat_id', $chat_id)->where('reciever_id', $user_id);
        // dd($chat_status);
        if(!empty($chat_status))
        {
            // dd("ok");
            // $chat_status->is_read = 'R';
            $chat_status->update([
                'is_read' => 'R'
            ]);
        }

        $messages = ChatMessage::with('sender')->with('replyMessage')
            ->where('chat_id', $chat_id)
            ->where('is_deleted', false)
            ->where('id', '>', $check->last_message_id);

        if(isset($request->offset) && isset($request->limit)){
            $messages->offset($request->offset)->limit($request->limit);
        }
        $data['messages'] = $messages->orderBy('created_at', 'ASC')->get();
        $data['chat'] = Chat::where('id', $chat_id)->with(['members' => function($query) use($user_id){
            $query->with('user')->where('member_id', '!=', $user_id);
        }])->first();
        // dd($chat);
        // $data['chat'] = Chat::with(['members' => function($query) use($user_id){
        //     $query->with('user')->where('member_id', '!=', $user_id);
        // }])->first();
        return sendSuccess('Chat found.', $data);
    }


    public function readUnChatCounts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chat_uuid' => 'required|exists:chats,uuid'
        ]);
        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


        $user_id = (int)$request->user()->profile->id;
        $chat_id = Chat::where('uuid', $request->chat_uuid)->first();
        $chat_id = $chat_id->id;

        $check = ChatMember::where('chat_id', $chat_id)->where('member_id', $user_id)->first();
        if (!$check) {
            return sendError('Chat not found.', null);
        }

        $chat_members = ChatMember::where('chat_id', $chat_id)->pluck('member_id')->toArray();


        $profile = Profile::whereIn('id', $chat_members)->where('id', '!=', $user_id)->first();
        // dd($profile->id, $user_id, $chat_id, $chat_members);

        $chatMember =  ChatMember::where('chat_id', $chat_id)->where('member_id', $profile->id)->first();
        // dd($chatMember, $profile->id, $user_id);
        $chatMember->unread_count = 0;
        $chatMember->save();
    }

    public function getNewUsers(Request $request){

        $validator = Validator::make($request->all(), [
            'profile_uuid' => 'required|exists:profiles,uuid',
        ]);
        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = Profile::where('uuid',$request->profile_uuid)->first();
        $user_id = $user->id;

        $my_chats = Chat::with('lastMessage', 'members')->whereHas('members', function ($query) use($user_id) {
            $query->where('member_id', $user_id)->where('is_deleted', false);
        })->get();

        $members = [];
        foreach($my_chats as $c){
            foreach ($c->members as $m)
                array_push($members, $m->member_id);
        }
        $users = Profile::where('user_id', '!=', $request->user()->id)->whereNotIn('id', $members)->where('is_approved', 1);
        if($request->search)
            $users->where('name', 'LIKE', '%'.$request->search.'%');
        $data['users'] = $users->get();

        return sendSuccess('success.', $data);
    }


    public function sendMessage(Request $request){
        // dd($request->all(), "asdasdas");

        $validator = Validator::make($request->all(), [
            'chat_uuid' => 'exists:chats,uuid',
            'id' => 'exists:chat_messages,id'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


        // dd($request->all());


        $user_id = $request->user()->profile->id;
        // dd($user_id);

        $chat_id = Chat::where('uuid',$request->chat_uuid)->first();
        $chat_id->created_at = now();
        $chat_id->save();

        $chat_id = $chat_id->id;


        $chat_members = ChatMember::where('chat_id', $chat_id)->pluck('member_id')->toArray();
        $reciever = Profile::whereIn('id', $chat_members)->where('id', '!=', $user_id)->first();

        // dd($reciever->id);

        ChatMember::where('chat_id', $chat_id)
            // ->where('member_id', '!=', $user_id)
            ->where('member_id', '=', $user_id)
            ->update(['unread_count' => \DB::raw('unread_count + 1')]);


        ChatMember::where('chat_id', $chat_id)
        // ->where('member_id', '!=', $user_id)
        ->where('member_id', '=', $reciever->id)
        ->update(['unread_count' => '0']);

        ChatMember::where('chat_id', $chat_id)
            ->update(['is_deleted' => false]);

        // dd("ok", $user_id);

        $message = new ChatMessage;
        $message->uuid = Str::uuid();
        $message->chat_id = $chat_id;
        $message->sender_id = $user_id;
        $message->reciever_id = $reciever->id;

        if(isset($request->id))
            $message->reply_msg_id = $request->id;
        if(isset($request->message))
            $message->message = $request->message;
        if(isset($request->media))
            $message->file_path = $request->media;
        if(isset($request->ratio))
            $message->file_ratio = $request->ratio;
        if(isset($request->type))
            $message->file_type = $request->type;
        if(isset($request->thumbnail))
            $message->thumbnail = $request->thumbnail;

        $message->save();

        /*if ($request->media != '' && $request->media != null && $request->hasFile('media')) {
            $file = $request->file('media');
            $file_name = 'message_' . $message->id . '.' . $file->getClientOriginalExtension();
            $uploaded_path = public_path() . '/assets/messages';
            $file->move($uploaded_path, $file_name);
            $message->file_path = asset('assets/messages').'/' . $file_name;
            $message->file_ratio = $request->ratio;
            $message->file_type = $request->type;
            $message->save();
        }*/

        /*if ($request->thumbnail != '' && $request->thumbnail != null && $request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $file_name = 'message_thumb_' . $message->id . '_' .time().  '.' . $file->getClientOriginalExtension();
            $uploaded_path = public_path() . '/assets/messages';
            $file->move($uploaded_path, $file_name);
            $message->thumbnail = asset('assets/messages').'/' . $file_name;
            $message->save();
        }*/
        $chatMember = ChatMember::where('chat_id', (int)$chat_id)
            ->where('member_id', '!=', $user_id)
            ->first();
        $UnreadCount = ChatMember::select('unread_count')->where('chat_id', (int)$chat_id)
                    ->where('member_id', $user_id)
                    ->first();
        // if(isset($message->sender_id) && isset($message->message))
        //     $this->noti->addNotification($message->sender_id, $chatMember->member_id, $chat_id, 'Chat' ,$message->message ,true);
        // dd($chatMember);

        // $noti_pem = NotificationPermission::where('profile_id', $chatMember->member_id);
        // $noti_con = new NotificationsController;
        // $noti_con->addNotification($user_id, $chatMember->member_id, $message->chat_id, listNotficationTypes()['message_receive'], 'sent you a message', $noti_pem);

        $data['message'] = ChatMessage::where('id',$message->id)->with(['sender','replyMessage'])->first();
        $data['reciever'] = $chatMember->member_id;
        $data['unread_count'] = $UnreadCount;

        $this->noti->addNotification($user_id, $chatMember->member_id, $chat_id, 'Chat', "sent you a message", $request->message, true);

        // if (isset($player->id) && isset($host->id))
        // $this->noti->addNotification($host->id, $player->id, $invitation->id, 'Invitation', $invitation->status, true);


        return sendSuccess('Message sent successfully.', $data);
    }


    public function getChats(Request $request){

        $validator = Validator::make($request->all(), [
            'profile_uuid' => 'required|exists:profiles,uuid'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user_id =  Profile::where('uuid',$request->profile_uuid)->first();
        $user_id = $user_id->id;

        $chats = Chat::with(['lastMessage', 'members' => function($query) use($user_id){
            $query->with('user')->where('member_id', '!=', $user_id);
        }])->whereHas('members', function ($query) use($user_id) {
            $query->where('member_id', $user_id)
                ->where('is_deleted', false);
        });

            // dd($chats);
        if($request->search){
            $search = $request->search;
            $chats->whereHas('members', function ($query) use($user_id, $search) {
                $query->where('member_id', '!=', $user_id)
                    ->whereHas('user', function ($q) use($search){
                        $q->where('name', 'Like', '%'.$search.'%');
                    });
            });
        }

        $chats->select('chats.*', DB::raw("(select unread_count from chat_members where chat_id = chats.id and member_id = ".$user_id." limit 1) as unread_count"));
        // dd($chats->get()[0]);
        $clone_chats = clone $chats;
        if(isset($request->offset) && isset($request->limit)){
            $chats->offset($request->offset)->limit($request->limit);
        }

        $data['chats'] = $chats->get();
        $data['total'] = $chats->count();
        $clone_chats->whereHas('members', function ($query) use($user_id) {
            $query->where('member_id', $user_id)->where('unread_count', '>', 0);
        });
        $data['total_unread_chats'] = $clone_chats->count();
        // dd($data);
        return sendSuccess('Success', $data);
    }

    public function getUnreadChatsCount(Request $request){
        // \DB::enableQueryLog();
        if (app('request')->user() != null) {
            $user_id = ($request->user_id) ? $request->user_id : $request->user()->profile_id;
        }
        else{
            return 0;
        }
        $chats = Chat::with(['lastMessage', 'members' => function($query) use($user_id){
            $query->with('user')->where('member_id', '!=', $user_id);
        // }])->whereHas('members', function ($query) use($user_id) {
        //     $query->where('member_id', $user_id)
        //         ->where('is_deleted', false);
        // })->whereHas('members', function ($query) use($user_id) {
        //     $query->where('member_id', '!=', $user_id)
        //         ->whereRaw("member_id NOT IN (Select blocked_id from block_users where user_id = ".$user_id.")")
        //         ->whereRaw("member_id NOT IN (Select user_id from block_users where blocked_id = ".$user_id.")");
        }]);

        $chats->select('chats.*', DB::raw("(select unread_count from chat_members where chat_id = chats.id and member_id = ".$user_id." limit 1) as unread_count"));
        $clone_chats = clone $chats;

        $clone_chats->whereHas('members', function ($query) use($user_id) {
            $query->where('member_id', $user_id)->where('unread_count', '>', 0);
        });
        $total_unread_chats = $clone_chats->count();

        // dd($total_unread_chats);
        // print_array(\DB::getQueryLog(), true);
        return $total_unread_chats;
    }


    public function deleteChat(Request $request){
        $validator = Validator::make($request->all(), [
            'chat_uuid' => 'required|exists:chats,uuid'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $chat_id = Chat::where('uuid', $request->chat_uuid)->delete();
        return sendSuccess('Chat deleted successfully.', null);
        $user_id = $request->user()->profile->id;

        $check = ChatMessage::orderBy('id', 'DESC')->select('id')->first();
        if(!$check){
            return sendError('Chat not found.', null);
        }
        ChatMember::where('chat_id', $chat_id)
            ->where('member_id', $user_id)
            ->update(['is_deleted' => true, 'unread_count' => 0, 'last_message_id' => $check->id]);

        return sendSuccess('Chat deleted successfully.', null);
    }

    public function deleteMessage(Request $request){
        $validator = Validator::make($request->all(), [
            'message_uuid' => 'required|exists:chat_messages,uuid',
        ]);
        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        // $user_id = $request->user()->profile->id;
        // $user_id = $request->profile_id;
        // dd($request->all());

        $check = ChatMessage::where('uuid', $request->message_uuid)->first();
        // dd($check);

        if($check){
            // $check->update([
            //             'is_deleted' => 1,
            //             'updated_at' => Carbon::now()
            //     ]);
            $check->is_deleted = 1;
            $check->save();

            return sendSuccess('Chat Message deleted successfully.', null);
        }
        return sendError('you cannot delete this message.', null);
    }


    /*public function getChatMedia(Request $request){
        $validator = Validator::make($request->all(), [
            'chat_id' => 'required'
        ]);
        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $check = ChatMember::where('chat_id', $request->chat_id)->where('member_id', Auth::user()->id)->select('last_message_id')->first();
        if(!$check){
            return sendError('Chat not found.', null);
        }
        $data['media'] = ChatMessage::with('sender')
            ->where('chat_id', $request->chat_id)
            ->where('id', '>', $check->last_message_id)
            ->where('file_path', '!=', null)
            ->orderBy('created_at', 'ASC')
            ->get();
        return sendSuccess('Chat found.', $data);
    }*/
}
