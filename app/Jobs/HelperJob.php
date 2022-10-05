<?php

namespace Acelle\Jobs;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Acelle\Model\Category;
use Acelle\Model\StripeKey;
use Acelle\Model\CreditAmount;
use Acelle\Model\Setting;
use Acelle\Model\DateFormet;
use Acelle\Model\User;
use Acelle\Model\JobDesign;
use Acelle\Model\QuotePrice;
use Acelle\Model\AdminCurrency;
use Acelle\Model\SiteSetting;
use Acelle\Model\SubCategory;
use Acelle\Model\Country;
use Acelle\Model\State;
use Acelle\Model\City;
use Acelle\Library\ExtendedSwiftMessage;

class HelperJob extends Base
{
    
    public static function supercategories(){
        return Category::where('cat_parent','0')->orderBy('category_name','desc')->get();
    }

    public static function categories(){
       $category =  Category::where('subdomain','=',request('account'))->where('cat_parent_id',0)->orderBy('category_name','desc')->get();
       if(count($category)){
          return $category;
       }else{
          return Category::where('cat_parent','0')->orderBy('category_name','desc')->get();
       }

    }

    public static function mycategories(){
       $category =  Category::where('subdomain','=',request('account'))->where('cat_parent_id',0)->orderBy('category_name','desc')->get();
          return $category;
    }

    public static function mysubcategories($id){
       $category =  Category::where('cat_parent_id','=',$id)->orderBy('category_name','desc')->get();
          return $category;
    }

    public static function categoryDetail($id){
       $category =  Category::where('id','=',$id)->first();
          return $category;
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

    public static function setcurrency($to,$amount){
      
      $currency = AdminCurrency::where('subdomain',request('account'))->first();
        if($currency){
          $code = $currency->code;
        }else{
          $code = 'USD';
        } 

      $covert = Currency::convert()
        ->from($to)
        ->to($code)->amount($amount)->round(2)
        ->get();
          // dd(['convert' => $covert, 'currency' => $code]);
        return ['convert' => $covert, 'currency' => $code] ;
    }

    public static function usdcurrency($amount){
      $currency = AdminCurrency::where('subdomain',request('account'))->first();
        if($currency){
          $code = $currency->code;
        }else{
          $code = 'USD';
        }
      $covert = Currency::convert()
        ->from('USD')
        ->to($code)->amount($amount)->round(2)
        ->get();
          // dd(['convert' => $covert, 'currency' => $code]);
        return ['convert' => $covert, 'currency' => $code] ;
    }

    public static function convertusd($amount){
      $currency = AdminCurrency::where('subdomain',request('account'))->first();
        if($currency){
          $code = $currency->code;
        }else{
          $code = 'USD';
        }
      $covert = Currency::convert()
        ->from($code)
        ->to('USD')->amount((float) str_replace(',', '',$amount))->round(2)
        ->get();
          // dd(['convert' => $covert, 'currency' => $code]);
        return ['convert' => $covert, 'currency' => $code] ;
    }

    public static function site_setting(){
      return  SiteSetting::where('subdomain',request('account'))->first();
    }

    public static function categoryname(){
      return  User::where('subdomain',request('account'))->where('user_type','admin')->first()->category_id;
    }
    public static function countries(){
        return  Country::all();
    }
    public static function countryname($id){
        return  Country::where('id',$id)->first();
    }
    public static function statename($id){

        return  State::where('id',$id)->first();
    }
    public static function cityname($id){
        return  City::where('id',$id)->first();
    }

}
