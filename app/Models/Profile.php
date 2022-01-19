<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'profiles';
    public $timestamps = true;


    protected $fillable = [
        'uuid',
        'user_id',
        'cat_id',
        'profile_type',
        'first_name',
        'last_name',
        'username',
        'profile_image',
        'bio',
        'dob',
        'employement_history'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];




    protected $appends = ['rating','is_my_fav','my_request', 'is_blocked_user'];

    protected $with = ['address'];

    use SoftDeletes;


    protected static function boot()
    {
        parent::boot();

        // delete a address
        static::deleting(function ($model) {
            $model->address()->delete(); // delete

        });
    }





    public function address(){
        return $this->belongsTo(Address::class, 'id', 'profile_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'profile_id');
    }
    public function user_ratings(){
        return $this->hasMany(Rating::class,'player_id','id');
    }

    // public function getMyRatingAttribute(){

    // }

    public function getRatingAttribute(){

        if(0 != $this->ratings_count)
        //  Profile::where('rating', $this->ratings / $this->ratings_count);
            return $this->ratings/$this->ratings_count;

        return 0;
    }

    public function getIsMyFavAttribute(){

        $request = app('request');

        $fav = Favorite::where('player_id',$this->id)->where('profile_id',$request->user()->profile->id)->first();
        return $fav->is_favorite ?? 0;
    }

    public function getMyRequestAttribute(){

        $now = Carbon::now()->format('Y-m-d 00:00:00');
        $request = app('request');

        return Invitation::where('player_id',$this->id)->where('host_id',$request->user()->profile->id)->where('created_at', '>' , $now)->first() != NULL ? 1 : 0;
    }

    public function card()
    {
        return $this->hasOne(Card::class, 'profile_id', 'id');
    }

    // public function blockerUser()
    // {
    //     return $this->belongsTo(Block::class, 'player_id', 'id');
    // }


    public function getIsBlockedUserAttribute()
    {

        $request = app('request');
        $blockPlayer = Block::all();

        return $blockPlayer->where('player_id', $this->id)->where('blocker_id', Auth::user()->profile->id)->first() != NULL ? 1 : 0 ;
    }

}
