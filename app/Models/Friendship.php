<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $table = "ss_friends";

    protected $fillable = [
        'user_id',
        'friend_id',
        'status'
    ];

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}