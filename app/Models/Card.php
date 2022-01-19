<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'uuid',
        'profile_id',
        'account_title_name',
        'card_holder_name',
        'card_no',
        'isdn_code',
        'swift_code',
        'Ibn_no',
        'select_payment_type',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // public function profile()
    // {
    //     return $this->belongsTo(Profile::class, 'id', 'profile_id');
    // }
}
