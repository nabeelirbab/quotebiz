<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    public function supportchat()
    {
        return $this->hasMany('Acelle\Model\SupportChat','support_id');
    }
    public function supportuser()
    {
        return $this->belongsTo('Acelle\Model\User','user_id')->select('id','first_name','last_name','user_type','email','user_img','mobileno','address');
    }
}
