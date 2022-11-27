<?php

namespace Acelle\Imports;

use Acelle\Model\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // dd($row['work_email']);
    //     dd(new User([
    //         "first_name" => 'abc',
    //         "last_name" => 'cd',
    //         "email" => 'av@gmail.com',
    //         "country" => 'as',
    //         "state" => 'dd',
    //         "city" => '33',
    //         "zipcode" => 'ee',
    //         "subdomain" => request('account'),
    //         "address" => 'ee',
    //         "user_type" => 'client', // User Type User
    //         "activated" => 1,
    //         "password" => Hash::make('password')
    //     ])
    // );
        if($row['work_email'] == ''){
            $email = 'abc'.rand(10,100).'@gmail.com';
        }else{
           $email = $row['work_email'];
        }
        return new User([
            "first_name" => $row['name'],
            "email" => $email,
            "country" => $row['country'],
            "state" => $row['state'],
            "city" => $row['city'],
            "zipcode" => $row['postcode'],
            "subdomain" => request('account'),
            "address" => $row['street'],
            "user_type" => 'client', // User Type User
            "activated" => 1,
            "password" => '$2y$10$xsrHVfSWKUEowpyfLWLklu/Ht1nhTMCg88x9rOBLXMh6dO4h8Ynr6'
        ]);
    }
}
