<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    function player(){
        return $this->belongsTo(Profile::class, 'player_id', 'id' );
    }

    function rater(){
        return $this->belongsTo(Profile::class, 'rater_id', 'id' );
    }
}
