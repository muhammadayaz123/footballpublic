<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    use SoftDeletes;

    protected $with = ['sender','invitation'];

    protected $appends = ['date_condition'];

    public function sender(){
        return $this->belongsTo(Profile::class,'sender_id','id')->with('user');
    }

    public function receiver(){
        return $this->belongsTo(Profile::class,'receiver_id','id');
    }

    public function invitation(){
        return $this->belongsTo(Invitation::class,'type_id','id');
    }

    public function getDateConditionAttribute(){
        $status = 'older';
        if(\Carbon\Carbon::parse($this->created_at)->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'))
            $status = 'today';
        if(\Carbon\Carbon::parse($this->created_at)->format('Y-m-d') == \Carbon\Carbon::yesterday()->format('Y-m-d'))
            $status = 'yesterday';

        return $status;
    }

}
