<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\PakegeResourses;
use App\Models\Code;
use App\Models\CodePermfomed;
use App\Models\CodeSubscription;
use App\Models\Discount;
use App\Models\DiscountSubscription;
use App\Models\Offer;
use App\Models\OfferUser;
use App\Models\Performed;
use App\Models\PromocodeUser;
use App\Models\Subscription;
use App\Models\Subscriptions_User;
use App\Models\Transaction;
use App\Models\Vendor;
use Carbon\Carbon;

class CodeController extends BaseController
{
    public function sub_by_activiton(Request $request)
    {
        // dd(auth('client_api')->id());
        $codesub = CodeSubscription::where('code', $request->activation_code)->first();
        if ($codesub->is_used == 1) {
            $res['status'] = $this->sendNewErorr('Failed to Subscribe', 'Activition Code is not Found or Used');
            return $res;
        }
        $code = Subscription::with('codes')->whereHas('codes', function ($q) use ($request) {
            $q->where('code', $request->activation_code);
        })->first();

        if (!$code) {
            $res['status'] = $this->sendNewErorr('Failed to Subscribe', 'Activition Code is not Found or Used');

            return $res;
        }
        $count = Subscriptions_User::where('clinet_id', auth('client_api')->id())->where('sub_id', $code->id)->count();
        $user = new Subscriptions_User();
        $user->payment_type = 'activition_code';
        // dd(auth('client_api')->id());
        $client = auth('client_api')->user();
        $client->type_of_subscribe = $code->type_paid;

        if ($code->type_balance == 'Limit') {
            $client->is_unlimited = 0;
            $client->credit = $code->balance;
            $client->remain = $code->balance;
        } elseif ($code->type_balance == 'UnLimit') {
            $client->is_unlimited = 1;
            $client->credit = null;
            $client->remain = null;
        }
        $client->start_date = Carbon::now();
        $data_type = $code->expire_date_type;
        $data_type_number = $code->number_of_dayes;
        if ($data_type == 'days') {
            $client->expire_date = Carbon::now()->addDays($data_type_number);
        } elseif ($data_type == 'months') {
            $client->expire_date = Carbon::now()->addMonths($data_type_number);
        } elseif ($data_type == 'years') {
            $client->expire_date = Carbon::now()->addYears($data_type_number);
        }
        $client->save();

        if ($data_type == 'days') {
            $user->expire_date = Carbon::now()->addDays($data_type_number);
        } elseif ($data_type == 'months') {
            $user->expire_date = Carbon::now()->addMonths($data_type_number);
        } elseif ($data_type == 'years') {
            $user->expire_date = Carbon::now()->addYears($data_type_number);
        }
        $user->status = 'active';
        $user->balnce = $code->balance;
        $user->purchases_no =  $count + 1;
        $user->sub_id  = $code->id;
        $user->clinet_id  = auth('client_api')->id();
        $user->save();
        $codesub->is_used = 1;
        $codesub->save();
        $res['status'] = $this->sendResponse('Created');
        $res['status']['title'] = "";
        $res['status']['message'] = "";

        $res['data']["package"] = new PakegeResourses($code);
        return $res;
    }
    public function redeem(Request $request)
    {
        $user = auth('client_api')->user();
        if ($user->status != 'active') {
            $user->type_paid_user == 'free';
        }
        $type_paid_user = $user->subs->last()->subscripe->type_paid;
        $offer = Offer::find($request->offer_id);
        $vendor = Vendor::find($offer->vendor_id);
        if(!($vendor->qr_code == $request->store_pin_code || $request->store_pin_code == 'dbc4d84bfcfe2284ba11beffb853a8c4')){
            $res['status'] = $this->SendError();
                $res['status']['title'] = 'Purchase is Fail';
                $res['status']['message'] = 'The PIN code is wrong';
                return $res;
        }
        
        if (!$offer) {
            $res['status'] = $this->SendError();
            $res['status']['title'] = 'Purchase is Fail';
            $res['status']['message'] = 'Not Found Offer';
            return $res;
        }
        $enterprise = Vendor::find($offer->vendor_id)->enterprise_id;


        $numer_time =Transaction::where('offer_id',$request->offer_id)->where('client_id',auth('client_api')->id())->count();
        
        // dd($codes);
        $system_uses = $offer->usege_system;
        $client_uses = $offer->usege_member;


        $type_of_offer = $offer->member_type;

        if ($system_uses != 'unlimit') {
            if ($offer->usage_number_system <= $numer_time) {
                $res['status'] = $this->SendError();
                $res['message'] = 'System count is full error 2';
                return $res;
            }
        }
        if ($client_uses != 'unlimit') {
            if ($offer->usage_member_number <= $numer_time) {
                $res['status'] = $this->SendError();
                $res['status']['title'] = 'Purchase is Fail';
                $res['status']['message'] = 'The PIN code is wrong error 3';
                return $res;
            }
        }
        if (($type_of_offer == 'Premium' && $type_paid_user == 'PREMIUM') || $type_of_offer == 'all' || ($type_of_offer == 'free' && $type_paid_user == 'TRIAL' || $type_paid_user == 'FREE' || $type_paid_user == 'PREMIUM' )) {


            if ($offer->usege_member == 'unlimit' || $offer->usage_member_number > $numer_time) {
                $ofe = new OfferUser();
                $ofe->offer_id = $request->offer_id;
                $ofe->vendor_id = $offer->vendor_id;
                $ofe->client_id = auth('client_api')->id();
                $ofe->branch_id = $request->branch_id;
                $user->purchases_no += 1;
                if($user->is_unlimited != 1){

                
                if ($type_of_offer != 'free'  ) {
               
                    if ($user->remain > 0 && $user->remain != null) {
                        $user->remain = $user->remain - 1;
                    } else {
                        $res['status'] = $this->SendError();
                        $res['status']['title'] = 'Purchase is Fail';
                        $res['status']['message'] = 'The PIN code is wrong error 4';
                        return $res;
                    }
                }
            }
                if ($vendor->type_refound == 'auto') {
                    $ofe->referance_no = rand(000000000, 999999999);
                } else {
                    $codes = CodePermfomed::with('codes')->where('vendor_id', $request->store_id)->first()->codes->where('is_user', 0)->first();
                    $ofe->referance_no = $codes->code;
                    $f = Performed::where('code', $codes->code)->first();
                    $f->is_used = 1;
                    $f->save();
                }

                $ofe->save();
                $user->used_offers_no = $user->used_offers_no + 1;
                $user->save();
                $trans = new Transaction();
                $trans->client_id = auth('client_api')->id();
                $trans->offer_id = $request->offer_id;
                $trans->vendor_id = $offer->vendor_id;
                $trans->offer_id = $request->offer_id;
                $trans->branch_id = $request->branch_id;
                $trans->enterprise_id = $enterprise;
                $trans->refreance_number = $ofe->referance_no;
                $trans->price = $offer->price;
                $trans->offer_type = $offer->offertype->offer_type;
                
                $trans->save();
                $vendor->sales += 1;
                $vendor->save();
                $res['status'] = $this->sendResponse('Created');
                $res['status']['title'] = '';
                $res['status']['message'] = '';
                $res['data']["coupon"]['id'] = $ofe->id;
                $res['data']["coupon"]['offer_id'] = (int)$request->offer_id;
                $res['data']["coupon"]['branch_id'] = (int)$request->branch_id;
                $res['data']["coupon"]['store_id'] = (int)$offer->vendor_id;
                $res['data']["coupon"]['saving'] = 0;
                $res['data']["coupon"]['reference_no'] = (int)$ofe->referance_no;
                return $res;
            } else {
                $res['status'] = $this->SendError();
                $res['status']['title'] = 'Purchase is Fail';
                $res['status']['message'] = 'The PIN code is wrong error 5';
                return $res;
            }
        } else {

            $res['status'] = $this->SendError();
            $res['status']['title'] = 'Purchase is Fail';
            $res['status']['message'] = 'The PIN code is wrong error 6';
            return $res;
        }
    }
    public function apply_promo_code(Request $request)
    {

        if($request->code != null){
            $discout = DiscountSubscription::where('code',$request->code)->first();
            if($discout){
                    $sub = Subscription::find($discout->sub_id);
                    $price =$sub->price;
                   $dis= Discount::find($discout->discount_id);
                   if($dis){
                       $count_useage = PromocodeUser::where('promocode',$request->promo_code)->count();
                       if($dis->type_of_limit == 'unlimit' || $dis->value > $count_useage ){
                       if(Carbon::now()->isoFormat('YYYY-MM-DD') >= $dis->start_at && Carbon::now()->isoFormat('YYYY-MM-DD') <= $dis->end_at ){
                             if($dis->type_discount == 'fixed'){
                                 $price = $price - $dis->value_discount ;
                             }else{
                                $price = ($dis->value / 100) * $price;
                             }
                             $res['status'] = $this->sendResponse200('OK');
                        $res['data']['discount']["price"] = $price;
                        $res['data']['discount']["discout_type"] = $dis->type_discount;
                        $res['data']['discount']["discout_value"] = $dis->value_discount;
                        if ( $dis->type_discount == 'percentage') {
                            $total =     $price -  ($price * $dis->value_discount / 100);
                        } else {
                            $total =     $price -  $dis->value_discount;
                        }
                        $res['data']['discount']['discount_percentage']= strval(100 * ($price - $total) / $price);
                        $res['data']['discount']["price_after_discount"] = $total;
                        return $res;

                       }else{
                        $res['status'] = $this->SendError();
                        $res['status']['message'] = 'The promocode has expired';
                        return $res; 
                       }
                    }else{
                        $res['status'] = $this->SendError();
                        $res['status']['message'] = 'The promocode not available';
                        return $res;    
                    }
                       
                   }else{
                    $res['status'] = $this->SendError();
                    $res['status']['message'] = 'Not Found Promocode';
                    return $res; 
                   }
                }
            }else{
                $res['status'] = $this->SendError();
                $res['status']['message'] = 'Not Found Promocode';
                return $res; 
            }
            
        }












    
}
