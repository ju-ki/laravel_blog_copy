<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["title", "slug"];


    public function posts()
    {
        //Postに対して紐づいている
        return $this->belongsToMany(Post::class);
    }


    public function publishedPosts()
    {
        //Postに対して紐づいている
        return $this->belongsToMany(Post::class)->where("active", "=", true)
            ->whereDate("published_at", "<", Carbon::now());
    }
}
