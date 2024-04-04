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
        return $this->hasMany('Acelle\Model\Question')->where('subcategory_id','=', 0)->orderBy('re_order','asc');
      }

      public function subquestions()
      {
        return $this->hasMany('Acelle\Model\Question','subcategory_id','id')->where('subcategory_id','!=', null)->orderBy('re_order','asc');
      }

      public function customs()
      {
        return $this->hasMany('Acelle\Model\CustomField')->where('subcategory_id','=', null)->orderBy('re_order','asc');
      }

      public function subcustoms()
      {
        return $this->hasMany('Acelle\Model\CustomField','subcategory_id','id')->where('subcategory_id','!=', null)->orderBy('re_order','asc');
      }

      public function subcategory()
      {
        return $this->hasMany('Acelle\Model\SubCategory');
      }
}
