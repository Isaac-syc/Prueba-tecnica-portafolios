<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portafolio extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'image_name',
        'public',
        'user_id'
    ];
}
