<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMember extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(Profile::class, 'member_id', 'id')->with('user');
    }
}
