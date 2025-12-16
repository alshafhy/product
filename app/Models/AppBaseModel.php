<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Class AppBaseModel
 * @package App\Models
 */
class AppBaseModel extends Model
{

    public function scopeFilter($q,$sessionFilterName=""){

        if ($sessionFilterName && session($sessionFilterName)){
            $filterArray = session($sessionFilterName);
            // dd($filterArray);
            foreach ($filterArray as $key => $value) {
                if($value){
                    // if (str_contains($key,"||")){
                    //     $arr =explode("||",$key);
                    //     $key =$arr[0];
                    // }
                    if (str_contains($key,"from_")){
                        $q = $q->where(str_replace("from_","",$key),">=",$value);
                    }elseif(str_contains($key,"to_")){
                        $q = $q->where(str_replace("to_","",$key),"<=",$value);
                    }else{
                        $q = $q->where($key,$value);
                    }  
                }
            }
            $filterArray = session($sessionFilterName);
        }

        // if (request('price_from')) {
        //     $q->where('price', '>', request('price_from'));
        // }
        // if (request('color')) {
        //     $q->where('color', '>', request('color'));
        // }
    
        return $q;
    }


}
