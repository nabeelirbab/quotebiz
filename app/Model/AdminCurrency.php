<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCurrency extends Model
{
    use HasFactory;

    public static function currency(){
    	$currency = AdminCurrency::where('subdomain',request('account'))->first();
    	if($currency){
            return $currency->code;
    	}else{
    		return 'USD';
    	}
    }
}
