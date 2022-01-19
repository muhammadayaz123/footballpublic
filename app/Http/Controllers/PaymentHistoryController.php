<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Invitation;
use App\Models\PaymentHistory;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentHistoryController extends Controller
{
	//add_update_paymnet

    public function updatePayment(Request $request){

    	$validator = Validator::make($request->all(), [

            'sender_uuid'          => 'string|exists:profiles,uuid',
            'receiver_uuid'        => 'string|exists:profiles,uuid',

            'invitation_uuid'      => 'required|exists:invitations,uuid',
            'price'                => 'numeric',
            'tax'                  => 'numeric',

            'payment_history_uuid' => 'string|exists:payment_histories,uuid'

        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        // Validation End

        // get invitaion object

        $invitation = Invitation::where('uuid',$request->invitation_uuid)->first();

    	if(NULL == $invitation)
    		return sendError('Invalid Invitation',[]);

    	$payment_history = PaymentHistory::where('invitation_id',$invitation->id)->first();

    	if(NULL != $payment_history)
    		return sendError('Payment Already Exist, cant Dublicate',[]);

        try{
        	DB::beginTransaction();

        	$payment_history = new PaymentHistory;

        	$payment_history->uuid        = str::uuid();
        	$payment_history->sender_id   = $sender->id ?? $invitation->host_id;
        	$payment_history->receiver_id = $recipient->id ?? $invitation->player_id;
        	$payment_history->invitation_id     = $invitation->id;
        	$payment_history->price       = $request->price ?? $invitation->total;

        	$payment_history->save();

        	if(!$payment_history->save())
        		return sendError('Internal Server Error',[]);

        	DB::commit();

        	$data['Payment'] = PaymentHistory::find($payment_history->id);

        	return sendSuccess('Payment',$data);

        }	catch(Exception $ex) {
                DB::rollBack();
                return sendError($ex->getMessage(), $ex->getTrace());
        }
    }

    public function getPayment(Request $request){

    	//Valudation

    	$validator = Validator::make($request->all(), [

			'host_uuid'	       => 'string|exists:profiles,uuid',
			'player_uuid'	       => 'string|exists:profiles,uuid',

			'payment_history_uuid' => 'string|exists:payment_histories,uuid'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        //Validation End

        $type  = 'multiple';

        $model = PaymentHistory::orderBy('created_at','DESC');

        if(isset($request->host_uuid)){

            $sender = Profile::where('uuid',$request->host_uuid)->first();

            $model = $model->where('sender_id',$sender->id);

        }

        //filter by Helper

        if(isset($request->player_uuid)){

            $reciver = Profile::where('uuid',$request->player_uuid)->first();

            $model = $model->where('receiver_id',$reciver->id);

        }

        if(isset($request->payment_history_uuid)){

        	$model = $model->where('uuid',$request->payment_history_uuid);

        	$type  = 'single';
        }

        if($type == 'single')
        	$model = $model->first();
        else{
        	$model = $model->get();
        }

        $data['Payment'] = $model;

        return sendSuccess('Payment History',$data);


    }

}
