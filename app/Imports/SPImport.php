<?php

namespace Acelle\Imports;

use Acelle\Model\User;
use Acelle\Model\Setting;
use Acelle\Model\SpBusiness;
use Acelle\Model\Invitation;
use Acelle\Mail\SendInvitation;
use Illuminate\Support\Facades\DB;
use Mail;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class SPImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     public function  __construct($credits)
    {
        $this->credits= $credits;
    }
    public function model(array $row)
    {
        if($row['work_email'] != ''){
        $code = rand();
        $maildata = [
         'code' => $code,
         'name' => $row['name']
        ];
        $invite = new Invitation;
        $invite->subdomain = Setting::subdomain();
        $invite->email = $row['work_email'];
        $invite->name = $row['name'];
        $invite->credits = $this->credits;
        $invite->token =  $code;
        $invite->save();
        Mail::to($row['work_email'])->send(new SendInvitation($maildata));
    }
     
        // if($row['work_email'] == ''){
        //     $email = 'abc'.rand(10,100).'@gmail.com';
        // }else{
        //    $email = $row['work_email'];
        // }

        // $user = new User();
        // $user->first_name = $row['name'];
        // $user->email = $email;
        // $user->country = $row['country'];
        // $user->state = $row['state'];
        // $user->city = $row['city'];
        // $user->category_id = '['.Auth::user()->category->id.']';
        // $user->zipcode = $row['postcode'];
        // $user->subdomain = Setting::subdomain();
        // $user->address = $row['street'];
        // $user->user_type = 'service_provider'; // User Type User
        // $user->activated = 1;
        // $user->password = '$2y$10$xsrHVfSWKUEowpyfLWLklu/Ht1nhTMCg88x9rOBLXMh6dO4h8Ynr6';
        // $user->save();
    
        // $business = new SpBusiness;
        // $business->user_id = $user->id;
        // $business->business_name = 'Company'.rand(10,100);
        // $business->save();
    }
}
