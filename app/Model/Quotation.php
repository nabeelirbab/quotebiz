<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Quotation extends Model
{
    use HasFactory;

        public function chatsp()
		  {
		    return $this->belongsTo('Acelle\Model\User','user_id');
		  }

        public function quote()
		  {
		    return $this->belongsTo('Acelle\Model\Quote','quote_id');
		  }

        public function wonquote()
		  {
		    return $this->belongsTo('Acelle\Model\Quote','quote_id')->where('status','won');
		  }

        public function quotestatus()
		  {
		    return $this->hasOne('Acelle\Model\QuotationStatus','quotation_id')->where('user_id','=', Auth::user()->id);
		  }

        public function chat()
		  {
		    return $this->hasMany('Acelle\Model\Chat','quotation_id');
		  }

        public function unread_msg()
		  {
		    return $this->hasMany('Acelle\Model\Chat','quotation_id')->where('receiver_id','=', Auth::user()->id)->whereNull('read_at');
		  }

        public function chatcustomer()
		  {
		    return $this->belongsTo('Acelle\Model\User','customer_id');
		  }
}
