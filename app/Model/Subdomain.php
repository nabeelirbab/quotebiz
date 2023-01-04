<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdomain extends Model
{
    use HasFactory;

     public function user()
    {
        return $this->belongsTo('Acelle\Model\User');
    }
}
