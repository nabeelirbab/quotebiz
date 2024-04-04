<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFieldAnswer extends Model
{
    protected $table = 'custom_filed_answers';

    protected $fillable = [
        'custom_field_id',
        'custom_field_choice_id',
        'user_id',
        'answer',
    ];

     public function customField()
    {
        return $this->belongsTo('Acelle\Model\CustomField', 'custom_field_id');
    }

    public function user()
    {
        return $this->belongsTo('Acelle\Model\User', 'user_id');
    }

    public function choice()
    {
        return $this->belongsTo('Acelle\Model\CustomFieldChoice', 'custom_field_choice_id');
    }
}
