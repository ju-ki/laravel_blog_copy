<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpvoteDownvote extends Model
{
    use HasFactory;

    protected $fillable = [
        "post_id",
        "is_upvote",
        "user_id"
    ];
}
