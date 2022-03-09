<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BranchCollection;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResourses;
use App\Http\Resources\CityCollection;
use App\Http\Resources\HomeSLiderCollection;
use App\Http\Resources\PopupResoures;
use App\Http\Resources\ReviewnewCollection;
use App\Http\Resources\SliderCollection;
use App\Http\Resources\StoresCollection;
use App\Http\Resources\SupportResourses;
use App\Http\Resources\VendorBranchesNewCollection;
use App\Http\Resources\VendorDetiesResourses;
use App\Http\Resources\VendorForOfferCollection;
use App\Http\Resources\VendorForOfferResourses;
use App\Http\Resources\VendorOfferCollection;
use App\Http\Resources\VendorOfferDeCollection;
use App\Http\Resources\VendorOfferDenewCollection;
use App\Http\Resources\VendorReviewCollection;
use App\Http\Resources\VendorReviewResourses;
use App\Http\Resources\VendorReviewsNewCollection;
use App\Models\Branch;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Enterprise;
use App\Models\Homeslider;
use App\Models\Offer;
use App\Models\Popup;
use App\Models\PopupUser;
use App\Models\Slider;
use App\Models\Support;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorReview;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class HomeController extends BaseController
{
  public function update_vendor_offer()
  {
    $vendor= Vendor::whereHas('offers')->with('offers')->get();
   foreach($vendor as $v){
     foreach($v->offers as $key=>$of){
      if($key == 0){
        $of->is_offer =1;
        $of->save();
      }else{
        continue;
      }
     }
     
   }
   dd('dd');

  }
  public function country()
  {
    $res['status'] = $this->sendResponse200('OK');
    $res['data'] = new CountryCollection(Country::get());
    return $res;
  }
  public function city(Request $request)
  {
    // dd($request);
    $uuid = userdefult() ? userdefult() : 'jooy';
    $country_id = Enterprise::where('uuid', $uuid)->first()->counteire->first()->id;

    $res['status'] = $this->sendResponse200('OK');
    $res['data'] = new CityCollection(City::where('country_id', $country_id)->where('status', 1)->get());
    return $res;
  }
  public function home(Request $request)
  {
    // dd($request->uuid);
    $uuid = userdefult() ? userdefult() : 'jooy';

    $city_id = $request->city_id ? $request->city_id : 15;
    $citynew = City::find($city_id);
    if ($citynew) {
      $city_id = $citynew->id;
    } else {
      $city_id = 15;
    }
    // $country_id = Enterprise::with('categorys')->where('uuid',$uuid)->first()->counteire->first()->id;
    $enterprice = Enterprise::with('categorys')->where('uuid', $uuid)->first();
    // dd($enterprice);
    if (!$enterprice) {
      $res['status'] = $this->sendError();
      return  $res;
    }
    $res['status'] = $this->sendResponse200('OK');
    $res['data']['slider'] = new SliderCollection(Slider::where('city_id', $city_id)->get());
    $res['data']['categories'] = new CategoryCollection(@$enterprice->categorys);
    $res['data']['recent_offers']['metadata']['max_no'] = 15;
    $res['data']['recent_offers']['metadata']['color'] = '#bcbcbc';
    $res['data']['recent_offers']['data'] = [];
    $res['data']['home_sliders'] = new HomeSLiderCollection(HomeSlider::where('city_id', $city_id)->get());
    return $res;
  }
  public  function vendor_list(Request $request)
  {

    $filtter = $request->filter;
    
    $page = $request->last_index +2;
    $limit = $request->has('paginate') ? $request->get('paginate') : 10;
    $city = $request->has('city_id') ? $request->city_id : 15;

    //  dd(userdefult());
    if ($filtter == 'offer') {

      $offer = Offer::has('vendor')->where('end_time','>=',Carbon::now())->whereHas('vendor', function ($q) use ($request,$city) {
        $q->where('status','active');
        $q->where('end_time','>', Carbon::now());
        $q->has('enterprise')->whereHas('enterprise', function ($q) use ($request) {
          $q->where('enterprise_id', get_enterprose_uuid(userdefult()));
        });
        $q->has('cities')->whereHas('cities', function ($q) use ($city) {
          $q->where('city_id', $city);
        });
        $q->has('counteire')->whereHas('counteire', function ($q) use ($request) {
          $q->where('country_id', $request->country_id);
        });
        $q->has('categorys')->whereHas('categorys', function ($q) use ($request) {
          $q->where('category_id', $request->category_id);
        });
      })->where('is_offer', 1)->get();
      $collction = new VendorOfferCollection($offer);
  
      $res['status'] = $this->sendResponse200('OK');
      $res['data'] = $collction;

   
      
      // $res['data']['category_slider_images'] = ;
      return $res;
    } elseif ($filtter == 'flash_deal') {
      $offer = Offer::has('vendor')->where('end_time','>=',Carbon::now())->whereHas('vendor', function ($q) use ($request,$city) {
        $q->where('status','active');
        $q->has('cities')->whereHas('cities', function ($q) use ($city) {
          $q->where('city_id', $city);
        });
        $q->has('counteire')->whereHas('counteire', function ($q) use ($request) {
          $q->where('country_id', $request->country_id);
        });
        $q->has('categorys')->whereHas('categorys', function ($q) use ($request) {
          $q->where('category_id', $request->category_id);
        });
      })->Where('is_flashdeal', 1)->get();
      $res['status'] = $this->sendResponse200('OK');
      $collction = new VendorOfferCollection($offer);
      $datad = [];
      foreach (collect($collction)->sortBy('distance') as $data) {
        array_push($datad, $data);
      }
        $res['status'] = $this->sendResponse200('OK');
        $res['data'] = $collction;
      return $res;
    } elseif ($filtter == 'voucher') {
      $offer = Offer::has('vendor')->where('end_time','>=',Carbon::now())->whereHas('vendor', function ($q) use ($request,$city) {
        $q->where('status','active');
        $q->has('cities')->whereHas('cities', function ($q) use ($request,$city) {
          $q->where('city_id', $city);
        });
        $q->has('counteire')->whereHas('counteire', function ($q) use ($request) {
          $q->where('country_id', $request->country_id);
        });
        $q->has('categorys')->whereHas('categorys', function ($q) use ($request) {
          $q->where('category_id', $request->category_id);
        });
        
      })->Where('is_voucher', 1)->get();
      $res['status'] = $this->sendResponse200('OK');
      $collction = new VendorOfferCollection($offer);
      $datad = [];
      foreach (collect($collction)->sortBy('distance') as $data) {
        array_push($datad, $data);
      }
        $res['status'] = $this->sendResponse200('OK');
        $res['data'] = $collction;
      return $res;
    } 
  }
  public function vendor_store_list(Request $request){
    $page = $request->last_index +2;
    $city = $request->has('city_id') ? $request->city_id : 15;
    $limit = $request->has('paginate') ? $request->get('paginate') : 10;
    $vendors = Vendor::with('categorys','counteire','cities')->whereHas('branches')->whereHas('offers')->where('status','active')
    ->has('categorys')->whereHas('categorys', function ($q) use ($request) {
      $q->where('category_id', $request->category_id);
    })
    ->has('counteire')->whereHas('counteire', function ($q) use ($request) {
      $q->where('country_id', $request->country_id);
    })
    ->has('cities')->whereHas('cities', function ($q) use ($request,$city) {
      $q->where('city_id', $city);
    })->get();
    $res['status'] = $this->sendResponse200('OK');

    $res['data'] = new VendorForOfferCollection($vendors);
    return $res;
  }
  public  function vendor_detels(Request $request)
  {

    $vendor = Vendor::find($request->store_id);
    if ($vendor) {
      $vendor->visitor +=1 ;
      $vendor->save();
      
      $res['status'] = $this->sendResponse200('OK');

      $res['data']['store'] = new VendorDetiesResourses($vendor);
      $res['data']['offer'] = new VendorOfferDenewCollection($vendor->offers->where('status',1)->where('end_time','>=',Carbon::now())) ;
      $res['data']['branches'] = new BranchCollection($vendor->branches->where('status','active')) ;
      $res['data']['store_reviews'] = new VendorReviewCollection($vendor->review) ;
      $res['data']['cart'] = null;
      $res['other']['server_current_time'] = Carbon::now()->format('Y-m-d H:i:s');

      return $res;
    }else{
      $res['status']=$this->sendError();
      return  $res;
    }
  }
  public function vendor_branches(Request $request)
  {
    $page = $request->last_index +2;
    $limit = $request->has('paginate') ? $request->get('paginate') : 10;
    $stores = Branch::where('status', 'active')->where('vendor_id', $request->store_id)->get();
    $res['status'] = $this->sendResponse200('OK');
    $res['data']['branches'] = (new VendorBranchesNewCollection($stores));
    return $res;
  }
  public function vendor_offers(Request $request)
  {
    $page = $request->last_index +2;
    $limit = $request->has('paginate') ? $request->get('paginate') : 10;
    $stores = Offer::where('status',1)->where('end_time','>=',Carbon::now())->where('vendor_id', $request->store_id)->get();
    $res['status'] = $this->sendResponse200('OK');
    $res['data'] = (new VendorOfferDeCollection($stores));
    return $res;
  }
  public function get_cridit(){
    $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:97.0) Gecko/20100101 Firefox/97.0';
    $response = Http::withHeaders(['User-Agent' => $userAgent])->get('http://api.oursms.com/api-a/billing/credits?token=whyfA4pML1nN4w3Yj7_WpKDo29NIOWav-0EqK38KRco');
    dd($response);
  }
  public function my_fatoorah_credential(){
    $res['status'] = $this->sendResponse200('Create');
    $res['data']['myfatoorah_credentials']['api_key']=get_general('api_key') ;
    $res['data']['myfatoorah_credentials']['base_url']=get_general('base_url') ;
    return $res;
  }
  public function credentials(){
    $res['status'] = $this->sendResponse200('Create');
    $res['data']['myfatoorah_credentials']['api_key']=get_general('api_key') ;
    $res['data']['myfatoorah_credentials']['base_url']=get_general('base_url') ;
    return $res;
  }
  public function creacte_review(Request $request){
    $review = new VendorReview();
    $review->user_id = auth('client_api')->id();
    $vendor = Vendor::find($request->store_id);
    if(!$vendor){
      $res['status'] = $this->SendError();
      $res['message'] = 'Store Not Found';
      return $res;
    }
    $review->vendor_id = $request->store_id;
    $review->rate= $request->stars_no;
    $review->comment = $request->comment;
    if($request->images != null){
      $array = [];
    foreach($request->images as $image){
      // $image = $request->file('image');
      $imageName = time() . 'image.' . $image->getClientOriginalExtension();
      $image->move('images/vendor_review', $imageName);
        array_push($array,$imageName);
    }
    $review->image = json_encode($array);
  }
  $review->save();
  $res['status'] = $this->sendResponse('Created');
  $res['data']['']="";
  return $res;
  }
  public  function review_sotre(Request $request)
  {
    $page = $request->last_index +2;
    $limit = $request->has('paginate') ? $request->get('paginate') : 10;
    $views = VendorReview::where('user_id',auth('client_api')->id())->limit($limit)->offset(($page - 1) * $limit)->get();
    $res['status']= $this->sendResponse200('OK');
    $res['data']['store_reviews']=  new ReviewnewCollection($views);
    return $res;


  }
  public function vendor_reviews(Request $request)
  {
    $page = $request->last_index +2;
    $limit = $request->has('paginate') ? $request->get('paginate') : 10;
    $reive = VendorReview::where('vendor_id', $request->store_id)->get();
    $res['status'] = $this->sendResponse200('OK');
    $res['data'] = new VendorReviewsNewCollection($reive);
    return $res;
  }
  public function nearby_partners(Request $request)
  {
    $page = $request->last_index +2;
    $city = $request->has('city_id') ? $request->city_id : 15;
    $limit = $request->has('paginate') ? $request->get('paginate') : 10;
    $vendors = Vendor::where('status','active')->has('counteire')->whereHas('counteire', function ($q) use ($request) {
      $q->where('country_id', $request->country_id);
    })->has('cities')->whereHas('cities', function ($q) use ($city) {
      $q->where('city_id', $city);
    })->limit($limit)->offset(($page - 1) * $limit)->get();
    //  $collction = get_sort(new StoresCollection($vendors));
    $collection =  sort_vendor(VendorForOfferResourses::collection($vendors));
    // $datad = [];
    // foreach (collect($collection)->sortBy('distance') as $data) {
    //   array_push($datad, $data);
    // }

    $res['status'] = $this->sendResponse200('OK');
    $res['data']['stores'] = $collection;

    return $res;
  }
  public function get_support(Request $request)
  {
    $suport = Support::where('user_id', auth('client_api')->id())->get();
    $res['status'] = $this->sendResponse200('OK');
    $res['data'] = SupportResourses::collection($suport);
    return $res;
  }
  public function post_support(Request $request)
  {
    $suport = new Support();
    $suport->user_id = auth('client_api')->id();
    $suport->title = $request->title;
    $suport->message = $request->message;
    $suport->type = $request->type;
    $suport->save();
    $res['status'] = $this->sendResponse200('OK');
    $res['data'] = [
      '' => ''
    ];
    return $res;
  }
  public function contact_us(Request $request)
  {
    $contact = new ContactUs();
    if ($request->city_id == 'null') {
      $contact->city_id = null;
    } else {
      $contact->city_id = $request->city_id;
    }
    if ($request->country_id == 'null') {
      $contact->country_id = null;
    } else {
      $contact->country_id = $request->country_id;
    }
    $contact->first_name = $request->first_name;
    $contact->last_name = $request->last_name;
    $contact->message = $request->message;
    // dd($contact);
    $contact->save();
    $res['status'] = $this->sendResponse200('OK');
    $res['data'] = [
      '' => ''
    ];
    return $res;
  }
  public function profile()
  {
    $user = User::find(auth('client_api')->id());
    $res['status'] = $this->sendResponse200('OK');
    $res['data'] = [
      'name' => $user->name,
      'email' => $user->email,
      'phone' => $user->phone,
      'last_login' => $user->last_login
    ];
    return $res;
  }
  public function popup_ad(Request $request)
  {
    
    $position = $request->position;
    if ($position == 'home') {
      $data_show = Popup::where('show_as', 'home')->where('end_date', '>', Carbon::now()->format('Y-m-d'))->first();
    } elseif ($position == 'store') {
      $data_show = Popup::where('show_as', 'brand')->where('end_date', '>', Carbon::now()->format('Y-m-d'))->first();
    } elseif ($position == 'category') {
      $data_show = Popup::where('show_as', 'category')->where('end_date', '>', Carbon::now()->format('Y-m-d'))->first();
    }
    if($data_show){
      if (auth('client_api')->check()) {
    
        if ($data_show->num_show != 'every_time') {
          if ($data_show->num_show == 'once') {
            $show = PopupUser::where('client_id', auth('client_api')->id())->where('popup_id', $data_show->id)->first();
            
            if (!$show) {
              $poop = new PopupUser();
              $poop->client_id = auth('client_api')->id();
              $poop->popup_id = $data_show->id;
              $poop->save();
            }
          } elseif ($data_show->num_show == 'hour') {
            $show = PopupUser::where(
              'created_at',
              '>',
              Carbon::now()->subHours($data_show->number_of_hour)->toDateTimeString()
            )->first();
            if (!$show) {
              $poop = new PopupUser();
              $poop->client_id = auth('client_api')->id();
              $poop->popup_id = $data_show->id;
              $poop->save();
            }
          }
        }
      
      }
      $res['status'] = $this->sendResponse200('OK');
      $array = [];
      array_push($array, new PopupResoures($data_show));
      $res['data']['popup_ads'] = $array;
       
    }else{
      $res['status'] = $this->SendError('OK');
     
    }
   
    
   
    return $res;
  }


}
