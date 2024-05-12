<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFieldTitle extends Model
{
    use HasFactory;

       protected $table = 'custom_filed_titles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'subdomain',
        'title',
    ];

    /**
     * Get the category that owns the custom field title.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
