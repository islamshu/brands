<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\FaqsCollection;
use App\Http\Resources\PageCollection;
use App\Http\Resources\PageResoures;
use App\Http\Resources\WorkResoures;
use App\Models\About;
use App\Models\Faqs;
use App\Models\HowItWork;
use App\Models\Privacy;
use App\Models\SystemInfo;
use App\Models\Termis;

class PageController extends BaseController
{
    public function privacy(){
        $res['status']= $this->sendResponse200('OK');
        $res['data']['privacy_policy'] = new PageCollection(Privacy::get());
        return $res;  
    }
    public function terms(){
        $res['status']= $this->sendResponse200('OK');
        $res['data']['term_and_conditions'] = new PageCollection(Termis::get());
        return $res;  
    }
    public function abouts(){
        $res['status']= $this->sendResponse200('OK');
        $res['data']['about_us'] = new PageCollection(About::get());
        return $res;  
    }
    public function faqs(){
        $res['status']= $this->sendResponse200('OK');
        $res['data']['FAQs'] = new FaqsCollection(Faqs::get());
        return $res;  
    }
    public function works(){
        $res['status']= $this->sendResponse('OK');
        $res['data']['how_it_work'] = new WorkResoures(HowItWork::first());
        return $res;  
    }
}
