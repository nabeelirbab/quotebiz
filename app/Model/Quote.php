<?php

namespace Acelle\Model;
use Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

public function user()
		  {
		    return $this->belongsTo('Acelle\Model\User','user_id');
		  }

public function category()
		  {
		    return $this->belongsTo('Acelle\Model\Category','category_id');
		  }

public function quotations()
		  {
		    return $this->hasMany('Acelle\Model\Quotation','quote_id','id');
		  }

public function myquotation()
		  {
		    return $this->hasOne('Acelle\Model\Quotation','quote_id','id')->where('user_id','=', Auth::user()->id);
		  }
		  
public function questionsget()
	    {
	        return $this->hasMany('Acelle\Model\QuoteQuestion','quote_id');
	    } 
}
