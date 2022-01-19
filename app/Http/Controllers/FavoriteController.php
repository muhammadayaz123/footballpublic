<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Bank;
use App\Models\Card;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\PasswordReset;
use App\Models\Profile;
use App\Models\SignupVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request){
        $validator = Validator::make($request->all(), [
            'profile_uuid' => 'required|exists:profiles,uuid',
            'player_uuid'  => 'required|exists:profiles,uuid',
            'is_favorite'  => 'required|in:1,0',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $player = Profile::where('uuid',$request->player_uuid)->first();
        if(NULL == $player)
            return sendError('Invalid Player',[]);

        $profile = Profile::where('uuid',$request->profile_uuid)->first();
        if(NULL == $profile)
            return sendError('Invalid profile',[]);
        

        $favorite = Favorite::where('profile_id',$profile->id)->where('player_id',$player->id)->first();

        if(NULL == $favorite){

            $favorite = new Favorite();

            $favorite->uuid       = Str::uuid();
            $favorite->profile_id = $profile->id;
            $favorite->player_id  = $player->id;            

        }

        $favorite->is_favorite = $request->is_favorite;
        $favorite->save();

        $data['favorite'] = Favorite::find($favorite->id);

        return sendSuccess('favorite',$data);

    }

    public function getFavorite(Request $request){

        $favorite_ids = Favorite::where('profile_id',Auth::User()->profile->id)->where('is_favorite',1)->pluck('player_id')->toArray();

        $profile_ids = Profile::whereIn('id',$favorite_ids)->pluck('user_id');

        $profile = User::whereIn('id',$profile_ids)->get();

        return sendSuccess('Favorite',$profile);
    }
}
