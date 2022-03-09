<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ClientPaidResourse;
use App\Http\Resources\ClientResoures;
use App\Http\Resources\ClientTwoResoures;
use App\Http\Resources\SubResoures;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\UserResoures;
use App\Http\Resources\UserSubscription;
use App\Models\City;
use App\Models\Clinet;
use App\Models\Enterprise;
use App\Models\Offer;
use App\Models\Subscriptions_User;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class UserController extends BaseController
{
    public  function login(Request $request)
    {
        $user = Clinet::where('phone',$request->phone)->first();
        if($user){
            $res['status']= $this->sendResponse('Created');
            // $res['data']['client'] = new UserResoures($user);
            // $res['token'] = $user->createToken('Personal Access Token')->accessToken;
                // $res['data']['client'] = new UserResoures($user);
            // $res['token'] = $user->createToken('Personal Access Token')->token;
            if($user->is_verify == 1){

            
            $res['data'][""]="";
            $res['other']['exist_status']= 'EXIST';
            $res['other']['for']= 'login';
            }else{
                $res['data'][""]="";
                $res['other']['exist_status']= 'NON-VERIFIED';
                $res['other']['for']= 'signup';  
            }
            if(get_general('actvie_sms') == '1'){
                $message = 'JOOY Offers Code: '.$user->code;

                send_message($user->phone,$message );
            }


        }else{
            $user = new Clinet();
            $user->phone = $request->phone;
            $user->code = 1991;
            $user->image = 'default.jpeg';
            $user->country_id = 1;
            $user->type_of_subscribe = 'FREE';
            $uuid = 'jooy';
            $enter = Enterprise::where('uuid',$uuid)->first();
            if($enter){
            $user->uuid_type =  'enterprise';
            $user->enterprise_id = $enter->id;
            }else{
                $res['status']=$this->sendError();
                $res['meessage'] = 'not found enterprise unkonw uuid';
                return  $res;
            }
            // if(!$enter){
            //     $ee = Offer::where('uuid',$uuid)->first();
            //     if($ee){
            //         $user->uuid_type =  'offer';
            //         $user->offer_id = $ee->id;  
            //     }
            // }else{
            //     $user->uuid_type =  'null';
            // }
            // dd($uuid);

            
            $user->save();
            
            if(get_general('actvie_sms') == '1'){
                $message = 'JOOY Offers Code: '.$user->code;

                send_message($user->phone,$message );
            }
            $res['status']= $this->sendResponse('Created');

            // $res['data']['client'] = new ClientResoures($user);

            // $res['token'] = $user->createToken('Personal Access Token')->token;
            $res['data'][""]="";
            $res['other']['exist_status']= 'NEW';
            $res['other']['for']= 'signup';
        }
        return $res;
    }
    public function resend_sms(Request $request){
        $phone = $request->phone;
        $code = 1991;
        
        // $user = Clinet::where('phone',$phone)->first();
        // dd($user);
        // $user->code = 1991;
        // $user->save();
        $message = 'JOOY Offers Code: '.$code;
        if(get_general('actvie_sms') == '1'){
            send_message($request->phone,$message );
        }
        $res['status']= $this->sendResponse('Created');

        // $res['data']['client'] = new ClientResoures($user);

        // $res['token'] = $user->createToken('Personal Access Token')->token;
        $res['data'][""]="";
        return $res;


    }
    public function update(Request $request){
        $user = auth('client_api')->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nationality = $request->nationality;
        $user->gender = $request->gender;
        $user->birth_date = $request->birth_date;
        $user->save();
        $res['status']= $this->sendResponse200('OK');
        if($user->type_of_subscribe == null || $user->type_of_subscribe == 'Free'){
            $res['data']['client'] =  new ClientResoures($user);

        }
        $res['data']['client'] = new ClientPaidResourse($user);



        return $res;
    }
    public function verification_code(Request $request){
    
        $user = Clinet::where('phone',$request->phone)->where('code',$request->verification_code)->first();
        // dd($user);
        if($user){
            $user->last_login = Carbon::now();
            $user->is_verify = 1;
            $user->save();
            $res['status']= $this->sendResponse200('OK');
            // $res['data']['client'] = new UserResoures($user);
            $res['data']['client'] = new ClientResoures($user);
            // $res['data']['token'] = $user->createToken('Personal Access Token')->accessToken;

            // $res['token'] = $user->createToken('Personal Access Token')->token;
            // $res['data'][""]="";
            $res['other']['is_trial_subscriber']= false;
            return $res;
        }else{
            $res['status']=$this->sendError();
            return  $res;
        }
    }
    public function user_info()
    {
      

        $user = auth('client_api')->user();
       
       
        $res['status']= $this->sendResponse200('OK');
        if($user->type_of_subscribe == null || $user->type_of_subscribe == 'Free'){
            $res['data']['client'] =  new ClientResoures($user);
            $res['other']['is_trial_subscriber']= false;

        }
        $res['data']['client'] = new ClientPaidResourse($user);
        return $res;
    }
    public function register_token(Request $request)
    {
      

        $user = auth('client_api')->user();
        $user->token = $request->registration_id;
        $user->save();
       
        $res['status']= $this->sendResponse('Created');
        $res['data']['data'][''] ="" ;

        return $res;
    }
    public function current_subscription(){
        $user = auth('client_api')->user();
        
       
        $res['status']= $this->sendResponse200('ok');
        $sub = Subscriptions_User::where('clinet_id',$user->id)->orderBy('id','desc')->first();
        
        $res['data']['client_subscription'] =new UserSubscription($sub);

        return $res;
    }
    public function update_image(Request $request){
        $user = auth('client_api')->user();
        $user->image = $request->image->store('client/image');
        $user->save();
        $res['status']= $this->sendResponse200('OK');
        if($user->type_of_subscribe == null || $user->type_of_subscribe == 'Free'){
            $res['data']['client'] =  new ClientResoures($user);
        }
        $res['data']['client'] = new ClientPaidResourse($user);
        return $res;
    }
    public function transactions(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('paginate') ? $request->get('paginate') : 10;
        $trans = Transaction::where('client_id',auth('')->id())->orderBy('id','desc')->limit($limit)->offset(($page - 1) * $limit)->get();
        $res['status']= $this->sendResponse200('OK');
        $res['data']['transactions'] = new TransactionCollection($trans);
        return $res;
    }
    public function update_city(Request $request){
        $user = auth('client_api')->user();
        $city = City::find($request->city_id);
        if(!$city){
            $res['status']=$this->sendError();
            $res['message']= 'city not found';
            return  $res;
        }
        $user->city_id = $request->city_id;
        $user->save();
        $res['status']= $this->sendResponse200('OK');
        if($user->type_of_subscribe == null || $user->type_of_subscribe == 'Free'){
            $res['data']['client'] =  new ClientResoures($user);

        }
        $res['data']['client'] = new ClientPaidResourse($user);
        return $res;
    }
    public function logout() {
        // dd
       $user = auth('client_api')->user();
       $user->tokens->each(function($token, $key) {
      
            $token->delete();
        });
        $user->token = null;
        $user->save();
        $res['status']= $this->sendResponse200('OK');
        $res['data']['']="";


    
        return $res;
    }
}
