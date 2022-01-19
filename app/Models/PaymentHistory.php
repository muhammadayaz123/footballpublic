<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $with = ['invitation'];

    protected $casts = [
        'total'  => 'double',
    ];

    public function invitation(){
    	return $this->belongsTo(Invitation::class, 'invitation_id','id');
    }
}
