<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'subtitle', 'image', 'badge_label', 'badge_icon',
        'price', 'highlights', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'highlights' => 'array',
    ];
}
