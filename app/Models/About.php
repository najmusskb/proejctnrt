<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'subtitle', 'description', 'mission', 'image', 'image2',
        'checkmarks', 'button_text', 'button_link', 'button2_text', 'button2_link',
        'counter1_number', 'counter1_label', 'counter2_number', 'counter2_label',
        'badge_number', 'badge_label', 'updated_by', 'ip_address'
    ];
    protected $casts = ['checkmarks' => 'array'];
}
