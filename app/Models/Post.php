<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_tr', 'title_en', 'slug', 'content_tr', 'content_en', 'status', 'featured_image',
    ];
}





