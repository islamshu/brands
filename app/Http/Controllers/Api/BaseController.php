<?php
 
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller  
{

    public function SendDeleteRquest()
    {
        $response = ['status' => true ,'HTTP_code'=>410,'HTTP_response'=>'Gone'];
        return $response;   
    }
    public function sendResponse($status){   
        $response = ['status' => true ,'HTTP_code'=>201,'HTTP_response'=>$status];
        return $response;    
    }
    public function sendResponsewithMessage($status,$title,$message){   
        $response = ['status' => true ,'HTTP_code'=>201,'HTTP_response'=>$status,'title'=>$title,'message'=>$message];
        return $response;    
    }
    public function sendResponse200($status){   
        $response = ['status' => true ,'HTTP_code'=>200,'HTTP_response'=>$status];
        return $response;    
    }
    public function sendNewErorr($title,$msg){   
        $response = ['status' => true ,'HTTP_code'=>502,'HTTP_response'=>'Bad Gateway','title'=>$title,'message'=>$msg];
        return $response;    
    }
    

        public function SendError( $code = 404){
            $response = ['status' => false,'HTTP_code'=>404,'HTTP_response'=>'Not Found'];
     
            return $response;
        }
    public function UnAuth( $code = 404){
        $response = ['status' => false,'HTTP_code'=>404,'HTTP_response'=>'Unauthorized', 'message' => 'Unauthorized or Signed in from another device'];
 
        return $response;
    }
}