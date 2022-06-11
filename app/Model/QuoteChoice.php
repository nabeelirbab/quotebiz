<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteChoice extends Model
{
    use HasFactory;

   
	 public function quotequestion()
	    {
	        return $this->belongsTo('Acelle\Model\QuoteQuestion','quote_question_id');
	    }

      public function choice()
		  {
		    return $this->belongsTo('Acelle\Model\QuestionChoice','choice_id');
		  }
}
