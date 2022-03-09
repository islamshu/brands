<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FavoritVendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\FavoritCollection;
use App\Http\Resources\FavoritOfferCollection;
use App\Models\FavoritOffer;
use App\Models\Offer;
use App\Models\Vendor;

class FavoritController extends BaseController
{
    public function store_to_favorate(Request $request)
    {
        $vendor = Vendor::find($request->store_id);
        if ($vendor) {
          
                $fav = new FavoritVendor();
                $fav->user_id = auth('client_api')->id();
                $fav->vendor_id = $request->store_id;
                $fav->save();
                $res['status'] = $this->sendResponse('Created');
                $res['data'][''] = "";
            
        
        } else {
            $res['status'] = $this->SendError();
        }
        return $res;
    }
    
    public function delete_from_favorate(Request $request)
    {
        $vendor = Vendor::find($request->vendor_id);

        FavoritVendor::where('user_id',auth('client_api')->id())->where('vendor_id',$request->store_id)->first()->delete();
        $res['status'] = $this->SendDeleteRquest();
        return $res;
    }
    public function store_favorite(Request $request)
    {
        $page = $request->last_index +2;
    $limit = $request->has('paginate') ? $request->get('paginate') : 10;
        $fav = FavoritVendor::where('user_id', auth('client_api')->id())->limit($limit)->offset(($page - 1) * $limit)->get();
        $res['status'] = $this->sendResponse('Ok');
        $res['data'] = new FavoritCollection($fav);
        return $res;
    }
    public function AddOrRemoveOfferFavorit(Request $request)
    {
        $vendor = Offer::find($request->offer_id);
        if ($vendor) {
            $fav = new FavoritOffer();
            $fav->user_id = auth('client_api')->id();
            $fav->offer_id = $request->offer_id;
            $fav->save();
            $res['status'] = $this->sendResponse('Created');
            $res['data'][''] = "";
        } else {

            $res['status'] = $this->SendError();
            
        }
        return $res;
    }
    
    public function OfferDeleteFovarit(Request $request)
    {
        $vendor = Offer::find($request->offer_id);
      
            $fav =  FavoritOffer::where('user_id', auth('client_api')->id())->where('offer_id', $request->offer_id)->first();
        
                $fav->delete();
                $res['status'] = $this->sendResponse('Deleted');
                $res['data'][''] = "";
          
            return $res;
        
    }
    public function offer_favorite(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('paginate') ? $request->get('paginate') : 10;
        $fav = Offer::where('status',1)->with('offerfav')->whereHas('offerfav', function ($q) use ($request) {
            $q->where('user_id',  auth('client_api')->id());
        })->limit($limit)->offset(($page - 1) * $limit)->get();
        $res['status'] = $this->sendResponse('Ok');
        $res['data'] = new FavoritOfferCollection($fav);
        return $res;
    }
}
