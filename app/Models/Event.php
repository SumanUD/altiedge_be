<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_heading',
        'description',
        'gallery_images',
    ];

    protected $casts = [
        'gallery_images' => 'array',
    ];
}
