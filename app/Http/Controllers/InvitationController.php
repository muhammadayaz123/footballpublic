<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use App\Models\Stadium;
use App\Models\Invitation;
use App\Exceptions\Handler;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\NotificationController;

class InvitationController extends Controller
{
    private $noti;

    public function __construct( NotificationController $noti )
    {
        $this->noti   = $noti;
    }
    public function getInvitation(Request $request){

		$validator = Validator::make($request->all(), [

    		'player_uuid' => 'string|exists:profiles,uuid',
    		'host_uuid'   => 'string|exists:profiles,uuid',
            'date' => 'string'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

		$player = Profile::where('uuid',$request->player_uuid ?? $request->host_uuid ?? $request->user()->profile->uuid)->first();
		    if(NULL == $player)
		        return sendError('Invalid Player',[]);

        // dd($player);

		$invitation = Invitation::orderBy('created_at','DESC');

		if(isset($player) && ('' == $request->date))
        {
			$invitation->where('player_id',$player->id)->whereDate('date_time', '=', Carbon::today()->toDateString());
        }


        if(isset($request->date) && (' ' !=$request->date))
        {
            $invitation->where('player_id',$player->id)->whereDate('date_time','=',$request->date );
        }

		$data['invitations'] = $invitation->with(['host','stadium', 'player'])->get()->groupBy(function ($val) {

            return  Carbon::parse($val->date_time)->format('H');

            // return array(Carbon::parse($val->date_time)->format('Y'));
            // return ($val->date_time as 'Time');
        });

		return sendSuccess('Invitations',$data);

    }

    public function getInvitationByUser(Request $request)
    {
        // dd($request->all(), "1211");

        $validator = Validator::make($request->all(), [

            'invitation_uuid' => 'string|exists:invitations,uuid',
            // 'host_uuid'   => 'string|exists:profiles,uuid',
            // 'date' => 'string'
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $invitation = Invitation::where('uuid',$request->invitation_uuid)->first();
        if(!$invitation) {
            return sendError('No Invitation Player found', []);
        }

        $data = Profile::where('id', $invitation->player_id)->with('card')->first();
        // dd($data);

        return sendSuccess('Invitations', $data);
    }

    public function getHirePlayer(Request $request)
    {

        $validator = Validator::make($request->all(), [

            // 'player_uuid' => 'string|exists:profiles,uuid',
            'host_uuid'   => 'string|exists:profiles,uuid',
            'date' => 'string'
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $player = Profile::where('uuid', $request->player_uuid ?? $request->host_uuid ?? $request->user()->profile->uuid)->first();
        if (NULL == $player)
            return sendError('Invalid Player', []);

        // dd($player);

        $invitation = Invitation::orderBy('created_at', 'DESC');
        // $invitation = Invitation::groupBy('date_time')->orderBy('date_time', 'DESC');

        if (isset($player) && ('' == $request->date)) {
            // dd(Carbon::today()->toDateString());
            $invitation->where('host_id', $player->id)->whereDate('date_time', '=', Carbon::today()->toDateString());
        }


        if (isset($request->date) && ('' != $request->date)) {
            // dd($request->date);
            $invitation->where('host_id', $player->id)->whereDate('date_time', '=',  $request->date);
        }



        $data['invitations'] = $invitation->with(['host', 'stadium', 'player'])->get()->groupBy(function ($val) {

            return  Carbon::parse($val->date_time)->format('H');

            // return array(Carbon::parse($val->date_time)->format('Y'));
            // return ($val->date_time as 'Time');
        });
        // $data['invitations'] = $invitation->with(['host', 'stadium', 'player'])->get();
        // $data['invitations_by_hour'] = DB::table('invitations')->get()->groupBy( function($val) {

        //     return  Carbon::parse($val->date_time)->format('Y', 'as', 'Year') ;
        //     // return ($val->date_time as 'Time');
        // });

        return sendSuccess('Invitations', $data);
    }

    public function updateInvitation(Request $request){

    	$validator = Validator::make($request->all(), [

    		'invitation_uuid' => 'string|exists:invitations,uuid',
    		'player_uuid'     => 'string|exists:profiles,uuid|required_without:invitation_uuid',
    		'stadium_uuid'    => 'string|exists:stadia,uuid|required_without:invitation_uuid',
    		'host_uuid'       => 'string|exists:profiles,uuid|required_without:invitation_uuid',

    		'date_time'       => 'date|required_without:invitation_uuid',
    		'price'           => 'numeric|required_without:invitation_uuid',
    		'commission'      => 'numeric|required_without:invitation_uuid',
    		'total'           => 'numeric|required_without:invitation_uuid',
    		'is_attended'     => 'numeric|in:1',
    		'status'          => 'string|in:pending,accepted,rejected,other',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


        $invitation = Invitation::where('uuid',$request->invitation_uuid)->first();
        // dd($request->all());

       	try {
            DB::beginTransaction();

	        //create new invitation
	        if(NULL == $invitation){

	        	$stadium = Stadium::where('uuid',$request->stadium_uuid)->first();
		        if(NULL == $stadium)
		        	return sendError('Invalid Stadium',[]);

		        $player = Profile::where('uuid',$request->player_uuid)->first();
                // $player_id = $player->id;
		        if(NULL == $player)
		        	return sendError('Invalid Player',[]);

		        $host = Profile::where('uuid',$request->host_uuid)->first();
                // $host_id = $host->id;
		        if(NULL == $host)
		        	return sendError('Invalid Host',[]);

	        	$invitation = new Invitation();

	        	$invitation->uuid       = Str::uuid();
	        	$invitation->stadium_id = $stadium->id;
	        	$invitation->player_id  = $player->id;
	        	$invitation->host_id    = $host->id;

	        }

			$invitation->date_time   = $request->date_time ?? $invitation->date_time;
			$invitation->price       = $request->price ?? $invitation->price;
			$invitation->commission  = $request->commission ?? $invitation->commission;
			$invitation->total       = $request->total ?? $invitation->total;
			$invitation->is_attended = $request->is_attended ?? $invitation->is_attended;
            $invitation->status      = $request->status ?? $invitation->status ?? 'pending';
            $invitation->is_payed    =  $request->is_payed ?? $invitation->is_payed ?? '0';


			$invitation->save();

			if(!$invitation->save())
				return sendError('Internal Server Error',[]);

			if(isset($player->id) && isset($host->id))
            {
                $this->noti->addNotification($host->id, $player->id, $invitation->id, 'Invitation' , $invitation->status,null, true);
            }

            else if (isset($request->player_id) && isset($request->host_id))
            {
                // dd($request->all(),"343");
                $this->noti->addNotification(  $request->player_id, $request->host_id, $invitation->id, 'Invitation', $invitation->status, null, true);
            }

			DB::commit();


			$data['invitation'] = Invitation::where('id',$invitation->id)->with(['player','host','stadium'])->get();


			return sendSuccess('Invitation',$data);

		} catch(Exception $ex) {
                DB::rollBack();
                return sendError($ex->getMessage(), $ex->getTrace());
        }
    }

    public function cancelInvitation(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'invitation_uuid'   => 'string|exists:invitations,uuid',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        // dd($request->all());

        $invitation = Invitation::where('uuid', $request->invitation_uuid)->first();
        if($invitation)
        {
            $invitation->delete();
            return sendSuccess('Invitation has been cancelled', []);
        }
        return sendError('Internal Server Error', []);

    }


    public function isPayedInvitation(Request $request)
    {

        $player = Profile::where('uuid',  $request->user()->profile->uuid)->first();
        if (NULL == $player)
            return sendError('Invalid Player', []);

        // dd($player);

        $invitation = Invitation::orderBy('created_at', 'DESC');

        $invitation->where('host_id', $player->id);
        // $invitation->where('is_attended','!=', null);
        // $invitation->where('is_payed', '!=', 0);

        $data['is_payed'] = $invitation->with(['host', 'stadium', 'player'])->get();

        return sendSuccess('Invitations', $data);

    }
}
