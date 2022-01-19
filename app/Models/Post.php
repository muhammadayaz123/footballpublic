<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $appends =['is_liked_by_me', 'is_blocked_user_post'];

    use HasFactory;


    public function media(){
        return $this->hasOne(Media::class, 'id','media_id');
    }

    public function profile(){
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

    public function getIsLikedByMeAttribute()
    {
        return Like::where('post_id', $this->id)->where('profile_id', Auth()->user()->profile->id)->first() != null ? 1 : 0;
    }

    public function getIsBlockedUserPostAttribute()
    {

        $request = app('request');
        $blockPlayer = Block::all();

        return $blockPlayer->where('post_id', $this->id)->where('blocker_id', Auth::user()->profile->id)->first() != NULL ? 1 : 0 ;
    }

}
