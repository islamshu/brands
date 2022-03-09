<?php

namespace App\Exports;

use App\Models\CodeSubscription;
use Maatwebsite\Excel\Concerns\FromCollection;

class GeneralCode implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $id;
    public function __construct( $id) 
    {
        $this->id = $id;
    }
    
    public function collection()
    {
        return CodeSubscription::where('sub_id',$this->id)->get(['code','is_used']);
    }
}
