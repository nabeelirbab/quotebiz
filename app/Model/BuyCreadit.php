<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCreadit extends Model
{
    use HasFactory;

     public function users()
    {
        return $this->belongsTo('Acelle\Model\User','user_id');
    }
}
