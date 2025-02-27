<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class language_programmation extends Model
{
    use HasFactory;
    protected $table = 'language_prog'; 

    protected $fillable = [
        'content',
        'user_id',
    ];
}
