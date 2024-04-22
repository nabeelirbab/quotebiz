<?php

namespace Acelle\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureBar extends Model
{
    use HasFactory;

    public function saveFeatureBar($data)
    {
        // dd($data);
        $this->user_id = $data['user_id'];
        $this->subdomain = $data['subdomain'];
        $this->feature1 = $data['feature1'];
        $this->feature2 = $data['feature2'];
        $this->feature3 = $data['feature3'];
        $this->feature4 = $data['feature4'];
        $this->icon1 = $data['icon1'];
        $this->icon2 = $data['icon2'];
        $this->icon3 = $data['icon3'];
        $this->icon4 = $data['icon4'];
        $this->feature1status = $data['feature1status'] ?? 0;
        $this->feature2status = $data['feature2status'] ?? 0;
        $this->feature3status = $data['feature3status'] ?? 0;
        $this->feature4status = $data['feature4status'] ?? 0;
        $this->status = $data['status'] ?? 1; // Default to 'active' if not provided
        $this->save();
    }
}
