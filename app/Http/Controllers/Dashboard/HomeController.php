<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
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

        //create read update delete
        $this->middleware(['permission:sale-repots'])->only('sales');
        $this->middleware(['permission:transaction-repots'])->only('transaction');
        $this->middleware(['permission:branches-repots'])->only('branch_repots');

    }//end of constructor

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
        if($request->from != null ||  $request->to != null ){
            if($request->to == null){
                $trans = Transaction::where('vendor_id',auth()->user()->vendor_id)->whereBetween('created_at', [$request->from,Carbon::now()->format('Y-m-d')])->get();

            }
            
            $trans_count = Transaction::where('vendor_id',auth()->user()->vendor_id)->whereBetween('created_at', [$request->from, $request->to])->count();
        }else{

            $trans = Transaction::where('vendor_id',auth()->user()->vendor_id)->get();
            $trans_count = Transaction::where('vendor_id',auth()->user()->vendor_id)->count();
        }
        // dd(auth()->user()->vendor_id);
        // $trans = Transaction::where('vendor_id',auth()->user()->vendor_id)->get();
        // $trans_count = Transaction::where('vendor_id',auth()->user()->vendor_id)->count();
        $branch = [];
        $offer =[];
        $users =[];
        $sales =[];
        foreach($trans as $tr){
            array_push($branch,$tr->branch_id);
            array_push($offer,$tr->offer_id);
            array_push($users,$tr->client_id);
            if($tr->offer_type != null && $tr->offer_type != 'general_offer'){
                array_push($sales ,$tr->price);
            }
        }
        
        $clients = Clinet::whereIn('id',$users)->get();
        $most_nat = [];
        foreach($clients as $client){
            array_push($most_nat,$client->nationality);
        }
      
  

        if($offer != null){
            $counts = array_count_values($offer);
            arsort($counts);
        }else{
            $counts = 0;
        }
        if($branch != null){
            $count_branch = array_count_values($branch);
            arsort($count_branch);
        }else{
            $count_branch = 0;
        }
        if($most_nat != '[]'){
            // dd($most_nat);
            if(count($most_nat) > 0 && $most_nat[0] != null){
                $natonalitss = array_count_values($most_nat);
                arsort($natonalitss);
            }else{
                $natonalitss = 0;
            }
           
        }else{
            $natonalitss = 0;
        }
        
     
        
        if($counts == 0){
            $most_offer_use = 0; 
        }else{
            $most_offer_use = key($counts);
        }
        if($count_branch == 0){
            $most_branch_use = 0; 
        }else{
            $most_branch_use = key($count_branch);
        }
        if($natonalitss == 0){
            
            $most_natonalities_use = 0; 
        }else{
            $most_natonalities_use = key($natonalitss);
        }
        


     
        $active_offer = Offer::whereIn('id',$offer)->where('end_time','>=',Carbon::now())->where('status',1)->count();
        $finish_offer = Offer::whereIn('id',$offer)->where('end_time','<=',Carbon::now())->where('status',0)->count();
        $branches = count(array_unique($branch, SORT_REGULAR));
        $uniqeuser = (array_unique($users, SORT_REGULAR));
        $natonalits = Clinet::whereIn('id',$uniqeuser)->where('nationality','!=',null)->count();
        $sale_count = (array_sum ($sales));
       


        return view('dashboard.repots.sales', compact('most_natonalities_use','sale_count','request','branches','active_offer','finish_offer','trans_count','natonalits','most_offer_use','most_branch_use'));
    }
    public function branch_repots()
    {
        $transa = Transaction::where('vendor_id',auth()->user()->vendor_id)->get();
        $branchs=[];
        foreach($transa as $tr){
            array_push($branchs,$tr->branch_id);
        }
        $branche_is = array_unique($branchs);
        $brs = Branch::whereIn('id',$branche_is)->get();
        return view('dashboard.repots.branches',compact('brs'));
    }
    public function transaction(Request $request){
        $query = Transaction::query()->where('vendor_id',auth()->user()->vendor_id);
        $query->when($request->referance, function ($q) use ($request) {  
            return $q->where('refreance_number', $request->referance);
        });
        $query->when($request->branch_id, function ($q) use ($request) {
            return $q->where('branch_id', $request->branch_id);
        });
        $query->when($request->from, function ($q) use ($request) {
            if($request->to == null && $request->from != null){
                return $q->whereBetween('created_at', [$request->from,Carbon::now()->format('Y-m-d')]);
            }elseif($request->to != null && $request->from == null){
                return $q->whereBetween('created_at', [Carbon::now()->format('Y-m-d'),$request->to,]);
            }else{
                return $q->whereBetween('created_at', [$request->from,$request->to,]);
            }
        });
        $trans = $query->get();
        $branches = Branch::where('vendor_id',auth()->user()->vendor_id)->get();
        return view('dashboard.repots.transaction',compact('request','trans','branches'));
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
