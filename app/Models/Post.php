<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = false;
    protected $fillable = ['title', 'body', 'image', 'name'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
