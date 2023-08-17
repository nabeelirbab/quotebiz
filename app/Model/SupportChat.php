<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportChat extends Model
{
    use HasFactory;

     public function supportchatimg()
    {
        return $this->hasMany('Acelle\Model\SupportImage','support_chat_id');
    }
}
