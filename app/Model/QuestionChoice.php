<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Acelle\Model\Question;

class QuestionChoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'question_id', 'user_id','choice','icon'
    ];

    public function questions()
		  {
		    return $this->belongsTo('Acelle\Model\Question');
		  }
}
