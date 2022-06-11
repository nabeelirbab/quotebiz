<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteQuestion extends Model
{
    use HasFactory;
     public function quotes()
    {
        return $this->belongsTo('Acelle\Model\Quote');
    }

    public function choice()
    {
        return $this->hasMany('Acelle\Model\QuoteChoice','quote_question_id');
    } 
    public function questions()
		  {
		    return $this->belongsTo('Acelle\Model\Question','question_id');
		  }
}
