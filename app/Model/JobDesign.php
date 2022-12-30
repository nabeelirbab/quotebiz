<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Acelle\Model\Setting;

class JobDesign extends Model
{
    use HasFactory;

     public static function get($name, $defaultValue=null)
    {
        $design = JobDesign::where('subdomain',Setting::subdomain())->first();
        if($design){
           return $design->$name;
        }else{
           return null;
        }
    } 
}

