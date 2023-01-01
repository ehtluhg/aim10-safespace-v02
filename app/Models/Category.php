<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'ss_categories';

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'image', 'id');
    }
}
