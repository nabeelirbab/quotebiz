<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFieldChoice extends Model
{
    use HasFactory;

    public function customField()
    {
        return $this->belongsTo('Acelle\Model\CustomField', 'custom_field_id');
    }
}
