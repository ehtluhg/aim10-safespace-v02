<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'ss_user_details';

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
        'birthdate',
        'gender',
        'file_id'
    ];
}
