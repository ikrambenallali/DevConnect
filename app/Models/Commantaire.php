<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commantaire extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];
    protected $table = 'commantaire'; 

    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
