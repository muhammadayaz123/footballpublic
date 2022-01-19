<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    function player(){
        return $this->belongsTo(Profile::class, 'player_id' ,'id')->with('user');
    }

    function host(){
        return $this->belongsTo(Profile::class, 'host_id' ,'id')->with('user');
    }

    function stadium(){
        return $this->belongsTo(Stadium::class,'stadium_id' ,'id');
    }



}
