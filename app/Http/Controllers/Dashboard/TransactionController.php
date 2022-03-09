<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-transaction'])->only('index');
 
  
    }//end of constructor
    public function index()
    {
        $transactions =Transaction::where('enterprise_id',auth()->user()->ent_id)->orderBy('id','desc')->get(); 
        return view('dashboard.transaction.index')->with('transactions',$transactions);
    }
}
