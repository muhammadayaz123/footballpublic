<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Stadium;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class StadiumController extends Controller
{
    public function getStadium(){
         $stadium = Stadium::get();

         return sendSuccess('Stadiums', $stadium);
    }

    public function userStadiums(Request $request)
    {
        $userStadium = Stadium::where('profile_id', $request->profile_id)->get();

        return sendSuccess('User Stadiums', $userStadium);
    }

    public function updateStadium(Request $request){

    	$validator = Validator::make($request->all(), [

    		'stadium_uuid' => 'string|exists:stadia,uuid',
    		'profile_uuid' => 'string|exists:profiles,uuid',
    		'latitude'     => 'numeric',
    		'longitude'    => 'numeric',
    		'address'      => 'string|required_without:stadium_uuid',
    		// 'city'         => 'string|required_without:stadium_uuid',
    		// 'country'      => 'string|required_without:stadium_uuid',
    		// 'name'         => 'string|regex:/^[a-zA-Z]+$/u|required_without:stadium_uuid',
            'name'         => 'string|required_without:stadium_uuid',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        try {
            DB::beginTransaction();



	        $stadium = Stadium::where('uuid',$request->stadium_uuid)->first();

	        // create new stadium
	        if(NULL == $stadium){

                // dd($request->all());
                $profile = Profile::where('uuid',$request->profile_uuid)->first();

		        if(NULL == $profile)
                    // dd($profile->id, "check");
		        	$profile = $request->user()->profile;
                    // dd($profile, "adasdasd", $profile->id);
		        	if(NULL == $profile)
		        		return sendError('Invalid user',[]);

                        // dd($profile->id, "3434");
	        	$stadium             = New Stadium;
	        	$stadium->uuid       = Str::uuid();
	        	$stadium->profile_id = $profile->id;
	        }

	        $stadium->latitude	   	= $request->latitude ?? $stadium->latitude;
	        $stadium->longitude	  	= $request->longitude ?? $stadium->longitude;
	        $stadium->address	   	= $request->address ?? $stadium->address;
	        $stadium->city	       	= $request->city ?? $stadium->city;
	        $stadium->country	   	= $request->country ?? $stadium->country;
	        $stadium->name	       	= $request->name ?? $stadium->name;
	        $stadium->zip	       	= $request->zip ?? $stadium->zip;

			$stadium->save();

			if(!$stadium->save())
				return sendError('Internal Server Error',[]);

			DB::commit();

			$data['Stadium'] = Stadium::find($stadium->id);


			return sendSuccess('Stadium Added',$data);

		} catch(Exception $ex) {
                DB::rollBack();
                return sendError($ex->getMessage(), $ex->getTrace());
        }

    }
}
