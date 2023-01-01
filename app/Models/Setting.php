<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'ss_settings';

    protected $fillable = [
        'website_name',
        'logo',
        'favicon',
        'description'
    ];
}
