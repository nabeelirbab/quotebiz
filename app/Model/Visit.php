<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'visitor_ip','track_type'];

    public function profile()
    {
        return $this->hasMany(User::class, 'user_id', 'id')->where('track_type','profile_view');
    }

}
