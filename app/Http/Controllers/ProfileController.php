<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function getUser(Request $request){

    	$validator = Validator::make($request->all(), [

            'user_uuid' => 'string|exists:users,uuid',
            'position'  => 'string|in:goalkeeper,defender,midfielder,forward',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $type = 'multiple';

    	$user = User::orderBy('created_at', 'DESC')->where('profile_id','!=',$request->User()->profile->id);
        // dd($user->first());

    	if(isset($request->user_uuid)){
            $user = $user->where('uuid',$request->user_uuid);
			$type = 'single';
    	}

		if(isset($request->position))
			$user = $user->where('position',$request->position);

		if($type == 'single')
			$user = $user->first();
		else
			$user = $user->get();

		return sendSuccess('User',$user);
    }


    public function updateProfile(Request $request){
    	$validator = Validator::make($request->all(), [

    		'profile_uuid'  => 'required|exists:profiles,uuid',
    		'position'      => 'in:goalkeeper,defender,midfielder,forward',

    		'first_name'    => 'string',
    		'last_name'     => 'string',
    		'favorite_club' => 'string',
    		'gender'        => 'in:male,female',
    		'price'         => 'numeric',

    		'city'          => 'string',
    		'country'       => 'string',
    		'address'       => 'string',
    		'state'         => 'string',

    		'dob'           => 'date',
    		'bio'           => 'string',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $profile = Profile::where('uuid',$request->profile_uuid)->first();
        if(NULL == $profile)
        	return sendError('Invalid Profile',[]);

        $profile->position       = $request->position ?? $profile->position ?? NULL;
        $profile->first_name     = $request->first_name ?? $profile->first_name ?? NULL;
        $profile->last_name      = $request->last_name ?? $profile->last_name ?? NULL;
        $profile->dob            = $request->dob ?? $profile->dob ?? NULL;
        $profile->bio            = $request->bio ?? $profile->bio ?? NULL;
        $profile->favorite_club  = $request->favorite_club ?? $profile->favorite_club ?? NULL;
        $profile->gender         = $request->gender ?? $profile->gender ?? NULL;
        $profile->price          = $request->price ?? $profile->price ?? NULL;
        $profile->profile_image  = $request->profile_image ?? asset('images/user-no-image.png') ?? NULL;
        $profile->user->position = $profile->position;

		$profile->save();
        $profile->user->save();

		$data['profile'] = Profile::where('id',$profile->id)->first();

		return sendSuccess('Profile Updated',$data);
    }

    public function getProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'profile_uuid' => 'string|exists:profiles,uuid',

        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $profile = Profile::where('uuid', $request->profile_uuid)->with('user')->with('user_ratings',function($q){
            $q->where('rater_id',\Auth::User()->profile->id);
        })->with('card')->first();

        if($profile)
        {
            return sendSuccess('Profile', $profile);
        }
        return sendError('Invalid Profile', []);


    }

    public function getFilterRating(Request $request)
    {
      


        if(isset($request->total_rating) || isset($request->position))
        {
            $ratings = Profile::orderBy('created_at', 'DESC')->where('id', '!=', $request->User()->profile->id);

            // $ratings = Profile::orderBy('created_at', 'DESC')->where('id', '!=', $request->User()->profile->id)->whereBetween('rating', [$request->min, $request->max])->with('user')->get();
            // \DB::enableQueryLog();
            // $ratings = Profile::orderBy('created_at', 'DESC')->where('id', '!=', $request->User()->profile->id)->where('rating' ,'>=', (float)$request->min)->where('rating' ,'<=', (float)$request->max)->with('user')->get();
            // dd(\DB::getQueryLog());

            $ratings->where('rating' ,'>=', (float)$request->min)->where('rating' ,'<=', (float)$request->max);

            if(isset($request->position))
            {
                $ratings->whereIn('position', array($request->position))->where('rating' ,'>=', (float)$request->min)->where('rating' ,'<=', (float)$request->max);    
            }

            // $ratings->with('user')->get();
        }
        // dd($request->all());

        if(isset($request->min_price) && isset($request->max_price))
        {
            $ratings = Profile::orderBy('created_at', 'DESC')->where('id', '!=', $request->User()->profile->id);

            // dd($request->min_price, $request->max_price);
            // dd("ok", array($request->position));
            // $ratings = Profile::orderBy('created_at', 'DESC')->where('id', '!=', $request->User()->profile->id)->whereIn('position', array($request->position))->where('price', '>=', $request->min_price)->where('price', '<=', $request->max_price)->with('user')->get();


            $ratings->where('price', '>=', $request->min_price)->where('price', '<=', $request->max_price);

            if(isset($request->position))
            {
            // dd($request->min_price, $request->max_price, $request->position);
            // \DB::enableQueryLog();
                
                $ratings->whereIn('position', array($request->position))->get();
            // dd(\DB::getQueryLog());

            }

            // $ratings->with('user')->get();




        }

        // if(isset($request->current_lat) && isset($request->current_long)){
        //     $ratings = Profile::orderBy('created_at', 'DESC')->where('id', '!=', $request->User()->profile->id)->offset(mt_rand(1, 15))->limit(mt_rand(1, 15))->with('user')->get();
        // }

        // $ratings = $profile->where('ratings', '<', 5);

        // dd($ratings);
        $ratings_filter = $ratings->with('user')->get();
        // dd($ratings_filter);
        // $data['ratings'] = $ratings;
        $data['ratings'] = $ratings_filter;

        return sendSuccess('Rating', $data);
    }

    public function deleteUser(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'user_uuid' => 'string|exists:users,uuid',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = User::where('uuid', $request->user_uuid)->first();
        // dd($user);
        if($user)
        {
            $user->delete();
		    return sendSuccess('User deleted successfully', []);
        }
        return sendError('User did not deleted ', []);

    }

    public function getFilterLocation(Request $request)
    {
            // dd($request->all(), "12312");

        $profile_id = $request->user()->profile->id;
        // if(isset($request->current_lat) && isset($request->current_long))
        // {

        // }
        $current_long = (int)$request->current_long;
        // $current_long = 1;
        // dd($current_long);
        // DB::enableQueryLog();


        $filterLocation =  \DB::raw("
                SELECT a.profile_id ,
                    SQRT(
                        POW(69.1 * (latitude - '$request->lat1'), 2) +
                        POW(69.1 * ('$request->long1' - `longitude`) * COS(latitude / 57.3),2)) AS distance
                    FROM
                        addresses AS a
                    INNER JOIN
                        profiles p ON p.user_id= a.profile_id

                    HAVING
                        distance < '$current_long'");


        $filterLocation =  DB::select($filterLocation);
        // $queries = DB::getQueryLog();
        // dd($filterLocation);
            $profile_ids = array();

        foreach ($filterLocation as $location) {
            // dd($location, $location->profile_id);
            $profile_ids[] = $location->profile_id;
        }

        // dd($profile_ids);

        $profile = Profile::whereIn('id',  $profile_ids)->orderBy('created_at', 'ASC')->with('user')->get();

        // dd($profile);

        // dd( $queries, $filterLocation );
        $data['location_filter']= $profile;
        // $data['profile'] = $profile;
        // $data['status'] = 'success';
        // return $filterLocation;
        return sendSuccess('filter_location', $data);
    }

    public function showFilterLocation(Request $request)
    {
        // dd($request->all(), "12312");

        $profile_id = $request->user()->profile->id;
        // DB::enableQueryLog();


        $filterLocation =  \DB::raw("
                SELECT  *,
                    SQRT(
                        POW(69.1 * (latitude - '$request->lat1'), 2) +
                        POW(69.1 * ('$request->long1' - `longitude`) * COS(latitude / 57.3),2)) AS distance
                    FROM
                        addresses
                    INNER JOIN
                        profiles ON profiles.user_id = addresses.profile_id
                    INNER JOIN
                        users On users.id = profiles.user_id
                    HAVING
                        distance < 90");


        $filterLocation =  DB::select($filterLocation);
        // $queries = DB::getQueryLog();
        // dd( $queries, $filterLocation );
        $data[] = $filterLocation;
        $data['status'] = 'success';
        // return $filterLocation;
        return $data;
    }


}
