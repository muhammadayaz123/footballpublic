<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_msg_deleted',
        'tag_msg_id'
    ];

    protected $with = ['taggedMessage', 'replyMessage'];
    protected $appends = ['local_created_at'];

    public function sender()
    {
        return $this->belongsTo(Profile::class, 'sender_id', 'id');
    }


    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id', 'id');
    }

    public function taggedMessage()
    {
        return $this->belongsTo(ChatMessage::class, 'tag_msg_id', 'id')->with('sender');
    }

    public function replyMessage(){
        return $this->belongsTo(ChatMessage::class, 'reply_msg_id', 'id');
    }

    public function getLocalCreatedAtAttribute()
    {
        $request = app('request');
        return get_locale_datetime($this->created_at, $request->ip());
        // return $this->
    }


    // public function getLocalReplayAtAttribute()
    // {
    //     $request = app('request');
    //     $replay_date = $this->replyMessage->created_at;
    //     // dd($replay_date);
    //     return $replay_date;
    //     // return get_utc_datetime($this->created_at, $request->ip());
    //     // return $this->
    // }
}
