<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Acelle\Model\Question;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
     protected $fillable = [
        'category_name', 'category_icon', 'user_id', 'category_description'
    ];

      public function questions()
      {
        return $this->hasMany('Acelle\Model\Question');
      }
}
