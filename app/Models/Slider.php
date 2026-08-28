<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'heading', 'button_text', 'button_url', 'video_url', 'image', 'link', 'created_by', 'updated_by', 'ip_address'];
}
