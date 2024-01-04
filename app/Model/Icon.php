<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use HasFactory;
     protected $fillable = [
        'icon', 'type'
    ];
}
