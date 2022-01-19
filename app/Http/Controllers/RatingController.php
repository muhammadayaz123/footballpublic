<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Profile;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\NotificationController;

class RatingController extends Controller
{
    private $noti;

    public function __construct(NotificationController $noti)
    {
        $this->noti   = $noti;
    }
    public function updateRating(Request $request){

    	$validator = Validator::make($request->all(), [

            'player_uuid'     => 'string|exists:profiles,uuid|required_without:rating_uuid',
            'rater_uuid'      => 'string|exists:profiles,uuid|required_without:rating_uuid',
            'invitation_uuid' => 'string|exists:invitations,uuid',

            'agility'         => 'numeric|required_without:rating_uuid|min:0|max:5',
            'stamina'         => 'numeric|required_without:rating_uuid|min:0|max:5',
            'strength'        => 'numeric|required_without:rating_uuid|min:0|max:5',
            'passes'          => 'numeric|required_without:rating_uuid|min:0|max:5',
            'shoots'          => 'numeric|required_without:rating_uuid|min:0|max:5',
            'appearance'      => 'numeric|required_without:rating_uuid|min:0|max:5',
            'pace'            => 'numeric|required_without:rating_uuid|min:0|max:5',

            'rating_uuid'     => 'exists:ratings,uuid',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $rating = Rating::where('uuid', $request->rating_uuid)->first();

        //to create new rating
        if(NULL == $rating){

			$player = Profile::where('uuid',$request->player_uuid)->first();

			if(NULL == $player)
				return sendError('Invalid player',[]);

			$rater = Profile::where('uuid',$request->rater_uuid)->first();

			if(NULL == $rater)
				return sendError('Invalid rater',[]);

			// $invitation = Invitation::where('uuid',$request->invitation_uuid)->first();

			// if(NULL == $invitation)
			//     return sendError('Invalid invitation',[]);

			$rating = new Rating;

			$rating->uuid          = Str::uuid();
			$rating->player_id     = $player->id;
			$rating->rater_id      = $rater->id;
			// $rating->invitation_id = $invitation->id ?? NULL;
            $rating->invitation_id = $request->invitation_id ;
        }

		$rating->agility    = $request->agility ?? $rating->agility;
		$rating->stamina    = $request->stamina ?? $rating->stamina;
		$rating->strength   = $request->strength ?? $rating->strength;
		$rating->passes     = $request->passes ?? $rating->passes;
		$rating->shoots     = $request->shoots ?? $rating->shoots;
		$rating->appearance = $request->appearance ?? $rating->appearance;
		$rating->pace       = $request->pace ?? $rating->pace;
		$rating->total_rating = ($rating->agility + $rating->stamina + $rating->strength + $rating->passes + $rating->shoots + $rating->pace)/6;

		$rating->player->ratings += $rating->total_rating;
		$rating->player->ratings_count++;
        $rating->player->rating = (int) round($rating->player->ratings / $rating->player->ratings_count);
		$rating->player->save();



		if(!$rating->save())
            return sendError('internal server error',[]);

        $this->noti->addNotification($rater->id, $player->id, $rating->id, 'Rating', 'Rate you', null, true);

		$data['rating'] = Rating::find($rating->id);

		return sendSuccess('Rating',$data);
    }

	public function getRating(Request $request){
		$validator = Validator::make($request->all(), [

            'player_uuid'     => 'string|exists:profiles,uuid',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


		// $player = Profile::where('uuid',$request->player_uuid ?? $request->user()->profile->uuid)->first();
        $player = Profile::where('uuid', $request->player_uuid)->first();

        $invitation = Invitation::where('uuid', $request->invitation_uuid)->first();
        // dd($invitation->id);

		if(NULL == $player || NULL == $invitation)
			return sendError('Invalid player',[]);

		// $rating = Rating::orderBy('created_at','DESC')->where('player_id', $player->id)->with('rater')->get();
        $rating = Rating::where('player_id', $player->id)->where('invitation_id', $invitation->id)->first();

        // dd($rating);
        if(NULL == $rating)
        {
            return sendError('no rating yet',[]);
        }
        else {

            return sendSuccess('Rating', $rating);
        }
        // dd($rating);

		// $data['rating'] = $rating;

	}

    public function filterRating(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'total_rating'     => 'numeric'

        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


        $rating = Rating::orderBy('created_at', 'DESC')->where('total_rating', $request->total_rating)->get();

        $data['rating'] = $rating;

        return sendSuccess('Rating', $data);
    }

    public function ratingSum(Request $request){
    	$rating = Rating::where('player_id',$request->profile_id ?? $request->User()->profile->id);

    	$ratingAglility = clone $rating;
    	$ratingStamina  = clone $rating;
    	$ratingStrength = clone $rating;
    	$ratingPasses   = clone $rating;
    	$ratingShoots   = clone $rating;
    	$ratingPace     = clone $rating;

    	$data['agility']  = $ratingAglility->pluck('agility')->avg();
    	$data['stamina']  = $ratingStamina->pluck('stamina')->avg();
    	$data['strength'] = $ratingStrength->pluck('strength')->avg();
    	$data['passes']   = $ratingPasses->pluck('passes')->avg();
    	$data['shoots']   = $ratingShoots->pluck('shoots')->avg();
    	$data['pace']     = $ratingPace->pluck('pace')->avg();

    	return sendSuccess('Average Rating',$data);
    }

    // public function getFilterLocation(Request $request)
    // {

    //     $profile_id = $request->user()->profile->id;

    //     $filetLocation =  \DB::raw("
    //             SELECT  *
    //                 SQRT(
    //                     POW(69.1 * (lat - '$request->lat'), 2) +
    //                     POW(69.1 * ('$request->long' - `long`) * COS(lat / 57.3),2)) AS distance
    //                 FROM
    //                     addresses
    //                 INNER JOIN
    //                     profiles ON $profile_id = addresses.id
    //                 HAVING
    //                     distance < 5");

    //     $location =  DB::select($filetLocation);
    //     return $location;
    // }
}
