<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['titre','description','image','user_id','tag_id'];

  
    public function comments(){
        return $this->hasMany(Commantaire::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

}
