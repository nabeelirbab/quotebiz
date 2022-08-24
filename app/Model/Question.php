<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Acelle\Model\QuestionChoice;
use Acelle\Model\Category;

class Question extends Model
{
     use HasFactory;
     protected $fillable = [
        'category_id', 'question','choice_selection', 'user_id'  ];

   public function categories()
		  {
		    return $this->belongsTo('Acelle\Model\Category','category_id');
		  }

   public function subcategories()
      {
        return $this->belongsTo('Acelle\Model\Category','subcategory_id');
      }

    public function choices()
      {
        return $this->hasMany('Acelle\Model\QuestionChoice');
      }
}
