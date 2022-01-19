<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Card;
use App\Models\User;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use App\Models\SignupVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request){

        $validator = Validator::make($request->all(), [

            'email'        => 'required_without:phone_number|string|email',

            'phone_number' => 'required_without:email',
            'phone_code'   => 'required_without:email',

            'password'     => 'required'

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $credentials = $request->only('email', 'password');


        $check = User::where('email', $request->email)->first();
        $login_type = 'email';

        if(!$check){
            $check = User::where('phone_number', $request->phone_number)->where('phone_code', $request->phone)->first();
            $login_type = 'number';
            $credentials = $request->only('phone_code', 'phone_number', 'password');
        }

        //check if email is verified
        if($check && ($check->email_verified_at == NULL) && isset($request->email) && $login_type == 'email'){
        // dd($check, $request->all());

            $code = mt_rand(1000, 9999);

            DB::delete('Delete from signup_verifications where email = ?',[$request->email]);

            Log::info($code);

                Mail::send('email_template.verification_code', ['name' => $check->profile->first_name.' '.$check->profile->last_name, 'code' => $code], function ($m) use ($check) {
                    $m->from(config('mail.from.address'), config('mail.from.name'));
                    $m->to($check->email, $check->profile->first_name.$check->profile->last_name)->subject('Account Verification');
                });

            // SAVE VERIFICATION TOKEN
            $signupVerification = new SignupVerification;

            $signupVerification->type = 'email';
            $signupVerification->email = $request->email;
            $signupVerification->token = $code;
            $signupVerification->save();

            $data['code'] = $code;
            return sendError('User Not Verified. Verification code sent to linked Email.', $data);
        }

        //check if phone no is verified
        if($check && ($check->phone_verified_at == NULL) && isset($request->phone_number) && isset($request->phone_code) && $login_type == 'number'){
            $code = mt_rand(1000, 9999);

            DB::delete('Delete from signup_verifications where phone = ?',[$request->phone_code.$request->phone_number]);

            Log::info($code);

            // $twilio = new TwilioController;
            // if(!$twilio->sendMessage($check->phone_code.$check->phone_number, 'Enter this code to verify your Grabions account ' . $code)) {
            //     return sendError('Phone is invalid', NULL);
            // }

            // SAVE VERIFICATION TOKEN
            $signupVerification = new SignupVerification;

            $signupVerification->type = 'phone';
            $signupVerification->phone = $request->phone_code.$request->phone_number;
            $signupVerification->token = $code;
            $signupVerification->save();

            $data['code'] = $code;
            return sendError('User Not Verified. Verification code sent to linked Email.', $data);
        }

        //attept Login
        if(Auth::attempt($credentials)){
        // dd($check, $request->all(), "123");

            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            if(isset($request->remember_me) && $request->remember_me != '' && $request->remember_me == 1)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            // User::where('id', $user->id)->update(['is_online' => true]); //set online to 1

            $data['access_token'] = $tokenResult->accessToken;
            $data['token_type']   = 'Bearer';
            $data['expires_at']   = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
            $data['user']         = User::where('id', $request->user()->id)->first();

            return sendSuccess('Login successfully.', $data);
        }

        return sendError('Email or password is incorrect.', null);
    }

    public function signup(Request $request){
        $validator = Validator::make($request->all(), [

            'is_social'     => 'required|in:1,0',

            'email'         => 'required_if:phone_number,NULL|unique:users,email',
            // 'phone_code'    => 'required_if:is_social,0',
            'phone_number'  => 'required_if:is_social,0|unique:users,phone_number',
            'password'      => 'required_if:is_social,0',

            'social_id'     => 'required_if:is_social,1',
            'social_type'   => 'required_if:is_social,1|in:facebook,google,twitter,apple',

            'profile_type'  => 'in:player,manger',
            'position'      => 'required|in:goalkeeper,defender,midfielder,forward',

            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'username'      => 'required|unique:profiles,username',
            'favorite_club' => 'required|string',
            'gender'        => 'required|in:male,female',
            'price'         => 'required|numeric',

            // 'city'          => 'required|string',
            // 'country'       => 'required|string',
            'address'       => 'string',
            'state'         => 'string',

            'dob'           => 'required|date',
            'bio'           => 'string',

            'is_twilio'     => 'in:1',
            'is_email'      => 'in:1',

        ]);
        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        //Twilio Check -----------------------

        $code = mt_rand(1000, 9999);

        // if(!isset($request->is_twilio)){

        // dd('DumpMan');
            // $twilio = new TwilioController;
            // $twilioResponse = $twilio->isValidNumber($request->phone_code, $request->phone_number);
            // // dd($request->phone_code, $request->phone_number);
            // dd($request->phone_code, $request->phone_number);
            // // dd($request->phone_code, $request->phone_number);


            // // dd($request->phone_code, $request->phone_number);

            // if(!$twilioResponse)
            //     return sendError('Phone number is invalid', null);

        // }
        //end Twilio Check----------------------------------

            $check = new User;

            $check = User::where('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();

            if($check){

                if($check->email == $request->email && $check->phone_number == $request->phone_number)
                    return sendError('User exists already', null);

                if($check->email == $request->email)
                    return sendError('Email exists already', null);

                if($check->phone_number == $request->phone_number)
                    return sendError('Phone exists already', null);

            }  // end if check


        try {
            DB::beginTransaction();

            //  PROFILE CREATE  ---------------------------------------------------------------------

            $check = Profile::where('username',$request->username)->first();
            if($check){
                DB::rollBack();
                return sendError('Usernname already exists', null);

            }


            $profile = new Profile;

            $profile->uuid = Str::uuid();

            $profile->profile_type  = $request->profile_type ?? 'player';
            $profile->position      = $request->position ?? NULL;
            $profile->first_name    = $request->first_name ?? NULL ;
            $profile->last_name     = $request->last_name ?? NULL ;
            $profile->username      = $request->username ?? NULL ;
            $profile->dob           = $request->dob ?? NULL ;
            $profile->bio           = $request->bio ?? NULL ;
            $profile->profile_image = $request->profile_image ?? 'images/user-no-image.png' ?? NULL ;
            $profile->favorite_club = $request->favorite_club ?? NULL ;
            $profile->gender        = $request->gender;
            $profile->price         = $request->price;

            if($profile->save()){

                //  ADDRESS CREATE ---------------------------------------------------------------------
                $address = new Address;

                $profile->uuid       = Str::uuid();
                $address->profile_id = $profile->id ?? NULL;
                $address->address    = $request->address ?? NULL;
                $address->address1   = $request->address1 ?? NULL;
                $address->city       = $request->city ?? NULL;
                $address->state      = $request->state ?? NULL;
                $address->zip        = $request->zip ?? NULL;
                $address->latitude   = $request->latitude ?? NULL;
                $address->longitude  = $request->longitude ?? NULL;
                $address->country    = $request->country ?? NULL;
                $address->is_default = true;

                if($address->save()){

                    //  USER CREATE ---------------------------------------------------------------------
                    $user = new User;

                    $user->uuid      = Str::uuid();
                    $user->is_social = $request->is_social;

                    //check if Social data is Given

                    if($request->is_social == 1){

                        $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
                        $user->phone_verified_at = Carbon::now()->format('Y-m-d H:i:s');
                        $user->social_type       = $request->social_type;
                        $user->social_id         = $request->social_id;
                        $user->social_email      = $request->email;
                        $user->email             = $request->email;

                    } else {

                        // if(isset($request->is_twilio))
                        //     $user->phone_verified_at = Carbon::now()->format('Y-m-d H:i:s');

                        if(isset($request->is_email))
                            $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');

                        $user->email        = $request->email;
                        $user->phone_code   = $request->phone_code;
                        $user->phone_number = $request->phone_number;
                        $user->position     = $profile->position;
                        $user->profile_id   = $profile->id;
                        $user->password     = bcrypt($request->password);
                        $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
                        $user->phone_verified_at = Carbon::now()->format('Y-m-d H:i:s');
                    }

                    if($user->save()) {
                        Profile::where('id', $profile->id)->update(['user_id'=>$user->id]);

                        if($request->is_social == 1){
                            return $this->socialLogin($request);

                        }else{


                            // if(!isset($request->is_twilio)){

                            //     if(!$twilio->sendMessage($request->phone_code.$request->phone_number, 'Enter this code to verify your Grabions account ' . $code)) {
                            //         return sendError('Phone is invalid', NULL);
                            //     }
                            // }

                            if(!isset($request->is_email)){

                                Mail::send('email_template.verification_code', ['name' => $profile->first_name.' '. $profile->last_name, 'code' => $code], function ($m) use ($user, $profile) {

                                    $m->from(config('mail.from.address'), config('mail.from.name'));
                                    $m->to($user->email, $profile->first_name.' '.$profile->last_name)->subject('Account Verification');
                                });

                            }

                            // if(!isset($request->is_twilio)){

                            //     if(!$twilio->sendMessage($request->phone_code.$request->phone_number, 'Enter this code to verify your FootBall account ' . $code)) {
                            //         return sendError('Phone is invalid', NULL);
                            //     }
                            // }

                            // if(!isset($request->is_email)){

                                // dd($profile->first_name);

                                // Mail::send('email_template.verification_code', [
                                //     'name' => $profile->first_name.' '. $profile->last_name,
                                //     'code' => $code], function ($m) use ($user, $profile) {

                                //         $m->from(config('mail.from.address'), config('mail.from.name'));
                                //         $m->to($user->email, $profile->first_name.' '.$profile->last_name)->subject('Account Verification');
                                // });

                            // }

                            Log::info($code);

                            // SAVE VERIFICATION TOKEN
                            $signupVerification = new SignupVerification;

                            $signupVerification->type = 'both';
                            $signupVerification->email = $request->email;
                            $signupVerification->phone = $request->phone_code.$request->phone_number;
                            $signupVerification->token = $code;
                            $signupVerification->save();

                            DB::commit();

                            $data[ 'code' ] = $code;
                            // dd($data);
                            return sendSuccess('Successfully Created User', $data);
                        }
                    }
                    DB::rollBack();
                    return sendError('There is some problem.', null);
                }

                DB::rollBack();
                return sendError('There is some problem.', null);
            }
            DB::rollBack();
            return sendError('There is some problem.', null);

        }catch (\Exception $ex){
            DB::rollBack();
            $data['exception_error'] = $ex->getMessage();
            return sendError('There is some problem.', $data);
        }

        DB::rollBack();
        return sendError('There is some problem.', null);
    }

    public function changeSocialLoginPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'new_password' =>'required',
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }
        $user = User::where('id', \Auth::user()->id)->first();

        if(null == $user){
            return sendError('404. User Not Found', null);
        }


        try{
            $user->password = bcrypt($request->new_password);
            $user->is_social_password_updated = 1;

            $user->save();
            return sendSuccess('Password Updated Successfully', null);
        }
        catch (\Exception $ex){
            DB::rollBack();
            $data['exception_error'] = $ex->getMessage();
            return sendError('There is some problem.', $data);
        }
    }

    public function socialLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email'       => 'required_unless:social_type,apple',
            'social_id'   => 'required',
            'social_type' => 'required'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = null;

        if($request->social_type == 'apple'){
            $user = User::where('social_id', $request->social_id)->first();
        }else{
            $user = User::where('email',  $request->email)->where('social_id', $request->social_id)->first();
        }

        $check1 = User::where('email',  $request->email)->first();
        if(!$user && $check1){
            return sendError('Email has been registered already with another account.', null);
        }

        $check2 = User::where('social_id', $request->social_id)->first();
        if(!$user && $check2){
            return sendError('Account has been registered with another email.', null);
        }

        if(!$user){
            return sendError('not_registered.', null);
        }

        Auth::login($user);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        User::where('id', $user->profile_id)->update(['is_online' => true]);

        $data['access_token'] = $tokenResult->accessToken;
        $data['token_type'] = 'Bearer';
        $data['expires_at'] = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
        $data['user'] = User::where('id', $request->user()->id)->first();
        return sendSuccess('Login successfully.', $data);
    }

    public function verifyUser(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = User::where('email',  $request->email)->first();

        if(!$user){
            return sendError('Email is not registered.', null);
        }

        Auth::login($user);

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        User::where('id', $user->id)->update(['email_verified_at' => Carbon::now('utc')->format('Y-m-d H:i:s'), 'phone_verified_at' => Carbon::now('utc')->format('Y-m-d H:i:s')]);
        Profile::where('id', $user->profile_id)->update(['is_online' => true]);

        $data['access_token'] = $tokenResult->accessToken;
        $data['token_type'] = 'Bearer';
        $data['expires_at'] = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
        $data['user'] = getUser()->where('id', $request->user()->id)->first();
        return sendSuccess('Verified successfully.', $data);
    }

    public function verifyUserWithCode(Request $request){
        $validator = Validator::make($request->all(), [
            'activation_type' => 'required|in:phone,email',
            'activation_email' => 'required_if:activation_type,email',
            'activation_phone_code' => 'required_if:activation_type,phone',
            'activation_phone_number' => 'required_if:activation_type,phone',
            'activation_code' => 'required',
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        if($request->activation_type == 'email'){
            $res1 = DB::select("select * from signup_verifications where email = ? and token = ?", [$request->activation_email, $request->activation_code]);

            if(count($res1) < 1){
                return sendError('Code does not match', null);
            }

            DB::delete('Delete from signup_verifications where email = ?',[$request->activation_email]);

            $user = User::where('email',  $request->activation_email)->first();

            if(!$user){
                return sendError('Email is not registered.', null);
            }

            User::where('id', $user->id)->update(['email_verified_at' => Carbon::now('utc')->format('Y-m-d H:i:s')]);

            return sendSuccess('Verified successfully.', null);

        }else{
            $res1 = DB::select("select * from signup_verifications where phone = ? and token = ?", [$request->activation_phone_code.$request->activation_phone_number, $request->activation_code]);

            if(count($res1) < 1){
                return sendError('Code does not match', null);
            }

            DB::delete('Delete from signup_verifications where phone = ?',[$request->activation_phone_code.$request->activation_phone_number]);

            $user = User::where('phone_number',  $request->activation_phone_number)->first();

            if(!$user){
                return sendError('Phone is not registered.', null);
            }

            User::where('id', $user->id)->update(['phone_verified_at' => Carbon::now('utc')->format('Y-m-d H:i:s')]);

            return sendSuccess('Verified successfully.', null);
        }

    }

    public function logout(Request $request){
        $user = $request->user();
        if($user){
            $user->token()->revoke();
            User::where('id', $user->id)->update(['is_online' => false]);
        }
        return sendSuccess('Successfully logged out', null);
    }

    public function user(Request $request){
        $validator = Validator::make($request->all(), [
            'is_online' => 'in:1,0'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = ($request->user_id) ? getUser()->where('id', $request->user_id)->first() : getUser()->where('id', $request->user()->id)->first();

        if($user){

            if(isset($request->is_online) &&  (NULL != $request->is_online)){
                    $user->is_online = $request->is_online;
            }

            $data['user'] = $user;
            return sendSuccess('success.', $data);
        }
        return sendError('User Not Found.', null);
    }

    public function forgotPasswordCode(Request $request) {
        $validator = Validator::make($request->all(), [
            'reference' => 'required'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = User::where('email', $request->reference)->first();
        $type = 'email';

        if(!$user){
            $user = User::whereRaw("CONCAT(phone_code, phone_number) = ?", [$request->reference])->first();
            $type = 'phone';
        }
        // dd($user, "asdfafa");
        if(!$user){
            return sendError('User not found', null);
        }

        $code = mt_rand(1000, 9999);
        $data['code'] = $code;
        $data['type'] = $type;

        if($type == 'email'){

            // Mail::send('email_template.forgot_password', ['name' => $user->profile->first_name.' '.$user->profile->last_name, 'code' => $code], function ($m) use ($user) {
            //     $m->from(config('mail.from.address'), config('mail.from.name'));
            //     $m->to($user->email, $user->profile->first_name.$user->profile->last_name)->subject('Forget Password Rquest');
            // });

            // Mail::send('email_template.forgot_password', ['name' => $user->profile->first_name.' '.$user->profile->last_name, 'code' => $code], function ($m) use ($user) {
            //     $m->from(config('mail.from.address'), config('mail.from.name'));
            //     $m->to($user->email, $user->profile->first_name.$user->profile->last_name)->subject('Forget Password Rquest');
            // });

            DB::delete('Delete from password_resets where email = ?',[$user->email]);
            DB::insert('Insert into password_resets (type, email, token) values(?, ?, ?)',['email', $user->email, $code]);

            return sendSuccess('Code sent on email', $data);

        }elseif($type == 'phone'){
            // $twilio = new TwilioController;
            // if(!$twilio->sendMessage($user->phone_code.$user->phone_number, 'Enter this code to verify your Grabions account ' . $code)) {
            //     return sendError('Phone is invalid', NULL);
            // }

            // $twilio = new TwilioController;
            // if(!$twilio->sendMessage($user->phone_code.$user->phone_number, 'Enter this code to verify your Grabions account ' . $code)) {
            //     return sendError('Phone is invalid', NULL);
            // }


            DB::delete('Delete from password_resets where phone = ?',[$user->phone_code.$user->phone_number]);
            DB::insert('Insert into password_resets (type, phone, token) values(?, ?, ?)',['phone', $user->phone_code.$user->phone_number, $code]);

            return sendSuccess('Code sent on phone', $data);
        }
        return sendError('There is some problem.', null);
    }

    public function recoverPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'reference' => 'required',
            'password' => 'required',
            'code' => 'required',
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $check = DB::select('Select * from password_resets where (email = ? AND token = ?) OR (phone = ? AND token = ?)',[$request->reference, $request->code, $request->reference, $request->code]);

        if($check){
            $user = User::where('email', $request->reference)->orwhereRaw("CONCAT(phone_code, phone_number) = ?", [$request->reference])->first();
        }

        if(!$user){
            return sendError('User not found', null);
        }

        $user->password = bcrypt($request->password);

        if($user->save()){
            DB::delete('Delete from password_resets where id = ?',[$check['0']->id]);
            return sendSuccess('Password updated successfully', null);
        }

        return sendError('There is some problem.', null);
    }

    public function updatePhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_uuid' => 'required|exists:users,uuid',
            'password' => 'required',
            'phone_number' => 'required_without:email',
            'phone_code' => 'required_with:phone_number',
            'email' => 'required_without:phone_number'
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $code = mt_rand(1000, 9999);

            // $twilio = new TwilioController;
            // $twilioResponse = $twilio->isValidNumber($request->phone_code, $request->phone_number);

            // if (!$twilioResponse)
            //     return sendError('Phone number is invalid', null);

            // $twilio = new TwilioController;
            // $twilioResponse = $twilio->isValidNumber($request->phone_code, $request->phone_number);

            // if (!$twilioResponse)
            //     return sendError('Phone number is invalid', null);

            $signupVerification = new SignupVerification;

            $signupVerification->type = 'phone';
            $signupVerification->email = $request->phone_number;
            $signupVerification->token = $code;
            $signupVerification->save();


        return sendSuccess('Phone code send  successfully', null);

    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $code = mt_rand(1000, 9999);

        // dd($code);

        $check =  User::where('email', $request->email)->first();
        // dd($check);
        if($check)
        {
            // Mail::send('email_template.verification_code', ['name' => $check->profile->first_name . ' ' . $check->profile->last_name, 'code' => $code], function ($m) use ($check) {
            //     $m->from(config('mail.from.address'), config('mail.from.name'));
            //     $m->to($check->email, $check->profile->first_name . $check->profile->last_name)->subject('Account Verification');
            // });

            // SAVE VERIFICATION TOKEN
            $passwordRest = new PasswordReset;

            $passwordRest->type = 'email';
            $passwordRest->email = $request->email;
            $passwordRest->token = $code;
            $passwordRest->save();
            return sendSuccess('Phone code send  successfully', null);

        }
            return sendError('Email is invalid', null);

    }


    public function createNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $code = mt_rand(1000, 9999);

        $check =  User::where('email', $request->email)->first();
        if ($check) {
            // Mail::send('email_template.verification_code', ['name' => $check->profile->first_name . ' ' . $check->profile->last_name, 'code' => $code], function ($m) use ($check) {
            //     $m->from(config('mail.from.address'), config('mail.from.name'));
            //     $m->to($check->email, $check->profile->first_name . $check->profile->last_name)->subject('Account Verification');
            // });

            // SAVE VERIFICATION TOKEN
            $signupVerification = new SignupVerification;

            $signupVerification->type = 'email';
            $signupVerification->email = $request->email;
            $signupVerification->token = $code;
            $signupVerification->save();
            return sendSuccess('Phone code send  successfully', null);
        }
        return sendError('Email is invalid', null);
    }



    public function validateCode(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'code' => 'exists:password_resets,token',
        //     'phone_code' => 'exists:signup_verifications,token',
        // ]);

        // if ($validator->fails()) {
        //     $data['validation_error'] = $validator->getMessageBag();
        //     return sendError($validator->errors()->all()[0], $data);
        // }

        // dd($request->all());

        $token = $request->code;
        $code = PasswordReset::where('token', $token)->first();
        if($code)
        {
            return sendSuccess('Code valide successfully', $code);
        }

        $token = $request->phone_code;
        $code = SignupVerification::where('token', $token)->first();
        if ($code) {
            return sendSuccess('Code valide successfully', $code);
        }
        return sendError('Code is invalid', null);

    }



    public function updateNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'            => 'required',
            'current_password' => 'string',
            'new_password'     => 'required',
            'code'             => 'required|exists:password_resets,token',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        // dd($request->all());


        $check = User::where('email' , $request->email)->first();
        if(NULL == $check)
        {
            // return sendError('Current password is invalid', null);
        }


        if(isset($request->current_password))
        {
            if (!(Hash::check($request->current_password, $check->password))) {
                $token = $request->code;

                $code = PasswordReset::where('token', $token)->first();
                $code->delete();

                return sendError('Current password is invalid', null);

            }
        }

        $check->password = bcrypt($request->new_password);
        $check->save();

        $token = $request->code;

        $code = PasswordReset::where('token', $token)->first();
        $code->delete();

        return sendSuccess('passwword changed successfully', null);
    }


    public function updatePhoneNumber(Request $request){
        $validator = Validator::make($request->all(), [
            'old_phone'  => 'required_without:new_phone',
            'new_phone'  => 'required_without:old_phone',
            'phone_code' => 'required_without:old_phone',
            'password'   => 'required'
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = User::where('id',$request->user()->id)->first();
        if (!Hash::check($request->password, $user->password)) {
            return sendError('Invalid password', []);
        }

        if ($request->old_phone) {
            $code = mt_rand(1000, 9999);

            $signupVerification = new SignupVerification;

            $signupVerification->type = 'phone';
            $signupVerification->phone = $request->old_phone;
            $signupVerification->token = $code;
            $signupVerification->save();


            return sendSuccess('code', $code);
            // dd($code, "asdasd");

            // $twilio = new TwilioController;
            // if(!$twilio->sendMessage($user->phone_code.$user->phone_number, 'Enter this code to verify your Grabions account ' . $code)) {
            //     return sendError('Phone is invalid', NULL);
            // DB::insert('Insert into password_resets (type, phone, token) values(?, ?, ?)', ['phone', $user->phone_code . $user->phone_number, $code]);
            // }
        }

            if ($request->new_phone) {
                // dd("not ok");
                $user->phone_code = $request->phone_code;
                $user->phone_number = $request->new_phone;
                $user->save();

                return sendSuccess('Phone Number changed', []);
            }
        DB::delete('Delete from password_resets where phone = ?', [$user->phone_code . $user->phone_number]);

    }



    public function createNewEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $code = mt_rand(1000, 9999);

        $check =  User::where('email', $request->email)->first();

        if (!(Hash::check($request->password, $check->password))) {
            return sendError('Current password is invalid', null);
        }

        if ($check) {

            // Mail::send('email_template.verification_code', ['name' => $check->profile->first_name . ' ' . $check->profile->last_name, 'code' => $code], function ($m) use ($check) {
            //     $m->from(config('mail.from.address'), config('mail.from.name'));
            //     $m->to($check->email, $check->profile->first_name . $check->profile->last_name)->subject('Account Verification');
            // });

            // SAVE VERIFICATION TOKEN
            $passwordRest = new PasswordReset;

            $passwordRest->type = 'email';
            $passwordRest->email = $request->email;
            $passwordRest->token = $code;
            $passwordRest->save();
            // dd($passwordRest);
            return sendSuccess('Phone code send  successfully', null);
        }
        return sendError('Email is invalid', null);
    }



    public function updateNewEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'code' => 'required|exists:password_resets,token',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $token = $request->code;

        $code = PasswordReset::where('token', $token)->first();

        $check = User::where('email', $code->email)->first();
        // if (NULL == $check) {
        //     // return sendError('Current password is invalid', null);
        // }

        if (!(Hash::check($request->password, $check->password))) {
            return sendError('Password is invalid', null);
        }

        $check->email = $request->email;
        // dd($check);
        $check->save();
        $code->delete();
        return sendSuccess('Email changed successfully', null);
    }
}
