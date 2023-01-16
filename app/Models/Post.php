<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Friendship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'ss_posts';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'file_id',
        'status',
        'created_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function friend()
    {
        return $this->belongsTo(Friendship::class, 'created_by', 'friend_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
