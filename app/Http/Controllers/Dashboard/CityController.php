<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Enterprise;
use App\Models\enterprise_city;
use App\Models\Vendor;
use App\Models\Vendor_cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-city'])->only('index');
        $this->middleware(['permission:create-city'])->only('create');
        $this->middleware(['permission:update-city'])->only('edit');
        $this->middleware(['permission:delete-city'])->only('destroy');

    }//end of constructor
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
        $cities = City::with('country')->get();
        return response()->view('dashboard.city.index',compact('cities'));
        }elseif(Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('read-city')){
            $enterprise = Enterprise::find(Auth::user()->ent_id);
            $cities = enterprise_city::where('enterprise_id', Auth::user()->ent_id)->get();
            
          
            return response()->view('dashboard.city.index', compact('enterprise', 'cities'));
        }

    }
    public function updateStatus(Request $request)
    {
    
        $user = City::find($request->id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'city status updated successfully.']);
    }
    public function update_enterprice_Status(Request $request)
    {
    
        $user = enterprise_city::find($request->id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'city status updated successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        return response()->view('dashboard.city.create',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'city_name' => 'required|string|min:3',
            'city_name_en' => 'required|string|min:3',
            'lat' => 'required',
            'lng' => 'required',
            'country_id' => 'required',
        ]);
        
            $new_city = new City();
            $new_city->country_id = $request->country_id;
            $new_city->city_name = $request->city_name;
            $new_city->city_name_english = $request->city_name_en;
            $new_city->lat = $request->lat;
            $new_city->lng = $request->lng;
            $new_city->save();
            $vendors = Vendor::all();
            foreach ($vendors as $vendor) {
                $citiesVendor = new Vendor_cities();
                $citiesVendor->vendor_id = $vendor->id;
                $citiesVendor->status = 'deactive';
                $citiesVendor->city_id = $new_city->id;
                $citiesVendor->save();
            }
            $Enterprises = Enterprise::all();
            foreach ($Enterprises as $Enterprise) {
                $citiesVendor = new enterprise_city();
                $citiesVendor->enterprise_id = $Enterprise->id;
                $citiesVendor->status = 'deactive';
                $citiesVendor->city_id = $new_city->id;
                $citiesVendor->save();
            }
            $IsSave = $new_city->save();
            if ($IsSave) {
                $request->session()->flash('status', 'alert-success');
                $request->session()->flash('message', 'City created successfully');
                return redirect()->back();
            } else {
                $request->session()->flash('status', 'alert-danger');
                $request->session()->flash('message', 'City create failed!');
                return redirect()->back();
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->view('dashboard.city.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
