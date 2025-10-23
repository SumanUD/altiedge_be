<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageRepeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'section_key',
        'image',
        'name',
        'designation',
        'description',
    ];
}
