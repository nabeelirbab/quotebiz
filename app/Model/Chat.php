<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('Acelle\Model\User','receiver_id')->select('id','first_name','last_name');
    }
}
