<?php

namespace Acelle\Jobs;
use Acelle\Model\Category;
use Acelle\Model\StripeKey;
use Acelle\Model\CreditAmount;
use Acelle\Model\Setting;
use Acelle\Model\DateFormet;
use Acelle\Model\User;
use Acelle\Model\JobDesign;
use Acelle\Model\QuotePrice;
use Acelle\Library\ExtendedSwiftMessage;

class HelperJob extends Base
{
    
    public static function supercategories(){
    	// dd(Category::orderBy('category_name','desc')->get());
        return Category::where('cat_parent','0')->orderBy('category_name','desc')->get();
    }

    public static function categories(){
        // dd(Category::orderBy('category_name','desc')->get());
       $category =  Category::where('subdomain','=',request('account'))->orderBy('category_name','desc')->get();
       if(count($category)){
          return $category;
       }else{
          return Category::where('cat_parent','0')->orderBy('category_name','desc')->get();
       }

    }


    public static function stripekey(){

    	return StripeKey::where('subdomain',request('account'))->first()->stripe_key;
    }

    public static function creditAmounts(){

        return CreditAmount::where('subdomain',request('account'))->orderBy('credit_amount','asc')->get();
    }

    public static function mask_email($email, $masks = 5) {
        $array = explode("@", $email);
        $string_length = strlen($array[0]);
        if ($string_length < $masks)
            $masks = $string_length;
        $result = substr($array[0], 0, -$masks) . str_repeat('*', $masks);
        return $result."@".$array[1];
    }

   public static function hide_mobile_no($number)
    {
        return substr($number, 0, 2) . '******' . substr($number, -2);
    }

    public static function dateFormat(){

       $result =  User::where('subdomain',request('account'))->where('user_type','admin')->first();
       // dd($result);
       if($result){
           return $result->date_format;
        }else{
            return 'd/m/Y';
        }
    }


   public static function form_design()
    {
        return JobDesign::where('subdomain',request('account'))->first();
    }

    public static function quoteprice(){
      return QuotePrice::where('subdomain',request('account'))->first();
    }
}
