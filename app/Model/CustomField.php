<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
	use HasFactory;
    protected $fillable = ['user_id', 'subdomain', 'question'];

   
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
        return $this->hasMany('Acelle\Model\CustomFieldChoice');
      }

      public function answers()
      {
        return $this->hasMany('Acelle\Model\CustomFieldAnswer','custom_field_id','id');
      }
}
