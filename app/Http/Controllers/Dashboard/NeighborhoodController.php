<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Enterprise;
use App\Models\enterprise_neighborhood;
use App\Models\Neighborhood;
use App\Models\Vendor;
use App\Models\Vendor_neighborhood;
use Illuminate\Http\Request;
use Auth;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {

        $Neighborhoods = Neighborhood::with('city')->get();
        return response()->view('dashboard.neighborhood.index',compact('Neighborhoods'));
    }elseif(Auth::user()->hasRole('Enterprises')){

        $Neighborhoods = enterprise_neighborhood::where('enterprise_id', Auth::user()->ent_id)->get();
      
        return response()->view('dashboard.neighborhood.index', compact('Neighborhoods'));
    }
    }
    public function update_enterprice_Status(Request $request)
    {
        $user = enterprise_neighborhood::find($request->id);
        
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'Neighborhood status updated successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return response()->view('dashboard.neighborhood.create',compact('countries'));
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
            'neighborhood_name' => 'required|string|min:3',
            'neighborhood_name_en' => 'required|string|min:3',
            'lat' => 'required',
            'lng' => 'required',
            'city_id' => 'required',
        ]);
        $new_neighborhood = new Neighborhood();
        $new_neighborhood->city_id = $request->city_id;
        $new_neighborhood->neighborhood_name = $request->neighborhood_name;
        $new_neighborhood->neighborhood_name_english = $request->neighborhood_name_en;
        $new_neighborhood->lat = $request->lat;
        $new_neighborhood->lng = $request->lng;
        $isSaved = $new_neighborhood->save();
        $vendors = Vendor::all();
        foreach ($vendors as $vendor) {
            $citiesVendor = new Vendor_neighborhood();
            $citiesVendor->vendor_id = $vendor->id;
            $citiesVendor->neighborhood_id = $new_neighborhood->id;
            // $citiesVendor->status = 'deactive';

            $citiesVendor->save();
        }
        $Enterprises = Enterprise::all();

        foreach ($Enterprises as $Enterprise) {
            $citiesVendor = new enterprise_neighborhood();
            $citiesVendor->enterprise_id = $Enterprise->id;
            // $citiesVendor->status = 'deactive';

            $citiesVendor->neighborhood_id = $new_neighborhood->id;
            $citiesVendor->save();
        }
        if ($isSaved) {
            $request->session()->flash('status', 'alert-success');
            $request->session()->flash('message', 'Neighborhood created successfully');
            return redirect()->back();
        } else {
            $request->session()->flash('status', 'alert-danger');
            $request->session()->flash('message', 'Neighborhood create failed!');
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
        return response()->view('dashboard.neighborhood.edit');
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
    public function get_cites_by_country()
    {
        return City::where('country_id', request()->country_id)->get();
    }
}
