<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Enterprise;
use App\Models\enterprise_city;
use App\Models\enterprise_country;
use App\Models\enterprise_neighborhood;
use App\Models\Neighborhood;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return phpinfo();

        if(Auth::user()->hasRole('Admin')){
            $enterprise = Enterprise::paginate(10);
            return response()->view('dashboard.enterprise.index', compact('enterprise'));

        } elseif (Auth::user()->hasRole('Enterprises')) {
               $enterprise = Enterprise::where('id', Auth::user()->ent_id)->first();
            return response()->view('dashboard.enterprise.show', compact('enterprise'));
        }
    }
    public  function show_enterprice()
    {
        $enterprise = Enterprise::where('id', Auth::user()->ent_id)->first();
        return response()->view('dashboard.enterprise.showenterprice', compact('enterprise'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        $curruncy= Currency::get();
        $categorys= Category::get();
        return response()->view('dashboard.enterprise.create', compact('country','curruncy','categorys'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            'commercial_registration_number' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:enterprises',
            'count_of_brands' => 'required|numeric',
            'password' => 'required|min:6',
            'image' => 'required',

        ]);

        if (!$validator->fails()) {
            try {
                DB::beginTransaction();
            $new_enterprise = new Enterprise();
            $new_enterprise->name_ar = $request->name_ar;
            $new_enterprise->name_en = $request->name_en;
            $new_enterprise->commercial_registration_number     = $request->commercial_registration_number;
            $new_enterprise->email = $request->email;
            $new_enterprise->phone = $request->phone;
            $new_enterprise->count_of_brands = $request->count_of_brands;
            $new_enterprise->uuid = $request->uuid;
            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('images/enterprise', $imageName);
                $new_enterprise->image = $imageName;
            }
            $new_enterprise->save();
           $new_enterprise->currencies()->sync(json_decode($request->currencies, false));
           $new_enterprise->categorys()->sync(json_decode($request->categorys, false));

           if($request->country_id != null){

           
            $country_ids = json_decode($request->country_id);
            
             
            for ($i = 0; $i < count($country_ids); $i++) {
                
                $enterpriseCountry = new enterprise_country();
                $enterpriseCountry->enterprise_id = $new_enterprise->id;
                $enterpriseCountry->country_id = $country_ids[$i];
                $enterpriseCountry->save();
                $cities = City::where('country_id',$country_ids[$i])->get();
                
                foreach ($cities as $city) {
                    $citiesVendor = new enterprise_city();
                    $citiesVendor->enterprise_id = $new_enterprise->id;
                    $citiesVendor->city_id = $city->id;
                    $citiesVendor->save();
                    $Neighborhoods = Neighborhood::where('city_id', $city->id)->get();
                    foreach ($Neighborhoods as $Neighborhood) {
                        $citiesVendor = new enterprise_neighborhood();
                        $citiesVendor->enterprise_id = $new_enterprise->id;
                        $citiesVendor->neighborhood_id = $Neighborhood->id;
                        $citiesVendor->save();
                    }
                }
            }
        }
          
            $new_user = new User();
            $new_user->username = $new_enterprise->name_en;
            $new_user->password =  bcrypt($request->password);
            $new_user->email = $new_enterprise->email;
            $new_user->phone = $request->phone;
            $new_user->last_ip = \Request::ip();
            $new_user->last_login = now();
            $new_user->name = $request->name_en;
            $new_user->ent_id = $new_enterprise->id;

            $new_user->save();

            //Assign Vendor Role To New User
            $role = Role::where('name', 'Enterprises')->first();
            $new_user->attachRole($role);
            foreach ($role->permissions as $one_permission) {
                $new_user->attachPermission($one_permission);
            }
            $isSaved = $new_enterprise->save();
             DB::commit();
            return response()->json(['icon' => 'success', 'title' => 'enterprsie created successfully'], $isSaved ? 200 : 400);
            

        } catch (\Exception $e) {
            DB::rollback();
            

            return response()->json(['icon' => 'error', 'title' =>'error when insert data'], 400);

        }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale,$id)
    {
        $country = Country::all();
        $enterprise = Enterprise::with('counteire')->find($id);
        $curruncy= Currency::get();
        $categorys= Category::get();

        return response()->view('dashboard.enterprise.edit', compact(['country','enterprise','curruncy','categorys']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $local,$id)
    {
        dd($request->all());
    }
    public function updateEnterpise(Request $request,$local, $id)
    {
        $user = User::where('ent_id',$id)->first();
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|min:3',
            'name_en' => 'required|string|min:3',
            'commercial_registration_number' => 'required',
            // 'email'=>'required|email|unique:users,email,'.$user->id,
            // 'phone' => 'required|unique:enterprises,phone,'.$user->enterprise->id,
            'count_of_brands' => 'required|numeric',

        ]);

        
        if (!$validator->fails()) {
            try {
                DB::beginTransaction();
            $user->enterprise->name_ar = $request->name_ar;
            $user->enterprise->name_en = $request->name_en;
            $user->enterprise->commercial_registration_number     = $request->commercial_registration_number;
            $user->enterprise->email = $request->email;
            $user->enterprise->phone = $request->phone;
            $user->enterprise->count_of_brands = $request->count_of_brands;
            $user->enterprise->uuid = $request->uuid;
            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('images/enterprise', $imageName);
                $user->enterprise->image = $imageName;
            }
            $user->enterprise->save();
            $user->enterprise->currencies()->sync(json_decode($request->currencies, false));
            $user->enterprise->categorys()->sync(json_decode($request->categorys, false));

            
            $user->username =$user->enterprise->name_en;
            $user->email = $user->enterprise->email;

            $user->name = $request->name_en;
            $user->save();

            $country_ids = json_decode($request->country_id);
            enterprise_country::where('enterprise_id',$user->enterprise->id)->delete();
            enterprise_city::where('enterprise_id', $user->enterprise->id)->delete();
            enterprise_neighborhood::where('enterprise_id', $user->enterprise->id)->delete();
            for ($i = 0; $i < count($country_ids); $i++) {
                $enterpriseCountry = new enterprise_country();
                $enterpriseCountry->enterprise_id = $user->enterprise->id;
                $enterpriseCountry->country_id = $country_ids[$i];
                $enterpriseCountry->save();
                $cities = City::where('country_id', $country_ids)->get();
                foreach ($cities as $city) {
                    $citiesVendor = new enterprise_city();
                    $citiesVendor->enterprise_id = $user->enterprise->id;
                    $citiesVendor->city_id = $city->id;
                    $citiesVendor->save();
                    $Neighborhoods = Neighborhood::where('city_id', $city)->get();
                    foreach ($Neighborhoods as $Neighborhood) {
                        $citiesVendor = new enterprise_neighborhood();
                        $citiesVendor->enterprise_id = $user->enterprise->id;
                        $citiesVendor->neighborhood_id = $Neighborhood->id;
                        $citiesVendor->save();
                    }
                }
            }
  
            $isSaved = $user->enterprise->save();
            DB::commit();
            return response()->json(['icon' => 'success', 'title' => 'enterprsie created successfully'], $isSaved ? 200 : 400);
           
        } catch (\Exception $e) {
            DB::rollback();
            

            return response()->json(['icon' => 'error', 'title' =>'error when insert data'], 400);

        }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $enterprise =Enterprise::find($id);
        $enterprise->delete();
        return response()->json(['icon' => 'success', 'title' => 'enterprsie deleted successfully'], 200);

     

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {

        $enterprise = Enterprise::where('id', $id)->first();
         
        return response()->view('dashboard.enterprise.show', compact('enterprise'));
    }
}
