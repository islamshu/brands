<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Enterprise;
use App\Models\enterprise_country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
        $country = Country::all();
            return response()->view('dashboard.country.index', compact('country'));
        }
        elseif(Auth::user()->hasRole('Enterprises')){
            $enterprise = Enterprise::find(Auth::user()->ent_id);
            $country = enterprise_country::where('enterprise_id', Auth::user()->ent_id)->with('country')->get();
            return response()->view('dashboard.country.indexEnterprise', compact('country', 'enterprise'));
        }elseif(Auth::user()->hasRole('Vendor')){

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('dashboard.country.create');
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
            'callingCodes' => 'required',
            'nativeName' => 'required|string|min:3',
            'name' => 'required|string|min:3',
            'lat' => 'required',
            'lng' => 'required',
            'flag' => 'required',
            'alpha2Code' => 'required',
            'alpha3Code' => 'required',


        ]);
        
            $new_country = new Country();
            $new_country->country_code = $request->callingCodes;
            $new_country->country_name_ar = $request->nativeName;
            $new_country->country_name_en = $request->name;
            $new_country->lat = $request->lat;
            $new_country->lng = $request->lng;
            $new_country->flag = $request->flag;
            $new_country->alph2code = $request->alpha2Code;
            $new_country->alph3code = $request->alpha3Code;
 
            $IsSave = $new_country->save();
             if ($IsSave) {
                $request->session()->flash('status', 'alert-success');
                $request->session()->flash('message', 'Country created successfully');
                return redirect()->back();
            } else {
                $request->session()->flash('status', 'alert-danger');
                $request->session()->flash('message', 'Country create failed!');
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
        return response()->view('dashboard.country.edit');
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
