<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\City;
use App\Models\CodePermfomed;
use App\Models\Performed;
use App\User;
use Session;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;

class Branchimport implements ToCollection     
{
    private $id;
    public function __construct( $id) 
    {
        $this->id = $id;
    }
    
   

    public function collection(Collection $rows)
    {
        // dd($rows);
        // dd( $this->id);
        // $per->total_codes = 
       
      
        foreach($rows as $key =>$row){
 
            if($key == 0 ){
                continue;
            }
            // dd($row[7]);
            $new_branch = new Branch();
            $new_branch->vendor_id = (int) $this->id;
            $new_branch->name_ar = $row[0];
            $new_branch->name_en = $row[1];
            $city = City::where('city_name','like','%'.$row[2].'%')->first()->id;
            $new_branch->city_id =  $city;
            $new_branch->neighborhood_id = $row[3];
            $new_branch->latitude =  $row[4];
            $new_branch->longitude =  $row[5];
            $new_branch->phone = $row[6];
            $new_branch->street=  $row[7];
            $new_branch->street_en =  $row[8];
            $new_branch->status =  'active';
            $new_branch->save();

        } 
        // return redirect()->back();
        
    }
 


    
}