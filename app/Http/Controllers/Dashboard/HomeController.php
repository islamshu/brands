<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Clinet;
use App\Models\Offer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Session;
use Carbon\Carbon;
use DB;
use Facade\FlareClient\Http\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function sales(Request $request){
        // if($request->from != null ||  $request->to != null ){

        // }
        $trans = Transaction::where('vendor_id',698)->get();
        $trans_count = Transaction::where('vendor_id',698)->count();
        $branch = [];
        $offer =[];
        $users =[];
        foreach($trans as $tr){
            array_push($branch,$tr->branch_id);
            array_push($offer,$tr->offer_id);
            array_push($users,$tr->client_id);
        }
        
        $clients = Clinet::whereIn('id',$users)->get();
        $most_nat = [];
        foreach($clients as $client){
            array_push($most_nat,$client->nationality);
        }
    //    $best_offers =  DB::table('offers')
    //     ->leftJoin('transactions','offers.id','=','transactions.offer_id')
    //     ->selectRaw('offers.*, COALESCE(sum(transactions.offer_id),0) offer_id')
    //     ->groupBy('offers.id')
    //     ->orderBy('offer_id')
    //     ->take(1)
    //     ->get();
    //     dd($best_offers);


        $counts = array_count_values($offer);
        arsort($counts);
        $count_branch = array_count_values($branch);
        arsort($count_branch);
        
        $natonalitss = array_count_values($most_nat);
        arsort($natonalitss);
        $most_offer_use = key($counts);
        $most_branch_use = key($count_branch);
        $most_natonalities_use = key($natonalitss);
        dd($most_natonalities_use);


     
        $active_offer = Offer::whereIn('id',$offer)->where('end_time','>=',Carbon::now())->where('status',1)->count();
        $finish_offer = Offer::whereIn('id',$offer)->where('end_time','<=',Carbon::now())->where('status',0)->count();
        $branches = count(array_unique($branch, SORT_REGULAR));
        $uniqeuser = (array_unique($users, SORT_REGULAR));
        $natonalits = Clinet::whereIn('id',$uniqeuser)->where('nationality','!=',null)->count();


        return view('dashboard.repots.sales', compact('request','branches','active_offer','finish_offer','trans_count','natonalits','most_offer_use','most_branch_use'));
    }
   
    function lang($local){

        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        
       
        Session::put('lang', $local);
        
        
        return redirect()->route($route,$local);
    }

    public function show_translate($local,$lang)
    {
        $language = $lang;
        
        return view('languages.language_view_en', compact('language'));
    }
    public function key_value_store(Request $request)
    {
        $data = openJSONFile($request->id);
        foreach ($request->key as $key => $key) {
            $data[$key] = $request->key[$key];
        }
        saveJSONFile($request->id, $data);
        return back();
    }

}
