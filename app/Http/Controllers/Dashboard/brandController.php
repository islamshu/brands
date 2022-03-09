<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\BrandImport;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Enterprise;
use App\Models\enterprise_country;
use App\Models\ImageVendor;
use App\Models\Neighborhood;
use App\Models\Role;
use App\Models\Social;
use App\Models\SoialVendor;
use App\Models\User as ModelsUser;
use App\Models\Vendor;
use App\Models\Vendor_cities;
use App\Models\vendor_country;
use App\Models\Vendor_neighborhood;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-vendor'])->only('index');
        $this->middleware(['permission:create-vendor'])->only('create');
        $this->middleware(['permission:update-vendor'])->only('edit');
        $this->middleware(['permission:delete-vendor'])->only('destroy');

    }//end of constructor
    public function index()
    {
        // dd(auth()->user()->isAbleTo('update-vendor'));

        if (Auth::user()->hasRole('Admin')) {

            $vendors = Vendor::select('image','id', 'name_en', 'name_ar', 'uuid', 'commercial_registration_number', 'mobile', 'image')->paginate(10);
            return response()->view('dashboard.vendor.indexAdmin', compact('vendors'));
        } elseif (Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('read-vendor') ) {
           
            $enterprise = Enterprise::find(Auth::user()->ent_id);
            $vendors = Vendor::where('enterprise_id', Auth::user()->ent_id)->select('status','image','created_at','name_en', 'name_ar', 'uuid', 'commercial_registration_number', 'mobile', 'id')->get();
            return response()->view('dashboard.vendor.index', compact('vendors', 'enterprise'));
        } elseif (Auth::user()->hasRole('Vendor')) {
            $Vendor = Vendor::find(Auth::user()->vendor_id);
            return response()->view('dashboard.vendor.index', compact('vendors', 'Vendor'));
        }
        //
    }
     public function post_cover(Request $request)
    {
        

            foreach($request->images as $key=> $imagex){
              

                    $imageNamee = time()+$key . 'image_cover.' . $imagex->getClientOriginalExtension();

               
                    $imagex->move('images/vendor_cover', $imageNamee);
                   
                   $vendor_image = new ImageVendor();
                   $vendor_image->vendor_id =   $request->vendor_id;
                   $vendor_image->image = $imageNamee;
                   $vendor_image->save();
                

            }
            return redirect()->back()->with(['success'=>'تم الاضافة بنجاح']);

        
        
    }
    public function get_cover($lang,$id){
        $vendor = Vendor::find($id);
        $vendor->vendor_image();
        $images = $vendor->vendor_image;
        return response()->view('dashboard.vendor.cover', compact('images','vendor'));
    }
    public function Brands($lang, $id)
    {


        if (Auth::user()->hasRole('Admin')) {
            $enterprise = Enterprise::find($id);
            $vendors = Vendor::where('enterprise_id', $id)->select('name_en', 'name_ar', 'uuid', 'commercial_registration_number', 'mobile')->paginate(10);
            return response()->view('dashboard.vendor.index', compact('vendors', 'enterprise'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return phpinfo();
        $curruncy = Currency::get();
        if (Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('create-vendor')) {
            $country = enterprise_country::where('enterprise_id', Auth::user()->ent_id)->with(['country'])->get();
            $category = Enterprise::with('categorys')->find(Auth::user()->ent_id)->categorys;
            $curruncy = Enterprise::with('currencies')->find(Auth::user()->ent_id)->currencies;
           

           
            

            $enterprises = null;
            return response()->view('dashboard.vendor.create', compact('country', 'enterprises', 'curruncy', 'category'));
        } elseif (Auth::user()->hasRole('Admin')) {
            $country = Country::all();
            $enterprises = Enterprise::all();
            return response()->view('dashboard.vendor.create', compact('country', 'enterprises', 'curruncy'));
        }
    }
    public function countriesAjax(Request $request)
    {
        $country = enterprise_country::where('enterprise_id', $request->id)->with('country')->get();
        return response()->json($country);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   $image=   \QrCode::size(500)
    //     ->
    //     ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
    //     dd($image);
    // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            'desc_en' => 'required',
            'desc_ar' => 'required',
            // 'visitor' => 'required',
            // 'sales' => 'required',
            // 'owner_name' => 'required|string|min:3',
            'commercial_registration_number' => 'required',
            'email' => 'required|email|unique:users',
            'telephoone' => 'unique:vendors',
            'mobile' => 'unique:vendors',
            'password' => 'required|min:6',
            'image' => 'required',
        ]);

        if (!$validator->fails()) {
            if (Auth::user()->hasRole('Enterprises')) {
                try {
                    DB::beginTransaction();
                    $enterprise =  Enterprise::find(Auth::user()->ent_id);
                    //check count of vendors(brands) in enterprise

                    if ($enterprise->vendors != null && $enterprise->vendors->count() >= $enterprise->count_of_brands) {
                        return response()->json(['icon' => 'error', 'title' => 'You Canot create New vendor ,You Have To Contact Admin']);
                    } else {
                        $vendor = new Vendor();
                        //$vendor->customer_type_id = '1';
                        $vendor->enterprise_id = Auth::user()->ent_id;
                        $vendor->name_ar = $request->name_ar;
                        $vendor->name_en = $request->name_en;
                        $vendor->desc_en = $request->desc_en;
                        $vendor->desc_ar = $request->desc_ar;
                        $vendor->policy_en = $request->policy_en;
                        $vendor->policy_ar = $request->policy_ar;

                        $vendor->terms_ar = $request->terms_ar;
                        $vendor->terms_en = $request->terms_en;
                        $vendor->visitor = $request->visitor;
                        $vendor->sales = $request->sales;
                        $vendor->menu_link = $request->menu_link;

                        // $vendor->uuid = $request->uuid;
                        $vendor->owner_name = $request->owner_name;
                        $vendor->commercial_registration_number = $request->commercial_registration_number;
                        $vendor->telephoone = $request->telephoone;
                        $vendor->mobile = $request->mobile;
                        $vendor->vat = $request->vat;
                        $vendor->vat_type = $request->vat_type;
                        $vendor->vat_no = $request->vat_no;
                        $vendor->start_at = $request->start_at;
                        $vendor->end_at = $request->end_at;
                        $codeinput = '';
                        if($request->codeinput == null){
                            $codeinput = rand(0, 999);
                        }else{
                            $codeinput =   $request->codeinput;
                        }
                        $image = QrCode::format('svg')
                        ->size(200)->errorCorrection('H')
                        ->generate((string)$codeinput);
                        $output_file =  time() . '.svg';
                        $file =  Storage::disk('local')->put($output_file, $image);
                        
                        $vendor->qr_code = $codeinput;
                        $vendor->is_pincode = $request->pincode;
                        $vendor->qr_image = $output_file;
                        $vendor->customer_use = $request->customer_use;
                        $vendor->number_of_hours = $request->time_count_input;
                        if (request()->hasFile('image')) {
                            $image = $request->file('image');
                            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                            $image->move('images/brand', $imageName);
                            $vendor->image = $imageName;
                        }
                   
                       
                        
                        $country_ids = json_decode($request->country_id);

                        $vendor->save();
                        DB::table('soial_vendors')->insert([
                            'facebook' => $request->facebook,
                            'twitter' =>  $request->twitter,
                            'instagram' => $request->instagram,
                            'snapchat' =>  $request->snapchat,
                            'vendor_id' =>  $vendor->id,
                        ]);
                        // $soial->save();
                    
                        $vendor->currencies()->sync(json_decode($request->currencies, false));
                        $vendor->categorys()->sync(json_decode($request->category_id, false));

                        if ($country_ids > 0) {



                            for ($i = 0; $i < count($country_ids); $i++) {
                                $enterpriseCountry = new vendor_country();
                                $enterpriseCountry->vendor_id = $vendor->id;
                                $enterpriseCountry->country_id = $country_ids[$i];
                                $enterpriseCountry->save();
                                $cities = City::where('country_id', $country_ids)->get();
                                foreach ($cities as $city) {
                                    $citiesVendor = new Vendor_cities();
                                    $citiesVendor->vendor_id = $vendor->id;
                                    $citiesVendor->city_id = $city->id;
                                    $citiesVendor->save();
                                    $Neighborhoods = Neighborhood::where('city_id', $city->id)->get();
                                    foreach ($Neighborhoods as $Neighborhood) {
                                        $citiesVendor = new Vendor_neighborhood();
                                        $citiesVendor->vendor_id = $vendor->id;
                                        $citiesVendor->neighborhood_id = $Neighborhood->id;
                                        $citiesVendor->save();
                                    }
                                }
                            }
                        }
                        $user = new User();
                        $user->username = $vendor->name_en;
                        $user->password =  bcrypt($request->password);
                        $user->email = $request->email;
                        $user->last_ip = \Request::ip();
                        $user->last_login = now();
                        $user->name = $request->name_en;
                        $user->phone = $request->mobile;
                        $user->vendor_id = $vendor->id;
                        $user->ent_id = Auth::user()->ent_id;

                        $user->save();



                        $role = Role::where('name', 'Vendors')->first();
                        DB::table('role_user')->insert([
                            'role_id' =>   $role->id,
                            'useR_id' =>  $user->id
                        ]);
                        foreach ($role->permissions as $one_permission) {
                            $user->attachPermission($one_permission);
                        }
                        DB::commit();
                        if ($request->TotalImages > 0) {
                           
                            for ($x = 0; $x < $request->TotalImages; $x++) {
                                if ($request->hasFile('image_cover' . $x)) {
                                  
                                    $imagex      = $request->file('image_cover' . $x);
            
                                    $imageNamee = time()+$x . 'image_cover.' . $imagex->getClientOriginalExtension();
                                    $imagex->move('images/vendor_cover', $imageNamee);
                                   
                                   $vendor_image = new ImageVendor();
                                   $vendor_image->vendor_id = $vendor->id;
                                   $vendor_image->image = $imageNamee;
                                   $vendor_image->save();
                                
    
                                }
                            }
                         
                        }
                        return response()->json(['icon' => 'success', 'title' => 'Vendor created successfully']);
                       
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    dd($e);
                    return response()->json(['icon' => 'error', 'title' => 'error when insert data'], 400);
                }
            } elseif (Auth::user()->hasRole('Admin')) {
                try {
                    DB::beginTransaction();
                    $vendor = new Vendor();
                    //$vendor->customer_type_id = '2';
                    if ($request->customer_type == 'Enterprise') {
                        $vendor->enterprise_id = $request->enterprise_id;
                    } else {
                        $vendor->enterprise_id = null;
                    }

                    $vendor->name_ar = $request->name_ar;
                    $vendor->name_en = $request->name_en;
                    $vendor->desc_en = $request->desc_en;
                    $vendor->desc_ar = $request->desc_ar;
                    $vendor->policy_en = $request->policy_en;
                    $vendor->policy_ar = $request->policy_ar;
                    $vendor->terms_ar = $request->terms_ar;
                    $vendor->terms_en = $request->terms_en;
                    $vendor->visitor = $request->visitor;
                    $vendor->sales = $request->sales;
                    $vendor->uuid = $request->uuid;
                    $vendor->vat = $request->vat;
                    $vendor->vat_type = $request->vat_type;

                    $vendor->owner_name = $request->owner_name;
                    $vendor->commercial_registration_number = $request->commercial_registration_number;
                    $vendor->telephoone = $request->telephoone;
                    $vendor->mobile = $request->mobile;
                    $vendor->address = $request->address;
                    if (request()->hasFile('image')) {
                        $image = $request->file('image');
                        $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                        $image->move('images/brand', $imageName);
                        $vendor->image = $imageName;
                    }
                    $codeinput='';
                    if($request->codeinput == null){
                        $codeinput = rand(0, 999);
                    }else{
                        $codeinput =   $request->codeinput;
                    }
                  
                    $image = QrCode::format('svg')
                        ->size(200)->errorCorrection('H')
                        ->generate((string)$codeinput);
                    $output_file =  time() . '.svg';
                    $file =  Storage::disk('local')->put($output_file, $image);
                    $vendor->qr_code =$codeinput;
                    $vendor->is_pincode = $request->pincode;
                    $vendor->qr_image = $output_file;
                    $vendor->customer_use = $request->customer_use;
                    $vendor->number_of_hours = $request->time_count_input;
                    $vendor->cover_image = " ";
                    $vendor->type_refound = $request->type_refound;
                    $vendor->save();
                    // if (request()->hasFile('image_cover')) {
                    //     $image = $request->file('image_cover');
                    //     $imageName = time() . 'image_cover.' . $image->getClientOriginalExtension();
                    //     $image->move('images/brand', $imageName);
                      
                    // }
                    if ($request->TotalImages > 0) {
                        $files = [];
                        for ($x = 0; $x < $request->TotalImages; $x++) {
        
                            if ($request->hasFile('image' . $x)) {
                                $imagex      = $request->file('image' . $x);
        
                                $imageNamee = time() . 'image.' . $imagex->getClientOriginalExtension();
                                $imagex->move('images/vendor_cover', $imageNamee);
                               
                               $vendor_image = new ImageVendor();
                               $vendor_image->vendor_id = $vendor->id;
                               $vendor_image->image = $imageNamee;
                               $vendor_image->save();

                            }
                        }
                     
                    }
                    $vendor->currencies()->sync(json_decode($request->currencies, false));
                    $vendor->categorys()->sync(json_decode($request->category_id, false));

                    $country_ids = json_decode($request->country_ids);


                    for ($i = 0; $i < count($country_ids); $i++) {
                        $enterpriseCountry = new vendor_country();
                        $enterpriseCountry->vendor_id = $vendor->id;
                        $enterpriseCountry->country_id = $country_ids[$i];
                        $enterpriseCountry->save();
                        $cities = City::where('country_id', $country_ids)->get();
                        foreach ($cities as $city) {
                            $citiesVendor = new Vendor_cities();
                            $citiesVendor->vendor_id = $vendor->id;
                            $citiesVendor->city_id = $city->id;
                            $citiesVendor->save();


                            $Neighborhoods = Neighborhood::where('city_id', $city->id)->get();
                            foreach ($Neighborhoods as $Neighborhood) {
                                $citiesVendor = new Vendor_neighborhood();
                                $citiesVendor->vendor_id = $vendor->id;
                                $citiesVendor->neighborhood_id = $Neighborhood->id;
                                $citiesVendor->save();
                            }
                        }
                    }
                    $user = new User();
                    $user->username = $vendor->name_en;
                    $user->password =  bcrypt($request->password);
                    $user->email = $request->email;
                    $user->last_ip = \Request::ip();
                    $user->last_login = now();
                    $user->name = $request->name_en;
                    $user->vendor_id = $vendor->id;
                    $user->phone = $request->mobile;

                    if ($request->customer_type == 'Enterprise') {
                        $user->ent_id = $request->enterprise_id;
                    } else {
                        $user->ent_id = null;
                    }
                    $user->save();

                    //Assign Vendor Role To New User
                    $role = Role::where('name', 'Vendors')->first();
                    DB::table('role_user')->insert([
                        'role_id' =>   $role->id,
                        'useR_id' =>  $user->id
                    ]);
                    foreach ($role->permissions as $one_permission) {
                        $user->attachPermission($one_permission);
                    }
                    DB::commit();
                    if ($request->TotalImages > 0) {
                           
                        for ($x = 0; $x < $request->TotalImages; $x++) {
                            if ($request->hasFile('image_cover' . $x)) {
                              
                                $imagex      = $request->file('image_cover' . $x);
        
                                $imageNamee = time() . 'image_cover.' . $imagex->getClientOriginalExtension();
                                $imagex->move('images/vendor_cover', $imageNamee);
                               
                               $vendor_image = new ImageVendor();
                               $vendor_image->vendor_id = $vendor->id;
                               $vendor_image->image = $imageNamee;
                               $vendor_image->save();
                            

                            }
                        }
                     
                    }
                    return response()->json(['icon' => 'success', 'title' => 'Vendor created successfully']);
                    
                } catch (\Exception $e) {
                    DB::rollback();




                    return response()->json(['icon' => 'error', 'title' => 'error when insert data'], 400);
                }
            }
        } else {

            return response()->json(['icon' => 'error', 'title' => $validator->errors()->first()], 400);
        }
    }
    public function download()
    {
        $file = public_path() . "/brands_new_new.xlsx";

        $headers = ['Content-Type: image/jpeg'];

        return \Response::download($file, 'brand.xlsx', $headers);
    }
    public function country_vendor($locale, $id)
    {
        $vendorCountry = vendor_country::where('vendor_id', $id)->get();
        $country = Vendor::with('counteire')->find($id)->counteire;
       
        return response()->view('dashboard.country.index', compact('country'));
    }
    public function city_vendor($locale, $id)
    {
        $cities = Vendor::with('cities')->find($id)->cities;

        return response()->view('dashboard.city.index', compact('cities'));
    }
    public function neighborhoods_vendor($locale, $id)
    {
        $Neighborhoods = Vendor::with('neighborhood')->find($id)->neighborhood;

        return response()->view('dashboard.neighborhood.index', compact('Neighborhoods'));
    }
    




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        $vendor = Vendor::with('user')->find($id);

        return response()->view('dashboard.vendor.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $vendor = Vendor::find($id);
        $user = User::where('vendor_id', $vendor->id)->first();
        // dd($vendor);
        $curruncy = Currency::get();
        // dd(auth()->user()->hasPermission('update-vendor'));
        if (Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('update-vendor')) {
            $country = enterprise_country::where('enterprise_id', Auth::user()->ent_id)->with(['country'])->get();
            $enterprises = null;
            $category = Enterprise::with('categorys')->find(Auth::user()->ent_id)->categorys;

            return response()->view('dashboard.vendor.edit', compact('country', 'enterprises', 'vendor', 'user', 'curruncy', 'category'));
        } elseif (Auth::user()->hasRole('Admin')) {
            $country = Country::all();
            $enterprises = Enterprise::all();
            return response()->view('dashboard.vendor.edit', compact('country', 'enterprises', 'vendor', 'user', 'curruncy'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_brand(Request $request, $locale, $id)
    {
        $user = User::where('vendor_id', $id)->first();
        $vendor = Vendor::find($id);


        
        
       
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            'desc_en' => 'required',
            'desc_ar' =>  'required',
            // 'owner_name' => 'required|string|min:3',
            'commercial_registration_number' => 'required',
            'email' => 'required|email|unique:users,email,' . @$user->id,
            'telephoone' => 'unique:vendors,telephoone,' . $vendor->id,
            'mobile' => 'unique:vendors,mobile,' . $vendor->id,
            'image' => 'required',
            // 'image_cover' => 'required',
        ]);
        if (!$validator->fails()) {
      
            if (Auth::user()->hasRole('Enterprises')) {


                $enterprise =  Enterprise::find(Auth::user()->ent_id);
                //check count of vendors(brands) in enterprise

                if ($enterprise->vendors != null && $enterprise->vendors->count() >= $enterprise->count_of_brands) {
                    return response()->json(['icon' => 'error', 'title' => 'You Canot create New vendor ,You Have To Contact Admin']);
                } else {
                    try {
                        DB::beginTransaction();
                        $vendor->name_ar = $request->name_ar;
                        $vendor->name_en = $request->name_en;
                        $vendor->desc_en = $request->desc_en;
                        $vendor->desc_ar = $request->desc_ar;
                        $vendor->policy_en = $request->policy_en;
                        $vendor->policy_ar = $request->policy_ar;
                        $vendor->terms_ar = $request->terms_ar;
                        $vendor->terms_en = $request->terms_en;
                        $vendor->visitor = $request->visitor;
                        $vendor->sales = $request->sales;
                        $vendor->uuid = $request->uuid;
                        $vendor->owner_name = $request->owner_name;
                        $vendor->commercial_registration_number = $request->commercial_registration_number;
                        $vendor->telephoone = $request->telephoone;
                        $vendor->mobile = $request->mobile;
                        $vendor->address = $request->address;
                        $vendor->vat = $request->vat;
                        $vendor->vat_type = $request->vat_type;
                        $vendor->vat_no = $request->vat_no;
                        $vendor->menu_link = $request->menu_link;

                        
                        $codeinput='';
                            if($request->codeinput == null){
                                $codeinput = rand(0, 999);
                            }else{
                                $codeinput =   $request->codeinput;
                            }
                        if ($vendor->qr_code != $codeinput) {
                            $image = QrCode::format('svg')
                                ->size(200)->errorCorrection('H')
                                ->generate((string)$codeinput);
                            $output_file =  time() . '.svg';
                            $file =  Storage::disk('local')->put($output_file, $image);
                            $vendor->qr_code = $codeinput;
                            $vendor->qr_image = $output_file;
                        }

                        $vendor->is_pincode = $request->pincode;
                        $vendor->customer_use = $request->customer_use;
                        $vendor->number_of_hours = $request->time_count_input;
                        if ($request->image != null && $request->image != 'undefined') {

                            $image = $request->file('image');
                            $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                            $image->move('images/brand', $imageName);
                            $vendor->image = $imageName;
                        }
                        $vendor->cover_image = " ";
                        $vendor->type_refound = $request->type_refound;
                        $vendor->save();
                        $soial = $vendor->social;
                        
                        $soial->facebook = $request->facebook;
                        $soial->twitter = $request->twitter;
                        $soial->instagram = $request->instagram;
                        $soial->snapchat = $request->snapchat;
                        $soial->save();
                        $vendor->currencies()->sync(json_decode($request->currencies, false));
                        $vendor->categorys()->sync(json_decode($request->category_id, false));
                        $country_ids = json_decode($request->country_id);

                        for ($i = 0; $i < count($country_ids); $i++) {
                            $enterpriseCountry = new vendor_country();
                            $enterpriseCountry->vendor_id = $vendor->id;
                            $enterpriseCountry->country_id = $country_ids[$i];
                            $enterpriseCountry->save();
                            $cities = City::where('country_id', $country_ids[$i])->get();
                            foreach ($cities as $city) {
                                $citiesVendor = new Vendor_cities();
                                $citiesVendor->vendor_id = $vendor->id;
                                $citiesVendor->city_id = $city->id;
                                $citiesVendor->save();
                                $Neighborhoods = Neighborhood::where('city_id', $city)->get();
                                foreach ($Neighborhoods as $Neighborhood) {
                                    $citiesVendor = new Vendor_neighborhood();
                                    $citiesVendor->vendor_id = $vendor->id;
                                    $citiesVendor->neighborhood_id = $Neighborhood->id;
                                    $citiesVendor->save();
                                }
                            }
                        }
                        if($user == null){
                            $user = new User();
                        $user->username = $vendor->name_en;
                        $user->password =  bcrypt($request->password);
                        $user->email = $request->email;
                        $user->last_ip = \Request::ip();
                        $user->last_login = now();
                        $user->name = $request->name_en;
                        $user->phone = $request->mobile;
                        $user->vendor_id = $vendor->id;
                        $user->ent_id = Auth::user()->ent_id;

                        $user->save();
                        }else{
                            $user->username = $vendor->name_en;
                            $user->email = $request->email;
                            $user->name = $request->name_en;
                            $user->save();
                        }

                      
                        //Assign Vendor Role To New User
                        // $role = Role::where('name', 'Vendors')->first();
                        // $user->attachRole($role);
                        DB::commit();
                        if ($request->TotalImages > 0) {
                            ImageVendor::where('vendor_id',$vendor->id)->delete();
                            for ($x = 0; $x < $request->TotalImages; $x++) {
                                if ($request->hasFile('image_cover' . $x)) {
                                  
                                    $imagex      = $request->file('image_cover' . $x);
            
                                    $imageNamee = time() . 'image_cover.' . $imagex->getClientOriginalExtension();
                                    $imagex->move('images/vendor_cover', $imageNamee);
                                   
                                   $vendor_image = new ImageVendor();
                                   $vendor_image->vendor_id = $vendor->id;
                                   $vendor_image->image = $imageNamee;
                                   $vendor_image->save();
                                
    
                                }
                            }
                         
                        }

                        return response()->json(['icon' => 'success', 'title' => 'Vendor updated successfully']);
                    } catch (\Exception $e) {
                        dd($e);
                        DB::rollback();


                        return response()->json(['icon' => 'error', 'title' => 'error when insert data']);
                    }
                
            }} elseif (Auth::user()->hasRole('Admin')) {

                try {

                    DB::beginTransaction();
                    //$vendor->customer_type_id = '2';
                    if ($request->customer_type == 'Enterprise') {
                        $vendor->enterprise_id = $request->enterprise_id;
                    } else {
                        $vendor->enterprise_id = null;
                    }


                    $vendor->name_ar = $request->name_ar;
                    $vendor->name_en = $request->name_en;
                    $vendor->desc_en = $request->desc_en;
                    $vendor->desc_ar = $request->desc_ar;
                    $vendor->policy_en = $request->policy_en;
                    $vendor->policy_ar = $request->policy_ar;
                    $vendor->terms_ar = $request->terms_ar;
                    $vendor->terms_en = $request->terms_en;
                    $vendor->visitor = $request->visitor;
                    $vendor->sales = $request->sales;
                    $vendor->uuid = $request->uuid;
                    $vendor->vat = $request->vat;
                    $vendor->vat_type = $request->vat_type;

                    $vendor->owner_name = $request->owner_name;
                    $vendor->commercial_registration_number = $request->commercial_registration_number;
                    $vendor->telephoone = $request->telephoone;
                    $vendor->mobile = $request->mobile;
                    $vendor->address = $request->address;
                    $codeinput='';
                    if($request->codeinput == null){
                        $codeinput = rand(0, 999);
                    }else{
                        $codeinput =   $request->codeinput;
                    }
                    if ($vendor->qr_code != $codeinput ) {
                        $image = QrCode::format('svg')
                            ->size(200)->errorCorrection('H')
                            ->generate((string)$codeinput );
                        $output_file =  time() . '.svg';
                        $file =  Storage::disk('local')->put($output_file, $image);
                        $vendor->qr_code =$codeinput ;
                        $vendor->qr_image = $output_file;
                    }

                    $vendor->is_pincode = $request->pincode;
                    $vendor->customer_use = $request->customer_use;
                    $vendor->number_of_hours = $request->time_count_input;
                    if (request()->hasFile('image')) {
                        $image = $request->file('image');
                        $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                        $image->move('images/brand', $imageName);
                        $vendor->image = $imageName;
                    }
                    if (request()->hasFile('image_cover')) {

                        $image = $request->file('image_cover');
                        $imageName = time() . 'image_cover.' . $image->getClientOriginalExtension();
                        $image->move('images/brand', $imageName);
                        $vendor->cover_image = $imageName;
                    }
                    $vendor->save();
                    $vendor->currencies()->sync(json_decode($request->currencies, false));
                    $vendor->categorys()->sync(json_decode($request->category_id, false));

                    vendor_country::where('vendor_id', $vendor->id)->delete();
                    Vendor_cities::where('vendor_id', $vendor->id)->delete();
                    Vendor_neighborhood::where('vendor_id', $vendor->id)->delete();
                    $country_ids = json_decode($request->country_ids);

                    for ($i = 0; $i < count($country_ids); $i++) {
                        $enterpriseCountry = new vendor_country();
                        $enterpriseCountry->vendor_id = $vendor->id;
                        $enterpriseCountry->country_id = $country_ids[$i];
                        $enterpriseCountry->save();
                        $cities = City::where('country_id', $country_ids)->get();
                        foreach ($cities as $city) {
                            $citiesVendor = new Vendor_cities();
                            $citiesVendor->vendor_id = $vendor->id;
                            $citiesVendor->city_id = $city->id;
                            $citiesVendor->save();
                            $Neighborhoods = Neighborhood::where('city_id', $city->id)->get();
                            foreach ($Neighborhoods as $Neighborhood) {
                                $citiesVendor = new Vendor_neighborhood();
                                $citiesVendor->vendor_id = $vendor->id;
                                $citiesVendor->neighborhood_id = $Neighborhood->id;
                                $citiesVendor->save();
                            }
                        }
                    }
                    if($user == null){
                        $user = new User();
                    $user->username = $vendor->name_en;
                    $user->password =  bcrypt($request->password);
                    $user->email = $request->email;
                    $user->last_ip = \Request::ip();
                    $user->last_login = now();
                    $user->name = $request->name_en;
                    $user->phone = $request->mobile;
                    $user->vendor_id = $vendor->id;
                    $user->ent_id = Auth::user()->ent_id;

                    $user->save();
                    }else{
                     
                    $user->username = $vendor->name_en;
                    $user->email = $vendor->email;

                    $user->name = $request->name_en;
                    if ($request->customer_type == 'Enterprise') {
                        $user->ent_id = $request->enterprise_id;
                    } else {
                        $user->ent_id = null;
                    }
                    $user->save();
                }
                    DB::commit();
                    if ($request->TotalImages > 0) {
                           
                        for ($x = 0; $x < $request->TotalImages; $x++) {
                            if ($request->hasFile('image_cover' . $x)) {
                              
                                $imagex      = $request->file('image_cover' . $x);
        
                                $imageNamee = time() . 'image_cover.' . $imagex->getClientOriginalExtension();
                                $imagex->move('images/vendor_cover', $imageNamee);
                               
                               $vendor_image = new ImageVendor();
                               $vendor_image->vendor_id = $vendor->id;
                               $vendor_image->image = $imageNamee;
                               $vendor_image->save();
                            

                            }
                        }
                     
                    }

                    return response()->json(['icon' => 'success', 'title' => 'Vendor updated successfully']);
                } catch (\Exception $e) {
                    DB::rollback();

                    return response()->json(['icon' => 'error', 'title' => 'error when insert data']);
                }
           
        }
    } else {
        return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()]);
    }
    }
    public function vendor_cover_delete($locale ,$id){
        $image = ImageVendor::find($id)->delete();
        return response()->json(['icon' => 'success', 'title' => 'image deleted successfully'], 200);

    }
    public function updateStatus(Request $request)
    {
        $user = Vendor::findOrFail($request->user_id);
        
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'User status updated successfully.']);
    }
    public function destroy($locale, $id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
        return response()->json(['icon' => 'success', 'title' => 'vendor deleted successfully'], 200);

    }
    public function get_import()
    {
        return view('dashboard.vendor.import');
    }
    public function import()
    {
        Excel::import(new BrandImport, request()->file('file'));
        return redirect()->back()->with(['success' => 'vendors Uploded successfully']);
    }
    public function showpostModal(Request $request){
        $vendor = Vendor::find($request->id);
        return view('dashboard.vendor.data_post_modal')->with('vendor',$vendor);
    }
}
