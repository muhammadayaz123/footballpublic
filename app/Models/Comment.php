<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $with = ['profile'];

    public function profile(){
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
