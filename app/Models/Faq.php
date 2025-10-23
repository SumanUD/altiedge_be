<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    // Add these fields to allow mass assignment
    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];
}
