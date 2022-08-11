<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDesign extends Model
{
    use HasFactory;

     public static function get($name, $defaultValue=null)
    {
        $design = JobDesign::where('subdomain',request('account'))->first();
        if($design){
           return $design->$name;
        }else{
           return null;
        }
    } 
}

