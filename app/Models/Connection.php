<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'connection_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  
    }
    public function connectedUser()
    {
        return $this->belongsTo(User::class, 'connected_user_id');
    }

    public static function getConnectionStatus($id1, $id2)
    {
        $connection = self::where(function ($query) use ($id1, $id2) {
            $query->where('user_id', $id1)
                ->where('connected_user_id', $id2);
        })
            ->orWhere(function ($query) use ($id1, $id2) {
                $query->where('user_id', $id2)
                    ->where('connected_user_id', $id1);
            })
            ->first();

        if ($connection) {
            return $connection->status;
        }
    }
}
