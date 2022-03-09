<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        return response()->view('dashboard.currency.index', compact('currencies'));
    
    }
    public function updateStatus(Request $request)
    {
        $user = Currency::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'Curruncy status updated successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('dashboard.currency.create');
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'code' => 'required',
        ]);
         if (!$validator->fails()) {
      $currency=  Currency::create($request->all());
       
        return response()->json(['icon' => 'success', 'title' => 'currency created successfully'], $currency ? 200 : 400);
    } else {
        return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit($locale ,$id)
    {
        return response()->view('dashboard.currency.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update_currency(Request $request, $id)
    {
        $currency =Currency::find($id);
        $validator = Validator($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'code' => 'required',
        ]);
       $currency->update($request->all());
        if (!$validator->fails()) {
        return response()->json(['icon' => 'success', 'title' => 'currency created successfully'], $currency ? 200 : 400);
    } else {
        return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy( $locale ,$id)
    {
        $enterprise =Currency::find($id);
        $enterprise->delete();
        if($enterprise->delete()){
            return response()->json(['icon' => 'success', 'title' => 'Currency deleted successfully'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'error when delete'], 400);
        }
    }
}
