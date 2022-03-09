<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\CodePermfomed;
use App\Models\Offer;
use App\Models\Offerimage;
use App\Models\Offertype;
use App\Models\Performed;
use App\Models\Vendor;
use App\User;
use Session;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use File;

class OfferImport implements ToCollection
{
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }



    public function collection(Collection $rows)
    {
        // dd($rows);
        // dd( $this->id);
        // $per->total_codes = 


        // dd($image);
        // File::copy(public_path('images/brand/'.$image), public_path('images/primary_offer/'.$image));
        foreach ($rows as $key => $row) {

            if ($key == 0) {
                continue;
            }
            //   dd();
            // dd()
            $offer = new Offer();
            $offer->vendor_id = (int)$row[20];
            $offer->name_ar = str_replace('_',' ',$row[0]);
            $offer->name_en = $row[1];
            $offer->desc_ar =  $row[2];
            $offer->desc_en = $row[3];
            $offer->terms_ar =  $row[4];
            $offer->terms_en =  $row[5];
            $offer->member_type = $row[6];
            $offer->usege_member =  $row[7];
            $offer->usage_member_number =  $row[8];
            $offer->usege_system =  $row[9];
            $offer->usage_number_system =  $row[10];
            $offer->system_point = $row[18];
            $offer->store_point = $row[19];

            // $offer->price =  $row[11];
            $offer->start_time =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('Y-m-d H:i:s');
            $offer->end_time =   \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])->format('Y-m-d H:i:s');
            $offer->datetime_use = 'deactive';
            $offer->systemCoupon_use = 'deactive';
            $offer->exchange_cash = 'deactive';
            $offer->payment_type = 'cash';
            $offer->sort =  (int)$row[17];
            $offer->save();
            $offertype = new Offertype();
            $offertype->offer_id = $offer->id;
            $offertype->offer_type = $row[13];
            $offertype->price = $row[14];
            // $offertype->price = $row[15];
            $offertype->price_after_discount= $row[14];
            $offertype->price_befor_discount = $row[15];
            $offertype->discount_value = $row[16];
            $offertype->discount_type = 'persantage';
            $offertype->save();
            $offerimage = new Offerimage();
            $offerimage->offer_id =  $offer->id;
            $offerimage->primary_image =$row[21] ;
            $array = [];
            array_push($array, $row[21]);
            $offerimage->image = json_encode($array);
            $offerimage->save();
        }
        // return redirect()->back();

    }
}
