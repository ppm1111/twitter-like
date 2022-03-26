<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharePost extends Model
{
    protected $table = 'share_posts';

    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
