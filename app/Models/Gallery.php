<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image', 'section', 'likes', 'comments', 'span', 'ip_address', 'created_by', 'updated_by'];
}
